<?php

namespace Medians\Application\Orders;

use Medians\Infrastructure\Orders as Repo;
use Medians\Infrastructure\Devices\DevicesRepository;

use Medians\Application\Devices\DeviceController;
use Medians\Application as apps;
use Medians\Application\Orders\ProductOrder;
use Medians\Application\Calculator\Calculator;
use Medians\Application\Prices\PricesController;

use Medians\Domain\Orders\DeviceOrder;
use Medians\Domain\Orders\Order;

class DeviceOrderController
{

	/*
	// @var Object
	*/
	protected $repo;


	

	function __construct($deviceId = 0, $bookingType = 'unlimited', $playingType = 'single')
	{

		$this->device = $deviceId;
		$this->bookingType = $bookingType;
		$this->playingType = $playingType;

		$this->repo = new Repo\DeviceOrdersRepository();
		$this->devicesRepo = new DevicesRepository;

	}

	public function store_device_order($request, $app)
	{


		$params = $request->get('params');

        try {


        	$this->request = [];
			
			$this->repo->providerId = $app->providerSession->id;
			$this->repo->deviceId = $params['id'];
			$this->repo->orderCode = $this->genrateCode();
			$this->repo->startTime = date('Y-m-d H:i:s');
			$this->repo->endTime = isset($params['hours']) ? $this->handleEndTime($params['hours'], $params['minutes']) : null;
			$this->repo->lastCheck = date('Y-m-d H:i:s');
			$this->repo->insertedBy = $app->providerSession->id;
			$this->repo->deviceCost = $params['deviceCost'];
	    	$this->repo->status = 'active';
	    	$this->repo->bookingType = $params['bookingType'];
            $this->repo->save();

            $this->devicesRepo->find($this->repo->deviceId)->update(['playing'=> 1, 'publish'=>1]);

        	$returnData = (!empty($this->repo->status) && $this->repo->status == 'active') 
	        	? array('success'=>1, 'reload'=>1, 'data'=>'Done') 
	        	: array('error'=>$e->getMessage());
	        
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }

		return $returnData;

	}



	public function handleEndTime($hours = 1, $minutes = 0) 
	{
		$minutes = empty($minutes) ? 1 : $minutes;
		return date('Y-m-d H:i:s', strtotime("+$hours hours +$minutes minutes ")) ;
	}

	public function unsetEndTime() : void
	{
		$this->DeviceOrder->setEndTime(0);
	}


	public function getByOrderCode($orderCode = 0) 
	{

		$this->repo->setOrderCode($orderCode);

		return $this->repo->getByOrderCode();
	}

	public function getItem($deviceId = 0) 
	{

		return $this->repo->getByDevice($deviceId);
	}


	public function getPrices($id, $col)
	{
		$prices = (new Prices())->getItem($id);

		return ($prices->$col()) ? $prices->$col() : 0;
	} 


	public function calculate($cost, $startTime, $endTime) 
	{

		$interval = date_diff(new \DateTime($startTime) , new \DateTime($endTime));

		return (new Calculator
			( 	
				$cost, 
				$interval->format('%h'), 
				$interval->format('%i')
			)
		)->getCost(0);

	}	


	public function calculateCost()  
	{
		
		$this->deviceCost = $this->calculate($this->DeviceOrder->deviceCost(), $this->DeviceOrder->startTime(),$this->Order->endTime() );

		$this->checkProductsCost();

		return $this->deviceCost;
	}
	
	public function checkProductsCost()
	{
		$this->deviceCost =  ( $this->deviceCost + (new ProductOrder)->getDeviceActiveCost($this->DeviceOrder->device()->id) );
	} 

	public function calculateTime($time1, $time2) 
	{

		$start_date = new \DateTime($time1);

		return array_map(function($a){
			return ($a > 9) ? $a : '0'.$a;
		}, (array) $start_date->diff(new \DateTime($time2)));
	}

	public function submitOrder() 
	{

		if (empty($this->DeviceOrder->device()->id))
		{
			throw new \Exception("Device not defined ", 1);
		}


		// Prepare the Order
		$this->Order = Order::create($this->DeviceOrder);
		$this->Order->setDevice($this->DeviceOrder->device->id);
		$this->Order->setProviderId($this->DeviceOrder->providerId);
		$this->Order->setCode($this->DeviceOrder->orderCode());
		$this->Order->setStartTime($this->DeviceOrder->startTime());
		$this->Order->setEndTime(date('Y-m-d H:i:s'));
		$this->Order->setTime(date('Y-m-d H:i:s'));
		$this->Order->setCode($this->Order->genrateCode());
		$this->Order->setCost($this->calculateCost());
		$this->Order->setStatus('pending');

		$checkOrder = new Order();
		$checkOrder->setModel($this->Order);
			
		// Submit the order
		$this->Order =  $checkOrder->handle();

		// Update the orderCode
		$this->DeviceOrder->setOrderCode($this->Order->code());

		// Update the order status and times
		$this->finishOrder();

		// Update the products status of this order
		$this->updateProductOrder();

		return $this->Order;
	}


	public function finishOrder() : void
	{

		// Update the order information
		$this->DeviceOrder->setLastCheck(date('Y-m-d H:i:s'));
		$this->DeviceOrder->setEndTime(date('Y-m-d H:i:s'));
		$this->DeviceOrder->setStatus('completed');
		

		// Prepare the repo
		$this->repo = $this->repo->createItem($this->DeviceOrder);	
		$this->repo->setDevice($this->DeviceOrder->device()->id);	
		$this->repo->setId($this->DeviceOrder->id);	
		
		// Update the database
		$this->repo->edit();

	}

	
	public function updateProductOrder() : void
	{


		$ProductOrder = new ProductOrder();

		// Update the items by device and status
		$query = array(
			'providerId'=> $this->DeviceOrder->providerId,
			'device'=> $this->DeviceOrder->device()->id,
			'status'=> 'active'
		);

		// Fields that will be Updated 
		$updatedData = array('status'=>'completed', 'orderCode' => $this->Order->code());

		// Update through the Repo 
		$ProductOrder->editItemStatus($updatedData, $query, $this->Order->code());

	}


	public function updateLastCheck() : DeviceOrder
	{

		if ($this->DeviceOrder->status() == 'active')
		{
			$this->DeviceOrder->setLastCheck(date('Y-m-d H:i:s'));
			$this->DeviceOrder->setStatus('active');
		}

		return $this->executeEdit();
	}


	public function handle()
	{
		return isset($this->request->id) ? $this->repo->update($this->request) : $this->repo->create($this->request);
	}

	public function saveItem() : DeviceOrder
	{

		$this->DeviceOrder->setStatus('active');
		$this->DeviceOrder->setId(0);	
		$this->DeviceOrder->setBookingType($this->bookingType);	
		$this->DeviceOrder->setStartTime(date('Y-m-d H:i:s'));
		$this->DeviceOrder->setDeviceCost(!empty($this->DeviceOrder->device()) ? $this->getPrices($this->DeviceOrder->device()->id, $this->playingType.'_price') : 0);

		$this->repo = $this->repo->createItem($this->DeviceOrder);	
		$this->repo->setDevice($this->DeviceOrder->device()->id);	

		$this->respone = $this->repo->saveItem();	
		$this->respone->device = $this->DeviceOrder->device();	
		return DeviceOrder::create($this->respone);
	}


	public function editItem() : DeviceOrder
	{

		$this->DeviceOrder->setId($this->DeviceOrder->id);	

		return $this->executeEdit();
	}


	public function executeEdit() : DeviceOrder
	{

		$this->DeviceOrder->setLastCheck(date('Y-m-d H:i:s'));
		$this->repo = $this->repo->createItem($this->DeviceOrder);	
		$this->repo->setDevice($this->DeviceOrder->device()->id);	
		$this->repo->setId($this->DeviceOrder->id);	

		$this->respone = $this->repo->edit();	
		$this->respone->device = ((new Device())->getItem($this->respone->device));	
		return DeviceOrder::create($this->respone);

	}


	public function deleteItem() : DeviceOrder
	{

		$this->repo->setDevice($this->DeviceOrder->device()->id);	

		return $this->repo->remove();

	}

	public function validate() 
	{

		if (empty($this->data->device))
		{
			throw new \Exception("Empty device id ", 1);
		}

	}




	/*
	// Count methods
	*/
	public function getCountByMonth($providerId, $month = null)
	{
		$month = empty($month) ? date('Y-m') : $month;
		$nextmonth = date('Y-m', strtotime('+1 month', strtotime($month))) ;
		return $this->repo->getCountByMonth($providerId, $month, $nextmonth);
	} 


}

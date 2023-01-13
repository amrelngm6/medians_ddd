<?php

namespace Medians\Infrastructure\Orders;

use Medians\Domain\Orders\Order;
use Medians\Domain\Products\Stock;
use Medians\Domain\Devices\OrderDevice;
use Medians\Domain\Devices\OrderDeviceItem;

class OrdersRepository
{


	public $app;


	function __construct($app)
	{
		$this->app = $app;
	}


	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{
		return Order::with('items', 'order_devices')
		->find($id);
	}

	/**
	 * Find by code
	 */  
	public function code($code)
	{
		return Order::with('items', 'order_devices')
		->where('code', $code)->first();
	} 
	
	/*
	// Find items by `deviceId` 
	*/
	public function getByDevice($deviceId) 
	{

		return  Order::where('deviceId', $deviceId)
		->with('items')
		->with('device')
		->orderedBy('updated_at','DESC')
		->get();

	}


	/*
	// Find all items by month
	*/
	public function getTotalByMonth($month, $nextmonth )
	{
	  	return  Order::with('device')
	  			->with('device_orders')
	  			// ->with('Provider')
	  			->whereDate( 'endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($month))))
	  			->whereDate( 'endTime' , '<', date('Y-m-d H:i:s', strtotime(date($nextmonth))))
	  			->get();
	}
	
	
	/*
	// Find total cost by month
	*/
	public function getCostByMonth($providerId, $month, $nextmonth )
	{

	  	return  Order::where('providerId' , $providerId)
	  			->whereDate('endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($month)))) 
	  			->whereDate('endTime' , '<', date('Y-m-d H:i:s', strtotime(date($nextmonth))))
	  			->sum('totalcost');
	}
	
	
	
	/*
	// Find total cost by day
	*/
	public function getSalesByDay($day, $nextday )
	{

	  	return  Order::where('providerId' , $this->app->provider->id)
			->whereDate('endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($day)))) 
			->whereDate('endTime' , '<', date('Y-m-d H:i:s', strtotime(date($nextday))))
  			->sum('totalcost');

	}
	
	

	/*
	// Find all items between two days By ProviderId
	*/
	public function getByDate($params )
	{

	  	$check = Order::where('provider_id' , $this->app->provider->id);

	  	if (!empty($params["created_by"]))
	  	{
	  		$check = $check->where('created_by', $params['created_by']);
	  	}

	  	if (!empty($params["status"]))
	  	{
	  		$check = $check->where('status', $params['status']);
	  	}
	  	if (!empty($params["start"]))
	  	{
	  		$check = $check->whereBetween('date' , [$params['start'] , $params['end']]);
	  	}
  		
  		return $check->orderBy('id', 'DESC');
	}

	/*
	// Find all items between two days
	*/
	public function getTotalByDate($date1, $date2 )
	{

	  	return  Order::with('DeviceModel')
	  		->whereDate('endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($date1)))) 
			->whereDate('endTime' , '<', date('Y-m-d H:i:s', strtotime(date($date2)))) 
			->get();
	}

	


	/**
	* Save item to database
	*/
	public function store($data, $items) 
	{
		try {
			
			$Model = new Order();
			
			foreach ($data as $key => $value) 
			{
				if (in_array($key, $Model->getFields()))
				{
					$dataArray[$key] = $value;
				}
			}	

			// Return the FBUserInfo object with the new data
	    	$Object = Order::create($dataArray);
	    	$Object->update($dataArray);
	 	
	    	$this->updateOrderDevice($Object, $items);

	    	$this->updateOrderProducts($Object, $items);

	    	return $Object;

		} catch (Exception $e) {
			return $e->getMessage();
		}
    }
    

    public function updateOrderDevice($Object, $items)
    {

    	foreach ($items as $key => $value) 
    	{
    		$update = OrderDevice::find($value->id)->update(['order_code' => $Object->code, 'status' => 'paid']);
    	}


    }


    public function updateOrderProducts($Object, $items)
    {

    	foreach ($items as $key => $value) 
    	{
    		foreach ($value->products as $product) {
	    		$item = OrderDeviceItem::with('product')->find($product->id);
	    		$item->update(['order_code' => $Object->code, 'status' => 'paid']);
	    		$updateStock = $item->product->pullStock($item->qty)->save();
	    		$updateStock = $this->pullStock($item, $Object);
    		}
    	}
    }


    public function pullStock($item, $Object)
    {

		$stocklog = [
	    	'product_id' => $item->product->id,
	    	'provider_id' => $item->product->provider_id,
	    	'stock' => $item->qty,
	    	'type' =>'pull',
	    	'date' => date('Y-m-d'),
			'model_type' => Order::class,	
			'model_id' => $Object->id,	
	    	'created_by' => $Object->created_by,
		];

		$updateStock = Stock::create($stocklog)->update($stocklog);

		return $updateStock;
    }


}

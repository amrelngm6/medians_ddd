<?php

namespace Medians\Infrastructure\Orders;

use Medians\Domain\Orders\Order;
use Medians\Domain\Devices\OrderDevice;

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
	// Find item by `code` 
	*/
	public function getByCode($code) 
	{

		return  Order::with('device')
			->with('items')
			->where('code', $code)
			->first();

	}

	/*
	// Find item by `discountCode` 
	*/
	public function getByDiscountCode($discountCode) 
	{
		return  Order::with('device')
			->with('items')
			->where('discountCode', $discountCode)
			->get();
	}

	/*
	// Find all items 
	*/
	public function getAll($providerId, $limit = null)
	{
		return  Order::where('providerId', $providerId)
		->with('items')
		->with('device')
		->limit($limit)
		->get();
	}


	/*
	// Find all items by month & provider
	*/
	public function getByMonth($providerId, $month, $nextmonth )
	{
		

	  	return  Order::where('providerId' , $providerId)
	  			->with('items')
	  			->with(['device_order'=>function($q)
	  			{
	  				return $q->with(['device']);
	  			}])
	  			->whereBetween('updated_at' , [date('Y-m-d H:i:s', strtotime(date($month))) , date('Y-m-d H:i:s', strtotime(date($nextmonth)))])
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
	public function getByDate($date1, $date2 )
	{

	  	return  Order::where('provider_id' , $this->app->provider->id)
  			->whereBetween('date' , [date('Y-m-d', strtotime(date($date1))) , date('Y-m-d', strtotime(date($date2)))])
			->get();
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


}

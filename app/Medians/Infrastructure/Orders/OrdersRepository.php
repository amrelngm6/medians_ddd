<?php

namespace Medians\Infrastructure\Orders;

use Medians\Domain\Orders\Order;

class OrdersRepository
{




	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Order::with('items')
		->find($id);

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
	public function getSalesByDay($providerId, $day, $nextday )
	{

	  	return  Order::where('providerId' , $providerId)
			->whereDate('endTime' , '>=', date('Y-m-d H:i:s', strtotime(date($day)))) 
			->whereDate('endTime' , '<', date('Y-m-d H:i:s', strtotime(date($nextday))))
  			->sum('totalcost');

	}
	
	

	/*
	// Find all items between two days By ProviderId
	*/
	public function getByDate($providerId, $date1, $date2 )
	{

	  	return  Order::where('providerId' , $providerId)
  			->whereBetween('updated_at' , [date('Y-m-d H:i:s', strtotime(date($date1))) , date('Y-m-d H:i:s', strtotime(date($date2)))])
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

	



}

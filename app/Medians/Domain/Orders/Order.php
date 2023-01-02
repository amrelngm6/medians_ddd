<?php

namespace Medians\Domain\Orders;


use Shared\dbaser\CustomController;

use Medians\Domain\Devices\Device;

class Order  extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'orders';

	/**
	* @var Array
	*/
	public $fillable = [
			'providerId',
			'code',
			'sub_total',
			'tax',
			'discount',
			'total_cost',
			'discountCode',
			'time',
			'insertedBy',
			'status',
		];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;



	public function id() : ?int
	{
		return $this->id;
	}


	public function sub_total() 
	{
		return $this->sub_total;
	}

	public function discountCode() : ?String
	{
		return $this->discountCode;
	}
	
	public function providerId() : ?String
	{
		return $this->providerId;
	}

	public function code() : String
	{
		return $this->code;
	}


	public function tax() : ?Float
	{
		return $this->tax;
	}

	public function total_cost() : ?Float
	{
		return $this->total_cost;
	}


	public function discount() : ?String
	{
		return $this->discount;
	}

	public function endTime() : ?String
	{
		return $this->endTime;
	}

	public function time() : ?String
	{
		return $this->time;
	}


	public function status() : ?String
	{
		return $this->status;
	}




	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setDevice( $device) : void
	{
		$this->device = $device;
	}

	public function setCode($code) : void
	{
		$this->code = $code;
	}

	public function setProviderId($providerId) : void
	{
		$this->providerId = $providerId;
	}


	public function setDiscountCode($discountCode) : void
	{
		$this->discountCode = $discountCode;
	}

	public function setCost($cost) : void
	{
		$this->cost = $cost;
	}

	public function setTotalCost($total_cost) : void
	{
		$this->total_cost = $total_cost;
	}

	public function setDiscount($discount) : void
	{
		$this->discount = $discount;
	}

	public function setEndTime($endTime) : void
	{
		$this->endTime = $endTime;
	}

	public function setTime($time) : void
	{
		$this->time = $time;
	}

	public function setStatus($status) : void
	{
		$this->status = $status;
	}



	/*
	// Genrate unique code 
	*/
	public function genrateCode() : String
	{
		return time().rand(9,99);
	}


	/**
	 * Relations
	 */
	public function items()
	{
		return $this->hasMany(OrderItem::class, 'orderCode', 'code');
	}

	/**
	 * Relations
	 */
	public function device_order()
	{
		return $this->hasOne(DeviceOrder::class, 'orderCode', 'code');
	}

	/**
	 * Relations
	 */
	public function device_orders()
	{
		return $this->hasMany(DeviceOrder::class, 'orderCode', 'code');
	}



	/**
	* Relationship with Devices Repo 
	* 
	*/
	// public function Device()
	// {
		// return $this->hasOne(Device::class, 'id', 'device');
	// }
	

	/**
	* Relationship with DeviceOrders Repo 
	* 
	*/
	

	/**
	* Relationship with Provider Repo 
	* 
	*/
	public function Provider()
	{
		return $this->hasOne('Medians\Infrastructure\Providers\ProviderRepository', 'id', 'providerId');
	}
	

	/**
	* Relationship with Products Repo 
	* 
	*/
	public function Products()
	{
		return $this->hasMany('Medians\Infrastructure\Orders\ProductOrdersRepository', 'orderCode', 'code');
	}
	
	/**
	* Relationship with Products Repo 
	* 
	*/
	public function ProductsT()
	{
		return $this->hasOneThrough('Medians\Infrastructure\Orders\ProductOrdersRepository', 'orderCode', 'code');
	}
	

}

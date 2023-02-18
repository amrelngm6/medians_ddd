<?php

namespace Medians\Domain\Orders;


use Shared\dbaser\CustomController;

use Medians\Domain\Providers\Provider;
use Medians\Domain\Devices\Device;
use Medians\Domain\Devices\OrderDevice;
use Medians\Domain\Products\Product;
use Medians\Domain\Users\User;

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

		'provider_id',
		'customer_id',
		'code',
		'subtotal',
		'tax',
		'discount',
		'total_cost',
		'discount_code',
		'payment_method',
		'date',
		'created_by',
		'status'
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;


	public $appends = ['products_subtotal'];

	public function getProductsSubtotalAttribute()
	{
		$cost = 0;

		if ($this->order_devices)
		{
			foreach ($this->order_devices as $key => $value) 
			{
				$cost = $cost + $value->products_subtotal;
			}
		}

		return $cost;
	}

	
	public function getFields()
	{
		return $this->fillable;
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
	public function cashier()
	{
		return $this->hasOne(User::class, 'id', 'created_by');
	}

	/**
	 * Relations
	 */
	public function items()
	{
		return $this->hasMany(OrderItem::class, 'order_code', 'code');
	}

	/**
	 * Relations
	 */
	public function order_device()
	{
		return $this->hasOne(OrderDevice::class, 'order_code', 'code');
	}

	/**
	 * Relations
	 */
	public function order_devices()
	{
		return $this->hasMany(OrderDevice::class, 'order_code', 'code')->with('device')->with('game')->with('products');
	}


	/**
	* Relationship with Provider Repo 
	* 
	*/
	public function Provider()
	{
		return $this->hasOne(Provider::class, 'id', 'provider_id');
	}
	

	/**
	* Relationship with Products Repo 
	* 
	*/
	public function Products()
	{
		return $this->hasMany(Product::class, 'order_code', 'code');
	}
	

	

}

<?php

namespace Medians\Domain\Orders;


use Shared\dbaser\CustomController;



class OrderItem extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'order_items';

	/**
	* @var Array
	*/
	public $fillable = [
			'providerId',
			'model_type',
			'model_id',
			'price',
			'qty',
			'orderCode',
			'cost',
			'tax',
			'total_cost',
			'insertedBy',
			'time',
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

	public function providerId() : ?Int
	{
		return $this->providerId;
	}

	public function orderCode() : ?String
	{
		return $this->orderCode;
	}

	public function product() 
	{
		return $this->product;
	}

	public function productCost() : ?Float
	{
		return $this->productCost;
	}

	public function device() 
	{
		return $this->device;
	}


	public function qty() : ?Int
	{
		return $this->qty;
	}

	public function status() : ?String
	{
		return $this->status;
	}

	public function insertedBy() : ?Int
	{
		return $this->insertedBy;
	}


	public function time() : ?String
	{
		return $this->time;
	}




	public function setId($id) : void
	{
		$this->id = $id;
	}


	public function setProviderId($providerId) : void
	{
		$this->providerId = $providerId;
	}


	public function setOrderCode($orderCode) : void
	{
		$this->orderCode = $orderCode;
	}


	public function setProduct( $product) : void
	{
		$this->product = $product;
	}

	public function setProductCost($productCost = 0) : void
	{
		$this->productCost = $productCost;
	}

	public function setQty($qty) : void
	{
		$this->qty = $qty;
	}

	public function setDevice( $device) : void
	{
		$this->device = $device;
	}


	public function setStatus($status = 0) : void
	{
		$this->status = $status;
	}

	public function setInsertedBy($insertedBy = 0) : void
	{
		$this->insertedBy = $insertedBy;
	}

	public function setTime($time) : void
	{
		$this->time = $time;
	}


}

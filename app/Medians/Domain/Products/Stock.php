<?php

namespace Medians\Domain\Products;


use Medians\Domain\Products\Product;

use Shared\dbaser\CustomController;



/**
 * Stock class database queries
 */
class Stock extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'stock';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'startStock',
    	'providerId',
    	'stock',
    	'product',
    	'time',
    	'insertedBy',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;



	public function id() : String
	{
		return $this->id;
	}


	public function providerId() 
	{
		return $this->providerId;
	}

	public function product() 
	{
		return $this->product;
	}


	public function startStock() : String
	{
		return $this->startStock;
	}


	public function stock() : ?String
	{
		return $this->stock;
	}

	public function time() : String
	{
		return $this->time;
	}

	public function insertedBy() : String
	{
		return $this->insertedBy;
	}




	public function setId($id) : stock
	{
		$this->id = $id;
		return $this;
	}

	public function setProduct($product) : stock
	{
		$this->product = $product;
		return $this;
	}

	public function setProviderId($providerId) : stock
	{
		$this->providerId = $providerId;
		return $this;
	}

	public function setStock($stock) : stock
	{
		$this->stock = $stock;
		return $this;
	}

	public function setStartStock($startStock = 0) : stock
	{
		$this->startStock = $startStock;
		return $this;
	}

	public function setTime($time = 0) : stock
	{
		$this->time = $time;
		return $this;
	}

	public function setInsertedBy($insertedBy = 0) : stock 
	{
		$this->insertedBy = $insertedBy;
		return $this;
	}

	public function Products()
	{
		return $this->hasOne(Product::class, 'id', 'product');
	}

}

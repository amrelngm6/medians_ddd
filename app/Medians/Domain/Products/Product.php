<?php

namespace Medians\Domain\Products;


use Shared\dbaser\CustomController;

/**
 * Product class database queries
 */
class Product extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'products';


	protected $fillable = [
    	'title',
    	'description',
    	'providerId',
    	'picture',
    	'price',
    	'type',
    	'stock',
    	'publish'
	];

	// public $timestamps = false;


	function __construct()
	{

	}


	public function id() : String
	{
		return $this->id;
	}


	public function title() : String
	{
		return $this->title;
	}

	public function providerId() : ?String
	{
		return $this->providerId;
	}


	public function description() : String
	{
		return $this->description;
	}


	public function picture() : ?String
	{
		return $this->picture;
	}

	public function price() : String
	{
		return $this->price;
	}

	public function type() : String
	{
		// return !is_object($this->type) ? DeviceTypeModel::applyId($this->type) : $this->type;
		return $this->type;
	}

	public function stock() : ?int
	{
		return $this->stock;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}



	public function setId($id) : Product
	{
		$this->id = $id;
		return $this;
	}

	public function setProviderId($providerId) : Product
	{
		$this->providerId = $providerId;
		return $this;
	}

	public function setTitle($title) : Product
	{
		$this->title = $title;
		return $this;
	}

	public function setDescription($description) : Product
	{
		$this->description = $description;
		return $this;
	}

	public function setPicture($picture = 0) : Product
	{
		$this->picture = $picture;
		return $this;
	}

	public function setPrice($price = 0) : Product
	{
		$this->price = $price;
		return $this;
	}

	public function setStock($stock = 0) : Product
	{
		$this->stock = $stock;
		return $this;
	}

	public function setType($type) : Product
	{
		$this->type = $type;
		return $this;
	}

	public function setPublish($publish = '0') 
	{
		$this->publish = $publish;
		return $this;
	}




	public function total_stock()
	{
		return $this->hasMany(Stock::class, 'product', 'id');
	}

}

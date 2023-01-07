<?php

namespace Medians\Domain\Products;


use Shared\dbaser\CustomController;

use Medians\Domain\Categories\Category;

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
    	'name',
    	'description',
    	'provider_id',
    	'picture',
    	'price',
    	'tax',
    	'stock',
    	'type',
    	'created_by',
    	'status'
	];

	// public $timestamps = false;


	function __construct()
	{

	}

	public function getFields()
	{
		return $this->fillable;
	}

	public function addStock($qty)
	{
		$this->stock = !empty($this->stock) ? (number_format($this->stock) + number_format($qty)) : $qty;
		return $this;
	}

	public function pullStock($qty)
	{
		$this->stock = !empty($this->stock) ? (number_format($this->stock) - number_format($qty)) : 0;
		return $this;
	}

	public function categoriesList()
	{
		return Category::byModel(Product::class);
	}

	public function category()
	{
		return $this->hasOne(Category::class, 'code', 'type');
	}

	public function stock_log()
	{
		return $this->hasMany(Stock::class, 'product', 'id');
	}

}

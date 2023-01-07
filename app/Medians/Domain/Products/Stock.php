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
    	'product_id',
    	'provider_id',
    	'stock',
    	'type',
    	'date',
    	'created_by',
		'model_type',	
		'model_id',	
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;



	public function Products()
	{
		return $this->hasOne(Product::class, 'id', 'product');
	}

}

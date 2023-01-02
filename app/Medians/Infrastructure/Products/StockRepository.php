<?php

namespace Medians\Infrastructure\Products;

use Medians\Infrastructure\Products\ProductsRepository;
use Medians\Domain\Products\Product;
use Medians\Domain\Products\Stock;

/**
 * Stock class database queries
 */
class StockRepository 
{
	

	/*
	/ @var String
	*/
	protected $table = 'stock';


	
	/*
	// Find item by `id` 
	*/
	public function getById($id) 
	{

		return  Stock::find($id);

	}



	/*
	// Find item by `id` 
	*/
	public function getByProvider($providerId, $limit) 
	{
		// print_r();
		return Stock::where('providerId', $providerId)
		->with('Products')
		->get();
	}


	/*
	// Find all items 
	*/
	public function getAll($limit = 1000)
	{
		return  Stock::limit($limit)->get();
	}



	/*
	// Find available stock 
	*/
	public function getStockObject($product, $qty = 1) 
	{
		return  Stock::where(
			'stock',  '>=' , $qty
		)
		->where(
			'product' , $product
		)
		->with('Products')
		->first();
	}


	/*
	// Find available stock 
	*/
	public function getStock($product, $qty = 1) : ?Int
	{
		$return =  $this->getStockObject($product, $qty);

		return isset($return->stock) ? $return->stock : 0;
	}


	
	/*
	// Find count by month
	*/
	public function getByMonth($month, $nextmonth )
	{

		$query = array( 
  					date('Y-m-d H:i:s', strtotime(date($month))),  
  					date('Y-m-d H:i:s', strtotime(date($nextmonth))) 
				);

	  	return Stock::whereBetween('time', $query)->get();
	  	
	}
	
	
	/*
	// Find count by month
	*/
	public function getByProduct($product ) 
	{
	  	return Stock::where('product', $product)->get();
	}
	



	/**
	* Save item to database
	* 
	* @param Array $data
	* @return Object 
	*/
	public function store($data) 
	{	

		$Model = new Stock();
		$Model
		->setProduct($data['product'])
		->setProviderId ($data['providerId'])
		->setStock($data['stock'])
		->setStartStock($data['startStock'])
		->setInsertedBy($data['insertedBy'])
		->setTime($data['time'])
		->save();

		// Return the DeviceType object with the new data
		return $Model;
	}


	
	/**
	* Update item at database
	* 
	* @param Object $object
	* @return Object 
	*/
	public function edit($object) 
	{
		$object->save();

		// Return the DeviceType object with the new data
		return Stock::find($object->id);
		
	}



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Stock::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}



}
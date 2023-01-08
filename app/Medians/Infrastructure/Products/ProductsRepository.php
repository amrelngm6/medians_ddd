<?php

namespace Medians\Infrastructure\Products;

use Medians\Domain\Products\Product;



/**
 * Product class database queries
 */
class ProductsRepository 
{

	public $app ;


	function __construct ($app)
	{
		$this->app = $app;
	}

	public function getModel()
	{
		return new Product;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Product::where('provider_id', $this->app->provider->id)->find($id);
	}

	/*
	// Find items by `params` 
	*/
	public function get($params = null) 
	{

		return Product::with('category')
		->where('provider_id', $this->app->provider->id)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Product();
		$dataArray = ['provider_id'=>$this->app->provider->id];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Product::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Product::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;
    } 



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Product::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}
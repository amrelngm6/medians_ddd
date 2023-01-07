<?php

namespace Medians\Infrastructure\Products;

use Medians\Domain\Products\Product;
use Medians\Domain\Products\Stock;
use Medians\Domain\Payments\Payment;

/**
 * Stock class database queries
 */
class StockRepository 
{


	public $app;



	function __construct($app)
	{
		$this->app = $app;
	}
	
	/**
	* Find item by `id` 
	*/
	public function find($id) 
	{
		return  Stock::with('user', 'product')->where('provider_id', $this->app->provider->id)->find($id);
	}

	/**
	* Find items by `params` 
	*/
	public function get($params = null) 
	{
		$query =  Stock::with('user', 'product')

		->where('provider_id', $this->app->provider->id);

		if (!empty($params->get('product')))
		{
			$query->where('product_id', $params->get('product'));
		}

		if (!empty($params->get('by')))
		{
			$query->where('created_by', $params->get('by'));
		}

		if (!empty($params->get('type')) && in_array($params->get('type'), ['add', 'pull']) )
		{
			$query->where('type', $params->get('type'));
		}

		if (!empty($params->get('start')) && !empty($params->get('end')))
		{
			$query->whereBetween('date', [$params->get('start'), $params->get('end')]);
		}

		return $query->get();
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


	/**
	* Find available stock 
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
	public function savePayment($Object, $data) 
	{	

		$save =  Payment::create([
			'name' => 'Purchase for products Stock',
			'invoice_id' => $data['invoice_id'],
			'amount' => $data['amount'],
			'created_by' => $Object->created_by,
		]);

		$Object->update(['model_type'=> Payment::class, 'model_id'=>$save->id]);
		return $save;
	}	

	public function updateProductStock($Object)
	{
		return Product::find($Object->product_id)->addStock($Object->stock);
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
		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Stock::create($dataArray);
    	$Object->update($dataArray);

		$this->savePayment($Object, $data['payment']);


		$this->updateProductStock($Object);

		return $Object;
	}


	
	/**
	* Update item at database
	* 
	* @param Object $object
	* @return Object 
	*/
	public function edit($object) 
	{

		
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
<?php

namespace Medians\Infrastructure\Payments;

use Medians\Domain\Payments\Payment;



/**
 * Payment class database queries
 */
class PaymentsRepository 
{



	public $app ;


	function __construct ($app)
	{
		$this->app = $app;
	}

	public function getModel()
	{
		return new Payment;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Payment::where('provider_id', $this->app->provider->id)->find($id);
	}

	/*
	// Find items by `params` 
	*/
	public function get($params = null) 
	{

		return Payment::with('user')
		->where('provider_id', $this->app->provider->id)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Payment();
		$dataArray = ['provider_id'=>$this->app->provider->id];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Payment::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Payment::find($data['id']);
		
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
			
			return Payment::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}
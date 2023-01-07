<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\Device;
use Medians\Domain\Devices\OrderDevice;
use Medians\Domain\Games\Game;
use Medians\Infrastructure\Orders\OrdersRepository;
use Medians\Infrastructure\Orders\DeviceOrdersRepository;

use Medians\Domain\Prices\Prices;




class DevicesRepository  
{

	public $app ;

	function __construct($app)
	{
		$this->app = $app;
	}


	/*
	// Find item by `id` 
	*/
	public function find($deviceId)
	{

		return Device::with('prices')->with('category')->where('provider_id', $this->app->provider->id)->find($deviceId);

	}


	/*
	// Find item by `provider` 
	*/
	public function getByProvider($providerId)
	{
		return Device::where('provider_id', $this->app->provider->id)
		->with('prices')
		->with('currentOrder')
		->with('category')
		->get();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  Device::with('category')->where('provider_id', $this->app->provider->id)->get();
	}

	/*
	// Find all items 
	*/
	public function get($limit = 20)
	{
		return  Device::where('provider_id', $this->app->provider->id)
		->with('prices')
		->with('games')
		->limit($limit)
		->get();
	}



	public function events($request,$limit)
	{
		$start = date('Y-m-d H:i:s', strtotime(date($request->get('start'))));
		$end = date('Y-m-d H:i:s', strtotime(date($request->get('end'))));

		return OrderDevice::whereBetween('start_time' , [$start , $end] )->with('game')->with('device')->with('products')->get();
	}


	public function getGames($type,$limit = 50)
	{
		return Game::where('type' , $type )->limit($limit)->get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Device();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Device::create($dataArray);
    	$Object->update($dataArray);


    	$this->storePrices($data['prices'], $Object->id);

    	return $Object;
    }
    	
    /**
     * Update Row
     */
    public function update($data)
    {

		$Object = Device::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	$this->storePrices($data['prices'], $Object->id);

    	return $Object;

    } 


    /**
     * Destroy Row
     */
    public function destroy($data)
    {

		$Object = Device::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->delete();

    	return $Object;

    } 





	/**
	* Save item to database
	*/
	public function storePrices($data, $id) 
	{
		Prices::where('model_type', Device::class)->where('model_id', $id)->delete();
		if ($data)
		{

			foreach ($data as $key => $value)
			{
				$fields = [
					'model_type' => Device::class,
					'model_id' => $id,
					'code' => $key,
					'value' => $value,
					'created_by' => $this->app->auth->id
				];

				$Model = Prices::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}

	}





    /**
     * Store Order Device
     */
    public function storeOrder($data)
    {

		$Device = Device::with('prices')->find($data['device_id']);
		$data['start_time'] = $data['date'].' '.$data['start_time'];
		$data['end_time'] = $data['date'].' '.(isset($data['end_time']) ? $data['end_time'] : '00:00');
		$data['game_id'] = isset($data['game_id']) ? $data['game_id'] : $data['game_id'];
		$data['provider_id'] = $this->app->provider->id;
		$data['device_id'] = $Device->id;
		$data['order_code'] = null;
		$data['break_time'] = 0;
		$data['device_cost'] = $Device->price->single_price;
		$data['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : 'single';
		$data['break_time'] = 0;
		$data['last_check'] = 0;
		$data['status'] = 'active';
		$data['created_by'] = $this->app->auth->id;

		$Object = new OrderDevice;
		// Return the FBUserInfo object with the new data
    	$Object = $Object->create( (array) $data)->save();

    	return $Object;
    } 


    /**
     * Update Order Device
     */
    public function updateOrder($data)
    {

		$Object = OrderDevice::find($data['id']);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['start_time'] = $date.' '.$data['start_time'];
		$newData['end_time'] = $date.' '.$data['end_time'];
		$newData['game_id'] = isset($data['game_id']) ? $data['game_id'] : $Object->game_id;
		$newData['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : $Object->booking_type;
		$newData['status'] = $data['status'];
		if ($data['status'] == 'completed')
		{
			$newData['end_time'] = date('Y-m-d H:i:s');
		}

		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $newData);

    	return $Object;

    } 


}

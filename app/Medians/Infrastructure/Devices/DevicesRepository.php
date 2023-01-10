<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\Device;
use Medians\Domain\Devices\OrderDevice;
use Medians\Domain\Games\Game;
use Medians\Domain\Products\Product;
use Medians\Infrastructure\Orders\OrdersRepository;
use Medians\Infrastructure\Orders\DeviceOrdersRepository;

use Medians\Domain\Prices\Prices;
use Medians\Domain\Devices\OrderDeviceItem;




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
		return  Device::where('provider_id', $this->app->provider->id)
		->with('category')
		->with('prices')
		->with('games')
		->get();
	}

	/*
	// Find all items 
	*/
	public function get($limit = 20)
	{
		return  Device::where('provider_id', $this->app->provider->id)
		->with('prices')
		->with('games')
		->where('status', '!=', '0')
		->limit($limit)
		->get();
	}



	public function events($params,$limit = 10)
	{
		$query = OrderDevice::with('game')->with('device')->with('user')->with('products')
		->where('provider_id', $this->app->provider->id);

		if (!empty($params->get('by')))
		{
			$query->where('created_by', $params->get('by'));
		}

		if (!empty($params->get('status')) && in_array($params->get('status'), ['active', 'completed', 'paid']) )
		{
			$query->where('status', $params->get('status'));
		}

		if (!empty($params->get('start')) && !empty($params->get('end')))
		{
			$start = date('Y-m-d H:i:s', strtotime(date($params->get('start'))));
			$end = date('Y-m-d 00:00:00', strtotime(date($params->get('end'))));
			$query->whereBetween('start_time', [$params->get('start'), $params->get('end')]);
		}

		return $query->limit($limit)->orderBy('id', 'DESC')->get();
	}



	public function eventsByDate($params,$limit = 10)
	{
		$query = OrderDevice::with('game')->with('device')->with('user')->with('products')
		->where('provider_id', $this->app->provider->id);

		if (!empty($params['start']) && !empty($params['end']))
		{
			$start = date('Y-m-d H:i:s', strtotime(date($params['start'])));
			$end = date('Y-m-d 23:59:59', strtotime(date($params['end'])));
			$query->whereBetween('start_time', [$start, $end]);
		}

		return $query->limit($limit)->orderBy('id', 'DESC');
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
		$data['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : 'single';
		$data['device_cost'] = ($data['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price;
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

		$Device = Device::with('prices')->find($Object->device_id);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['start_time'] = $date.' '.$data['start_time'];
		$newData['end_time'] = $date.' '.$data['end_time'];
		$newData['game_id'] = isset($data['game_id']) ? $data['game_id'] : $Object->game_id;
		$newData['booking_type'] = isset($data['booking_type']) ? $data['booking_type'] : $Object->booking_type;
		$newData['device_cost'] = ($newData['booking_type'] == 'multi') ? $Device->price->multi_price : $Device->price->single_price;
		$newData['status'] = $data['status'];
		if ($data['status'] == 'completed')
		{
			$newData['end_time'] = date('Y-m-d H:i:s');
		}

		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $newData);

    	return $Object;

    } 



    /**
     * Add Order Device product
     */
    public function removeProduct($id)
    {
    	return OrderDeviceItem::where('id', $id)->delete();
    }

    /**
     * Add Order Device product
     */
    public function storeProduct($id, $data)
    {
		$Object = OrderDevice::find($id);

		$date = date('Y-m-d', strtotime(date($Object->created_at)));

		$newData = [];
		$newData['order_device_id'] = isset($Object->id) ? $Object->id : 0;
		$newData['model_type'] = Product::class;
		$newData['model_id'] = $data['id'];
		$newData['qty'] = $data['qty'];
		$newData['price'] = $data['price'];
		$newData['created_by'] = $this->app->auth->id;

		// Return the FBUserInfo object with the new data
    	OrderDeviceItem::create($newData);

    	return $Object;

    } 




}

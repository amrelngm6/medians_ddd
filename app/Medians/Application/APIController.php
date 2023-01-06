<?php

namespace Medians\Application;

use Medians\Infrastructure as Repo;


class APIController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
	

	}

	/**
	 * Model object 
	 * 
	 */
	public function handle($request, $app)
	{
		$return = [];
		switch ($request->get('model')) 
		{
			case 'User':
				$controller = (new Repo\Users\UserRepository);
				break;
			case 'Lead':
				$controller = (new Repo\Leads\LeadRepository);
				break;
			case 'Task':
				$controller = (new Repo\Tasks\TaskRepository);
				break;
			case 'Property.tasks':
				$return = (new Repo\Properties\PropertyRepository)->find($request->get('id'));
				return response(json_encode(isset($return->Tasks) ? $return->Tasks : []), $app);
				break;
		}

		$return = $controller->find($request->get('id'));

		return response(json_encode($return), $app);
	} 

	/**
	 * Create model 
	 * 
	 */
	public function create($request, $app)
	{
		try {
				
			$return = [];
			switch ($request->get('type')) 
			{
				case 'Device.create':
					$return = (new Devices\DeviceController($app))->store($request, $app);
					break;
				case 'Task.create':
					$return = (new Tasks\TaskController)->store($request, $app);
					break;
				case 'Customer.create':
					$return = (new Customers\CustomerController)->store($request, $app);
					break;
				case 'Event.create':

					$params = (array)  json_decode($request->get('params')['event']);
					$check = (new Repo\Devices\DevicesRepository($app))->storeOrder($params);
					$return = isset($check->id) ? ['result'=>'Created'] : ['result'=>'Error'];
					break;
			}

			return response(json_encode($return), $app);

		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function update($request, $app)
	{
		$return = [];
		switch ($request->get('type')) 
		{
			case 'Task.update':
				$return = (new Tasks\TaskController)->update($request, $app);
				break;
			case 'Customer.update':
				$return = (new Customers\CustomerController)->update($request, $app);
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new Repo\Devices\DevicesRepository($app))->updateOrder($params);
				$return = isset($check->id) ? ['result'=>'Updated'] : ['result'=>'Error'];
				break;
		}

		return response(json_encode($return), $app);
	} 

	/**
	 * Update model 
	 * 
	 */
	public function updateStatus($request, $app)
	{
		$id = $request->get('id');
		$status = $request->get('status');

		$return = [];
		switch ($request->get('model')) 
		{
			case 'Task':
				$return = (new Repo\Tasks\TaskRepository)->find($id)->update(['status'=>$status]);
				break;
			case 'Property':
				$return = (new Repo\Properties\PropertyRepository)->find($id)->update(['web'=>$status]);
				break;
		}

		return response(json_encode($return), $app);
	} 

	public function calendar($request, $app)
	{
		$repo = new Repo\Devices\DevicesRepository($app);

		$data = $repo->get(100);

		foreach ($data as $key => $value) {
			$data[$key]->businessHours = [(object) [
				'days'=>[0],
				'daysOfWeek' => [0, 1, 2, 3, 4, 5, 6],
				'disabledDates' => [],
				'startTime' => "00:000",
				'endTime' => "06:00",
				'status' => true
			], (object) [
				'days'=>[0],
				'daysOfWeek' => [0, 1, 2, 3, 4, 5, 6],
				'disabledDates' => [],
				'startTime' => "13:000",
				'endTime' => "23:59",
				'status' => true
			
			]];

		}

		return json_encode(['data'=>$data, 'status'=>TRUE]);

	}

	public function events($request, $app)
	{
		$repo = new Repo\Devices\DevicesRepository($app);

		$data = $repo->events($request, 100);

		foreach ($data as $key => $value) {
			// $data[$key]->id = $value->id;
			$data[$key]->title = isset($value->game->name) ? $value->game->name : $value->device->name;
			$data[$key]->resourceId = $value->device_id;
			$data[$key]->start = $value->start_time;
			$data[$key]->start_time = date('H:i', strtotime(date($data[$key]->start)));
			$data[$key]->end = $value->end_time;
			$data[$key]->end_time = date('H:i', strtotime(date($data[$key]->end)));
			$data[$key]->date = date('Y-m-d', strtotime(date($value->created_at)));
			$data[$key]->backgroundColor = '#f56954';
			$data[$key]->borderColor = '#000';
			$data[$key]->display = 'block';
			$data[$key]->draggable = true;
			$data[$key]->allow = true;
			$data[$key]->url = 'javascript:;';
			$data[$key]->classNames = $value->status;
			$data[$key]->games = $repo->getGames($value->device->type);
		}

		return $data;

	}

}

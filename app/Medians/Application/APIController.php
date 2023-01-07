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
				case 'Product.create':
					$return = (new Products\ProductController($app))->store($request, $app);
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
			case 'Product.update':
				$return = (new Products\ProductController($app))->update($request, $app);
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

}

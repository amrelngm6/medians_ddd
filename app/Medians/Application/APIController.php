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
				$controller = (new Repo\Users\UserRepository($app));
				break;
			case 'OrderDevice':
				$controller = (new Repo\Devices\OrderDevicesRepository($app));
				break;
			case 'Devices':
				return json_encode((new Repo\Devices\DevicesRepository($app))->getApi());
				break;
			
		}

		$return = isset($controller) ? $controller->find($request->get('id')) : $return;

		return response(json_encode(['status'=>true, 'result'=>$return]), $app);
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
				case 'OrderDevice.addProduct':
					$return = (new Devices\DeviceController($app))->addProduct($request, $app);
					break;
				case 'Stock.create':
					$return = (new Products\StockController($app))->store($request, $app);
					break;
				case 'Payment.create':
					$return = (new Payments\PaymentController($app))->store($request, $app);
					break;
				case 'Event.create':
					$params = (array)  json_decode($request->get('params')['event']);
					$check = (new Repo\Devices\DevicesRepository($app))->storeOrder($params);
					$return = isset($check->id) ? ['result'=>'Created'] : ['result'=>'Error'];
					break;

	            case 'User.create':
	                $return =  (new Users\UserController($app))->store($request, $app); 
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
			case 'Device.update':
                $return =  (new Devices\DeviceController($app))->update($request, $app); 
				break;
			case 'Task.update':
				$return = (new Tasks\TaskController)->update($request, $app);
				break;
			case 'Customer.update':
				$return = (new Customers\CustomerController)->update($request, $app);
				break;
			case 'Product.update':
				$return = (new Products\ProductController($app))->update($request, $app);
				break;
			case 'Payment.update':
				$return = (new Payments\PaymentController($app))->update($request, $app);
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new Repo\Devices\DevicesRepository($app))->updateOrder($params);
				$return = isset($check->id) ? ['result'=>'Updated'] : ['result'=>'Error'];
				break;
            case 'Settings.update':
                $return = (new Settings\SettingsController($app))->update($request, $app); 
                break;

            case 'User.update':
                $return =  (new Users\UserController($app))->update($request, $app); 
                break;

		}

		return response(json_encode($return), $app);
	} 

	/**
	 * delete model 
	 * 
	 */
	public function delete($request, $app)
	{
		$return = [];
		switch ($request->get('type')) 
		{
			case 'OrderDevice.removeProduct':
				$return = (new Devices\DeviceController($app))->removeProduct($request, $app);
				break;

		}

		return response(json_encode(['status'=>true, 'result'=>$return]), $app);
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

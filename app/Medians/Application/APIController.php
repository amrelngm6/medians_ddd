<?php

namespace Medians\Application;

use Medians\Infrastructure as Repo;


class APIController
{

	/**
	 * @var Object
	 */ 
	public $app;

	/**
	* @var Object
	*/
	protected $repo;



	function __construct($app )
	{
		$this->app = $app;
	}


	/**
	 * Model object 
	 * 
	 */
	public function handle($request, $model, $type)
	{
		$return = [];
		switch ($model) 
		{
			case 'home':
				return $this->home();
			case 'sections':
				return $this->sections();
				break;
			case 'section':
				return $this->section($type);
				break;
			case 'quiz':
				return json_encode([$this->quiz($type)]);
				break;
			case 'OrderDevice':
				$controller = (new Repo\Devices\OrderDevicesRepository($app));
				break;
			case 'Devices':
				return json_encode((new Repo\Devices\DevicesRepository($app))->getApi());
				break;
			
		}

		$return = isset($controller) ? $controller->find($request->get('id')) : $return;

		return json_encode(['status'=>true, 'result'=>$return]);
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

	public function home()
	{
		$data = [
			['id' => 1, 'title'=>'Hole 2','sub_title'=>'Hole 2','picture'=>'uploads/images/quiz-1.png'],
			['id' => 2, 'title'=>'Hole 2','sub_title'=>'Hola 2','picture'=>'uploads/images/quiz-2.png'],
			['id' => 3, 'title'=>'Hole 2','sub_title'=>'Hola 3','picture'=>'uploads/images/quiz-3.png']
		];

		return json_encode($data);
	}

	public function quiz($id)
	{
		return [
				'id' => (Int) $id, 'title'=>'Çfarë duhet të bëjë Klejdi?','picture'=>'uploads/images/quiz-'.$id.'.png','video_bg'=>'uploads/images/video-bg.png','video_url'=>'https://medianssolutions.com/assets/1.mp4', 'text'=>'Test',
				'options' => [
					['id' => 1, 'letter'=>'A', 'text'=>'Të bashkohet dhe postojë emoji-t në bisedë në kanalin e videos tjetër.', 'selected'=>false, 'is_correct'=>false],
					['id' => 2, 'letter'=>'B', 'text'=>'Të injorojë udhëzimin', 'selected'=>false, 'is_correct'=>false],
					['id' => 3, 'letter'=>'C', 'text'=>"T’i dërgojë mesazh privatisht YouTuberit të tij të preferuar për t'i bërë të ditur se kjo nuk është në rregull", 'selected'=>false, 'is_correct'=>true]
				],
				'next_id' => ($id + 1)
			];
	}

	public function section($id)
	{

		$data = [
			$this->quiz(1),
			$this->quiz(2),
			$this->quiz(3)
		];

		return json_encode($data);
	}

	public function sections()
	{
		$data = [
			['id' => 1, 'title'=>'Grupmosha','sub_title'=>'8-10 vjeç','picture'=>'uploads/images/quiz-section1.png', 'section_bg' => 'uploads/images/section1-bg.png'],
			['id' => 2, 'title'=>'Grupmosha','sub_title'=>'11-14 vjeç','picture'=>'uploads/images/quiz-section2.png', 'section_bg' => 'uploads/images/section2-bg.png'],
			['id' => 3, 'title'=>'Grupmosha','sub_title'=>'15-18 vjeç','picture'=>'uploads/images/quiz-section3.png', 'section_bg' => 'uploads/images/section3-bg.png']
		];

		return json_encode($data);
	}
}

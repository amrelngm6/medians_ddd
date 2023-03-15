<?php

namespace Medians;

use Medians\Users\Infrastructure\UserRepository;

use Medians\Devices\Infrastructure\OrderDevicesRepository;

use Medians\Devices\Infrastructure\DevicesRepository;

use Medians\Products\Infrastructure\ProductsRepository;


use Medians\Quizzes\Domain\Quiz;
use Medians\Categories\Domain\Category;

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
	public function handle()
	{

		$this->app = new \config\APP;

		$return = [];
		switch ($this->app->request()->get('model')) 
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
				return json_encode($this->quiz($type));
				break;

			case 'User':
				$controller = new UserRepository();
				break;
			
		}

		$return = isset($controller) ? $controller->find($this->app->request()->get('id')) : $return;

		return response(json_encode(['status'=>true, 'result'=>$return]));
	} 

	/**
	 * Create model 
	 * 
	 */
	public function create()
	{
		
		$app = new \config\APP;
		$request = $app->request();
		
		try {
				
			$return = [];
			switch ($request->get('type')) 
			{
				case 'Device.create':
					$return = (new Devices\Application\DeviceController())->store();
					break;
				case 'Category.create':
					$return = (new Categories\Application\CategoryController())->store();
					break;
				case 'Game.create':
					$return = (new Games\Application\GameController())->store();
					break;
				case 'Product.create':
					$return = (new Products\Application\ProductController())->store();
					break;
				case 'OrderDevice.addProduct':
					$return = (new Devices\Application\DeviceController())->addProduct();
					break;
				case 'Stock.create':
					$return = (new Products\Application\StockController())->store();
					break;
				case 'Payment.create':
					$return = (new Payments\Application\PaymentController())->store();
					break;
				case 'Event.create':
					$params = (array)  json_decode($request->get('params')['event']);
					$check = (new DevicesRepository())->storeOrder($params);
					$return = isset($check->id) ? ['result'=>'Created'] : ['result'=>'Error'];
					break;

	            case 'User.create':
	                $return =  (new Users\Application\UserController())->store(); 
	                break;

			}

			return response(json_encode($return));

		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function update()
	{
		$app = new \config\APP;
		$request = $app->request();

		$return = [];
		switch ($request->get('type')) 
		{
			case 'Quiz.update':
                $return =  (new Quizzes\Application\QuizController())->update(); 
				break;
			case 'QuizOption.update':
                $return =  (new Quizzes\Application\QuizOptionsController())->update(); 
				break;
			case 'Device.update':
                $return =  (new Devices\Application\DeviceController())->update(); 
				break;
			case 'Category.update':
				$return = (new Categories\Application\CategoryController)->update($request);
				break;
			case 'Game.update':
				$return = (new Games\Application\GameController())->update($request);
				break;
			case 'Product.update':
				$return = (new Products\Application\ProductController())->update();
				break;
			case 'Payment.update':
				$return = (new Payments\Application\PaymentController())->update();
				break;
			case 'Event.update':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->updateOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;
			case 'Event.cancel':
				$params = (array)  json_decode($request->get('params')['event']);
				$check = (new DevicesRepository())->cancelOrder($params);
				$return = isset($check->id) ? ['result'=>__('Updated')] : ['result'=>'Error'];
				break;
            case 'Settings.update':
                $return = (new Settings\Application\SettingsController())->update(); 
                break;

            case 'User.update':
                $return =  (new Users\Application\UserController())->update(); 
                break;
		}

		return response(json_encode($return));
	} 

	/**
	 * delete model 
	 * 
	 */
	public function delete()
	{

		$app = new \config\APP;
		$request = $app->request();

		try {
			
			$return = [];
			switch ($request->get('type')) 
			{
				case 'OrderDevice.removeProduct':
					$return = (new Devices\Application\DeviceController())->removeProduct();
					break;

				case 'Category.delete':
					$return = (new Categories\Application\CategoryController())->delete();
					break;

				case 'Product.delete':
					$return = (new Products\Application\ProductController())->delete();
					break;
					
				case 'Game.delete':
					return response((new Games\Application\GameController())->delete());
					break;

				case 'Stock.delete':
					return (new Products\Application\StockController())->delete();
					break;


			}

			return response(json_encode($return));

		} catch (Exception $e) {
			throw new Exception("Error Processing Request", 1);
					
		}
	} 

	/**
	 * Update model 
	 * 
	 */
	public function updateStatus()
	{

		$app = new \config\APP;
		$request = $app->request();

		$id = $request->get('id');
		$status = $request->get('status');

		$return = [];
		switch ($request->get('model')) 
		{
			case 'Device':
				$return = (new DevicesRepository())->find($id)->update(['status'=>$status]);
				break;
		}

		return response(json_encode($return));
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

		return Quiz::with('options')->find($id);
	}

	public function section($id)
	{
		$data = Category::byModel(Quiz::class, $id);

		return json_encode($data);
	}

	public function sections()
	{
		$data = Category::byModel(Quiz::class);

		return json_encode($data);
	}
}

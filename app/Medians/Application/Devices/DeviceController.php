<?php

namespace Medians\Application\Devices;

use Medians\Application as apps;

use Medians\Infrastructure as Repo;

use Medians\Domain\Devices as Devices;

use Medians\Domain\Devices\Device;

class DeviceController 
{

	/*
	// @var Object
	*/
	protected $repo;

	/*
	// @var Device
	*/
	protected $Device;

	/*
	// @var Array
	*/
	protected $data = array();
	

	function __construct($app)
	{

		$this->repo = new Repo\Devices\DevicesRepository($app);

	    // Set PricesModel
	    // $this->PricesController = new Repo\Prices\PricesController();

	    // Set PricesModel
	    $this->CategoryRepo = new Repo\Categories\CategoryRepository();

	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index($request, $app) 
	{
	    return render('views/admin/devices/calendar.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->get(50),
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	    ]);
	}


	/**
	 * Admin index orders
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function orders($request, $app) 
	{
	    return render('views/admin/devices/orders.html.twig', [
	        'title' => 'Devices bookings',
	        'app' => $app,
	        'events' => $this->repo->events($request, 10),
	    ]);
	}


	/**
	 * Admin manage items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function manage( $request, $app) 
	{

	    return render('views/admin/devices/devices_manage.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->getAll(100),
	        'typesList' => $this->CategoryRepo->categories(Device::class),

	    ]);
	}



	public function show(int $id,$request , $app) 
	{

	    return render('views/admin/devices/device.html.twig', [
	        'title' => 'Edit device',
	        'typesList' => $this->DeviceTypeController->getAll(),
	        'app' => $app,
	        'device' => $this->repo->find($id)
	    ]);
	}



	public function edit(int $id , $request, $app) 
	{

	    return render('views/admin/forms/edit_device.html.twig', [
	        'title' => 'Edit device',
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	        'app' => $app,
	        'device' => $this->repo->find($id)
	    ]);
	}


	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = (array) $request->get('params')['device'];

		try {

			$params['provider_id'] = $app->provider->id;
			$Property = $this->repo->store($params);

        	return array('success'=>1, 'result'=>'Created');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  update item
	*/
	public function update($request, $app) 
	{

		$params = (array)  $request->get('params')['device'];

		try {

			$params['provider_id'] = $app->provider->id;
			$params['status'] = !empty($params['status']) ? 1 : 0;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}


	/** 
	 * Delete item
	 */
	public function delete($request, $app) 
	{	

		$params = (array)  json_decode($request->get('params')['device']);

		try {

			$Property = $this->repo->destroy($params);

        	return array('success'=>1, 'result'=>'Deleted');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}


	public function validate($params) 
	{

		if (empty($params['title']))
		{
			throw new \Exception("Empty title", 1);
		}

		if (empty($params['type']))
		{
			throw new \Exception("Empty type", 1);
		}

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

		$newdata = [];
		foreach ($data as $key => $value) {
			if ((date('Y-m-d H:i', strtotime(date($value->end_time)))) == date('Y-m-d 00:00', strtotime(date($value->end_time))))
			{
				if ($value->end_time == '0000-00-00 00:00:00' || $value->end_time == (date('Y-m-d', strtotime(date($value->end_time))).' 00:00:00') )
				{
					$value->end_time = date('Y-m-d 23:59:00', strtotime(date($value->start_time)));
				}
			}
			$newdata[] = $this->filterItem($value, $repo);
		}

		return json_encode($newdata);

	}

	public function filterItem($event, $repo)
	{

		$event->id = $event->id;
		$event->duration_minutes = $event->duration;
		$event->duration_hours = round(number_format($event->duration)/60, 2);
		$event->title = isset($event->game->name) ? $event->game->name : $event->device->name;
		$event->resourceId = $event->device_id;
		$event->start = $event->start_time;
		$event->start_time = date('H:i', strtotime(date($event->start_time)));
		$event->end = $event->end_time;
		$event->end_time = date('H:i', strtotime(date($event->end)));
		$event->date = date('Y-m-d', strtotime(date($event->created_at)));
		$event->backgroundColor = '#f56954';
		$event->borderColor = '#000';
		$event->display = isset($event->display )? $event->display : 'block';
		$event->draggable = true;
		$event->allow = true;
		$event->url = 'javascript:;';
		$event->classNames = $event->status.' ';
		$event->classNames .= $event->order_code ? '  ' : 'bg-gradient-purple';
		$event->games = $repo->getGames($event->device->type);

		return $event;
	}


	public function getMinutes($from, $to)
	{
		return round(abs(strtotime($to) - strtotime($from)) / 60,2);
	}


}

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
	public function index($request, $app, $twig) 
	{
	    return render('views/admin/devices/calendar.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->get(50),
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	    ]);
	}


	/**
	 * Admin manage items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function manage( $request, $app, $twig) 
	{

	    return render('views/admin/devices/devices_manage.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->get(100),
	        'typesList' => $this->CategoryRepo->categories(Device::class),

	    ]);
	}



	public function show(int $id,$request , $app, $twig) 
	{

	    return render('views/admin/devices/device.html.twig', [
	        'title' => 'Edit device',
	        'typesList' => $this->DeviceTypeController->getAll(),
	        'app' => $app,
	        'device' => $this->repo->find($id)
	    ]);
	}



	public function edit(int $id , $request, $app, $twig) 
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


}

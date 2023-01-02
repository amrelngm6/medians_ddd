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
	

	function __construct($data = null)
	{

		$this->data = (object) $data;

		$this->repo = new Repo\Devices\DevicesRepository();

	    // Set PricesModel
	    $this->PricesController = new apps\Prices\PricesController();

	    // Set PricesModel
	    $this->DeviceTypeController = new apps\Devices\DeviceTypeController();

	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( $app, $twig) 
	{
	    return $twig->render('views/admin/devices/devices.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->getByProvider($app->providerSession->id),
	        'typesList' => $this->DeviceTypeController->getAll()
	    ]);
	}


	/**
	 * Admin manage items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function manage( $app, $twig) 
	{

	    return $twig->render('views/admin/devices/devices_manage.html.twig', [
	        'title' => 'Devices list',
	        'app' => $app,
	        'devicesList' => $this->repo->getByProvider($app->providerSession->id),
	        'typesList' => $this->DeviceTypeController->getAll()

	    ]);
	}



	public function show(int $id , $app, $twig) 
	{

	    return $twig->render('views/admin/devices/device.html.twig', [
	        'title' => 'Edit device',
	        'typesList' => $this->DeviceTypeController->getAll(),
	        'app' => $app,
	        'device' => $this->repo->find($id)
	    ]);
	}



	public function edit(int $id , $app, $twig) 
	{

	    return $twig->render('views/admin/forms/edit_device.html.twig', [
	        'title' => 'Edit device',
	        'typesList' => $this->DeviceTypeController->getAll(),
	        'app' => $app,
	        'device' => $this->repo->find($id)
	    ]);
	}



	public function store($request, $app) 
	{	
        try {

        	$params = $request->get('params');

            $returnData = ((!$this->validate($params)) && !empty($this->saveItem($params, $app))) 
            ? array('success'=>1, 'data'=>'Added', 'reload'=>1)
            : array('success'=>0, 'data'=>'Error', 'error'=>1);

        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

		return $returnData;
	}


	public function update($request, $app) 
	{	
        try {

        	$params = $request->get('params');

            $check = $this->repo->find($params['id']);

            if (($app->providerSession->id == $check->providerId) && $this->editItem( $params )) 
            {

                $this->PricesController->saveItem($params['prices'], $check->id);

                $returnData = array('success'=>1, 'data'=>'Updated');
            } else {

               $returnData = array('error'=>'Not allowed');
            }

        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

		return $returnData;
	}

	public function delete($request, $app) 
	{	

        try {

        	$params = $request->get('params');
            
            $check = $this->repo->find($params['id']);

            $returnData = (($app->providerSession->id == $check->providerId) && $this->deleteItem( $params['id'] )) 
            ? array('success'=>1, 'data'=>'Deleted', 'reload'=>1)
            : array('error'=>'Not allowed');


        } catch (Exception $e) {

            $returnData = array('error'=>$e->getMessage());
        }   

		return $returnData;
	}



	public function getItem($deviceId = null) : ?Device
	{	
		return $this->repo->find($deviceId);
	}



	public function getAll($limit = 100) 
	{	

		return $this->repo->getAll($limit);
	}



	public function saveItem($params, $app) : ?Device
	{

		$data['title'] = $params['title'];
		$data['providerId'] = $app->providerSession->id;
		$data['type'] = $params['type'];
		$data['playing'] = 0;
		$data['publish'] = 1;

		return $this->repo->store($data);

	}


	public function editItem($params) 
	{

		$check = $this->repo->find($params['id']);

		$check->title = $params['title'];	
		$check->type = $params['type'];	
		$check->publish = !empty($params['publish']) ? 1 : 0;	

		return $this->repo->edit($check);	

	}


	public function deleteItem($id) 
	{

		return $this->repo->delete($this->repo->find($id));	

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

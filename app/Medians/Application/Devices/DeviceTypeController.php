<?php

namespace Medians\Application\Devices;

use Medians\Infrastructure\Devices as Repo;

use Medians\Domain\Devices\DeviceType;

class DeviceTypeController
{

	/*
	// @var Object
	*/
	protected $repo;

	/*
	// @var Array
	*/
	protected $data = array();
	

	function __construct($data = null)
	{

		$this->data = (object) $data;

		$this->repo = new Repo\DevicesTypesRepository();

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
	    return $twig->render('views/admin/devices/device_types.html.twig', [
	        'title' => 'Device types',
	        'app' => $app,
	        'typesList' => $this->getAll(),
	        'devicesList' => (new DeviceController)->getAll(),
	    ]);

	}




	public function edit(int $id , $app, $twig) 
	{

		return $twig->render('views/admin/forms/edit_device_type.html.twig', [
	        'title' => 'Edit device type',
	        'app' => $app,
	        'deviceType' => $this->getItem($id),
	    ]);

	}



	public function getItem($deviceId = null) 
	{	
		return $this->repo->find($deviceId);
	}


	public function getAll() 
	{	

		return $this->repo->getAll();
	}


	public function create($data = []) 
	{
		$this->data = (object) $data;

		return $this;
	}


	public function store($request, $app) 
	{

		$params = $request->get('params');

        try {

        	$data = [
        		'title' => $params['title'],
        		'publish' => 1, 
    		]; 

            $returnData = ((!$this->validate($params)) && !empty($this->repo->store($data))) 
            ? array('success'=>1, 'data'=>'Added', 'reload'=>1)
            : array('success'=>0, 'data'=>'Error', 'error'=>1);

        } catch (Exception $e) {

            $returnData = array('error'=>$e->getMessage());
        }

		return $returnData;
	}



	public function update($request, $app)
	{
		$params = $request->get('params');

        try {

            if ($this->repo->find($params['id'])->id)
            {
            	$data = [
            		'title' => $params['title'],
            	];

                if ($this->repo->edit($params))
                {
                    return array('success'=>1, 'data'=>'Deleted', 'reload'=>1);
                }
            
            }

        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }

	}


	public function delete($request, $app) 
	{

		$params = $request->get('params');

        try {

            if ($this->repo->find($params['id'])->id)
            {
                if ($this->repo->delete($params['id']))
                {
                    return array('success'=>1, 'data'=>'Deleted', 'reload'=>1);
                }
            
            }

        } catch (Exception $e) {

            return array('error'=>$e->getMessage());
        }

	}

	public function validate($params) 
	{

		if (empty($params['title']))
		{
			throw new \Exception("Empty title", 1);
		}

	}

}

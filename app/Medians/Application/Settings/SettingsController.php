<?php

namespace Medians\Application\Settings;

use Medians\Infrastructure\Settings as Repo;


class SettingsController
{

	/**
	* @var Object
	*/
	protected $repo;

	public $app;



	function __construct($app)
	{
		$this->app = $app;

		$this->repo = new Repo\SettingsRepository($app);

	}

	/**
	 * Index settings page
	 * 
	 */
	public function index($request, $app)
	{

		return render('views/admin/forms/settings_form.html.twig', [
	        'title' => 'Settings',
	        'app' => $app,
	    ]);
	} 



	public function getItem($code = null) 
	{	
		return $this->repo->getByCode($code);
	}


	public function getAll() 
	{	
		return array_column(json_decode($this->repo->getAll()), 'value', 'code');
	}



	/*
	// Return the Settings
	*/
	public function update($request, $app) 
	{

		$params = $request->get('params')['settings'];

		try {

            if (isset($this->updateSettings($params, $app)->updated)) 
            	return array('success'=>1, 'data'=>'Updated', 'reload'=>1);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/*
	// Return the Settings
	*/
	public function updateSettings($params, $app) 
	{

		foreach ($params as $code => $value)
		{

			$this->updated = isset($app->Settings[$code]) ? $this->deleteItem($code) : true;

			if (isset($this->updated))
			{
				$this->saveItem($code, $value);
			}
		}

		return $this;
	}




	public function saveItem($code, $value) 
	{

		$data = [
			'provider_id' => $this->app->provider->id,
			'created_by' => $this->app->auth->id,
			'model' => '',
			'code' => $code,
			'value' => $value
		];

		return $this->repo->store($data);

	}


	public function deleteItem($code) 
	{

		return $this->repo->delete($this->repo->getByCode($code));
	}


}

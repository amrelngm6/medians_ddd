<?php

namespace Medians\Application\Providers;

use Medians\Infrastructure\Providers\ProviderRepository;


class ProviderController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	public $app;


	function __construct($app = null)
	{

		$this->app = $app;
		
		$this->repo = new ProviderRepository($app);
	}



	/**
	 * Index page
	 * 
	 */
	public function index($request)
	{
		return render('views/admin/providers/list.html.twig', [
			'items' => $this->getData(),
	        'title' => __('providers'),
	        'app' => $this->app,
	    ]);
	} 

	/**
	 * Index page
	 * 
	 */
	public function getData()
	{
		return ($app->auth->role_id == 1) ? $this->repo->get() : $this->repo->find($this->app->provider->id);
	} 
	


}

<?php

namespace Medians\Application\Customers;

use Medians\Infrastructure as Repo;



class CustomerController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{

		$this->repo = new Repo\Customers\CustomerRepository();

		$this->LeadSourcesrepo = new Repo\Leads\LeadSourcesRepository();

		$this->AgentRepo = new Repo\Users\UserRepository();

	}


	/**
	 * Index page
	 * 
	 */
	public function index($request, $app, $twig)
	{
		$this->AgentRepo->app = $app;
		return render('views/admin/customers/list.html.twig', [
			'items' =>  $this->repo->get(),
	        'title' => 'Customers',
	        'app' => $app,
	    ]);
	} 


	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $twig)
	{
		$this->AgentRepo->app = $app;
		return render('views/admin/customers/create.html.twig', [
	        'title' => 'Customers',
	        'Model' => $this->repo->getModel(),
	        'agents' => $this->AgentRepo->get(),
	        'sources' => $this->LeadSourcesrepo->getModel()->get(),
	        'stages' => $this->repo->getModel()->LoadStages(),
	        'app' => $app,
	    ]);
	} 





	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = (array) json_decode($request->get('params')['customer']);

		try {	

			if (empty($params['first_name']))
	        	return array('error'=>1, 'result'=>'First Name is required');

			if (empty($params['phone']))
	        	return array('error'=>1, 'result'=>'Phone is required');

			$this->repo->app = $app;
			$params['created_by'] = $app->auth->id;
			$Property = $this->repo->store($params);

        	return array('success'=>1, 'result'=>'Created');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  Store item
	*/
	public function update($request, $app) 
	{

		$params = (array)  json_decode($request->get('params')['customer']);

		try {

			$this->repo->app = $app;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



}

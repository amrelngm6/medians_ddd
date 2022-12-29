<?php

namespace Medians\Application\Leads;

use Medians\Infrastructure as Repo;


class LeadController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
	
		$this->repo = new Repo\Leads\LeadRepository();

		$this->LeadSourcesrepo = new Repo\Leads\LeadSourcesRepository();

		$this->AgentRepo = new Repo\Users\AgentRepository();

	}

	/**
	 * Index page
	 * 
	 */
	public function index($request, $app, $twig)
	{
		return $twig->render('views/admin/leads/list.html.twig', [
			'items' =>  $this->repo->getModel()->with('Agent', 'source')->get(),
	        'title' => 'Leads',
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $twig)
	{
		return $twig->render('views/admin/leads/create.html.twig', [
	        'title' => 'Leads',
	        'Model' => $this->repo->getModel(),
	        'agents' => $this->AgentRepo->getModel()->get(),
	        'sources' => $this->LeadSourcesrepo->getModel()->get(),
	        'stages' => $this->repo->getModel()->LoadStages(),
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id, $request, $app, $twig)
	{
		return $twig->render('views/admin/leads/create.html.twig', [
	        'title' => 'Leads',
	        'Model' => $this->repo->find($id),
	        'agents' => $this->AgentRepo->getModel()->get(),
	        'sources' => $this->LeadSourcesrepo->getModel()->get(),
	        'stages' => $this->repo->getModel()->LoadStages(),
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






	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = json_decode($request->get('params')['lead']);

		try {

			$Property = $this->repo->store((array) $params);

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

		$params = json_decode($request->get('params')['lead']);

		try {

			$Property = $this->repo->update((array) $params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}




}

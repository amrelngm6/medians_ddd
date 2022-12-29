<?php

namespace Medians\Application\Contacts;

use Medians\Infrastructure as Repo;


class ContactController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
	
		$this->repo = new Repo\Contacts\ContactRepository();

		$this->LeadSourcesrepo = new Repo\Leads\LeadSourcesRepository();

		$this->AgentRepo = new Repo\Users\AgentRepository();

	}

	/**
	 * Index page
	 * 
	 */
	public function index($request, $app, $twig)
	{
		return $twig->render('views/admin/contacts/list.html.twig', [
			'items' =>  $this->repo->getModel()->with('Agent', 'source')->get(),
	        'title' => 'Contacts',
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $twig)
	{
		return $twig->render('views/admin/contacts/create.html.twig', [
	        'title' => 'Contacts',
	        'Model' => $this->repo->getModel(),
	        'agents' => $this->AgentRepo->getModel()->get(),
	        'sources' => $this->LeadSourcesrepo->getModel()->get(),
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id, $request, $app, $twig)
	{
		return $twig->render('views/admin/contacts/create.html.twig', [
	        'title' => 'Contacts',
	        'Model' => (object) $this->repo->find($id),
	        'agents' => $this->AgentRepo->getModel()->get(),
	        'sources' => $this->LeadSourcesrepo->getModel()->get(),
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

		$params = $request->get('params')['contact'];

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

		$params = $request->get('params')['contact'];

		try {

			$Property = $this->repo->update((array) $params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}




}

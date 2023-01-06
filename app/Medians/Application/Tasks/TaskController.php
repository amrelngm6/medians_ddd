<?php

namespace Medians\Application\Tasks;

use Medians\Infrastructure as Repo;


class TaskController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
	
		$this->repo = new Repo\Tasks\TaskRepository();

		$this->AgentRepo = new Repo\Users\AgentRepository();


	}


	/**
	 * Index page
	 * 
	 */
	public function index($request, $app, $twig)
	{
		return render('views/admin/tasks/list.html.twig', [
			'items' =>  $this->repo->getModel()->with('Files', 'Owner', 'TaskUsers')->get(),
	        'title' => 'Tasks',
	        'agents' => $this->AgentRepo->get(),
	        'app' => $app,
	    ]);
	} 





	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = (array) json_decode($request->get('params')['task']);

		try {	

			if (empty($params['name']))
	        	return array('error'=>1, 'result'=>'Name is required');

			if (empty($params['start_date']))
	        	return array('error'=>1, 'result'=>'Date is required');

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

		$params = (array)  json_decode($request->get('params')['task']);

		try {

			$this->repo->app = $app;
			$Property = $this->repo->update($params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}




}

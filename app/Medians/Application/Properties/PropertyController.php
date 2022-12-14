<?php

namespace Medians\Application\Properties;

use Medians\Infrastructure\Properties as Repo;


class PropertyController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
	
		$this->repo = new Repo\PropertyRepository();

	}

	/**
	 * Index page
	 * 
	 */
	public function index($request, $app, $twig)
	{
		return $twig->render('views/admin/properties/list.html.twig', [
			'items' =>  $this->repo->getModel()->get(),
	        'title' => 'Properties',
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $twig)
	{
		return $twig->render('views/admin/properties/create.html.twig', [
	        'title' => 'Properties',
	        'Model' => $this->repo->getModel(),
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id, $request, $app, $twig)
	{
		return $twig->render('views/admin/properties/create.html.twig', [
	        'title' => 'Properties',
	        'Model' => $this->repo->find($id),
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

		$params = json_decode($request->get('params')['property']);

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

		$params = json_decode($request->get('params')['property']);

		try {

			$Property = $this->repo->update((array) $params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}




}

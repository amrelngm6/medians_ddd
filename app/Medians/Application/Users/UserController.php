<?php

namespace Medians\Application\Users;

use Medians\Infrastructure\Users\UserRepository;


class UserController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{

		$this->repo = new UserRepository;
	}




	/**
	 * Index page
	 * 
	 */
	public function index($list, $title, $app, $twig)
	{
		return render('views/admin/users/list.html.twig', [
			'items' =>  $list,
	        'title' => $title,
	        'app' => $app,
	    ]);
	} 


	/**
	 * Administrators page
	 * 
	 */
	public function admins($request, $app, $twig)
	{
		return $this->index( $this->queryByRole(1), 'Administrators', $app, $twig );
	}


	/** 
	 * Query users
	 */
	public function queryByRole($role_id)
	{
		return	$this->repo->getModel()->with('Role', 'properties')->where('role_id', $role_id)->get();

	} 



	/**
	 * Index page
	 * 
	 */
	public function index($list, $title, $app, $twig)
	{
		return render('views/admin/users/list.html.twig', [
			'items' =>  $list,
	        'title' => $title,
	        'app' => $app,
	    ]);
	} 


	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $twig)
	{
		return render('views/admin/users/create.html.twig', [
	        'title' => 'Users',
	        'Model' => $this->repo->getModel(),
	        '' => '',
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id, $request, $app, $twig)
	{
		return render('views/admin/users/create.html.twig', [
	        'title' => 'Users',
	        'Model' => $this->repo->find($id),
	        'app' => $app,
	    ]);
	} 




	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = $request->get('params')['user'];

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

		$params = $request->get('params')['user'];

		try {

			$Property = $this->repo->update((array) $params);

        	return array('success'=>1, 'result'=>'Updated');

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}




}

<?php

namespace Medians\Application\Users;

use Medians\Infrastructure\Users\UserRepository;


class UserController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;

	public $app;

	function __construct($app)
	{
		$this->app = $app;
		$this->repo = new UserRepository($app);
	}




	/**
	 * Index page
	 * 
	 */
	public function index($list, $title, $app)
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
	public function admins($request, $app)
	{	
		if ($app->auth->role_id == 1)
		{
			return $this->index( $this->queryByRole(1), 'Administrators', $app, $twig );
		} else {
			return $this->index( $this->queryByRole(3), 'Users', $app, $twig );
		}
	}


	/** 
	 * Query users
	 */
	public function queryByRole($role_id)
	{
		return	$this->repo->getModel()->with('Role')->where('role_id', $role_id)->get();

	} 



	/**
	 * Create page
	 * 
	 */
	public function create($request, $app, $role_id = 3)
	{
		return render('views/admin/users/create.html.twig', [
	        'title' => __('Users'),
	        'Model' => $this->repo->getModel(),
	        'role_id' => $role_id,
	        'app' => $app,
	    ]);
	} 

	/**
	 * Create page
	 * 
	 */
	public function edit($id, $request, $app)
	{
		return render('views/admin/users/create.html.twig', [
	        'title' => __('Users'),
	        'Model' => $this->repo->find($id),
	        'app' => $app,
	    ]);
	} 




	/**
	*  Store item
	*/
	public function store($request, $app) 
	{

		$params = (array)  $request->get('params')['user'];

		try {

			if ($this->validate($params))
				return $this->validate($params);

			$params['role_id'] = !empty($params['role_id']) ? $params['role_id'] : 3;
			$params['provider_id'] = isset($app->provider->id) ? $app->provider->id : 0;

			$save = $this->repo->store($params);

        	return array('status'=>1, 'result'=>__('Created'));

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}



	/**
	*  Store item
	*/
	public function validate($params) 
	{
		$check = $this->repo->checkDuplicate($params);

		if (empty($params['first_name']))
			return ['result'=> __('Name required')];

		if (empty($params['email']))
			return ['result'=> __('Email required')];

		if (empty($params['password']))
			return ['result'=> __('Password required')];

		if ($check)
			return ['result'=>$check];

	}



	/**
	*  Store item
	*/
	public function update($request, $app) 
	{

		$params = (array)  $request->get('params')['user'];

		try {

			$params['provider_id'] = isset($app->provider->id) ? $app->provider->id : 0;
			$save = $this->repo->update($params);

        	return array('status'=>true, 'result'=>'Updated');

        } catch (Exception $e) {
            return  $e->getMessage();
        }
	}




}

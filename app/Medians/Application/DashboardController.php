<?php

namespace Medians\Application;

use Medians\Infrastructure as Repo;


class DashboardController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		

	}

	/**
	 * Model object 
	 * 
	 */
	public function index($request, $twig, $app)
	{

        return  render('views/admin/dashboard/index.html.twig', [
            'title' => 'Dashboard',
            'app' => $app,
            'formAction' => $app->CONF['url'],
        ]);
	} 


}

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

        return  $twig->render('views/admin/dashboard/index.html.twig', [
            'title' => 'Dashboard',
            'app' => $app,
            'properties' => (new Repo\Properties\PropertyRepository)->get(5),
            'tasks' => (new Repo\Tasks\TaskRepository)->get(5),
            'leads' => (new Repo\Leads\LeadRepository)->get(5),
            'contacts' => (new Repo\Contacts\ContactRepository)->get(5),
            'formAction' => $app->CONF['url'],
        ]);
	} 


}

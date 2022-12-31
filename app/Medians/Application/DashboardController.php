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
            'properties_count' => (new Repo\Properties\PropertyRepository)->getModel()->count(),
            'tasks' => (new Repo\Tasks\TaskRepository)->get(5),
            'tasks_count' => (new Repo\Tasks\TaskRepository)->getModel()->count(),
            'leads' => (new Repo\Leads\LeadRepository)->get(5),
            'leads_count' => (new Repo\Leads\LeadRepository)->getModel()->count(),
            'contacts' => (new Repo\Contacts\ContactRepository)->get(5),
            'formAction' => $app->CONF['url'],
        ]);
	} 


}

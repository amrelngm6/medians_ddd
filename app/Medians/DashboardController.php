<?php

namespace Medians;


class DashboardController
{

	/**
	* @var Object
	*/
	protected $repo;



	function __construct()
	{
		$this->app = new \config\APP;
	}

	/**
	 * Model object 
	 */
	public function index()
	{

		try {
			

	        return  render('views/admin/dashboard/index.html.twig', [

	        ]);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


}

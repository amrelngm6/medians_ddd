<?php

namespace config;

use Twig\Environment;
use \NoahBuscher\Macaw\Macaw;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Medians\Settings\Infrastructure\SettingsRepository;



class APP 
{

	// public $auth;

	public $branch;

	public $CONF;

	public $currentPage;

	public $Settings;



	function __construct()
	{
		$this->currentPage = $this->request()->getPathInfo();

		$this->CONF = (new \config\Configuration())->getCONFArray();

		$this->branch = isset($this->auth()->branch) ? $this->auth()->branch : null;

	}

	public function Settings()
	{
		return  (new \Medians\Settings\Application\SettingsController())->getAll();
	}

	public function setting($code)
	{
		return (new SettingsRepository)->getByCode($code);
	}

	public function auth()
	{
		return (new \Medians\Auth\Application\AuthService( new \Medians\Users\Infrastructure\UserRepository($this), $this ))->checkSession();
	}

	public static function request()
	{
		return Request::createFromGlobals();
	}


	public static function redirect($url)
	{
		return new RedirectResponse($url);
	}

	public function  run()
	{
		Macaw::dispatch();

		return true;

	}


	/**
	 * Template for Twig render 
	 */
	public function template()
	{
		$twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader('./app'), 
		    [
		        //'cache' => '/app/cache',
		        'debug' => true,
		    ]
		);

		$twig->addFilter(new \Twig\TwigFilter('html_entity_decode', 'html_entity_decode'));

		return $twig;
	}

	
	/**
	* Return 
	* List of side menu
	*/
	public function menu()
	{
		$data = array(
			array('title'=>__('Dashboard'), 'icon'=>'fa-dashboard', 'link'=>'dashboard'),
	        array('title'=>__('Quizzes'),  'icon'=>'fa-file-invoice', 'link'=>'', 'sub'=>
	            [
	                array('title'=>__('Quizzes'),  'icon'=>'fa-dashboard', 'link'=>'quizzes/index'),
	                array('title'=>__('Options'),  'icon'=>'fa-dashboard', 'link'=>'quiz_options/index'),
	            ]
	        ),
	        // array('title'=>__('Users'),  'icon'=>'fa-users', 'link'=>'', 'sub'=>
	        //     [
	        //         array('title'=>__('Users'),  'icon'=>'fa-dashboard', 'link'=>'users/'),
	        //         array('title'=>__('add_User'),  'icon'=>'fa-dashboard', 'link'=>'users/create'),
	        //     ]
	        // ),


			// array('title'=> __('Settings'),  'icon'=>'fa-cogs', 'link'=>'settings'),
			array('title'=> __('Logout'),  'icon'=>'fa-sign-out', 'link'=>'logout'),
		);

		return $data;
	}

}
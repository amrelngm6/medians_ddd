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
	public function index($request, $app)
	{

		try {
			
	        return  render('views/admin/dashboard/index.html.twig', [
	            'title' => 'Dashboard',
	            'app' => $app,
	            'active_order_devices_count' => (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'active')->count(),
	            'today_order_devices_count' => (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->count(),
	            'today_orders_count' => (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'paid')->groupBy('order_code')->count(),
	            'latest_paid_order_devices' => (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')], 5)->where('status', 'paid')->get(),
	            'latest_unpaid_order_devices' => (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')], 5)->where('status','!=', 'paid')->get(),
	            'latest_order_products' => (new Repo\Products\StockRepository($app))->getLatest(5)->get(),
	            'formAction' => $app->CONF['url'],
	        ]);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


}

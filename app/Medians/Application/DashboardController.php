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
			
			$today_revenue = (new Repo\Orders\OrdersRepository($app))->getByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->sum('total_cost');
            
            $latest_order_products =  (new Repo\Products\StockRepository($app))->getLatest(5)->get();

            $today_order_products_count =  (new Repo\Products\StockRepository($app))->getLatest(1000)->where('type', 'pull')->where('date', date('Y-m-d'))->count();
            
            $latest_unpaid_order_devices = (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')], 5)->where('status','!=', 'paid')->get();

            $latest_paid_order_devices =  (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')], 5)->where('status', 'paid')->get();

            $today_orders_count = (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'paid')->groupBy('order_code')->count();

            $active_order_devices_count = (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->where('status', 'active')->count();

            $today_order_devices_count = (new Repo\Devices\DevicesRepository($app))->eventsByDate(['start'=>date('Y-m-d'), 'end'=>date('Y-m-d')])->count();

	        return  render('views/admin/dashboard/index.html.twig', [
	            'title' => 'Dashboard',
	            'app' => $app,
	            'active_order_devices_count' => $active_order_devices_count,
	            'today_order_devices_count' => $today_order_devices_count,
	            'today_orders_count' => $today_orders_count,
	            'latest_paid_order_devices' => $latest_paid_order_devices,
	            'latest_unpaid_order_devices' => $latest_unpaid_order_devices,
	            'latest_order_products' => $latest_order_products,
	            'today_order_products_count' => $today_order_products_count,
	            'today_revenue' => round($today_revenue, 2),
	            'formAction' => $app->CONF['url'],
	        ]);
	        
		} catch (Exception $e) {
			return $e->getMessage();
		}
	} 


}

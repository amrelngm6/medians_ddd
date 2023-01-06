<?php

namespace Medians\Application\Orders;

use Medians\Infrastructure\Orders as Repo;
use Medians\Application\Devices\Device;
use Medians\Application\Calculator\Calculator;
use Medians\Application\Prices\Prices;
use Medians\Application\Discounts\Discount;

use Medians\Domain\Orders\Order;

class OrderController
{


	function __construct()
	{

		$this->repo = new Repo\OrdersRepository();
	}



	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index($filter = 'month', $app, $twig) 
	{

	    switch ($filter) 
	    {
	        case 'lastweek':
	            $query = $this->getByLastWeek( $app->providerSession->id );
	            break;

	        case 'month':
	            $query = $this->getByMonth($app->providerSession->id, date('Y-m'), date('Y-m', strtotime('+1 month')));
	            break;
	    }


	    $app->currentPage = '/orders';


	    return render('views/admin/orders/orders.html.twig', [
	        'title' => 'Orders list',
	        'app' => $app,
	        'orders' => $query,
	        'todayOrders' => count($this->getByLastDay($app->providerSession->id)),
	        'lastWeekOrders' => count($this->getByLastWeek($app->providerSession->id)),
	        'lastMonthOrders' => count($this->getByMonth($app->providerSession->id, date('Y-m'), date('Y-m', strtotime('+1 month')))),

	    ]);

	}



	public function getItem($id) 
	{

		return $this->repo->getById($id);
	}

	public function getByCode($code) 
	{

		return $this->repo->getByCode($code);
	}


	public function getByMonth(?Int $providerId, $month, $nextmonth) 
	{
		return $this->repo->getByMonth($providerId, $month, $nextmonth);
	}


	public function getByLastWeek($providerId ) 
	{

		return $this->repo->getByDate($providerId , date('Y-m-d', strtotime('-1 week') ), date('Y-m-d', strtotime('+1 day') ) );
	}

	public function getByLastDay($providerId) 
	{
		return $this->repo->getByDate($providerId, date('Y-m-d' ), date('Y-m-d', strtotime('+1 day') )  );
	}

	public function getSalesByDay($providerId, $day) 
	{
		return $this->repo->getSalesByDay($providerId , $day, date('Y-m-d', strtotime("+1 day", strtotime($day))) );
	}

	public function getAll($providerId, $limit = null) 
	{

		return $this->repo->getAll( $providerId, $limit );
	}



	public function checkDiscountUsed($discountCode) 
	{
		return $this->repo->getByDiscountCode($discountCode);
	}


	public function handleOrderDiscount($discountCode) : OrderModel
	{
		
		$this->discountCodeObject = (new Discount())->validateCodeWithOrder($discountCode, $this->OrderModel);

		if (count($this->checkDiscountUsed($this->discountCodeObject->code())) >= $this->discountCodeObject->useCount())
		{
			throw new \Exception("Error: This code usage limit has exceeded", 1);
		}

        $this->OrderModel->setDiscountCode($this->discountCodeObject->code());

        $this->OrderModel->setTotalCost($this->costWithDiscount($this->OrderModel));

        $this->editItem();


        return $this->OrderModel;

	}











	/*
	// Calculate Discount
	*/
	public function costWithDiscount(OrderModel $OrderModel) : ?Float
	{
		return ( new Discount)->costWithDiscount($OrderModel);
	}


	/*
	// Count methods
	*/
	public function getCostByMonth($providerId, $month = null)
	{

		$month = empty($month) ? date('Y-m') : $month;
		$nextmonth = date('Y-m', strtotime('+1 month', strtotime($month))) ;

		return $this->repo->getCostByMonth($providerId, $month, $nextmonth);

	} 





}

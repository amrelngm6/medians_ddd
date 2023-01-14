<?php

namespace Medians\Application\Orders;

use Medians\Infrastructure\Orders\OrdersRepository;
use Medians\Application\Devices\Device;
use Medians\Application\Calculator\Calculator;
use Medians\Application\Prices\Prices;
use Medians\Application\Discounts\Discount;

use Medians\Domain\Orders\Order;

class OrderController
{


	function __construct($app)
	{

		$this->repo = new OrdersRepository($app);
	}



	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index($request, $app) 
	{


    	$params['start'] = $request->get('start') ? date('Y-m-d', strtotime(date($request->get('start')))) : date('Y-m-d');
    	$params['end'] = ($request->get('end') && $request->get('start')) ? date('Y-m-d', strtotime(date($request->get('end')))) : date('Y-m-d');
    	$params['created_by'] = $request->get('created_by') ? $request->get('created_by') : null;
    	$params['status'] = $request->get('status') ? $request->get('status') : null;

	    $app->currentPage = '/orders';

	    return render('views/admin/orders/orders.html.twig', [
	        'title' => __('Orders list'),
	        'app' => $app,
	        'orders' => $this->repo->getByDate($params)->get(),
	        'todayOrders' => $this->repo->getByDate(['start'=>date('Y-m-d' ), 'end'=>date('Y-m-d', strtotime('+1 day') )])->count(),
	        'lastWeekOrders' => $this->repo->getByDate(['start'=>date('Y-m-d',strtotime('-1 week')), 'end'=>date('Y-m-d', strtotime('+1 day'))])->count(),
	        'lastMonthOrders' => $this->repo->getByDate(['start'=>date('Y-m-01'), 'end'=>date('Y-m-01', strtotime('+1 month'))])->count(),

	    ]);

	}



	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function show($code, $request, $app) 
	{
	    return render('views/admin/orders/order.html.twig', [
	        'title' => __('Invoice'),
	        'app' => $app,
	        'order' => $this->repo->code($code),
	        // 'qrcode' => $qrcode,
	    ]);

	}




	/**
	* Genrate unique code 
	*/
	public function genrateCode() : String
	{
		return time().rand(9,99);
	}


	public function checkout($request, $app) 
	{

		$params = (array) json_decode($request->get('params')['cart']);

		try {

			$cost = 0;

			foreach ($params as $key => $value) 
			{
				$cost += $value->subtotal;
			}

			$data = [];
			$data['provider_id'] = $app->provider->id;
			$data['customer_id'] = '0';
			$data['tax'] = '0';
			$data['discount'] = '0';
			$data['discount_code'] = '';
			$data['code'] = $this->genrateCode();
			$data['subtotal'] = $this->getSubTotal($params);
			$data['total_cost'] = $this->getSubTotal($params) ;
			$data['date'] = date('Y-m-d');
			$data['created_by'] = $app->auth->id;
			$data['status'] = 'paid';
			$data['payment_method'] = $request->get('params')['payment_method'];

			$save = $this->repo->store($data, $params);

        	return isset($save->id) ? __('Order Created') : '' ;

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}



	public function calculate($cost, $startTime, $endTime) 
	{

		$interval = date_diff(new \DateTime($startTime) , new \DateTime($endTime));

		return (new Calculator
			( 	
				$cost, 
				$interval->format('%h'), 
				$interval->format('%i')
			)
		)->getCost(0);

	}	


	public function getSubTotal($params)  
	{
		$cost = 0;
		if (!empty($params))
		{
			foreach ($params as $key => $value) 
			{
				$cost = round(((float) $value->subtotal) + ((float) $cost), 2);

				if (!empty($value->products))
				{
					foreach ($value->products as $product) 
					{
						$cost = round(((float) $product->subtotal) + ((float) $cost), 2);
					}		
				}
			}
		}


		return $cost;
	}

	public function calculateCost($item)  
	{
		return $this->calculate($item->subtotal, $item->start_time, $item->end_time );
	}
	

	public function calculateTime($time1, $time2) 
	{

		$start_date = new \DateTime($time1);

		return array_map(function($a){
			return ($a > 9) ? $a : '0'.$a;
		}, (array) $start_date->diff(new \DateTime($time2)));
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
			throw new \Exception(__("Error: This code usage limit has exceeded"), 1);
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

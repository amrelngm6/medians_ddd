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

	    switch ($request->get('filter')) 
	    {
	        case 'lastweek':
	            $query = $this->repo->getByDate(date('Y-m-d',strtotime('-1 week')), date('Y-m-d', strtotime('+1 day')));
	            break;

	        case 'month':
	            $query = $this->repo->getByDate(date('Y-m-01', strtotime(date($request->get('month')))), date('Y-m-31', strtotime(date($request->get('month')))));
	            break;

	        case 'date':
	        	$start = $request->get('start') ? date('Y-m-d', strtotime(date($request->get('start')))) : date('Y-m-d');
	        	$end = $request->get('end') ? date('Y-m-d', strtotime(date($request->get('end')))) : date('Y-m-d');
	        	$query = $this->repo->getByDate($start, $end);
	        	break;	
	        default:
	        	$query = $this->repo->getByDate(date('Y-m-d'), date('Y-m-d', strtotime('+1 day')));
	        	break;	
	    }


	    $app->currentPage = '/orders';


	    return render('views/admin/orders/orders.html.twig', [
	        'title' => 'Orders list',
	        'app' => $app,
	        'orders' => $query,
	        'todayOrders' => count($this->repo->getByDate(date('Y-m-d' ), date('Y-m-d', strtotime('+1 day') )  )),
	        'lastWeekOrders' => count($this->repo->getByDate(date('Y-m-d',strtotime('-1 week')), date('Y-m-d', strtotime('+1 day')))),
	        'lastMonthOrders' => count($this->repo->getByDate(date('Y-m'), date('Y-m', strtotime('+1 month')))),

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
	        'title' => 'Invoice',
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
			$data['subtotal'] = $cost;
			$data['total_cost'] = $cost;
			$data['date'] = date('Y-m-d');
			$data['created_by'] = $app->auth->id;
			$data['status'] = 'paid';
			$data['payment_method'] = $request->get('params')['payment_method'];

			$save = $this->repo->store($data, $params);

        	return isset($save->id) ? 'Order Created' : '' ;

        } catch (Exception $e) {
            echo $e->getMessage();
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

<?php

namespace Medians\Application\Payments;

use Medians\Infrastructure\Payments\PaymentsRepository;

class PaymentController
{

	/*
	// @var Object
	*/
	protected $repo;



	function __construct($app)
	{
		$this->repo = new PaymentsRepository($app);
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
		return render('views/admin/payments/list.html.twig', [
	        'title' => 'Payments list',
	        'app' => $app,
	        'items' => $this->repo->get($request),
	    ]);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function create($request, $app) 
	{
		return render('views/admin/payments/create.html.twig', [
	        'title' => 'New Payment',
	        'app' => $app,
	    ]);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function edit($id, $request, $app) 
	{
		return render('views/admin/payments/payment.html.twig', [
	        'title' => 'Edit Payment',
	        'app' => $app,
	        'payment' => $this->repo->find($id),
	    ]);
	}



	/**
	 * Store item to database
	 * 
	 * @param Symfony\Component\HttpFoundation\Request $request
	 * @param Silex\Application $app
	 * 
	 * @return [] 
	*/
	public function store($request, $app) 
	{	
        
		$params = $request->get('params')['payment'];

        try {
        	$params['provider_id'] = $app->provider->id;
        	$params['created_by'] = $app->auth->id;
        	
            return ($this->repo->store($params))
            ? array('success'=>1, 'data'=>'Added', 'reload'=>1)
            : array('success'=>0, 'data'=>'Error', 'error'=>1);


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
	
	}



	/**
	 * Update item to database
	 * 
	 * @param Symfony\Component\HttpFoundation\Request $request
	 * @param Silex\Application $app
	 * 
	 * @return [] 
	*/
	public function update($request, $app) 
	{
		$params = $request->get('params')['payment'];

        try {


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'data'=>'Updated', 'redirect'=>$app->CONF['url'].'payments/index')
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}


	/**
	 * Delete item from database
	 * 
	 * @param Symfony\Component\HttpFoundation\Request $request
	 * @param Silex\Application $app
	 * 
	 * @return [] 
	*/
	public function delete($request, $app) 
	{
		$params = $request->get('params');

        try {

           	$returnData =  $this->repo->delete($params['id'])
           	? array('success'=>1, 'data'=>'Deleted', 'reload'=>1)
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}





}

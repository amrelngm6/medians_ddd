<?php

namespace Medians\Application\Products;

use Medians\Infrastructure as Repo;

use Medians\Application\Products\ProductController;


class StockController
{


	function __construct($app)
	{

		$this->repo = new Repo\Products\StockRepository($app);
		$this->ProductsRepo = new Repo\Products\ProductsRepository($app);

	}




	public function index($request, $app) 
	{	

	    return render('views/admin/products/stock.html.twig', [
	        'title' => 'Products Stock',
	        'app' => $app,
	        'stockList' => $this->repo->get($request),
	        'products' => $this->ProductsRepo->get(),
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
        
        $params = $request->get('params')['stock'];

        try {

            $params['provider_id'] = $app->provider->id;
            $params['created_by'] = $app->auth->id;
            $params['date'] = date('Y-m-d');

            return !empty($this->repo->store($params)) 
            ? array('success'=>1, 'data'=>'Added', 'reload'=>1)
            : array('success'=>0, 'data'=>'Error', 'error'=>1);


        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
	
	}



	/**
	 * Excute Store item to database
	 * 
	 * @param Symfony\Component\HttpFoundation\Request::$params $params
	 * @param Silex\Application $app
	 * 
	 * @return [] 
	*/
	public function saveItem($params, $app) 
	{

		$data['providerId'] = $app->providerSession->id;
		$data['product'] = isset($params['product']) ? $params['product'] : 0;
		$data['stock'] = isset($params['stock']) ? $params['stock'] : 0;
		$data['startStock'] = isset($params['startStock']) ? $params['startStock'] : 0;
		$data['time'] = isset($params['time']) ? $params['time'] : date("Y-m-d H:i:s");
		$data['insertedBy'] = $app->providerSession->id;

		return $this->repo->store($data);

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

        	$check = $this->getItem($params['id']);

           	$returnData =  $this->repo->delete($params['id'])
           	? array('success'=>1, 'data'=>'Deleted', 'reload'=>1)
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}





}

<?php

namespace Medians\Application\Products;

use Medians\Infrastructure\Products as Repo;

use Medians\Application\Products\ProductController;

use Medians\Domain\Products\StockModel;

class StockController
{


	function __construct()
	{

		$this->repo = new Repo\StockRepository();

	}




	public function index($app, $twig) 
	{	

	    return render('views/admin/products/stock.html.twig', [
	        'title' => 'Products Stock',
	        'app' => $app,
	        'stockList' => $this->getByProvider($app->providerSession->id),
	        'products' => (new ProductController)->getByProvider($app->providerSession->id),
	    ]);
	}


	public function getItem($id) 
	{	
		return $this->repo->getById($id);
	}

	public function getByProvider($providerId, $limit = 100) 
	{	
		return $this->repo->getByProvider($providerId, $limit);
	}

	public function getItemStock($id, $qty = 1) : ?int 
	{	
		return $this->repo->getStock($id, $qty);
	}





	public function getAll($limit = 100) : Array
	{	

		return $this->repo->getAll($limit);
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
        
        $params = $request->get('params');

        try {

        	$check = (new ProductController)->getItem($params['product']);

        	if (empty($check->id))
            	return array('success'=>0, 'data'=>'Error', 'error'=>1);


            $params['stock'] = $params['startStock'];

            return !empty($this->saveItem($params, $app)) 
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

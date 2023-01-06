<?php

namespace Medians\Application\Products;

use Medians\Infrastructure\Products as Repo;
use Medians\Application\Devices\DeviceController;

class ProductController
{

	/*
	// @var Object
	*/
	protected $repo;



	function __construct()
	{

		$this->repo = new Repo\ProductsRepository();
	}



	public function getItem($id = 0) 
	{
		return $this->repo->find($id);
	}


	public function getByProvider($providerId = 0) 
	{
		return $this->repo->getByProvider($providerId);
	}


	public function getAll($limit = null) 
	{
		return $this->repo->getAll( $limit );
	}





	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index( $app, $twig) 
	{
		return render('views/admin/products/products.html.twig', [
	        'title' => 'Products list',
	        'app' => $app,
	        'products' => $this->getByProvider($app->providerSession->id),
	        'stock' => new StockController(null),
	    ]);
	}



	/**
	 * Get product order page
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function pos(Int $deviceId, $app, $twig) 
	{
		
	    return render('views/admin/products/pos.html.twig', [
	        'title' => 'Products list',
	        'app' => $app,
	        'device' => (new DeviceController)->getItem($deviceId),
	        'products' => $this->getByProvider($app->providerSession->id),
	        'stock' => new StockController(null),
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
        
        $params = $request->get('params');

        try {

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
		$data['title'] = isset($params['title']) ? $params['title'] : '';
		$data['picture'] = isset($params['picture']) ? $params['picture'] : 'default.png';
		$data['description'] = isset($params['description']) ? $params['description'] : '';
		$data['stock'] = isset($params['stock']) ? $params['stock'] : 0;
		$data['price'] = isset($params['price']) ? $params['price'] : 0;
		$data['type'] = isset($params['type']) ? $params['type'] : '';
		$data['publish'] = isset($params['picture']) ? $params['publish'] : 0;
		$data['playing'] = 0;

		return $this->repo->store($data);

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
		$params = $request->get('params');

        try {

        	$check = $this->getItem($params['id']);

           	$returnData =  ($this->editItem($request, $app ))
           	? array('success'=>1, 'data'=>'Updated', 'redirect'=>$app->CONF['url'].'provider_area/products')
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}


	/**
	 * excute Update item to database
	 * 
	 * @param Symfony\Component\HttpFoundation\Request $request
	 * @param Silex\Application $app
	 * 
	 * @return Medians\Domain\Products\Product 
	*/
	public function editItem($request, $app) 
	{

		$params = $request->get('params');

		$check = $this->repo->find($params['id']);

		$check->title = $params['title'];	
		$check->type = $params['type'];	
		$check->price = $params['price'];	
		$check->description = $params['description'];	
		$check->publish = !empty($params['publish']) ? 1 : 0;	

		return $this->repo->edit($check);	

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

           	$returnData =  (($app->providerSession->id == $check->providerId) && $this->repo->delete($params['id']))
           	? array('success'=>1, 'data'=>'Deleted', 'reload'=>1)
           	: array('error'=>'Not allowed');


        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        return $returnData;

	}



	public function updateStock($id, $newVal) : ProductModel
	{

		$this->ProductModel = $this->getItem($id);	
		$this->ProductModel->setStock( $newVal );	

		return $this->executeEdit();
	}




}

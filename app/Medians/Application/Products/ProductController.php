<?php

namespace Medians\Application\Products;

use Medians\Infrastructure\Products\ProductsRepository;
use Medians\Application\Devices\DeviceController;

class ProductController
{

	/*
	// @var Object
	*/
	protected $repo;



	function __construct()
	{

		$this->repo = new ProductsRepository();
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
		return render('views/admin/products/products.html.twig', [
	        'title' => 'Products list',
	        'app' => $app,
	        'products' => $this->repo->get($app->provider->id),
	        'typesList' => $this->repo->getModel()->categoriesList(),
	        'stock' => new StockController(null),
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
		return render('views/admin/products/product.html.twig', [
	        'title' => 'Products list',
	        'app' => $app,
	        'product' => $this->repo->find($id),
	        'typesList' => $this->repo->getModel()->categoriesList(),
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
	        'products' => $this->getByProvider($app->provider->id),
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
        
		$params = $request->get('params')['product'];

        try {

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
		$params = $request->get('params')['product'];

        try {

        	$check = $this->repo->find($params['id']);

           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'data'=>'Updated', 'redirect'=>$app->CONF['url'].'products/index')
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

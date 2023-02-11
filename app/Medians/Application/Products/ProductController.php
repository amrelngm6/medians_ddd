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



	function __construct($app)
	{

		$this->app = $app;

		$this->repo = new ProductsRepository($app);
	}


	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index($request) 
	{
		return render('views/admin/products/products.html.twig', [
	        'title' => __('Products list'),
	        'app' => $this->app,
	        'products' => $this->repo->get($request),
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
	public function stock_alert($request) 
	{

		return render('views/admin/products/products.html.twig', [
	        'title' => __('Stock alert products'),
	        'app' => $this->app,
	        'products' => $this->repo->getByStock((Int) $this->app->Settings['stock_alert']),
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
	public function stock_out($request) 
	{

		return render('views/admin/products/products.html.twig', [
	        'title' => __('Stock out products'),
	        'app' => $this->app,
	        'products' => $this->repo->getByStockOut(),
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
	        'title' => __('Products list'),
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
	public function pos(Int $deviceId, $app) 
	{
		
	    return render('views/admin/products/pos.html.twig', [
	        'title' => __('Products list'),
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
        	$params['provider_id'] = $app->provider->id;
        	$params['created_by'] = $app->auth->id;
            return ($this->repo->store($params))
            ? array('success'=>1, 'result'=>__('Added'), 'reload'=>1)
            : array('success'=>0, 'result'=>__('Error'), 'error'=>1);


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


           	$returnData =  ($this->repo->update($params))
           	? array('success'=>1, 'result'=>__('Updated'), 'redirect'=>$app->CONF['url'].'products/index')
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
           	? array('success'=>1, 'result'=>__('Deleted'), 'reload'=>1)
           	: array('error'=>__('Not allowed'));


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

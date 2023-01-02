<?php 

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;



// invoke a fresh QRCode instance
$qrcode = new QRCode();

// and dump the output

// quick and simple:

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// TWIG template engine
use Twig\Environment;

use Medians\Application as apps;
use Shared\dbaser;
use Medians\Infrastructure\Administrators\AdminRepository;
use Medians\Infrastructure\Users\UserRepository;


$app->menuList = getMenuList();
$app->currentPage = $request->getPathInfo();


$app->request = $request;

/*
// Return list of device 
*/
$app->post('', function () use ($twig, $app, $request) 
{ 

    $params = $request->get('params');

    switch ($request->get('type')) 
    {
        case 'userLogin':
            
            $returnData =  (new apps\Auth\AuthService( new AdminRepository() ))->userLogin($request, $app); 
            break;
        

        case 'add_device':
            
            $returnData =  (new apps\Devices\DeviceController( ))->store($request, $app); 
            break;

        case 'delete_device':
            
            $returnData = (new apps\Devices\DeviceController( ))->delete($request, $app); 
            break;
            
        case 'edit_device':
            
            $returnData = (new apps\Devices\DeviceController( ))->update($request, $app); 

            break;
        

        case 'add_device_type':
            
            $returnData = (new apps\Devices\DeviceTypeController)->store($request, $app); 

            break;
        
        case 'delete_device_type':
            
            $returnData = (new apps\Devices\DeviceTypeController)->delete($request, $app); 
            break;   
            
        case 'edit_device_type':
            
            $returnData = (new apps\Devices\DeviceTypeController)->update($request, $app); 
            break;
        
        case 'updateSettings':
            
            $returnData = (new apps\Settings\SettingsController)->update($request, $app); 

            break;

        case 'add_product':
            
            $returnData = (new apps\Products\ProductController($params))->store($request, $app); 

            break;
        
        case 'edit_product':
            
            $returnData = (new apps\Products\ProductController)->update($request, $app); 


            break;
        
        case 'delete_product':
            
            $returnData = (new apps\Products\ProductController)->delete($request, $app); 
        
            break;
        

        case 'add_stock':
            

            $returnData = (new apps\Products\StockController)->store($request, $app); 

            break;
        
        case 'delete_stock':
            
            $returnData = (new apps\Products\StockController)->delete($request, $app); 
        
            break;
        
        

        case 'order_product':
                
            $service = new apps\Orders\ProductOrder(null); 

            try {

                $checkItem = (new apps\Devices\DeviceController)->getItem($params['id']);

                $params['products'] = $service->filterData($params['products']);
                $params['providerId'] = $app->providerSession->id;
                
                if ($service->handle( $params ))
                {
                    $returnData = array('success'=>1, 'data'=>'Added', 'redirect'=>$app->CONF['url'].'provider_area/devices');
                }

            } catch (Exception $e) {

                $returnData = array('error'=>$e->getMessage());
            }   
        
            break;
        
        
        case 'newDeviceOrder':
            
            $returnData = (new apps\Orders\DeviceOrderController(  ))->store_device_order($request, $app); 
            break;
        
        case 'endDeviceOrder':

            $service = new apps\Orders\DeviceOrderController($params['id']); 

            try {

                $service->setDeviceId($params['id']);

                $service->setProviderId($app->providerSession->id);

                $service->setOrderedBy($app->auth->id);

                $checkDeviceOrder = $service->submitOrder();

                $device = apps\Devices\DeviceController::create(array('id' => $checkDeviceOrder->device()->id,  'playing'=> '0', 'publish'=>1)); 
                $device->editItem( $checkDeviceOrder->device()->id );

                if (!empty($checkDeviceOrder->status()) ) { $returnData = array('success'=>1, 'redirect'=>$app->CONF['url'].'provider_area/order/'.$checkDeviceOrder->code(), 'data'=>1); }

            } catch (Exception $e) {
                $returnData = array('error'=>$e->getMessage());
            }
            break;

        case 'setOrderPaid':

            $code = $params['id'];

            $service = new apps\Orders\Order($code); 

            try {

                $service->setCode($params['id']);

                $orderData = $service->getByCode($code);
                $orderData->device = (new apps\Devices\DeviceController)->getItem($orderData->device);
                $service->setModel($service->createModel($orderData));
                
                $service->setOrderedBy($app->auth->id);

                $checkOrder = $service->setOrderPaid();

                if (!empty($checkOrder->status()) ) { $returnData = array('success'=>1, 'reload'=>1, 'data'=>1); }

            } catch (Exception $e) {
                $returnData = array('error'=>$e->getMessage());
            }
            break;



        case 'add_discount':
            
            $service = new apps\Discounts\Discount($params); 

            try {

                if (!$service->validate())
                {

                    $checkInsert = $service->saveItem( ) ;

                    if (!empty($checkInsert->id))
                    {
                        $returnData = array('success'=>1, 'data'=>'Added', 'reload'=>1);
                    }
                }

            } catch (Exception $e) {
                $returnData = array('error'=>$e->getMessage());
            }

            break;
        
        
        case 'order_discount':

            $code = $params['id'];
            $discountCode = $params['discountCode'];

            $service = new apps\Orders\Order($code); 

            try {

                $checkItem = $service->getByCode($code);

                if (isset($checkItem->id))
                {
                    $checkItem->device = ((new apps\Devices\DeviceController())->getItem($checkItem->device));
                    $service->setModel($service->createModel($checkItem));

                    if ($service->handleOrderDiscount($discountCode) )
                    {
                        $returnData = array('success'=>1, 'data'=>'Updated', 'reload'=>1);
                    }

                }  else { $returnData = array('error'=>'Order not found'); }

            } catch (Exception $e) { $returnData = array('error'=>$e->getMessage()); }   

            break;
        
        
        case 'delete_discount':
            
            $service = new apps\Discounts\Discount(null); 
        
            try {

                $checkItem = $service->getItem($params['id']);

                if (isset($checkItem->id))
                {

                    if ($service->deleteItem( $checkItem->id ))
                    {
                        $returnData = array('success'=>1, 'data'=>'Deleted', 'reload'=>1);
                    }

                }

            } catch (Exception $e) {

                $returnData = array('error'=>$e->getMessage());
            }   
        
            break;
        
        

    }


    return json_encode($returnData);

    // return true;
});


/*
// Return list of device 
*/
$app->match('', function () use ($twig, $app) 
{

    return  $twig->render('views/front/home.html.twig', [
        'title' => 'Home page ',
        'app' => $app,
        'formAction' => $app->CONF['url'].'/',
    ]);


});

/**
 * @return  Login page in case if not authorized 
*/
$app->match('login', function () use ($twig, $app) 
{

    return  $twig->render('views/admin/forms/login.html.twig', [
        'title' => 'Login page ',
        'app' => $app,
        'formAction' => $app->CONF['url'].'/',
    ]);

});



/*
// Return Products Stock list page
*/
$app->match('provider_area/discounts', function () use ($twig, $app) 
{
    return response((new apps\Discounts\DiscountController)->index($app, $twig), $app, $twig);
});


/**
* @return Products list of provider
*/
$app->match('provider_area/products', function () use ($twig, $app) 
{
    return response((new apps\Products\ProductController)->index($app, $twig), $app, $twig);
});


/**
* @return Products Stock list page
*/
$app->match('provider_area/stock', function () use ($twig, $app) 
{
    return response((new apps\Products\StockController)->index($app, $twig), $app, $twig);
});


/**
 * @return list of device 
*/
$devices = $app->match('provider_area/devices', function () use ($twig, $app) 
{
    return response( (new apps\Devices\DeviceController(null))->index($app, $twig), $app, $twig );
});


/**
 * @return list of device to manage
*/
$app->match('provider_area/devices_manage', function () use ($twig, $app) 
{
    return response( (new apps\Devices\DeviceController(null))->manage($app, $twig), $app, $twig );
});


/**
 * @return Show device form
*/
$app->match('provider_area/device/{id}', function ($id) use ($twig, $request, $app) 
{

    // Get Device model item with data by 'id'
    return response( (new apps\Devices\DeviceController())->show($id, $app, $twig), $app, $twig);
});


/**
 * @return Edit device form
*/
$app->match('provider_area/edit_device/{id}', function ($id) use ($twig, $request, $app) 
{
    return response( (new apps\Devices\DeviceController())->edit($id, $app, $twig), $app, $twig);

});






/**
 * @return list of device type
*/
$app->match('provider_area/device_types', function () use ($twig, $request, $app) 
{
    return response( (new apps\Devices\DeviceTypeController())->index($app, $twig), $app, $twig);
});

/**
 * @return Edit device type form
*/
$app->match('provider_area/device_type/edit/{id}', function ($id) use ($twig, $request, $app) 
{
    return response( (new apps\Devices\DeviceTypeController())->edit($id, $app, $twig), $app, $twig);
});



/**
 * @return Products list page
*/
$app->match('provider_area/pos/{id}', function ($id) use ($twig, $app) 
{
    return (new apps\Products\ProductController)->pos($id, $app, $twig);

});





/*
// Return Settings page
*/
$app->match('settings', function () use ($twig, $app) 
{
    return $twig->render('views/admin/forms/settings_form.html.twig', [
        'title' => 'Settings',
        'app' => $app,
    ]);
});










/*
// Return Orders list page
*/
$app->match('orders', function () use ($twig, $app) 
{

    $order = new apps\Orders\Order(null);
 
    $app->deviceOrder = new apps\Orders\DeviceOrderController(null);

    $app->orders = $order->repo()->getTotalByMonth( date('Y-m', strtotime('-1 month')), date('Y-m') );

    $app->currentPage = '/orders';
    
    return $twig->render('views/admin/orders/orders.html.twig', [
        'title' => 'Orders list',
        'app' => $app,
        'orders' => $app->orders,
        'todayOrders' => count($order->repo()->getTotalByDate(date('Y-m-d'), date('Y-m-d', strtotime('+1 day')) ) ),
        'lastWeekOrders' => count($order->repo()->getTotalByDate(date('Y-m-d', strtotime('+1 week')), date('Y-m-d', strtotime('+1 day')))),
        'lastMonthOrders' => count($app->orders),
    ]);
});



/*
// Return Order list for the custom month
*/
$app->match('orders/month/{month}', function ($month) use ($twig, $app) 
{

    $order = new apps\Orders\Order(null);
    $app->deviceOrder = new apps\Orders\DeviceOrderController(null);

    $app->orders = $order->repo()->getTotalByMonth( $month, date('Y-m', strtotime('+1 month', strtotime($month))));

    $app->currentPage = '/orders';
    
    return $twig->render('views/admin/orders/orders.html.twig', [
        'title' => 'Orders list',
        'app' => $app,
        'orders' => $app->orders,
        'todayOrders' => $order->repo()->getTotalByDate(date('Y-m-d'), date('Y-m-d', strtotime('+1 day')) )->count(),
        'lastWeekOrders' => $order->repo()->getTotalByDate(date('Y-m-d', strtotime('-1 week')), date('Y-m-d', strtotime('+1 day')))->count(),
        'lastMonthOrders' => count($app->orders),
    ]);
});



/*
// Return Order list for the last week
*/
$app->match('orders/lastweek', function () use ($twig, $app) 
{

    $order = new apps\Orders\Order(null);
    
    $app->deviceOrder = new apps\Orders\DeviceOrderController();

    $app->orders = $order->repo()->getTotalByDate(date('Y-m-d', strtotime('-1 week')), date('Y-m-d', strtotime('+1 day')));

    $app->currentPage = '/orders';

    return $twig->render('views/admin/orders/orders.html.twig', [
        'title' => 'Orders list',
        'app' => $app,
        'orders' => $app->orders,
    ]);

});






/*
// Return single Order page with 'Code'
*/
$app->match('order/{code}', function ($code) use ($twig, $app, $qrcode) 
{
    $order = new apps\Orders\Order(null);

    $orderData = $order->getByCode($code);

    // print_r($orderData);

    if (empty($orderData->id)) { return Page404($twig, $app); }

    // $productOrder = new apps\Orders\ProductOrder();

    $app->deviceOrder = new apps\Orders\DeviceOrderController();

    // $checkOrder->device = (new apps\Devices\Device())->getItem($checkOrder->device);

    // $orderData = $order->createModel($checkOrder);
        
    // $orderData->device()->prices = (new apps\Prices\Prices($orderData->device()->id))->getItem($orderData->device()->id);

    // $orderData->deviceOrder = $deviceOrder->createModel($deviceOrder->getByOrderCode($checkOrder->code));
    // $orderData->productsCost = $deviceOrder->calculate($orderData->deviceOrder->deviceCost(), $orderData->deviceOrder->startTime(), $orderData->deviceOrder->endTime());

    // $orderData->bookingTime = $deviceOrder->calculateTime($checkOrder->startTime, $checkOrder->endTime);

    // $orderData->products = $productOrder->handleModels($productOrder->getByOrderCode($orderData->code()));

    // $orderData->discount = (new apps\Discounts\Discount(null))->getByCode($orderData->discountCode());

    $app->currentPage = '/orders';

    return $twig->render('views/admin/orders/order.html.twig', [
        'title' => 'Orders list',
        'qrcode' => $qrcode,
        'app' => $app,
        'order' => $orderData,
    ]);
});











/*
// Return Product edit page
*/
$app->match('product/{id}', function ($id) use ($twig, $app) 
{
    $product = new apps\Products\ProductController(null);
   
    $product = $product->createModel($product->getItem($id));

    if (empty($product->id))
    {
        return $app->redirect('devices');
    }

    return $twig->render('views/admin/products/product.html.twig', [
        'title' => 'Edit Product',
        'app' => $app,
        'product' => $product,
    ]);
});






// Logout and remoce cookies and session
$app->match('logout', function () use ($twig, $request, $app) 
{

    (new apps\Auth\AuthService(new UserRepository))->unsetSession();

    return $app->redirect('./');
});



include ('controller_provider.php');


$app->run();


    





/*
// Async methods
*/

// use Spatie\Async\Pool;

// $pool = Pool::create();

// $pool[] = async(function () use ($app) {
//    $output = ' Amr ';
//    return $output;
// })->then(function (String $output) {
//    echo $output . "\n";
// });

// await($pool);


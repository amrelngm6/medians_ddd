<?php 

use Medians\Application as apps;

$app->menuList = !empty($app->providerSession) ? getProviderMenuList() : getMenuList();


/*
// Return  Login page in case if not authorized 
*/

// if (empty($app->providerSession)) { return $app->redirect('login'); }

/*
// = Login = 
//
// Return  Login page in case if not authorized 
*/
$app->match('provider_area/login', function () use ($twig,  $app) 
{

    return  $twig->render('views/front/forms/login.html.twig', [
        'title' => 'Login page ',
        'app' => $app,
        'formAction' => $app->CONF['url'].'/',
    ]);

});




/*
// = Signup = 
//
// Return  Login page in case if not authorized 
*/
$app->match('provider_area/signup', function () use ($twig, $app) 
{
    return  $twig->render('views/front/forms/signup.html.twig', [
        'title' => 'Signup page ',
        'app' => $app,
        'formAction' => $app->CONF['url'].'/',
    ]);

});


/*
// Return list of device 
*/
$devices = $app->match('provider_area', function () use ($twig, $app) 
{

    if (empty($app->providerSession)) { return $app->redirect('provider_area/login'); }

    $app->chartsOrders = array();

    // $order = new apps\Orders\Order(null);

    // $ProductOrder = new apps\Orders\ProductOrder(null);



    /*foreach (range(1, cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))) as $key => $value)
    {
        $app->chartsOrders[$key] =  array('date'=>date('Y-m-') . $key,'value'=>$order->getSalesByDay($app->providerSession->id(), date('Y-m-') . $key )) ;

        $app->chartsProductOrder[$key] =  array('category'=>date('Y-m-') . $key,'value'=>$ProductOrder->getSalesByDay($app->providerSession->id(), date('Y-m-') . $key )) ;
    }*/


    return $twig->render('views/admin/intro.html.twig', [
        'title' => 'Dashboard',
        'app' => $app,
        'chartsDays' => json_encode(range(1, cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')))),
        // 'Order' => $order,
        // 'ProductOrder' => $ProductOrder,
        // 'DevicesOrder' => new apps\Orders\DeviceOrder(null),
    ]);

});





/*
// Return Settings page
*/
$app->match('provider_area/settings', function () use ($twig, $app) 
{

    return $twig->render('views/admin/forms/settings_form.html.twig', [
        'title' => 'Settings',
        'app' => $app,
    ]);
});


/*
// Return list of device 
*/
$app->match('provider_area/orders', function () use ($twig, $app) 
{
    if (empty($app->providerSession)) { return $app->redirect('login'); }

        return $app->redirect('orders/month');

//     $deviceTypes = new apps\Devices\DeviceType(null);

//     $device = new apps\Devices\Device(null);

//     $devicesList = array_map(function($data) use ($deviceTypes)  {
        
//         $data->typeData = $deviceTypes->getItem($data->type()->id());
//         return $data;

//     }, $device->getByProvider($app->providerSession));


//     return $twig->render('views/admin/devices/devices_manage.html.twig', [
//         'title' => 'Devices list',
//         'app' => $app,
//         'typesList' => $deviceTypes->getAll(),
//         'devicesList' => $devicesList,
//     ]);
});





/*
// Return Order list for the last week
*/
$app->match('provider_area/orders/{filter}', function ($filter) use ($twig, $app) 
{

    return (new apps\Orders\OrderController())->index($filter, $app, $twig);
    

});







/*
// Return Product page by Id
*/
$app->match('{provider_area}/product/{id}', function ($provider_area, $id) use ($twig, $app) 
{
    if (empty($app->providerSession)) { return $app->redirect('login'); }

    $product = new apps\products\ProductController(null);
   
    $product = $product->getItem($id);

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






/*
// Return Products list page of provider
*/
$app->match('provider_area/order_product/{id}', function ($id) use ($twig, $app) 
{
    if (empty($app->providerSession)) { return $app->redirect('../login'); }

    $product = new apps\products\productController(null);

    $device  = new apps\Devices\DeviceController(null);

    if ($device->getItem($id)->providerId != $app->providerSession->id)
    {
        return $app->redirect('');
    }

    return $twig->render('views/admin/products/pos.html.twig', [
        'title' => 'Products list',
        'app' => $app,
        'device' => $device->getItem($id),
        'stock' => new apps\Products\StockController(null),
        'products' => array_filter($product->getByProvider($app->providerSession->id())),
    ]);
});







/*
// Return single Order page with 'Code'
*/
$app->match('provider_area/order/{code}', function ($code) use ($twig, $app, $qrcode) 
{
    if (empty($app->providerSession)) { return $app->redirect('login'); }

    $order = new apps\Orders\Order(null);

    $checkOrder = $order->getByCode($code);

    if (empty($checkOrder->id))
    {
        return Page404($twig, $app);
    }

    $productOrder = new apps\Orders\ProductOrder();

    $deviceOrder = new apps\Orders\DeviceOrder();

    $checkOrder->device = (new apps\Devices\DeviceController())->getItem($checkOrder->device);

    $orderData = $order->createModel($checkOrder);
        
    $orderData->device()->prices = (new apps\Prices\Prices($orderData->device()->id()))->getItem($orderData->device()->id());

    $orderData->deviceOrder = $deviceOrder->createModel($deviceOrder->getByOrderCode($checkOrder->code));
    $orderData->productsCost = $deviceOrder->calculate($orderData->deviceOrder->deviceCost(), $orderData->deviceOrder->startTime(), $orderData->deviceOrder->endTime());

    $orderData->bookingTime = $deviceOrder->calculateTime($checkOrder->startTime, $checkOrder->endTime);

    $orderData->products = $productOrder->handleModels($productOrder->getByOrderCode($orderData->code()));

    $orderData->discount = (new apps\Discounts\Discount(null))->getByCode($orderData->discountCode());

    $app->currentPage = '/orders';

    return $twig->render('views/admin/orders/order.html.twig', [
        'title' => 'Orders list',
        'qrcode' => $qrcode,
        'app' => $app,
        'order' => $orderData,
    ]);
});



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
use Medians\Infrastructure as Repo;
use Medians\Infrastructure\Administrators\AdminRepository;
use Medians\Infrastructure\Users\UserRepository;
use Medians\Domain\FaceBook\FBUserInfo;
// use Facebook\Facebook;


$app->menuList = getMenuList();
$app->currentPage = $request->getPathInfo();
$app->request = $request;




$app->post('/api/{type?}', function ($type) use ($app, $request) 
{   
    try {
         
        switch ($type) 
        {
            case 'create':
                return (new apps\APIController($app))->create($request, $app);
                break;
            
            case 'update':          
                return (new apps\APIController($app))->update($request, $app);
                break;
            
            case 'delete':          
                return (new apps\APIController($app))->delete($request, $app);
                break;
            
            case 'updateStatus':          
                return (new apps\APIController($app))->updateStatus($request, $app);
                break;

            case 'checkout':          
                return (new apps\Orders\OrderController($app))->checkout($request, $app);
                break;
            
        }

        return (new apps\APIController($app))->handle($request, $app);
        
    } catch (Exception $e) {
        return $e->getMessage();
    }
});

$app->match('/api/{type?}', function ($type) use ($app, $request) 
{   
    try {
        
        switch ($type) 
        {
            case 'calendar':
                return (new apps\Devices\DeviceController($app))->calendar($request, $app);
                break;
            
            case 'calendar_events':          
                return (new apps\Devices\DeviceController($app))->events($request, $app);
                break;
         
        }

        return (new apps\APIController($app))->handle($request, $app);

    } catch (Exception $e) {
        return $e->getMessage();
    }
});

/*
// Return list of device 
*/
$app->post('/media-library-api/{type?}', function ($type) use ( $app, $request) 
{ 
    switch ($type) {
        case 'delete':
            return (new apps\Media\MediaController())->delete($request, $app);
            break;
        
        default:
            return (new apps\Media\MediaController())->upload($request, $app);
            break;
    }
});

/*
// Return list of device 
*/
$app->post('', function () use ( $app, $request) 
{ 

    try {
        switch ($request->get('type')) 
        {

            case 'userLogin':
                    
                    $returnData =  (new apps\Auth\AuthService( new AdminRepository() ))->userLogin($request, $app); 
                break;

            default:
                print_r($_POST);
                break;
        }

    } catch (Exception $e) {

        $returnData = array('error'=> $e->getMessage());            
    }
    
    return json_encode($returnData);

});


/*
// Return list of device 
*/
$app->match('', function () use ($request,  $app) 
{
    try 
    {
        if (isset($app->auth->id))
        {
            return (new apps\DashboardController($app))->index($request,  $app);

        } else {

            return (new apps\Auth\AuthService(new UserRepository($app)))->loginPage($request, $app); 
        }

    } catch (Exception $e) 
    {
        return $e->getMessage();
    }

});



/**
 * @return  Login page in case if not authorized 
*/
$app->match('login', function () use ($request, $app) 
{   
    try {
        
        return (new apps\Auth\AuthService(new UserRepository($app)))->loginPage($request, $app); 
    } catch (Exception $e) {
        return $e->getMessage();
    }
});



/*
// Return list of device 
*/
$app->match('/dashboard', function () use ($request,  $app) 
{
    try {

        return (new apps\DashboardController($app))->index($request,  $app);

    } catch (Exception $e) {
        return $e->getMessage();
    }
});



if (isset($app->auth->id))
{

    /**
    * @return properties
    */
    $app->match('/devices/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Devices\DeviceController($app))->create($request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Devices\DeviceController($app))->edit($id, $request, $app);
            }

            if ($action == 'manage')
            {
                return (new apps\Devices\DeviceController($app))->manage($request, $app);
            }

            if ($action == 'orders')
            {
                return (new apps\Devices\DeviceController($app))->orders($request, $app);
            }

            return (new apps\Devices\DeviceController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Products
    */
    $app->match('/products/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Products\ProductController($app))->create($request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Products\ProductController($app))->edit($id, $request, $app);
            }

            return (new apps\Products\ProductController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });

    /**
    * @return stock
    */
    $app->match('/stock/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Products\StockController($app))->create($request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Products\StockController($app))->edit($id, $request, $app);
            }

            return (new apps\Products\StockController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Payments
    */
    $app->match('/payments/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Payments\PaymentController($app))->create($request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Payments\PaymentController($app))->edit($id, $request, $app);
            }

            return (new apps\Payments\PaymentController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });

    /**
    * @return Orders
    */
    $app->match('/orders/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Orders\OrderController($app))->create($request, $app);
            }

            if ($action == 'show')
            {
                return (new apps\Orders\OrderController($app))->show($id, $request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Orders\OrderController($app))->edit($id, $request, $app);
            }

            return (new apps\Orders\OrderController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Contacts
    */
    $app->match('/users/{action?}/{id?}', function ($action, $id) use ($request, $app)  {
        $UserController = new apps\Users\UserController($app);
        try {
            
            if ($action == 'create')
            {
                if ($action == 'agents')
                    return $UserController->create($request, $app, 3);

                if ($action == 'managers')
                    return $UserController->createManager($request, $app, 3);
    
                return $UserController->create($request, $app, 3);
            }

            if ($action == 'edit')
            {
                return $UserController->edit($id, $request, $app);
            }

            if ($action == 'agents')
                return $UserController->index( $UserController->queryByRole(3, $app), 'Agents', $app );

            if ($action == 'managers')
                return $UserController->index( $UserController->queryByRole(2, $app), 'Managers', $app );

            if ($app->auth->can('view_admins', $app) && $app->auth->role_id == 1)
                return $UserController->index( $UserController->queryByRole(1, $app), 'Administrators', $app );

            if ($app->auth->can('view_admins', $app) && $app->auth->role_id == 3)
                return $UserController->index( $UserController->queryByRole(3, $app), 'Users',  $app );


            return '';

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Media items
    */
    $app->match('/media-library-api/{type?}', function ($type) use ($request, $app)  {

        try {
        
            $filter_type = $request->get('type');
            
            if ($type == 'media')
            {
                return (new apps\Media\MediaController())->media($filter_type, $request, $app);
            }

            if ($type == 'file')
            {
                return true;
                return (new apps\Media\MediaController())->media($filter_type, $request, $app);
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



    /**
    * @return Tasks
    */
    $app->match('/tasks/{action?}/{id?}', function ($action, $id) use ($request, $app)  {

        try {
            
            return (new apps\Tasks\TaskController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Customers
    */
    $app->match('/customers/{action?}/{id?}', function ($action, $id) use ($request, $app)  
    {

        try {
            
            if ($action == 'create')
            {
                return (new apps\Customers\CustomerController($app))->create($request, $app);
            }

            if ($action == 'edit')
            {
                return (new apps\Customers\CustomerController($app))->edit($id, $request, $app);
            }

            return (new apps\Customers\CustomerController($app))->index($request, $app);

        } catch (Exception $e) {
            return $e->getMessage();
        }

    });



    /**
    * @return Settings page
    */
    $app->match('settings', function () use ($request, $app) 
    {
        return (new apps\Settings\SettingsController($app))->index($request, $app); 
    });


    // Logout and remoce cookies and session
    $app->match('logout', function () use ( $request, $app) 
    {

        (new apps\Auth\AuthService(new UserRepository($app)))->unsetSession();

        return $app->redirect('./');
    });

}


/*
// Return list of device 
*/
$app->match('/{page}', function ($page) use ( $app) 
{

    return  render('views/front/pages/page.html.twig', [
        'title' => 'Medians',
        'app' => $app
    ]);
});



$app->run();


    
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


$app->provider = $app->auth;


$app->post('/api/{type?}', function ($type) use ($app, $request) 
{   
    try {
         
        switch ($type) 
        {
            case 'create':
                return (new apps\APIController)->create($request, $app);
                break;
            
            case 'update':          
                return (new apps\APIController)->update($request, $app);
                break;
            
            case 'updateStatus':          
                return (new apps\APIController)->updateStatus($request, $app);
                break;

            case 'checkout':          
                return (new apps\Orders\OrderController($app))->checkout($request, $app);
                break;
            
        }

        return (new apps\APIController)->handle($request, $app);
        
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

        return (new apps\APIController)->handle($request, $app);

    } catch (Exception $e) {
        return $e->getMessage();
    }
});

/*
// Return list of device 
*/
$app->post('/media-library-api/{type?}', function ($type) use ($twig, $app, $request) 
{ 
    switch ($type) {
        case 'delete':
            return (new apps\Media\MediaController())->delete($request, $app, $twig);
            break;
        
        default:
            return (new apps\Media\MediaController())->upload($request, $app, $twig);
            break;
    }
});

/*
// Return list of device 
*/
$app->post('', function () use ($twig, $app, $request) 
{ 

    try {
        switch ($request->get('type')) 
        {
            case 'Device.create':
                $returnData =  (new apps\Devices\DeviceController($app))->store($request, $app); 
                break;

            case 'Device.update':
                $returnData =  (new apps\Devices\DeviceController($app))->update($request, $app); 
                break;

            case 'Lead.create':
                $returnData =  (new apps\Leads\LeadController())->store($request, $app); 
                break;

            case 'Lead.update':
                $returnData =  (new apps\Leads\LeadController())->update($request, $app); 
                break;

            case 'Contact.create':
                $returnData =  (new apps\Contacts\ContactController())->store($request, $app); 
                break;

            case 'Contact.update':
                $returnData =  (new apps\Contacts\ContactController())->update($request, $app); 
                break;

            case 'Organization.create':
                $returnData =  (new apps\Organizations\OrganizationController())->store($request, $app); 
                break;

            case 'Organization.update':
                $returnData =  (new apps\Organizations\OrganizationController())->update($request, $app); 
                break;

            case 'User.create':
                $returnData =  (new apps\Users\UserController())->store($request, $app); 
                break;

            case 'User.update':
                $returnData =  (new apps\Users\UserController())->update($request, $app); 
                break;

            case 'userLogin':
                    
                    $returnData =  (new apps\Auth\AuthService( new AdminRepository() ))->userLogin($request, $app); 
                break;
            

            case 'updateSettings':
                
                $returnData = (new apps\Settings\SettingsController)->update($request, $app); 

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
$app->match('', function () use ($request, $twig, $app) 
{
    try 
    {
        if (isset($app->auth->id))
        {
            return (new apps\DashboardController)->index($request, $twig, $app);

        } else {

            return (new apps\Auth\AuthService(new UserRepository))->loginPage($request, $app, $twig); 
        }

    } catch (Exception $e) 
    {
        return $e->getMessage();
    }

});



/**
 * @return  Login page in case if not authorized 
*/
$app->match('login', function () use ($request, $app, $twig) 
{   
    try {
        
        return (new apps\Auth\AuthService(new UserRepository))->loginPage($request, $app, $twig); 
    } catch (Exception $e) {
        return $e->getMessage();
    }
});



/*
// Return list of device 
*/
$app->match('/dashboard', function () use ($request, $twig, $app) 
{
    return (new apps\DashboardController)->index($request, $twig, $app);
});



if (isset($app->auth->id))
{

    /**
    * @return properties
    */
    $app->match('/devices/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Devices\DeviceController($app))->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Devices\DeviceController($app))->edit($id, $request, $app, $twig);
            }

            if ($action == 'manage')
            {
                return (new apps\Devices\DeviceController($app))->manage($request, $app, $twig);
            }

            return (new apps\Devices\DeviceController($app))->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Products
    */
    $app->match('/products/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Products\ProductController($app))->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Products\ProductController($app))->edit($id, $request, $app, $twig);
            }

            return (new apps\Products\ProductController($app))->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Contacts
    */
    $app->match('/users/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        $UserController = new apps\Users\UserController;
        try {
            
            if ($action == 'create')
            {
                if ($action == 'agents')
                    return $UserController->createAgent($request, $app, $twig);

                if ($action == 'managers')
                    return $UserController->createManager($request, $app, $twig);
    
                return $UserController->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return $UserController->edit($id, $request, $app, $twig);
            }

            if ($action == 'agents')
                return $UserController->index( $UserController->queryByRole(3), 'Agents', $app, $twig );

            if ($action == 'managers')
                return $UserController->index( $UserController->queryByRole(2), 'Managers', $app, $twig );

            if ($app->auth->can('view_admins', $app))
                return $UserController->index( $UserController->queryByRole(1), 'Administrators', $app, $twig );


            return '';

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Media items
    */
    $app->match('/media-library-api/{type?}', function ($type) use ($request, $app, $twig)  {

        try {
        
            $filter_type = $request->get('type');
            
            if ($type == 'media')
            {
                return (new apps\Media\MediaController())->media($filter_type, $request, $app, $twig);
            }

            if ($type == 'file')
            {
                return true;
                return (new apps\Media\MediaController())->media($filter_type, $request, $app, $twig);
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



    /**
    * @return Tasks
    */
    $app->match('/tasks/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {

        try {
            
            return (new apps\Tasks\TaskController)->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Customers
    */
    $app->match('/customers/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  
    {

        try {
            
            if ($action == 'create')
            {
                return (new apps\Customers\CustomerController)->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Customers\CustomerController)->edit($id, $request, $app, $twig);
            }

            return (new apps\Customers\CustomerController)->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }

    });



    /**
    * @return Settings page
    */
    $app->match('settings', function () use ($request, $app, $twig) 
    {
        return (new apps\Settings\SettingsController)->index($request, $app, $twig); 
    });


    // Logout and remoce cookies and session
    $app->match('logout', function () use ($twig, $request, $app) 
    {

        (new apps\Auth\AuthService(new UserRepository))->unsetSession();

        return $app->redirect('./');
    });

}


/*
// Return list of device 
*/
$app->match('/{page}', function ($page) use ($twig, $app) 
{

    return  $twig->render('views/front/pages/page.html.twig', [
        'title' => 'Medians',
        'app' => $app
    ]);
});



$app->run();


    
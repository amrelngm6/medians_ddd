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
    }

    return (new apps\APIController)->handle($request, $app);
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
            case 'Property.create':
                $returnData =  (new apps\Properties\PropertyController())->store($request, $app); 
                break;

            case 'Property.update':
                $returnData =  (new apps\Properties\PropertyController())->update($request, $app); 
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
$app->match('', function () use ($twig, $app) 
{
    try {

        return  $twig->render('views/front/home.html.twig', [
            'title' => 'Home page ',
            'app' => $app,
            'rent_properties' => (new Repo\Properties\PropertyRepository)->getItems('rent'),
            'sale_properties' => (new Repo\Properties\PropertyRepository)->getItems('sale'),
            'formAction' => $app->CONF['url'],
        ]);
    } catch (Exception $e) {
        return $e->getMessage();
    } 
});


/*
// Return list of device 
*/
$app->match('property/{id?}', function ($id) use ($twig, $app, $request) 
{
    try {

        if ($id)
        {
            return  $twig->render('views/front/properties/page.html.twig', [
                'title' => 'Property page ',
                'app' => $app,
                'property' => (new Repo\Properties\PropertyRepository)->find($id),
                'formAction' => $app->CONF['url'],
            ]);

        } else {

            $type = $request->get('request_type');

            return  $twig->render('views/front/properties/list.html.twig', [
                'title' => 'Property list ',
                'app' => $app,
                'propertyModel' => (new Repo\Properties\PropertyRepository)->getModel(),
                'properties' => (new Repo\Properties\PropertyRepository)->getItems($type),
                'formAction' => $app->CONF['url'],
            ]);

        }

    } catch (Exception $e) {
        return $e->getMessage();
    } 
});

/*
// Return search for properties 
*/
$app->match('/find_property', function () use ($twig, $app, $request) 
{
    try {

        return  $twig->render('views/front/properties/list.html.twig', [
            'title' => 'Property list ',
            'app' => $app,
            'propertyModel' => (new Repo\Properties\PropertyRepository)->getModel(),
            'properties' => (new Repo\Properties\PropertyRepository)->findItems($request),
            'formAction' => $app->CONF['url'],
        ]);


    } catch (Exception $e) {
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




if (isset($app->auth->id))
{

    /*
    // Return list of device 
    */
    $app->match('/dashboard', function () use ($request, $twig, $app) 
    {
        return (new apps\DashboardController)->index($request, $twig, $app);
    });

    /**
    * @return Settings page
    */
    $app->match('settings', function () use ($request, $app, $twig) 
    {
        return (new apps\Settings\SettingsController)->index($request, $app, $twig); 
    });



    /**
    * @return properties
    */
    $app->match('/properties/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Properties\PropertyController(new Repo\Properties\PropertyRepository))->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Properties\PropertyController(new Repo\Properties\PropertyRepository))->edit($id, $request, $app, $twig);
            }

            return (new apps\Properties\PropertyController(new Repo\Properties\PropertyRepository))->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



    /**
    * @return Organizations
    */
    $app->match('/organizations/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Organizations\OrganizationController(new Repo\Organizations\OrganizationRepository))->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Organizations\OrganizationController(new Repo\Organizations\OrganizationRepository))->edit($id, $request, $app, $twig);
            }

            return (new apps\Organizations\OrganizationController(new Repo\Organizations\OrganizationRepository))->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });



    /**
    * @return Leads
    */
    $app->match('/leads/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Leads\LeadController)->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Leads\LeadController)->edit($id, $request, $app, $twig);
            }

            return (new apps\Leads\LeadController)->index($request, $app, $twig);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    });


    /**
    * @return Contacts
    */
    $app->match('/contacts/{action?}/{id?}', function ($action, $id) use ($request, $app, $twig)  {
        try {
            
            if ($action == 'create')
            {
                return (new apps\Contacts\ContactController)->create($request, $app, $twig);
            }

            if ($action == 'edit')
            {
                return (new apps\Contacts\ContactController)->edit($id, $request, $app, $twig);
            }

            return (new apps\Contacts\ContactController)->index($request, $app, $twig);

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


    
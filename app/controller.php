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

    return  $twig->render('views/front/home.html.twig', [
        'title' => 'Home page ',
        'app' => $app,
        'formAction' => $app->CONF['url'],
    ]);
});

/*
// Return list of device 
*/
$app->match('/dashboard', function () use ($twig, $app) 
{

    return  $twig->render('views/admin/dashboard/index.html.twig', [
        'title' => 'Home page ',
        'app' => $app,
        'formAction' => $app->CONF['url'],
    ]);
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
* @return properties
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




// Logout and remoce cookies and session
$app->match('logout', function () use ($twig, $request, $app) 
{

    (new apps\Auth\AuthService(new UserRepository))->unsetSession();

    return $app->redirect('./');
});


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


    
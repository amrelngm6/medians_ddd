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
$app->post('', function () use ($twig, $app, $request) 
{ 

    $params = $request->get('params');

    try {
        switch ($request->get('type')) 
        {
            case 'userLogin':
                    
                    $returnData =  (new apps\Auth\AuthService( new AdminRepository() ))->userLogin($request, $app); 
                break;
            

            case 'updateSettings':
                
                $returnData = (new apps\Settings\SettingsController)->update($request, $app); 

                break;

            default:

                print_r($_POST);

                breadk;

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



/**
 * @return  Login page in case if not authorized 
*/
$app->match('login', function () use ($request, $app, $twig) 
{
    return (new apps\Auth\AuthService(new UserRepository))->loginPage($request, $app, $twig); 
});

/**
* @return Settings page
*/
$app->match('settings', function () use ($twig, $request, $app) 
{
    return (new apps\Settings\SettingsController)->index($request, $app, $twig); 
});



/**
* @return FB page
*/
$app->match('fb', function () use ($twig, $request, $app) 
{
    return (new apps\Auth\AuthService(new UserRepository))->loginBtn();
});



/**
* @return FB login back
*/
$app->match('facebook_login_back', function () use ($twig, $request, $app) 
{
    try {
        
        $fbAuth = (new apps\Auth\AuthService(new UserRepository));

        $user = (object) $fbAuth->login_back();

        $pages = $fbAuth->fb_page_list($user->access_token_set);

    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
    

    try {
        
        $userData = UserRepository::store(['email'=>$user->email, 'access_token'=>$user->access_token, 'name'=>$user->name]);

        $FBUserInfo = $fbAuth->insertUserInfo($user, $userData->id);

        foreach ($pages as $key => $value) {
            $fbAuth->insertPageInfo($value, $userData->id, $FBUserInfo->id);
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }


    return 'Valid ' . $fbAuth->loginBtn();
});





// Logout and remoce cookies and session
$app->match('logout', function () use ($twig, $request, $app) 
{

    (new apps\Auth\AuthService(new UserRepository))->unsetSession();

    return $app->redirect('./');
});




$app->run();


    
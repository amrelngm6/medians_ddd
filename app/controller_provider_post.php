<?php 

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// TWIG template engine
use Twig\Environment;

use Medians\Application as apps;
use Shared\dbaser;

use Medians\Infrastructure\Administrators\AdminRepository;
use Medians\Infrastructure\Customers\CustomerRepository;



switch ($request->request->get('type')) 
{
    case 'providerLogin':
        
        $service = new apps\Auth\AuthService( new CustomerRepository() ); 
        
        $requestData = $params;

        try {
            $checkUser = $service->checkLogin($requestData['email'], $service->encrypt($requestData['password']));
            

            if (!empty($checkUser->providerId()))
            {
                $service->setSession($checkUser);
            }

            $returnData = array('success'=>1, 'data'=>'Logged in', 'redirect'=>$app->CONF['url'].'provider_area');

        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        break;
    

    case 'providerSignup':
        
        $service = new apps\Auth\AuthService( new CustomerRepository() ); 
        
        try {
            
            $checkUser = $service->checkSignup($params);
            
            if (!empty($checkUser->providerId()))
            {
                $service->setSession($checkUser);
            }
            
            $returnData = array('success'=>1, 'data'=>'Logged in', 'redirect'=>$app->CONF['url'].'provider_area');

        } catch (Exception $e) {
            $returnData = array('error'=>$e->getMessage());
        }

        break;
    

}




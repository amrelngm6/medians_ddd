<?php

namespace Medians\Application\Auth;


use Medians\Application\Customers\Customer;

use Medians\Application\Providers\Provider;

use Medians\Domain\Customers\CustomerModel;

use Medians\Domain\Auth\AuthModel;

use Medians\Infrastructure as Repo;




class AuthService 
{

	/*
	/ @var Int
	*/
	private $passLen = 5;

	/*
	/ @var String
	*/
	private $email;

	/*
	/ @var String
	*/
	private $password ;

	/*
	/ @var CustomerModel
	*/
	private $AuthModel;

	/*
	/ @var Instance
	*/
	private $repo;



	function __construct($repo)
	{

		$this->repo = $repo;
	}


	/**
	 * Display login page 
	 * 
	 */
	public function loginPage($request, $app, $twig)
	{


		if (isset($app->auth->id)) { return $app->redirect('/'); }

	    return  $twig->render('views/admin/forms/login.html.twig', [
	        'title' => 'Login page ',
	        'app' => $app,
	        'formAction' => '/',
	    ]);
	}


	public function userLogin($request, $app)
	{
		
        $requestData = $request->get('params');

        try {
            
            $checkUser = $this->checkLogin($requestData['email'], $this->encrypt($requestData['password']));

            if (!empty($checkUser->id))
            {
                $this->setSession($checkUser);
            }

            if (($request->get('request_type') == 'post'))
            {

            	header("Location: " . $app->CONF['url']);
            	exit;
            };

            return array('success'=>1, 'result'=>'Logged in', 'redirect'=>$app->CONF['url']);

        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
	}

	public function checkLogin($email, $password)
	{


		$checkLogin = $this->repo->checkLogin($email, $password);

		if (empty($checkLogin->id))
		{
			throw new \Exception("User credentials not valid", 1);
		}

		if (empty($checkLogin->publish))
		{
			throw new \Exception("User account is not active", 1);
			
		}

		return $checkLogin;
	}


	public function checkSignup($params) 
	{

		// Check if email already found 
		$checkEmail = $this->repo->getByEmail($params['email']);

		// Validate if email already found 
		if (!empty($checkEmail->id()))
		{
			throw new \Exception("Email already found", 1);
		}

		// Validate the password 
		if (!empty($this->validatePassword($params['password'])))
		{
			throw new \Exception($this->validatePassword($params['password']), 1);
		}

		// Set the CustomerModel Data 
		$this->CustomerModel = $this->createModel($params);

		// Add new Provider & Update the ProviderId
		// Update the Password after encrypting it
		$this->addProvider($params['provider'])->CustomerModel->setPassword($this->encrypt($params['password']));

		if ($this->CustomerModel->providerId())
		{
			return $this->repo->createItem($this->CustomerModel)->saveItem();	
		}

	}


	public function addProvider($provider)
	{

		// Add new Provider 
		$addProvider = ( new Provider($provider))->saveItem();

		// Update the ProviderId with the new Id
		$this->CustomerModel->setProviderId($addProvider->id());

		return $this;
	}


	public function validatePassword($password)
	{
		if (strlen($password) < $this->passLen)
		{
			throw new \Exception("Password length must be $this->passLen at least ", 1);
		}

	} 


	public function checkSession($code = null) 
	{
		$AuthModel = new AuthModel($code);

		if (!empty ( $AuthModel->checkSession($code) ))
		{
			return $this->repo->find($AuthModel->checkSession($code));
		}
	}



	public function setSession($data, $code = null) 
	{

		$AuthModel = new AuthModel($code);

		if ($AuthModel->setData($data)) 
		{
			return $AuthModel->checkSession($code);
		}
	}


	public function unsetSession() 
	{
		
		$AuthModel = new AuthModel();
		return $AuthModel->unsetSession();
	}


	public function encrypt($value) : String 
	{
		return sha1(md5($value));

	}









	public function fbConfigQuery()
	{
	    return (new Repo\FaceBook\FBRepository)->getAll()->first();
	}

	public function fbConfig()
	{

		$config = $this->fbConfigQuery();

	    return new \Facebook\Facebook([
	        'app_id' => $config->api_id, 
	        'app_secret' => $config->api_secret,
	        'default_graph_version' => 'v10.0',
	        'fileUpload'    =>TRUE
	    ]);
	}

	public function fbConfigHelper()
	{
	    return $this->fbConfig()->getRedirectLoginHelper();
	}

	public function create_long_lived_access_token($short_lived_user_token)
	{
		$config = $this->fbConfigQuery();

		$short_token = $short_lived_user_token;

		$url="https://graph.facebook.com/v10.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$config->api_id."&client_secret=".$config->api_secret."&fb_exchange_token=".$short_token;

		$headers = array("Content-type: application/json");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

		$st=curl_exec($ch); 
		$result=json_decode($st,TRUE);

		$access_token=isset($result["access_token"]) ? $result["access_token"] : "";

		return $access_token;

	}

	/**
	 *  FB Pages list
	 */
	public function fb_page_list($access_token="")
	{

		try {

			$request = $this->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);	
			return  $request->getGraphList()->asArray();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			$error=true;

		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$error=true;
		}


		try {

			$request = $this->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);
			
			return $request->getGraphList()->asArray();
		}

		catch(Facebook\Exceptions\FacebookResponseException $e) {
			$response['error']='1';
			$response['message']= $e->getMessage();
			return $response; 
		}

		catch(Facebook\Exceptions\FacebookSDKException $e) {
			$response['error']='1';
			$response['message']= $e->getMessage();
			return $response; 
		}


	}


	/**
	 * Create FB page 
	 */
	public function insertPageInfo($page, $user_id=0, $facebook_table_id=null)
	{

		$page_id = $page['id'];
        $page_cover = isset($page['cover']['source']) ?  $page['cover']['source'] : '';
        $page_profile = isset($page['picture']['url']) ? $page['picture']['url'] : '';
        $page_name = isset($page['name']) ? $page['name'] : '';
        $page_access_token = isset($page['access_token']) ? $page['access_token'] : '';
        $page_email = isset($page['emails'][0]) ? $page['emails'][0] : '';
        $page_username =  isset($page['username']) ? $page['username'] : '';

        $data = array(
            'user_id' => $user_id,
            'facebook_rx_fb_user_info_id' => $facebook_table_id,
            'page_id' => $page_id,
            'page_cover' => $page_cover,
            'page_profile' => $page_profile,
            'page_name' => $page_name,
            'username' => $page_username,
            'page_access_token' => $page_access_token,
            'page_email' => $page_email,
            'add_date' => date('Y-m-d'),
            'deleted' => '0'
        );	

        $create = (new Repo\FaceBook\FBPageInfoRepository)->store($data);

        return $create;
	}

	/**
	 * Create FB user info 
	 */
	public function insertUserInfo($user, $userId = 0)
	{

		$config = $this->fbConfigQuery();

        $data = array(
            'user_id' => $userId,
            'facebook_rx_config_id' => $config->api_id,
            'access_token' => $user->access_token,
            'name' => $user->name,
            'email' => isset($user->email) ? $user->email : $user->id,
            'fb_id' => $user->id,
            'add_date' => date('Y-m-d'),
            'deleted' => '0'
        );

        return (new Repo\FaceBook\FBUserInfoRepository)->store($data);

	}	


	/**
	 * Login Back FB Func
	 */
	public function login_back()
	{

        $helper =  $this->fbConfigHelper(); 

        $fb =  $this->fbConfig(); 

        try {
        	
	        print_r('$accessToken');
	        $accessToken = $helper->getAccessToken('https://ddd.medianssolutions.com/facebook_login_back');
        } catch (Exception $e) {
	        print_r($e->getMessage());
        	return $e->getMessage();	
        }
	        $response = $fb->get('/me?fields=id,name,email', $accessToken);

	        print_r('response');
	        print_r($response);

	        $user = $response->getGraphUser()->asArray();
	        print_r($user);


        $access_token   = (string) $accessToken;
        $access_token = $this->create_long_lived_access_token($access_token);

        $user["access_token_set"] = $access_token;

        $user["access_token"] = $access_token;

        return $user;
	} 


	/**
	 * 
	*/
	public function loginBtn()
	{

	    $helper =  $this->fbConfigHelper(); 

	    $permissions = ['email','pages_manage_posts','pages_manage_engagement','pages_manage_metadata','pages_read_engagement','pages_show_list','pages_messaging','public_profile','read_insights','publish_to_groups', 'instagram_basic','instagram_manage_comments','instagram_manage_insights','instagram_content_publish','instagram_manage_messages'];

	    $loginUrl = $helper->getLoginUrl('https://ddd.medianssolutions.com/facebook_login_back', $permissions);

	    return '<a href="'.$loginUrl.'">Login</a>';
	}

}

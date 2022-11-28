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









}

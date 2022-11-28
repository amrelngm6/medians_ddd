<?php

namespace Medians\Application\FaceBook;


use Medians\Infrastructure as Repo;




class FBWebhook 
{


	/**
	* @var Instance
	*/
	private $repo;


	function __construct($repo)
	{

		$this->config = new FBConfig($repo);

	}


	/**
	 * Handle webhook request
	 * 
	*/
	public function webhook_init()
	{

	    $config = $this->config->fbConfigQuery();


	    $verifyToken = '1010'; // You will specify it when you enable the Webhook for your app
	    $appSecret = $config->api_secret;

	    // Handle verification request
	    if (isset($_GET['hub_mode']) && $_GET['hub_mode'] === 'subscribe') {
	        if ($_GET['hub_verify_token'] === $verifyToken) {
	            echo $_GET['hub_challenge'];
	            exit;
	        }
	    }

	    // Validate the integrity and payload and it's origin
	    $payload = file_get_contents('php://input');
	    if (isset($_SERVER['HTTP_X_HUB_SIGNATURE']) && hash_equals(explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'])[1], hash_hmac('sha1', $payload, $appSecret))) {
	        // Handle payload
	        $data = json_decode($payload, true);
	        file_put_contents(time().'-webhook.php', $payload);

	        // $fbAuth->send_private_reply();

	        exit;
	    } else {

	        $data = json_decode($payload, true);
	        file_put_contents(time().'-webhook.php', $payload);
	    }

	    if (!empty($request->get('hub_challenge')))
	    {
	        return $request->get('hub_challenge');
	    }
	}

	public function create_long_lived_access_token($short_lived_user_token)
	{
		$config = $this->config->fbConfigQuery();

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

			$request = $this->config->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);	
			return  $request->getGraphList()->asArray();

		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			$error=true;

		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$error=true;
		}


		try {

			$request = $this->config->fbConfig()->get('/me/accounts?fields=cover,emails,picture,id,name,url,username,access_token&limit=400',$access_token);
			
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

        try {
        	
	        $this->enable_bot($data['page_id'], $data['page_access_token']);
	        error_log('Saved');
        } catch (Exception $e) {
        	
	        error_log('Error Saving');
	        return $e->getMessage();
        }

        return $create;
	}

	/**
	 * Create FB user info 
	 */
	public function insertUserInfo($user, $userId = 0)
	{

		$config = $this->config->fbConfigQuery();

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
	public function login_back($app)
	{

        $helper =  $this->config->fbConfigHelper(); 

        $fb =  $this->config->fbConfig(); 

        try {
        	
	        $accessToken = $helper->getAccessToken($app->CONF['url'].'facebook_login_back');

	        $response = $fb->get('/me?fields=id,name,email', $accessToken);

	        $user = $response->getGraphUser()->asArray();

        } catch (Exception $e) {
        	return $e->getMessage();	
        }

        $access_token   = (string) $accessToken;
        $access_token = $this->create_long_lived_access_token($access_token);

        $user["access_token_set"] = $access_token;

        $user["access_token"] = $access_token;

        return $user;
	} 


	/**
	 * Return login url
	*/
	public function loginBtn($app)
	{

	    $helper =  $this->config->fbConfigHelper(); 

	    $permissions = ['email','pages_manage_posts','pages_manage_engagement','pages_manage_metadata','pages_read_engagement','pages_show_list','pages_messaging','public_profile','read_insights','publish_to_groups', 'instagram_basic','instagram_manage_comments','instagram_manage_insights','instagram_content_publish','instagram_manage_messages'];

	    $loginUrl = $helper->getLoginUrl($app->CONF['url'].'facebook_login_back', $permissions);

	    return '<a href="'.$loginUrl.'">Login</a>';
	}



	/* Add get Started Button */
	public function add_get_started_button($post_access_token='')
	{
	
		$url = "https://graph.facebook.com/v4.0/me/messenger_profile?access_token={$post_access_token}";
		$get_started_data='{"get_started":{"payload":"GET_STARTED_PAYLOAD"}}';
	
		$ch = curl_init();
	 	$headers = array("Content-type: application/json");
	 
	 	curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	 
	 	curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$get_started_data); 
	 
	 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
	 	$st=curl_exec($ch);	 
	 	$result=json_decode($st,TRUE);
	 	if(isset($result["result"])) 
		{
			$result["result"]=$this->CI->lang->line(trim($result["result"]));
			$result['success']=1;
		}
		if(isset($result["error"])) 
		{
			$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : $this->CI->lang->line("Something went wrong, please try again.");
			$result['success']=0;
		}
		return $result;
	}


	public function set_welcome_message($page_id='',$welcome_message='')
	{
	    
		try {
		    	
		    $page = (new Repo\FaceBook\FBPageInfoRepository)->getByPageId($page_id);

			if($welcome_message=='') return false;

			$url = "https://graph.facebook.com/v4.0/me/messenger_profile?access_token={$page->page_access_token}";
			$get_started_data=array
			(
				'greeting'=>array(0=>array("locale"=>"default","text"=>$welcome_message))
			);
			// $get_started_data='{"greeting":[{"locale":"default","text":"'.$welcome_message.'"}]}';
			$get_started_data=json_encode($get_started_data);

			$ch = curl_init();
		 	$headers = array("Content-type: application/json");
		 
		 	curl_setopt($ch, CURLOPT_URL, $url);
		 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		 
		 	curl_setopt($ch,CURLOPT_POST,1);
		 	curl_setopt($ch,CURLOPT_POSTFIELDS,$get_started_data); 
		 
		 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
		 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
		 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 	$st=curl_exec($ch);	 
		 	$result=json_decode($st,TRUE);
		 	if(isset($result["result"])) 
			{
				$result["result"]= trim($result["result"]);
				$result['success']=1;
			}
			if(isset($result["error"])) 
			{
				$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : "Something went wrong, please try again.";
				$result['success']=0;
			}


	    } catch (Exception $e) {
	    	return $e->getMessage();	
	    }

		return $result;
	}




	// ================== webhook enable disable ==============//
	// Array([success] => 1)
	public function enable_bot($page_id='',$post_access_token='')
	{
		if($page_id=='' || $post_access_token=='') 
		{
			return array('success'=>0,'error'=>"Something went wrong, please try again."); 
			exit();
		}
		try 
		{
			$params=array();			
			$params['subscribed_fields']= array("messages","messaging_optins","messaging_postbacks","messaging_referrals","feed");			
			$response = $this->config->fbConfig()->post("{$page_id}/subscribed_apps",$params,$post_access_token);			
			$response = $response->getGraphObject()->asArray();
			$response['error']='';
			return $response;			
		} 
		catch (Exception $e) 
		{
			return array('success'=>0,'error'=>$e->getMessage());
		}
	}

	// Array([success] => 1)
	public function disable_bot($page_id='',$post_access_token='')
	{
		if($page_id=='' || $post_access_token=='') 
		{
			return array('success'=>0,'error'=>$this->CI->lang->line("Something went wrong, please try again.")); 
			exit();
		}
		try 
		{
			$response = $this->fb->delete("{$page_id}/subscribed_apps",array(),$post_access_token);
			$response = $response->getGraphObject()->asArray();
			$response['error']='';
			return $response;			
		} 
		catch (Exception $e) 
		{
			return array('success'=>0,'error'=>$e->getMessage());
		}
	}





	/* Add Ice Breaker Questions */
	public function add_ice_breakers($page_id,$icebreakers_content_json='',$social_media_type='fb')
	{
		
	    $page = (new Repo\FaceBook\FBPageInfoRepository)->getByPageId($page_id);

		if($social_media_type=='ig'){
			$url = "https://graph.facebook.com/v5.0/me/messenger_profile?platform=instagram&access_token={$page->page_access_token}";
			$icebreakers_content_array=json_decode($icebreakers_content_json,true);
			$icebreakers_content_array['platform']="instagram";
			$icebreakers_content_json=json_encode($icebreakers_content_array);
		}
		else
			$url = "https://graph.facebook.com/v5.0/me/messenger_profile?access_token={$page->page_access_token}";


		$ice_breakers_data=$icebreakers_content_json;
	
		$ch = curl_init();
	 	$headers = array("Content-type: application/json");
	 
	 	curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	 
	 	curl_setopt($ch,CURLOPT_POST,1);
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$ice_breakers_data); 
	 
	 	// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	 	curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt'); 
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	 	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
	 	$st=curl_exec($ch);	 
 	 	$result=json_decode($st,TRUE);
 	 	if(isset($result["result"])) 
 		{
 			$result["result"]=$this->CI->lang->line(trim($result["result"]));
 			$result['success']=1;
 		}
 		if(isset($result["error"])) 
 		{
 			$result["result"]=isset($result["error"]["message"]) ? $result["error"]["message"] : $this->CI->lang->line("Something went wrong, please try again.");
 			$result['success']=0;
 		}
 		return $result;
	}

}

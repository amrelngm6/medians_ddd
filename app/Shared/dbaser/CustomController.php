<?php

namespace Shared\dbaser;

use \Illuminate\Database\Eloquent\Model;

class CustomController extends Model
{

	function can($permission, $app)
	{
	    if (isset($app->auth->role))
	    {

	        if ($app->auth->role == 1)
	            return true;

		    if (isset($this->agent_id) && $this->agent_id == $app->auth->id)
	            return true;

	    }


	    return null;
	}

}





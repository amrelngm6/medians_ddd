<?php

namespace Medians\Domain\Devices;

use Shared\dbaser\CustomController;
use Medians\Domain\Prices\Prices;
use Medians\Domain\Orders\OrderDevice;
use Medians\Domain\Categories\category;


class Device extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'games';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'name',
    	'description',
    	'category',
    	'status'
	];


	public $appends = ['price'];
 

 	/**
 	 * Filter fillable fields for frontend requests
 	 */ 
	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			if (!in_array($q, array('model_type' ,'model_id')))
			{
				return $q;
			}
		}, $this->fillable));
	}


}

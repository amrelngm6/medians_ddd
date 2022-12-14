<?php

namespace Medians\Domain\ModelOptions;

use Shared\dbaser\CustomController;


class LocationInfo extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'location_info';


	protected $fillable = [
		'model_type',
		'model_id',
		'country',
		'city',	
		'zip',	
		'state',	
		'address',	
		'zone',	
		'longitude',	
		'latitude'
	];



	function __construct()
	{
	}

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

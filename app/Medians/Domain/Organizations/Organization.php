<?php

namespace Medians\Domain\Organizations;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

use Medians\Domain;


class Organization extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'Organizations';

	public $fillable = [
		'name',
		'email',
		'website',
		'phone',
		'agent_id',
		'status',
		'created_by',	
	];


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


	/**
	 * Set relation with Agent
	*/ 
	public function Agent()
	{
		return $this->HasOne(Domain\Users\Agent::class, 'id', 'agent_id');
	}

}

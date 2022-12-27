<?php

namespace Medians\Domain\Leads;

use Shared\dbaser\CustomController;

use Medians\Domain;


class Lead extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'leads';

	public $fillable = [
		'business_type',
		'name',
		'email',
		'title',
		'phone',
		'company',
		'description',
		'agent_id',
		'status',
		'source_type',
		'source_id',
		'created_by',
		'is_public',
		'client_id',
		'lead_value'
	];




	function __construct()
	{

	}



	/**
	 * Set relation with Agent
	*/ 
	public function Agent()
	{
		return $this->HasOne(Domain\Agents\Agent::class, 'id', 'agent_id');
	}



}

<?php

namespace Medians\Domain\Leads;

use Shared\dbaser\CustomController;

use Medians\Domain;


class LeadSources extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'leads_sources';

	public $fillable = [
		'name',
		'model_id',
		'model_type',
		'active'
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

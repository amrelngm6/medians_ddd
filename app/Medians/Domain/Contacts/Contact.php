<?php

namespace Medians\Domain\Contacts;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;
use Medians\Domain\Leads\LeadSources;

use Medians\Domain;


class Contact extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'contacts';

	public $fillable = [
		'customer_id',
		'first_name',
		'last_name',
		'email',
		'phone',
		'is_primary',
		'agent_id',
		'status',
		'comment',
		'created_by',
	];


	public function name()
	{
		return $this->first_name.' '.$this->last_name;
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


	/**
	 * Set Relation with SelectedOption 
	 */
	public function SelectedOption()
	{
		return $this->MorphMany(ModelOptions\SelectedOption::class, 'model');
	} 


	/**
	 * Set relation with Agent
	*/ 
	public function Agent()
	{
		return $this->HasOne(Domain\Users\Agent::class, 'id', 'agent_id');
	}


	/**
	 * Set relation with Agent
	*/ 
	public function Source()
	{
		return $this->HasOne(LeadSources::class, 'id', 'source_id');
	}


	/**
	 * Set relation with Lead Sources
	*/ 
	public function LoadSources()
	{
		return LeadSources::get();
	}


	/** 
	 * Render options values
	 */ 
	public function renderOptions($category)
	{
		return (object) array_column(
				array_map(function($q) use ($category) {
					if ($q->category == $category) { return $q; }
				}, (array) json_decode($this->SelectedOption))
			, 'value', 'code');

	}



}

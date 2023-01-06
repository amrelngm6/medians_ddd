<?php

namespace Medians\Domain\Games;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

use Medians\Domain;


class Game extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'games';

	public $fillable = [
		'name',
		'picture',
		'type',
		'description',
		'created_by',
	];


	public $appends = ['photo'];


	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
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
	 * Set relation with Stages
	*/ 
	public function LoadStages()
	{
		return Domain\Stages\Stage::get();
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


	/** 
	 * Render options values
	 */ 
	public function renderFields($category)
	{
		return array_column(Options::where('model', Lead::class)->where('category', $category)->get()->toArray(), 'title', 'code');
	}


	/** 
	 * Load Location fields as custom fields
	 */ 
	public function getLocationFieldsAttribute()
	{
		return (new ModelOptions\LocationInfo)->getFields();
	}


}

<?php

namespace Medians\Domain\Properties;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

class Property extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'properties';


	protected $fillable = [
		'name',
		'description',
		'type',
		'status',
		'availability',
		'request_type',
		'cost',
		'picture',
		'addedfrom',
		'owner_id',
		'agent_id',
		'active'
	];

	public $timestamps = false;


	public $appends = [
		'selected_options_list', 'status_list', 'availability_list', 'divisions_fields', 'faces_fields', 'location_fields', 'areas_fields', 
		'types', 'request_types', 'divisions', 'areas', 'faces'];

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


	public function SelectedOption()
	{
		return $this->MorphMany(ModelOptions\SelectedOption::class, 'model');
	}

	public function getSelectedOptionsListAttribute()
	{
		return array_column((array) json_decode($this->SelectedOption), 'value', 'code');
	}

	public function getDivisionsAttribute()
	{
		return array_column((array) json_decode($this->SelectedOption), 'value', 'code');
	}

	public function getAreasAttribute()
	{
		return array_column((array) json_decode($this->SelectedOption), 'value', 'code');
	}

	public function getFacesAttribute()
	{
		return array_column((array) json_decode($this->SelectedOption), 'value', 'code');
	}


	public function Owner()
	{
		return $this->HasOne(\Medians\Domain\Users\User::class, 'id', 'owner_id');
	}

	public function Location()
	{
		return $this->MorphOne(ModelOptions\LocationInfo::class, 'model');
	}


	public function getLocationFieldsAttribute()
	{
		return (new ModelOptions\LocationInfo)->getFields();
	}


	public function getTypesAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'type')->get()->toArray(), 'title', 'code');
	}

	public function getAvailabilityListAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'availability')->get()->toArray(), 'title', 'code');
	}

	public function getStatusListAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'status')->get()->toArray(), 'title', 'code');
	}

	public function getRequestTypesAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'request_type')->get()->toArray(), 'title', 'code');
	}


	/** 
	 * Load Divisions as custom fields
	 */ 
	public function getDivisionsFieldsAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'divisions')->get()->toArray(), 'title', 'code');
	}

	/** 
	 * Load Faces as custom fields
	 */ 
	public function getAreasFieldsAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'areas')->get()->toArray(), 'title', 'code');
	}

	/** 
	 * Load Faces as custom fields
	 */ 
	public function getFacesFieldsAttribute()
	{
		return array_column(Options::where('model', Property::class)->where('category', 'faces')->get()->toArray(), 'title', 'code');
	}

}

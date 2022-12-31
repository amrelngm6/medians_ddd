<?php

namespace Medians\Domain\Properties;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

use Medians\Domain\Users\Agent;

use Medians\Domain\Tasks\Task;

class Property extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'properties';


	protected $fillable = [
		'code',
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
		'active',
		'web',
	];

	public $timestamps = false;


	public $appends = [
		'agent_info',	
		'selected_options_list', 'status_list', 'availability_list', 'divisions_fields', 'faces_fields', 'location_fields', 'areas_fields','spaces_fields', 
		'types', 'request_types', 'divisions', 'areas', 'faces', 'spaces'];

	function __construct()
	{
		
	}


	public function photo()
	{
		return isset($this->Files[0]->file_name) ? $this->Files[0]->file_name : '/uploads/img/default.jpg';
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


	public function getLocationFieldsAttribute()
	{
		return (new ModelOptions\LocationInfo)->getFields();
	}


	public function getSelectedOptionsListAttribute()
	{
		return array_column((array) json_decode($this->SelectedOption), 'value', 'code');
	}

	public function getDivisionsAttribute()
	{
		return $this->renderOptions('divisions');
	}

	public function getAreasAttribute()
	{
		return $this->renderOptions('areas');
	}

	public function getFacesAttribute()
	{
		return $this->renderOptions('faces');
	}

	public function getSpacesAttribute()
	{
		return $this->renderOptions('spaces');
	}



	/**
	 * Load options dropdown lists
 	*/ 
	public function getTypesAttribute()
	{
		return $this->renderFields('type');
	}

	public function getAvailabilityListAttribute()
	{
		return $this->renderFields('availability');
	}

	public function getStatusListAttribute()
	{
		return $this->renderFields('status');
	}

	public function getRequestTypesAttribute()
	{
		return $this->renderFields('request_type');
	}


 
	/** 
	 * Load Divisions as custom fields
	 */ 
	public function getDivisionsFieldsAttribute()
	{
		return $this->renderFields('divisions');
	}

	/** 
	 * Load Areas as custom fields
	 */ 
	public function getAreasFieldsAttribute()
	{
		return $this->renderFields('areas');
	}

	/** 
	 * Load Faces as custom fields
	 */ 
	public function getFacesFieldsAttribute()
	{
		return $this->renderFields('faces');
	}

	/** 
	 * Load Spaces as custom fields
	 */ 
	public function getSpacesFieldsAttribute()
	{
		return $this->renderFields('spaces');
	}



	/** 
	 * Load Agent info
	 */ 
	public function getAgentInfoAttribute()
	{
		return $this->Agent;
	}




	/**
	 * Relations
	 */
	public function Owner()
	{
		return $this->HasOne(Agent::class, 'id', 'owner_id');
	}

	/**
	 * Set relation with Agent
	*/ 
	public function Agent()
	{
		return $this->HasOne(Agent::class, 'id', 'agent_id');
	}


	/**
	 * Set relation with Location info
	*/ 
	public function Location()
	{
		return $this->MorphOne(ModelOptions\LocationInfo::class, 'model');
	}

	/**
	 * Set relation with Files
	*/ 
	public function Files()
	{
		return $this->MorphMany(Files::class, 'model');
	}


	/**
	 * Set Relation with SelectedOption 
	 */
	public function SelectedOption()
	{
		return $this->MorphMany(ModelOptions\SelectedOption::class, 'model');
	} 

	/**
	 * Set Relation with Tasks 
	 */
	public function Tasks()
	{
		return $this->MorphMany(Task::class, 'model');
	} 

	public function loadAgents()
	{
		return User::where('')->get();
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
		return array_column(Options::where('model', Property::class)->where('category', $category)->get()->toArray(), 'title', 'code');
	}


	/**
	 * Related items
	 */
	public function related()
	{

		return Property::where('request_type', $this->request_type)
		->whereNotIn('id', [$this->id])
		->with('Owner', 'SelectedOption', 'Location', 'Files', 'Agent')
		->get();

	}
 
	/**
	 * Latest items
	 */
	public function latest($limit = 10)
	{

		$return = Property::with('Owner', 'SelectedOption', 'Location', 'Files', 'Agent')
		->orderBy('id', 'Desc')
		->limit($limit);

		if ($this->request_type)
		{
			$return = $return->whereNotIn('id', [$this->id])->where('request_type', $this->request_type);
		}
		return $return->get();

	}
 	
 	public function url()
 	{
 		return '/property/'.$this->id;
 	}
}

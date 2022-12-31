<?php

namespace Medians\Domain\Tasks;

use Shared\dbaser\CustomController;

use Medians\Domain\ModelOptions;

use Medians\Domain\Users\Agent;

class Task extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'tasks';


	protected $fillable = [
		'name',
		'description',
		'type',
		'priority',
		'start_date',
		'start_time',
		'end_date',
		'end_time',
		'finish_date',
		'status',
		'model_id',
		'model_type',
		'is_public',
		'created_by',
		'created_at',
		'updated_at'	
	];


	public $appends = ['users'];

	public function getUsersAttribute()
	{
		return isset($this->TaskUsers[0]->id) ? $this->TaskUsers[0]->id : 0;
	}

	public function photo()
	{
		return isset($this->Files[0]->file_name) ? $this->Files[0]->file_name : '/uploads/img/default.jpg';
	}


	public function getFields()
	{
		return array_filter(array_map(function ($q) 
		{
			// if (!in_array($q, array('model_type' ,'model_id')))
			// {
				return $q;
			// }
		}, $this->fillable));
	}


	/**
	 * Start date & Time
	 */
	public function start($format = 'D m/d, h:i a')
	{
		return date($format, strtotime($this->start_date.' '. $this->start_time));
	} 


	/**
	 * end date & Time
	 */
	public function end($format = 'D m/d, h:i a')
	{
		return date($format, strtotime($this->end_date.' '. $this->end_time));
	} 


	/**
	 * Duration of task
	 */
	public function duration()
	{
		$datetime1 = new \DateTime($this->start_date.' '. $this->start_time);
		$datetime2 = new \DateTime($this->end_date.' '. $this->end_time);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%H:%I');
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
		return $this->HasOne(Agent::class, 'id', 'created_by');
	}

	/**
	 * Set relation with Users
	*/ 
	public function TaskUsers()
	{
		return $this->HasMany(TaskUser::class, 'task_id')->with('user');
	}



	/**
	 * Set relation with Files
	*/ 
	public function Files()
	{
		return $this->MorphMany(Files::class, 'model');
	}


	public function loadAgents()
	{
		return User::where('role_id', 3)->where('active','1')->get();
	}




 	public function url()
 	{
 		return '/tasks/'.$this->id;
 	}


}

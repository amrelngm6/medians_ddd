<?php

namespace Medians\Infrastructure\Tasks;

use Medians\Domain\Tasks\Task;
use Medians\Domain\Tasks\TaskUser;
use Medians\Domain\Tasks\Files;

class TaskRepository 
{

	public $app;


	function __construct()
	{
	}

	public static function getModel()
	{
		return new Task();
	}

	public static  function get($limit = 100)
	{
		return Task::with('Owner', 'TaskUsers','Files')->limit($limit)->get();
	}

	public static  function getItems($limit = 100)
	{
		 return Task::with('Owner', 'TaskUsers','Files')
            ->limit($limit)
            ->get();

	}



	public static  function find($id)
	{

		return Task::with('Owner', 'TaskUsers', 'Files')->find($id);

	}






	/**
	* Save item to database
	*/
	public  function storeFiles($data, $id) 
	{

		Files::where('model_type', Task::class)->where('model_id', $id)->delete();
	
		if (isset($data['files']))
		{
			foreach ($data['files'] as $key => $value)
			{
				if (isset($value->file_name))
				{
					$fields = [
						'model_type' => Task::class,
						'model_id' => $id,
						'file_name' => $value->file_name,
						'filetype' => Files::getFileType($value->file_name),
						'user_id' => 0,
						'description' => null,
					];

					$Model = Files::create($fields)->update($fields);
				}
			}
	
			return $Model;		
		}

	}




	/**
	* Save item to database
	*/
	public  function storeUsers($data, $id) 
	{

		TaskUser::where('task_id', $id)->delete();
	
		if (isset($data['users']))
		{
			$data['users'] = is_array($data['users']) ? $data['users'] : [$data['users']];
			foreach ($data['users'] as $key => $value)
			{
				$fields = [
					'task_id' => $id,
					'user_id' => $value,
					'created_by' => $this->app->auth->id,
				];

				$Model = TaskUser::create($fields)->update($fields);
			}
	
			return $Model;		
		}

	}



	/**
	* Save item to database
	*/
	public  function store($data) 
	{

		$Model = new Task();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, TaskRepository::getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Task::create($dataArray);
    	$Object->update($dataArray);
    	

    	// Store users
    	TaskRepository::storeUsers( (array) $data, $Object->id);

    	// Store files
    	TaskRepository::storeFiles( (array) $data, $Object->id, 'files');


    	return $Object;

	}
	

	/**
	* Update item to database
	*/
	public  function update($data) 
	{
		$Object = Task::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	// Store users 
    	TaskRepository::storeUsers( (array) $data, $Object->id);

    	// Store files 
    	TaskRepository::storeFiles( (array) $data, $Object->id, 'files');

    	return $Object; 

	}
	


}

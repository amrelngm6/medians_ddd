<?php

namespace Medians\Infrastructure\Properties;

use Medians\Domain\Properties\Property;
use Medians\Domain\Properties\SelectedOptions;
use Medians\Domain\Properties\LocationsInfo;
use Medians\Domain\Properties\Files;

class PropertyRepository 
{




	function __construct()
	{
	}

	public static function getModel()
	{
		return new Property();
	}

	public static  function get()
	{

		return Property::with('Owner', 'SelectedOption', 'Location', 'Files')->get();

	}


	public static  function find($id)
	{

		return Property::with('Owner', 'SelectedOption', 'Location', 'Files')->find($id);

	}



	/**
	* Save item to database
	*/
	public static function storeLocation($data, $id) 
	{

		$Model = LocationsInfo::firstOrCreate([
			'model_type' => Property::class,
			'model_id' => $id,
		]);
		$data['model_type'] = Property::class;
		$data['model_id'] = $id;
		$Model->update($data);

		return $Model;
	}




	/**
	* Save item to database
	*/
	public static function storeOptions($data, $id, $category = null) 
	{

		SelectedOptions::where('model_type', Property::class)->where('category', $category)->where('model_id', $id)->delete();
		if ($data)
		{

			foreach ($data as $key => $value)
			{
				$fields = [
					'model_type' => Property::class,
					'model_id' => $id,
					'code' => $key,
					'value' => $value,
					'category' => $category
				];

				$Model = SelectedOptions::create($fields);
				$Model->update($fields);
			}
	
			return $Model;		
		}

	}



	/**
	* Save item to database
	*/
	public static function storeFiles($data, $id) 
	{

		Files::where('model_type', Property::class)->where('model_id', $id)->delete();
	
		if ($data)
		{
			foreach ($data as $key => $value)
			{
				if (isset($value->file_name))
				{
					$fields = [
						'model_type' => Property::class,
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
	public static function store($data) 
	{

		$Model = new Property();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, PropertyRepository::getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Property::create($dataArray);
    	$Object->update($dataArray);
    	
    	// Store Location data 
    	PropertyRepository::storeLocation( (array) $data['location'], $Object->id);

    	// Store Divisions data 
    	PropertyRepository::storeOptions( (array) $data['divisions'], $Object->id, 'divisions');

    	// Store areas data 
    	PropertyRepository::storeOptions( (array) $data['areas'], $Object->id, 'areas');

    	// Store faces data 
    	PropertyRepository::storeOptions( (array) $data['faces'], $Object->id, 'faces');

    	// Store spaces data 
    	PropertyRepository::storeOptions( (array) $data['spaces'], $Object->id, 'spaces');

    	// Store files
    	PropertyRepository::storeFiles( (array) $data['files'], $Object->id, 'files');


    	return $Object;

	}
	

	/**
	* Update item to database
	*/
	public static function update($data) 
	{
		$Object = Property::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);
    	
    	// Store Location data 
    	PropertyRepository::storeLocation( (array) $data['location'], $Object->id);

    	// Store Divisions data 
    	PropertyRepository::storeOptions( (array) $data['divisions'], $Object->id, 'divisions');

    	// Store areas data 
    	PropertyRepository::storeOptions( (array) $data['areas'], $Object->id, 'areas');

    	// Store faces data 
    	PropertyRepository::storeOptions( (array) $data['faces'], $Object->id, 'faces');

    	// Store spaces data 
    	PropertyRepository::storeOptions( (array) $data['spaces'], $Object->id, 'spaces');

    	// Store files 
    	PropertyRepository::storeFiles( (array) $data['files'], $Object->id, 'files');

    	return $Object; 

	}
	


}

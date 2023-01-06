<?php

namespace Medians\Infrastructure\Categories;

use Medians\Domain\Categories\Category;


class CategoryRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new Category();
	}


	public function find($id)
	{
		return Category::find($id);
	}

	public function get($limit)
	{
		return Category::limit($limit)->get();
	}

	public function categories($model)
	{
		return Category::where('model', $model)->get();
	}






	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Category();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Contact::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Contact::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    } 
}

<?php

namespace Medians\Infrastructure\Organizations;

use Medians\Domain\Organizations\Organization;


class OrganizationRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new Organization();
	}


	public function find($id)
	{

		return Organization::find($id);
	}






	/**
	* Save item to database
	*/
	public static function store($data) 
	{

		$Model = new Organization();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, OrganizationRepository::getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Organization::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Organization
     */
    public function update($data)
    {

		$Object = Organization::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    } 
}

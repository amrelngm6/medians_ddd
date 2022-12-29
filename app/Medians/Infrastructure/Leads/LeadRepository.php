<?php

namespace Medians\Infrastructure\Leads;

use Medians\Domain\Leads\Lead;


class LeadRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new Lead();
	}


	public function find($id)
	{

		return Lead::find($id);
	}


	public function getByEmail($email)
	{
		return  Lead::where('email', $this->email)->first();
	}






	/**
	* Save item to database
	*/
	public static function store($data) 
	{

		$Model = new Lead();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, LeadRepository::getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Lead::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Lead::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    } 
}

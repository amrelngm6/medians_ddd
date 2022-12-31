<?php

namespace Medians\Infrastructure\Contacts;

use Medians\Domain\Contacts\Contact;


class ContactRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new Contact();
	}


	public function find($id)
	{
		return Contact::find($id);
	}

	public function get($limit)
	{
		return Contact::limit($limit)->get();
	}


	public function getByEmail($email)
	{
		return  Contact::where('email', $this->email)->first();
	}






	/**
	* Save item to database
	*/
	public static function store($data) 
	{

		$Model = new Contact();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, ContactRepository::getModel()->getFields()))
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

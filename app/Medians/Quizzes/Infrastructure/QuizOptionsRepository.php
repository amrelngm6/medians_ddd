<?php

namespace Medians\Quizzes\Infrastructure;

use Medians\Quizzes\Domain\QuizOptions;


class QuizOptionsRepository 
{




	function __construct()
	{
		$this->app = new \config\APP;
	}



	public function find($id)
	{
		return QuizOptions::find($id);
	}


	public function get()
	{
		return QuizOptions::get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new QuizOptions();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$dataArray['status'] = isset($dataArray['status']) ? 'on' : 0;
		// Return the FBUserInfo object with the new data
    	$Object = QuizOptions::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = QuizOptions::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;

    } 


	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return QuizOptions::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

}

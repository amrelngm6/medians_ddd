<?php

namespace Medians\Quizzes\Infrastructure;

use Medians\Quizzes\Domain\Quiz;


class QuizRepository 
{




	function __construct()
	{
		$this->app = new \config\APP;
	}



	public function find($id)
	{
		return Quiz::find($id);
	}


	public function get()
	{
		return Quiz::get();
	}




	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Quiz();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $this->getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		$dataArray['status'] = isset($dataArray['status']) ? 'on' : 0;
		// Return the FBUserInfo object with the new data
    	$Object = Quiz::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	
    /**
     * Update Lead
     */
    public function update($data)
    {

		$Object = Quiz::find($data['id']);
		
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
			
			return Quiz::find($id)->delete();

		} catch (\Exception $e) {

			throw new \Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}

}

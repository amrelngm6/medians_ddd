<?php

namespace Medians\Quizzes\Application;

use Medians\Quizzes\Infrastructure\QuizRepository;
use Medians\Categories\Infrastructure\CategoryRepository;


class QuizController
{

	/**
	* @var Object
	*/
	protected $repo;

	public $app;



	function __construct()
	{
		$this->app = new \config\APP;

		$this->repo = new QuizRepository();

		$this->CategoryRepo = new CategoryRepository();

	}

	/**
	 * Admin index items
	 * 
	 * @param Silex\Application $app
	 * @param \Twig\Environment $twig
	 * 
	 */ 
	public function index() 
	{
	    return render('views/admin/quizzes/index.html.twig', [
	        'title' => __('Devices list'),
	        'app' => $this->app,
	        'quizzesList' => $this->repo->get(100),
	        'typesList' => $this->CategoryRepo->categories(),

	    ]);
	}




	public function edit(int $id ) 
	{

	    return render('views/admin/quizzes/edit_quiz.html.twig', [
	        'title' => __('Edit quiz'),
	        'typesList' => $this->CategoryRepo->categories(Device::class),
	        'app' => $this->app,
	        'quiz' => $this->repo->find($id)
	    ]);
	}


	/**
	*  Store item
	*/
	public function store() 
	{

		$params = (array) $this->app->request()->get('params');

		try {

			$params['branch_id'] = $this->app->branch->id;
			$Property = $this->repo->store($params);

        	return array('success'=>1, 'result'=>__('Created'), 'reload'=>2);

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}



	/**
	*  update item
	*/
	public function update() 
	{

		$params = (array)  $this->app->request()->get('params');

		try {

			$params['branch_id'] = $this->app->branch->id;
			$params['status'] = !empty($params['status']) ? 1 : 0;
			$this->repo->update($params);

        	return array('success'=>1, 'result'=>__('Updated'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }
	}


	/** 
	 * Delete item
	 */
	public function delete() 
	{	

		$params = (array)  json_decode($this->app->request()->get('params'));

		try {

			$Property = $this->repo->destroy($params);

        	return array('success'=>1, 'result'=>__('Deleted'));

        } catch (Exception $e) {
            return  array('error'=>$e->getMessage());
        }

	}


	public function validate($params) 
	{

		if (empty($params['title']))
		{
			throw new \Exception(__("Empty title"), 1);
		}

		if (empty($params['type']))
		{
			throw new \Exception(__("Empty type"), 1);
		}

	}


}

<?php

namespace Medians\Domain\Quizzes;

use Shared\dbaser\CustomController;


class QuizOptions extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'quiz_options';

	public $fillable = [
		'text',
		'letter',
		'picture',
		'quiz_id',
		'style',
		'is_correct',
		'created_by',
		'status',
	];

	/**
	 * Disable create & update times fields
	 */ 
	// public $timestamps = false;


	public function getFields()
	{
		return $this->fillable;
	}


}

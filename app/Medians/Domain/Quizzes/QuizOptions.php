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
		'correct',
		'created_by',
		'status',
	];

	public $appends = ['selected', 'is_correct'];

	public function getSelectedAttribute()
	{
		return false;
	}

	public function getIsCorrectAttribute()
	{
		return $this->correct ? true : false;
	}

	/**
	 * Disable create & update times fields
	 */ 
	// public $timestamps = false;


	public function getFields()
	{
		return $this->fillable;
	}


}

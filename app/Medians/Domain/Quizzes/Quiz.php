<?php

namespace Medians\Domain\Quizzes;

use Shared\dbaser\CustomController;


class Quiz extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'quizzes';

	public $fillable = [
		'title',
		'pciture',
		'category_id',
		'video_bg',
		'video_url',
		'options_style',
		'options_img',
		'quote_title',
		'quote_text',
		'next_id',
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

	public static function byCategory($category_id)
	{
		return Quiz::with('options')->where('category_id', $category_id)->where('status', 1)->get();
	}


	public function options()
	{
		return $this->HasMany(QuizOptions::class, 'quiz_id', 'id');
	}
}

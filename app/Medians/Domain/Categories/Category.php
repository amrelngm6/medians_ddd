<?php

namespace Medians\Domain\Categories;

use Shared\dbaser\CustomController;


class Category extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'categories';

	public $fillable = [
		'name',
		'code',
		'model',
		'status',
	];


	/**
	 * Disable create & update times fields
	 */ 
	public $timestamps = false;


	public function getFields()
	{
		return $this->fillable;
	}



}

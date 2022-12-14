<?php

namespace Medians\Domain\ModelOptions;

use Shared\dbaser\CustomController;


class ModelOption extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'model_options';


	protected $fillable = [
		'model',
		'code',
		'title',
		'category',
		'position'
	];

	public $timestamps = false;


	function __construct()
	{
	}



}

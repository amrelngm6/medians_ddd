<?php

namespace Medians\Domain\ModelOptions;

use Shared\dbaser\CustomController;


class SelectedOption extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'model_selected_options';


	protected $fillable = [
		'model_type',
		'model_id',
		'code',
		'value',
		'category'
	];


	function __construct()
	{
	}



}

<?php

namespace Medians\Domain\Stages;

use Shared\dbaser\CustomController;

use Medians\Domain;


class Stage extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'stages';

	public $fillable = [
		'name',
		'status'
	];


	



}

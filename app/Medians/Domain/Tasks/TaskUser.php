<?php

namespace Medians\Domain\Tasks;

use Shared\dbaser\CustomController;

use Medians\Domain;


class TaskUser extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'task_users';

	public $fillable = [
		'task_id',
		'user_id',
		'created_by',
	];



	public function user()
	{
		return $this->HasOne(Domain\Users\User::class, 'id', 'user_id');
	}


}

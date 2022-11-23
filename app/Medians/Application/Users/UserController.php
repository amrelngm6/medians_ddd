<?php

namespace Medians\Application\Users;

use Medians\Infrastructure\Users\UserRepository;


class UserController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{

		$this->repo = new UserRepository;
	}




}

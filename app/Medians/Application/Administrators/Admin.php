<?php

namespace Medians\Application\Users;

use Medians\Infrastructure\Users as Repo;

use Medians\Domain\Customers\CustomerModel as CustomerModel;

class Admin 
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{
		$this->repo = new Repo\UserRepository();
	}




}

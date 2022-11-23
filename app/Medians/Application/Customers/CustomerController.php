<?php

namespace Medians\Application\Customers;

use Medians\Infrastructure\Customers as Repo;



class CustomerController
{


	/*
	/ @var new CustomerRepository
	*/
	private $repo;


	function __construct()
	{

		$this->repo = new Repo\CustomerRepository();

	}

	public function getItem($id)
	{
		return $this->repo->find($id);
	}

}

<?php

namespace Medians\Domain\Providers;


use Shared\dbaser\CustomController;

class ProviderUsers extends CustomController
{

	/**
	* @var String
	*/
	protected $table = 'provider_users';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'userId',
    	'providerId',
    	'main',
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;


	public function id() 
	{
		return $this->id;
	}


	public function setId($id) : void
	{
		$this->id = $id;
	}


}

<?php

namespace Medians\Domain\Providers;


use Shared\dbaser\CustomController;

class Provider extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'providers';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'title',
    	'publish'
	];

	/**
	* @var bool
	*/
	// public $timestamps = false;

	public function id() 
	{
		return $this->id;
	}


	public function title() : String
	{
		return $this->title;
	}


	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setTitle($title) : void
	{
		$this->title = $title;
	}


	public function setPublish($publish) : void
	{
		$this->publish = $publish;
	}

	public function users()
	{
		return $this->hasOneThrough(
			User::class, ProviderUsers::class, 'userId', 'id', 'id'
		);
	}
}

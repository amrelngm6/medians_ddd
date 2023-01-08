<?php

namespace Medians\Domain\Users;


use Medians\Domain\Properties\Property;

use Shared\dbaser\CustomController;

class User extends CustomController
{


	/*
	/ @var String
	*/
	protected $table = 'users';


	protected $fillable = [
    	'provider_id',
    	'first_name',
    	'last_name',
    	'email',
    	'password',
    	'phone',
    	'profile_image',
    	'role_id',
    	'active',
	];

	public $appends = ['name', 'photo', 'password'];

	public function getPasswordAttribute() 
	{
		return null;
	}
	public function getNameAttribute() : String
	{
		return $this->name();
	}

	public function getPhotoAttribute() : ?String
	{
		return $this->photo();
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function name() : String
	{
		return $this->first_name.' '.$this->last_name;
	}

	public function email() : String
	{
		return $this->email;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setName($name) : void
	{
		$this->name = $name;
	}

	public function setEmail($email) : void
	{
		$this->email = $email;
	}

	public function setPublish($publish) : void
	{
		$this->publish = $publish;
	}

	public function properties()
	{
		return $this->HasMany(Property::class , 'agent_id');
	}


	public function provider()
	{
		return $this->hasOne(Provider::class , 'id', 'provider_id');
	}


	/**
	 * Relation with role 
	 */
	public function Role() 
	{
		return $this->hasOne(Role::class, 'id', 'role_id');
	}
}

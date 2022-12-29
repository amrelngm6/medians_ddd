<?php

namespace Medians\Domain\Users;

use Shared\dbaser\CustomController;

use Medians\Domain\Providers\Provider;
use Medians\Domain\Providers\ProviderUsers;
use Medians\Domain\FaceBook\FBPageInfo;
use Medians\Domain\FaceBook\FBUserInfo;

class User extends CustomController
{


	/*
	/ @var String
	*/
	protected $table = 'users';


	protected $fillable = [
    	'firstname',
    	'lastname',
    	'email',
    	'password',
    	'phone',
    	'profile_image',
    	'role',
    	'active',
	];

	public $appends = ['name'];

	public function getNameAttribute() : String
	{
		return $this->firstname.' '.$this->lastname;
	}


	public function photo() : String
	{
		return !empty($this->profile_image) ? $this->profile_image : '/uploads/images/default_profile.jpg';
	}

	public function name() : String
	{
		return $this->firstname.' '.$this->lastname;
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

	public function providers()
	{
		return $this->HasManyThrough(
			Provider::class, ProviderUsers::class, 'userId', 'id', 'id', 'providerId'
		);
	}

	public function fb_pages()
	{
		return $this->HasMany(
			FBPageInfo::class,  'user_id', 'id'
		);
	}

	public function fb_user()
	{
		return $this->HasOne(
			FBUserInfo::class,  'user_id', 'id'
		);
	}

}

<?php

namespace Medians\Domain\Users;

use Shared\dbaser\CustomController;

use Medians\Domain\Providers\Provider;
use Medians\Domain\Providers\ProviderUsers;

class User extends CustomController
{


	public function name() : String
	{
		return $this->name;
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

}

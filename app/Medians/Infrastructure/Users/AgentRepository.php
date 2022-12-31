<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\Agent;

class AgentRepository extends UserRepository 
{


	public function getModel()
	{
		return new Agent;
	}

	public function get($limit = 100)
	{
		return Agent::where('role_id', 3)->limit($limit)->get();
	}

}

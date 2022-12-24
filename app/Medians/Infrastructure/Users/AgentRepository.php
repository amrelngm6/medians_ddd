<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\Agent;

class AgentRepository extends UserRepository 
{


	public function getModel()
	{
		return new Agent;
	}


}

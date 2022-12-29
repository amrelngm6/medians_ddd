<?php

namespace Medians\Infrastructure\Leads;

use Medians\Domain\Leads\Lead;
use Medians\Domain\Leads\LeadSources;


class LeadSourcesRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new LeadSources();
	}


	public function find($id)
	{

		return LeadSources::find($id);
	}


}

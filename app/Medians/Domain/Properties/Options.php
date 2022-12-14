<?php

namespace Medians\Domain\Properties;

use Medians\Domain\ModelOptions\ModelOption;


class Options extends ModelOption
{



	function __construct()
	{
		$this->where('model', Property::class);
	}



}

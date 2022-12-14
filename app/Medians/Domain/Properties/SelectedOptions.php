<?php

namespace Medians\Domain\Properties;

use Medians\Domain\ModelOptions\SelectedOption;


class SelectedOptions extends SelectedOption
{



	function __construct()
	{
		$this->where('model', Property::class);
	}



}

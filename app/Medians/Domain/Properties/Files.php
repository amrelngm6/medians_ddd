<?php

namespace Medians\Domain\Properties;

use Medians\Domain\ModelOptions\ModelFile;


class Files extends ModelFile
{
	


	function __construct()
	{
	}


	public static function getFileType($filename)
	{
		$explode = explode('.', $filename);
		return is_array($explode) ? end($explode) : null;
	}

}

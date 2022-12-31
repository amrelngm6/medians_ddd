<?php

namespace Medians\Domain\Tasks;

use Medians\Domain\ModelOptions\ModelFile;


class Files extends ModelFile
{
	


	public static function getFileType($filename)
	{
		$explode = explode('.', $filename);
		return is_array($explode) ? end($explode) : null;
	}

}

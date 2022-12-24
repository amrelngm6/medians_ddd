<?php

namespace Medians\Domain\ModelOptions;

use Shared\dbaser\CustomController;


class ModelFile extends CustomController 
{

	/*
	/ @var String
	*/
	protected $table = 'model_files';


	protected $fillable = [
		'model_type',
		'model_id',
		'file_name',
		'description',
		'user_id',
		'filetype'
	];

	public $appends = ['data_url','download_url', 'image'];

	function __construct()
	{
	}

	public function getDownloadUrlAttribute()
	{
		return $this->file_name;
	}

	public function getDataUrlAttribute()
	{
		return $this->file_name;
	}

	public function getImageAttribute()
	{
		return (object) ['height'=>'', 'width'=>''];
	}


}

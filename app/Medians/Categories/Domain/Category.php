<?php

namespace Medians\Categories\Domain;

use Shared\dbaser\CustomController;

use Medians\Devices\Domain\Device;
use Medians\Products\Domain\Product;

class Category extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'categories';

	public $fillable = [
		'name',
		'branch_id',
		'model',
		'status',
	];


	/**
	 * Disable create & update times fields
	 */ 
	public $timestamps = false;


	public function getFields()
	{
		return $this->fillable;
	}

	public static function byModel($Model)
	{
		return Category::where('model', $Model)->where('status', '!=', '')->get();
	}



	public function parent_category()
	{
		return $this->hasOne(Category::class, 'id', 'parent');
	}

	public function childs()
	{
		return $this->hasMany(Category::class, 'parent', 'id');
	}

	public function devices()
	{
		return $this->hasMany(Device::class, 'type', 'id');
	}

	public function products()
	{
		return $this->hasMany(Product::class, 'type', 'id');
	}

}

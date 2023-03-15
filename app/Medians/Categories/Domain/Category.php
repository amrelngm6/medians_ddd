<?php

namespace Medians\Categories\Domain;

use Shared\dbaser\CustomController;

use Medians\Devices\Domain\Device;
use Medians\Quizzes\Domain\Quiz;
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

	public $appends = ['title', 'sub_title', 'picture', 'section_bg', 'quiz_id', 'video_type'];


	/**
	 * Disable create & update times fields
	 */ 
	public $timestamps = false;


	public function getVideoTypeAttribute()
	{
		return !empty($this->is_video) ? true : false;
	}
	public function getQuizIdAttribute()
	{
		return isset($this->quiz->id) ? $this->quiz->id : 0;
	}
	public function getTitleAttribute()
	{
		return $this->name;
	}
	public function getSubTitleAttribute()
	{
		return $this->code;
	}
	public function getPictureAttribute()
	{
		return $this->icon;
	}
	public function getSectionBgAttribute()
	{
		return $this->bg;
	}


	public function getFields()
	{
		return $this->fillable;
	}

	public static function byModel($Model, $parent = 0)
	{
		return Category::where('model', $Model)
		->where('parent', $parent)
		->where('status', '1')
		->with('quiz')
		->get();
	}

	public function quiz()
	{
		return $this->HasOne(Quiz::class, 'category_id', 'id')->with('options');
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

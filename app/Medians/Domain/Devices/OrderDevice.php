<?php

namespace Medians\Domain\Devices;


use Shared\dbaser\CustomController;

use Medians\Domain\Devices\Device;
use Medians\Domain\Games\Game;
use Medians\Domain\Products\Product;


class OrderDevice extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'order_devices';

	/**
	* @var Array
	*/
	public $fillable = [
		'provider_id',	
		'device_id',	
		'game_id',	
		'device_cost',	
		'order_code',	
		'booking_type',	
		'start_time',	
		'break_time',	
		'end_time',	
		'last_check',	
		'created_by',	
		'status'
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;

	public $appends = ['duration', 'duration_time', 'currency'];


	public function getCurrencyAttribute() 
	{
		return 'EGP';
	}

	public function getDurationAttribute() 
	{
		return round(abs(strtotime($this->end_time) - strtotime($this->start_time)) / 60,2);
	}



	public function getDurationTimeAttribute() 
	{
		$interval = (new \DateTime($this->start_time ))->diff(new \DateTime($this->end_time));
		$hours   = $interval->format('%h : %i'); 
		return $hours;
	}




	/**
	 * Relations
	 */
	public function device()
	{
		return $this->hasOne(Device::class, 'id', 'device_id');
	}

	/**
	 * Relations
	 */
	public function products()
	{
		return $this->hasMany(OrderDeviceItem::class, 'order_device_id', 'id')->where('model_type', Product::class)->with('product');
	}


	/**
	 * Relations
	 */
	public function game()
	{
		return $this->hasOne(Game::class, 'id', 'game_id');
	}



}

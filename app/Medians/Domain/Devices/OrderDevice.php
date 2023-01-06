<?php

namespace Medians\Domain\Devices;


use Shared\dbaser\CustomController;

use Medians\Domain\Devices\Device;
use Medians\Domain\Games\Game;


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



	public function spend_time() 
	{
		$interval = (new \DateTime($this->startTime ))->diff(new \DateTime($this->endTime));
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
	public function game()
	{
		return $this->hasOne(Game::class, 'id', 'game_id');
	}



}

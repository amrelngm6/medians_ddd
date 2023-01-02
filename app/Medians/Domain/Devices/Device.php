<?php

namespace Medians\Domain\Devices;

use Medians\Domain\Prices\Prices;
use Medians\Domain\Orders\DeviceOrder;
use Shared\dbaser\CustomController;


class Device extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'devices';

	/**
	* @var Array
	*/
	protected $fillable = [
    	'title',
    	'providerId',
    	'playing',
    	'type',
    	'publish'
	];

	/**
	* @var bool
	*/
	public $timestamps = false;


	function __construct()
	{


	}


	public function id() : String
	{
		return $this->id;
	}


	public function title() : String
	{
		return $this->title;
	}


	public function playing() : ?String
	{
		return $this->playing;
	}


	public function providerId() : ?Int
	{
		return $this->providerId;
	}

	public function type() 
	{
		return 	$this->type;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : Device
	{
		$this->id = $id;
		return $this;
	}

	public function setTitle($title) : Device
	{
		$this->title = $title;
		return $this;
	}

	public function setPlaying($playing = 0) : Device
	{
		$this->playing = $playing;
		return $this;
	}

	public function setProviderId($providerId = 0) : Device
	{
		$this->providerId = $providerId;
		return $this;
	}

	public function setType($type) : Device
	{
		$this->type = $type;
		return $this;
	}

	public function setPublish($publish = '0') : Device
	{
		$this->publish = $publish;
		return $this;
	}



	/**
	 * Relatoins
	 *
	*/

	/*
	// Relation with orders 
	*/
	public function currentOrder()
	{
		return  $this->hasOne(DeviceOrder::class, 'deviceId', 'id')->where('status', 'active');
	}


	/*
	// Relation 
	*/
	public function category()
	{
		return  $this->hasOne(DeviceType::class, 'id', 'type');
	}


	/*
	// Relation 
	*/
	public function prices()
	{
		return  $this->hasOne(Prices::class, 'device', 'id');
	}



}

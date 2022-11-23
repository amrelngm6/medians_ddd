<?php

namespace Medians\Domain\Prices;

use Medians\Domain\Devices\Device;

use Shared\dbaser\CustomController;


class Prices extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'prices';


	public $fillable = [
			'device',
			'single_price',
			'multi_price'
		];

	public $timestamps = null;




	function __construct()
	{

	}


	public function id() : ?int
	{
		return $this->id;
	}


	public function device() : ?Device
	{
		return Device::find($this->device);
	}


	public function single_price() : ?Int
	{
		return (int) $this->single_price;
	}


	public function multi_price() : ?Int
	{
		return (int) $this->multi_price;
	}



	public function setId($id) : Prices
	{
		$this->id = $id;
		return $this;
	}

	public function setDevice($deviceId) : Prices
	{
		$this->device = $deviceId;
		return $this;
	}

	public function setSinglePrice($singlePrice) : Prices
	{
		$this->single_price = $singlePrice;
		return $this;
	}

	public function setMultiPrice($multiPrice) : Prices
	{
		$this->multi_price = $multiPrice;
		return $this;
	}


}

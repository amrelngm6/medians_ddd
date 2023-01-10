<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\OrderDevice;

class OrderDevicesRepository
{
 	


	public $app ;


	function __construct($app)
	{
		$this->app = $app;
	}


	/*
	// Find item by `id` 
	*/
	public function find($id)
	{

		return OrderDevice::with('products','game','user')->where('provider_id', $this->app->provider->id)->find($id);

	}



}

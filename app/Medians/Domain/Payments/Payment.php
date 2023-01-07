<?php

namespace Medians\Domain\Payments;


use Shared\dbaser\CustomController;



class Payment extends CustomController
{


	/**
	* @var String
	*/
	protected $table = 'payments';

	/**
	* @var Array
	*/
	public $fillable = [
		'name',
		'notes',
		'picture',
		'invoice_id',
		'amount',
	];

	/**
	* @var Boolen
	*/
	// public $timestamps = null;



}

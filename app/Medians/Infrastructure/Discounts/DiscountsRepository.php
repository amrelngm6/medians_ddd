<?php

namespace Medians\Infrastructure\Discounts;

use Medians\Domain\Discounts\Discount;

class DiscountsRepository 
{
	


	/*
	// Find item by `id` 
	*/
	public function getById($id) 
	{

		return  Discount::find($id);
	}


	
	/*
	// Find by code
	*/
	public function getByCode($code ) 
	{
	  	return Discount::where('code', $code)->first();
	}


	/*
	// Find all items 
	*/
	public function getAll($limit = 100)
	{
		return  Discount::limit($limit)->get();
	}


	

}
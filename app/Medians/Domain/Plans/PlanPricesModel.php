<?php

namespace Medians\Domain\Plans;


class PlanPricesModel 
{



	public function id() : ?int
	{
		return $this->id;
	}

	public function planId() : ?Int
	{
		return $this->planId;
	}

	public function months() : ?Int
	{
		return $this->months;
	}

	public function cost() : ?Float
	{
		return $this->cost;
	}



	public function setId($id) : void
	{
		$this->id = $id;
	}


	public function setPlanId($planId) : void
	{
		$this->planId = $planId;
	}



	public function setMonths($months) : void
	{
		$this->months = $months;
	}


	public function setCost($cost = 0) : void
	{
		$this->cost = $cost;
	}



}

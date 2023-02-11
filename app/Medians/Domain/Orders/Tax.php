<?php

namespace Medians\Domain\Orders;

class Tax
{

	protected $amount; 

	protected $percent; 

	protected $tax_amount; 


	function __construct($percent, $amount)
	{
		$this->tax_amount = ($percent * $amount / 100);

		$this->percent = $percent;

		$this->amount = $amount;

	}


	public function amount()
	{
		return $this->amount;
	}


	public function percent()
	{
		return $this->percent;
	}


	public function tax_amount()
	{
		return round($this->tax_amount);
	}

	public function total_cost()
	{
		return round(round($this->tax_amount) + round($this->amount) );
	}


}

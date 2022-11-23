<?php

namespace Medians\Domain\Plans;


class PlanModel 
{




	public function id() : ?int
	{
		return $this->id;
	}

	public function title() : ?String
	{
		return $this->title;
	}

	public function description() : ?String
	{
		return $this->description;
	}

	public function planType() : ?Int
	{
		return $this->planType;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}

	public function insertedBy() : ?Int
	{
		return $this->insertedBy;
	}




	public function setId($id) : void
	{
		$this->id = $id;
	}


	public function setTitle($title) : void
	{
		$this->title = $title;
	}


	public function setPlanType($planType) : void
	{
		$this->planType = $planType;
	}


	public function setDescription($description) : void
	{
		$this->description = $description;
	}


	public function setInsertedBy($insertedBy) : void
	{
		$this->insertedBy = $insertedBy;
	}


	public function setPublish($publish = 0) : void
	{
		$this->publish = $publish;
	}



}

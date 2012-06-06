<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\AccountInterface;

class Account implements AccountInterface
{
	protected $id;
	protected $name;
	protected $status;
	protected $createdAt;
	
	public function getId() 
	{
		return $this->id;
	}
	
	public function setId( $id )
	{
		$this->id = $id;
	}

	public function getName() 
	{
		return $this->name;
	}

	public function setName($name) 
	{
		$this->name = $name;
	}

	public function getStatus() 
	{
		return $this->status;
	}

	public function setStatus($status) 
	{
		$this->status = $status;
	}
	
	public function setCreatedAt()
	{
		if (null === $this->createdAt)
		{
			$this->createdAt = new \DateTime();
		}
		$this->updatedAt = new \DateTime();
	}
	
	public function getCreatedAt()
	{
		return $this->createdAt;
	}
}

<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\AccountingEntryInterface;

class AccountingEntry implements AccountingEntryInterface
{
	protected $account;
	protected $amount;
	protected $description;
	protected $trackingId;
	protected $transactionType;
	protected $createdAt;

	public function getTransactionType() 
	{
		return $this->transactionType;
	}

	public function setTransactionType($transactionType) 
	{
		$this->transactionType = $transactionType;
	}

	public function setCreatedAt() 
	{
		if (null === $this->createdAt) 
		{
			$this->createdAt = new \DateTime();
		}
		$this->updatedAt = new \DateTime();
	}

	public function getAccount() 
	{
		return $this->account;
	}

	public function setAccount($account) 
	{
		$this->account = $account;
	}

	public function getAmount() 
	{
		return $this->amount;
	}

	public function setAmount($amount) 
	{
		$this->amount = $amount;
	}

	public function getDescription() 
	{
		return $this->description;
	}

	public function setDescription($description) 
	{
		$this->description = $description;
	}

	public function getTrackingId() 
	{
		return $this->trackingId;
	}

	public function setTrackingId($trackingId) 
	{
		$this->trackingId = $trackingId;
	}

	public function getCreatedAt() 
	{
		return $this->createdAt;
	}
}

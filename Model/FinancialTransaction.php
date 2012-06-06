<?php

namespace BSP\AccountingBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use BSP\AccountingBundle\Model\FinancialTransactionInterface;
use BSP\AccountingBundle\Model\ExtendedDataInterface;

class FinancialTransaction implements FinancialTransactionInterface 
{
	protected $id;
	protected $state;
	protected $referenceNumber;
	protected $createdAt;
	protected $updatedAt;
	protected $extendedData;
	protected $accountingEntries;

	public function __construct() 
	{
		$this->accountingEntries = new ArrayCollection();
		$this->state = self::STATE_NEW;
		$this->createdAt = new \DateTime();
	}

	public function getId() 
	{
		return $this->id;
	}

	public function setCreatedAt() 
	{
		if (null === $this->createdAt) 
		{
			$this->createdAt = new \DateTime();
		}
		$this->updatedAt = new \DateTime();
	}

	public function incrementUpdatedAt() 
	{
		$this->updatedAt = new \DateTime();
	}

	public function getState() 
	{
		return $this->state;
	}

	public function setState($state) 
	{
		$this->state = $state;
	}

	public function getReferenceNumber() 
	{
		return $this->referenceNumber;
	}

	public function setReferenceNumber($referenceNumber) 
	{
		$this->referenceNumber = $referenceNumber;
	}

	public function getCreatedAt() 
	{
		return $this->createdAt;
	}

	public function getUpdatedAt() 
	{
		return $this->updatedAt;
	}

	public function getAccountingEntries() 
	{
		return $this->accountingEntries;
	}

	public function setAccountingEntries($accountingEntries) 
	{
		$this->accountingEntries = $accountingEntries;
	}

	public function addAcountingEntry( $accountingEntry )
	{
		$this->accountingEntries[] = $accountingEntry;
	}
	
	public function getExtendedData()
	{
		return $this->extendedData;
	}
	
	public function setExtendedData(ExtendedDataInterface $extendedData)
	{
		$this->extendedData = $extendedData;
	}
}

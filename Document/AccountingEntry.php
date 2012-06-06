<?php

namespace BSP\AccountingBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use BSP\AccountingBundle\Model\AccountingEntry as BaseAccountingEntry;

/**
 * @MongoDB\EmbeddedDocument
 */
class AccountingEntry extends BaseAccountingEntry
{
	/**
	 * @MongoDB\ReferenceOne(targetDocument="BSP\AccountingBundle\Document\Account")
	 */
	protected $account;
	
	/**
	 * @MongoDB\Int
	 */
	protected $amount;
	
	/**
	 * @MongoDB\String
	 */
	protected $units;
	
	/**
	 * @MongoDB\String
	 */
	protected $description;
	
	/**
	 * @MongoDB\String
	 */
	protected $trackingId;
	
	/**
	 * @MongoDB\Int
	 */
	protected $transactionType;
	
	/**
	 * @MongoDB\Date
	 */
	protected $createdAt;
	
	/** @MongoDB\PrePersist */
	public function prePersistEntry()
	{
		parent::setCreatedAt();
	}
	
}
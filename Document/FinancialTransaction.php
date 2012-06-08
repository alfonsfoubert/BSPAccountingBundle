<?php

namespace BSP\AccountingBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="transactions")
 */
class FinancialTransaction
{	
	/**
	 * @MongoDB\Id
	 */
	protected $id;
	
	/**
	 * @MongoDB\Int
	 */
	protected $state;
	
	/**
	 * @MongoDB\String
	 */
	protected $referenceNumber;
	
	/**
	 * @MongoDB\Date
	 */
	protected $createdAt;
	
	/**
	 * @MongoDB\Date
	 */
	protected $updatedAt;
	
	/**
	 * @MongoDB\EmbedMany(targetDocument="BSP\AccountingBundle\Document\AccountingEntry")
	 */
	protected $accountingEntries;
	
	/** 
	 * @MongoDB\String
	 */
	protected $extendedData;
}
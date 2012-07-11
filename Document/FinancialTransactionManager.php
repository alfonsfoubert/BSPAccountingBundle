<?php

namespace BSP\AccountingBundle\Document;

use BSP\AccountingBundle\Model\FinancialTransactionManager as AbstractFinancialTransacionManager;
use BSP\AccountingBundle\Model\FinancialTransactionInterface;

class FinancialTransactionManager extends AbstractFinancialTransacionManager
{
	protected $dm;
	protected $repository;
	protected $class;
	protected $accountManager;
	protected $entryClass;
	
	public function __construct( $dm, $class, $entryClass, $accountManager )
	{
		$this->dm = $dm;
		$this->repository = $dm->getRepository($class);
		$metadata = $dm->getClassMetadata($class);
		$this->class = $metadata->name;
		$this->accountManager = $accountManager;
		$this->entryClass = $entryClass;
	}
	
	public function getClass()
	{
		return $this->class;
	}
	
	public function getEntryClass()
	{
		return $this->entryClass;
	}
	
	public function findTransactionBy( array $criteria )
	{
		return $this->repository->findOneBy($criteria);
	}
	
	public function findTransactions()
	{
		return $this->repository->findAll();
	}
	
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	{
		return $this->productRepo->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	function updateTransaction( FinancialTransactionInterface $transaction, $andFlush = true )
	{
		$this->dm->persist($transaction);
		if ($andFlush) {
			$this->dm->flush();
		}
	}
	
	public function checkTransactions()
	{
		$transactions = $this->dm->createQueryBuilder( $this->class )
                				 ->where('checkTransaction(this.accountingEntries) == false')
                				 ->getQuery()
                				 ->execute();
		return $transactions;
	}
}
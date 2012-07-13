<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\FinancialTransactionInterface;

interface FinancialTransactionManagerInterface
{
	function getClass();
	function getEntryClass();
	function findTransactionBy(array $criteria);
	function findTransactionById( $id );
	function findTransactionByReference( $reference );
	function findTransactions();
	function findTransactionsByAccount( $account_id );
	function findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null );
	function createTransaction();
	function updateTransaction( FinancialTransactionInterface $transaction, $andFlush = true );
	function checkTransactions();
}
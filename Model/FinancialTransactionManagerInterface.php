<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\FinancialTransactionInterface;

interface FinancialTransactionManagerInterface
{
    public function getClass();
    public function getEntryClass();
    public function findTransactionBy(array $criteria);
    public function findTransactionById( $id );
    public function findTransactionByReference( $reference );
    public function findTransactions();
    public function findTransactionsByAccount( $account_id );
    public function findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null );
    public function createTransaction();
    public function updateTransaction( FinancialTransactionInterface $transaction, $andFlush = true );
    public function checkTransactions();
}

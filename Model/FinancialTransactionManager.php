<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\FinancialTransactionManagerInterface;

abstract class FinancialTransactionManager implements FinancialTransactionManagerInterface
{
    public function findTransactionById( $id )
    {
        return $this->findTransactionBy( array( 'id' => $id ) );
    }

    public function findTransactionByReference( $reference )
    {
        return $this->findTransactionBy( array( 'reference' => $reference ) );
    }

    public function findTransactionsByAccount( $account_id, array $orderBy = null, $limit = null, $offset = null )
    {
        return $this->findBy( array( 'account.$id' => $account_id ), $orderBy, $limit, $offset );
    }

    public function createTransaction()
    {
        $class = $this->getClass();
        $transaction = new $class();

        return $transaction;
    }
}

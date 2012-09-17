<?php

namespace BSP\AccountingBundle\Util;

class AccountingManipulator
{
    protected $accountManager;
    protected $transactionManager;

    public function __construct( $accountManager, $transactionManager )
    {
        $this->accountManager     = $accountManager;
        $this->transactionManager = $transactionManager;
    }

    public function createAccount( $name, $units, $generator = 'default', array $options = null )
    {
        $account = $this->accountManager->createAccount( $generator, $options );
        $account->setName( $name );
        $account->setUnits($units);
        $this->accountManager->updateAccount( $account );

        return $account;
    }

    public function createTransaction( $reference, $extendedData = null )
    {
        $transaction = $this->transactionManager->createTransaction();

        // Set the reference number
        $transaction->setReference( $reference );

        // Set the extended data
        if ($extendedData !== null) {
            $transaction->setExtendedData( $extendedData );
        }

        $this->transactionManager->updateTransaction( $transaction );

        return $transaction;
    }

    public function balance( $account )
    {
        $account = $this->getAccount( $account );

        return $this->accountManager->balance( $account, $this->transactionManager->getClass() );
    }

    // Throws Exception //
    public function closeTransaction( $transaction, $success )
    {
        $transaction = $this->getTransaction( $transaction );
        $transaction->close( $success );
        $this->transactionManager->updateTransaction( $transaction );
    }

    // Throws Exception //
    public function cancelTransaction( $transaction )
    {
        $transaction = $this->getTransaction( $transaction );
        $transaction->cancel();
        $this->transactionManager->updateTransaction( $transaction );
    }

    // Throws Exception //
    public function addAccountingEntry( $transaction, $account,
                                          $type, $amount,
                                          $trackingId = null, $description = null )
    {
        // Getting the objects
        $transaction = $this->getTransaction( $transaction );
        $account     = $this->getAccount( $account );

        // Generating the entry
        $entryClass = $this->transactionManager->getEntryClass();
        $entry = new $entryClass();
        $entry->setAccount( $account );
        $entry->setTransactionType( $type );
        $entry->setAmount( $amount );
        if ( $trackingId ) $entry->setTrackingId( $trackingId );
        if ( $description ) $entry->setDescription( $description );

        // Adding Entry
        $transaction->addAcountingEntry( $entry );
        $this->transactionManager->updateTransaction( $transaction );

        return $transaction;
    }

    public function checkTransactions()
    {
        return $this->transactionManager->checkTransactions();
    }

    public function getSystemAccount( $account )
    {
        return $this->accountManager->findSystemAccount( $account );
    }

    public function getTransaction( $transaction )
    {
        if ( is_string($transaction) ) {
            $ntransaction = $this->transactionManager->findTransactionById( $transaction );

            if (! $ntransaction) {
                $ntransaction = $this->transactionManager->findTransactionByReference( $transaction );
            }

            if (! $ntransaction) {
                throw new \Exception( 'Transaction ' . $transaction . ' not found' );
            }

            return $ntransaction;
        }

        return $transaction;
    }

    public function getAccount( $account )
    {
        if ( is_string($account) ) {
            $naccount = $this->accountManager->findAccountById( $account );
            if (! $naccount) {
                throw new \Exception( 'Account ' . $account . ' not found' );
            }

            return $naccount;
        }

        return $account;
    }
}

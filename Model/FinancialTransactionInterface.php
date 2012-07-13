<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\ExtendedDataInterface;

interface FinancialTransactionInterface
{
    const STATE_CANCELED = 100;
    const STATE_FAILED   = 200;
    const STATE_NEW      = 300;
    const STATE_PENDING  = 400;
    const STATE_SUCCESS  = 500;

    function getId();
    function incrementUpdatedAt();
    function isOpen();
    function getState();
    function setState($state);
    function getReference();
    function setReference($reference);
    function getCreatedAt();
    function getUpdatedAt();
    function getAccountingEntries();
    function setAccountingEntries($accountingEntries);
    function addAcountingEntry( $accountingEntry );
    function getExtendedData();
    // function setExtendedData( ExtendedDataInterface $extendedData );
    function setExtendedData( $extendedData );
}
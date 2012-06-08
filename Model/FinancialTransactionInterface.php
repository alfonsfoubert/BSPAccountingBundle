<?php

namespace BSP\AccountingBundle\Model;

use BSP\AccountingBundle\Model\ExtendedDataInterface;

interface FinancialTransactionInterface
{
    const STATE_CANCELED = 1;
    const STATE_FAILED   = 2;
    const STATE_NEW      = 3;
    const STATE_PENDING  = 4;
    const STATE_SUCCESS  = 5;

    function getId();
    function setCreatedAt();
    function incrementUpdatedAt();
    function getState();
    function setState($state);
    function getReferenceNumber();
    function setReferenceNumber($referenceNumber);
    function getCreatedAt();
    function getUpdatedAt();
    function getAccountingEntries();
    function setAccountingEntries($accountingEntries);
    function addAcountingEntry( $accountingEntry );
    function getExtendedData();
    function setExtendedData( ExtendedDataInterface $extendedData );
}
<?php

namespace BSP\AccountingBundle\Model;

interface AccountingEntryInterface
{
    const TRANSACTION_TYPE_APPROVE             = 100;
    const TRANSACTION_TYPE_APPROVE_AND_DEPOSIT = 200;
    const TRANSACTION_TYPE_CREDIT              = 300;
    const TRANSACTION_TYPE_DEPOSIT             = 400;
    const TRANSACTION_TYPE_REVERSE_APPROVAL    = 500;
    const TRANSACTION_TYPE_REVERSE_CREDIT      = 600;
    const TRANSACTION_TYPE_REVERSE_DEPOSIT     = 700;

    public function getTransactionType();
    public function setTransactionType($transactionType);
    public function setCreatedAt();
    public function getAccount();
    public function setAccount($account);
    public function getAmount();
    public function setAmount($amount);
    public function getDescription();
    public function setDescription($description);
    public function getTrackingId();
    public function setTrackingId($trackingId);
    public function getCreatedAt();
}

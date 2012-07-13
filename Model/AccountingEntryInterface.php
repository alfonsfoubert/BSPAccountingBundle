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
	
	function getTransactionType();
	function setTransactionType($transactionType);
	function setCreatedAt();
	function getAccount();
	function setAccount($account);
	function getAmount();
	function setAmount($amount);
	function getDescription();
	function setDescription($description);
	function getTrackingId();
	function setTrackingId($trackingId);
	function getCreatedAt();
}
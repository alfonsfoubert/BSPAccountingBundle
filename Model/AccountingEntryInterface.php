<?php

namespace BSP\AccountingBundle\Model;

interface AccountingEntryInterface
{
	const TRANSACTION_TYPE_APPROVE             = 1;
	const TRANSACTION_TYPE_APPROVE_AND_DEPOSIT = 2;
	const TRANSACTION_TYPE_CREDIT              = 3;
	const TRANSACTION_TYPE_DEPOSIT             = 4;
	const TRANSACTION_TYPE_REVERSE_APPROVAL    = 5;
	const TRANSACTION_TYPE_REVERSE_CREDIT      = 6;
	const TRANSACTION_TYPE_REVERSE_DEPOSIT     = 7;
	
	function getTransactionType();
	function setTransactionType($transactionType);
	function setCreatedAt();
	function getAccount();
	function setAccount($account);
	function getAmount();
	function setAmount($amount);
	function getUnits();
	function setUnits($units);
	function getDescription();
	function setDescription($description);
	function getTrackingId();
	function setTrackingId($trackingId);
	function getCreatedAt();
}
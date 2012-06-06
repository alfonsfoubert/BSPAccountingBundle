<?php

namespace BSP\AccountingBundle\Model;

interface AccountInterface
{
	const ACCOUNT_STATUS_PENDING  = 1;
	const ACCOUNT_STATUS_ACTIVE   = 2;
	const ACCOUNT_STATUS_CANCELED = 3;
	const ACCOUNT_STATUS_BLOCKED  = 4;
	
	function getId();
	function getName();
	function getStatus();
	function setId($id);
	function setName($name);
	function setStatus($status);
	function setCreatedAt();
	function getCreatedAt();
}
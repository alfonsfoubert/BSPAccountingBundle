<?php

namespace BSP\AccountingBundle\Model;

interface AccountInterface
{
	const ACCOUNT_STATUS_PENDING  = 100;
	const ACCOUNT_STATUS_ACTIVE   = 200;
	const ACCOUNT_STATUS_CANCELED = 300;
	const ACCOUNT_STATUS_BLOCKED  = 400;
	
	function getId();
	function getName();
	function getStatus();
	function setId($id);
	function setName($name);
	function setStatus($status);
	function setCreatedAt();
	function getCreatedAt();
}
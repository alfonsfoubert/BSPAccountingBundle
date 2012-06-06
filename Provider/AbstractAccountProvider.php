<?php

namespace BSP\AccountingBundle\Provider;

use BSP\AccountingBundle\Provider\AccountProviderInterface;
use BSP\AccountingBundle\Handler\AccountHandlerInterface;

abstract class AbstractAccountProvider implements AccountProviderInterface
{
	protected $handlers;
	
	function addAccountHandler(AccountHandlerInterface $handler)
	{
		$type = $handler->getType();
		if (isset($this->handlers[$type]))
		{
			throw new \Exception("Account Handler '$type' duplicated");
		}
		$this->handlers[$type] = $handler;
	}
	
	protected function getAccountHandler($type)
	{
		if (!isset($this->handlers[$type])) {
			throw new \Exception("Account Handler '$type' does not exists");
		}
		return $this->handlers[$type];
	}
}
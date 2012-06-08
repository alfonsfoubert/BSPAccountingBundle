<?php

namespace BSP\AccountingBundle\Provider;

use BSP\AccountingBundle\Handler\AccountHandlerInterface;

interface AccountProviderInterface
{
	function addAccountHandler(AccountHandlerInterface $handler);
	function listAccountHandlers();
}
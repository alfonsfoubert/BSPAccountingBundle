<?php

namespace BSP\AccountingBundle\Provider;

use BSP\AccountingBundle\Handler\AccountHandlerInterface;

interface AccountProviderInterface
{
    public function addAccountHandler(AccountHandlerInterface $handler);
    public function listAccountHandlers();
}

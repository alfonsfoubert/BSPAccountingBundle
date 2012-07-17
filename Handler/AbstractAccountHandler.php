<?php

namespace BSP\AccountingBundle\Handler;

use BSP\AccountingBundle\Handler\AccountHandlerInterface;

abstract class AbstractAccountHandler implements AccountHandlerInterface
{
    public function generateId( array $options = null )
    {
        throw new \Exception("Sorry generateId() doesn't have default functionality in place");
    }
}

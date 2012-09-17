<?php

namespace BSP\AccountingBundle\Handler;

interface AccountHandlerInterface
{
    public function getType();
    public function generateId( array $options = null );
}

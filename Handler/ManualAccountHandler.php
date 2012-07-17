<?php

namespace BSP\AccountingBundle\Handler;

use BSP\AccountingBundle\Handler\AbstractAccountHandler;

class ManualAccountHandler extends AbstractAccountHandler
{
    public function generateId( array $options = null )
    {
        if ($options === null) {
            throw new \Exception( 'You need to specify the account ID' );
        }

        return isset( $options['id'] )? $options['id'] : array_pop($options);
    }

    public function getType()
    {
        return 'manual';
    }
}

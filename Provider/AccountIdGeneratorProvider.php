<?php

namespace BSP\AccountingBundle\Provider;

use BSP\AccountingBundle\Provider\AbstractAccountProvider;

class AccountIdGeneratorProvider extends AbstractAccountProvider
{	
	public function generateId( $type = 'default', array $options = null )
	{
		$handler =  $this->getAccountHandler( $type );
		return $handler->generateId( $options );
	}
}
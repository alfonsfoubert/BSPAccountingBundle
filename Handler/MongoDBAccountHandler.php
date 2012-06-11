<?php

namespace BSP\AccountingBundle\Handler;

use BSP\AccountingBundle\Handler\AbstractAccountHandler;

class MongoDBAccountHandler extends AbstractAccountHandler
{
	public function generateId( array $options = null )
	{
		return (string) new \MongoId();
	}
	
	public function getType()
	{
		return 'mongodb';
	}
}
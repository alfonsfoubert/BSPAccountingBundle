<?php

namespace BSP\AccountingBundle\Document;

use BSP\AccountingBundle\Model\FinancialTransactionManager as AbstractFinancialTransacionManager;

class FinancialTransacionMaager extends AbstractFinancialTransacionManager
{
	private function setType()
	{
		Doctrine\ODM\MongoDB\Mapping\Types\Type::$typesMap['EncryptedData'] = 'BSP\AccountingBundle\Type\ExtendedDataType';
	}
	
	public function construct()
	{
		$this->setType();
	}
}
<?php

namespace BSP\AccountingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ODM\MongoDB\Mapping\Types\Type;
use BSP\AccountingBundle\DependencyInjection\Compiler\AccountHandlerFactoryPass;
use BSP\AccountingBundle\Type\ExtendedDataType;

class BSPAccountingBundle extends Bundle
{
	public function boot()
	{
		if (false === Type::hasType(ExtendedDataType::NAME)) {
			ExtendedDataType::setEncryptionService($this->container->get('bsp_accounting.encryption_service'));
			Type::addType(ExtendedDataType::NAME, 'BSP\AccountingBundle\Type\ExtendedDataType');
		}
	}
	
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		
		$container->addCompilerPass(new AccountHandlerFactoryPass());
	}
}

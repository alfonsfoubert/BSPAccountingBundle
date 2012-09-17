<?php

namespace BSP\AccountingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AccountHandlerFactoryPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $factory = $container->getDefinition('bsp_accounting.id_generator_provider');
        foreach ($container->findTaggedServiceIds('bsp_accounting.account_handler') as $id => $attr) {
            $factory->addMethodCall('addAccountHandler', array(new Reference($id)));
        }
    }
}

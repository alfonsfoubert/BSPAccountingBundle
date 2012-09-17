<?php

namespace BSP\AccountingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use BSP\AccountingBundle\DependencyInjection\Compiler\AccountHandlerFactoryPass;

class BSPAccountingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AccountHandlerFactoryPass());
    }
}

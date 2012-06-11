<?php

namespace BSP\AccountingBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BSPAccountingExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load(sprintf('%s.yml', $config['db_driver']));
        $loader->load('services.yml');
        
        if (isset($config['secret'])) {
        	$container->setParameter('bsp_accounting.encryption_service.secret', $config['secret']);
        }
        
        $this->setTypes( $config, $container );
        
        if (isset($config['account'])) {
        	$this->configureAccount($config['account'], $container);
        }
    }
    
    protected function configureAccount(array $config, ContainerBuilder $container)
    {
        if (isset($config['account'])) {
            $container->setParameter('bsp_accounting.account.class', $config['class']);
        }
    }
    
    protected function setTypes( $config, $container )
    {
    	if ($config['db_driver'] == 'mongodb')
    	{
	    	if (false === \Doctrine\ODM\MongoDB\Mapping\Types\Type::hasType(\BSP\AccountingBundle\Type\MongoDB\ExtendedDataType::NAME)) {
	    		\BSP\AccountingBundle\Type\MongoDB\ExtendedDataType::setEncryptionService($container->get('bsp_accounting.encryption_service'));
	    		\Doctrine\ODM\MongoDB\Mapping\Types\Type::addType(\BSP\AccountingBundle\Type\MongoDB\ExtendedDataType::NAME, 'BSP\AccountingBundle\Type\MongoDB\ExtendedDataType');
	    	}    		
    	}
    }
}

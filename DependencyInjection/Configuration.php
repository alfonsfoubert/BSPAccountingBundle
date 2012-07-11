<?php

namespace BSP\AccountingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('bsp_accounting');

        $rootNode
	        ->children()
	        	->scalarNode('db_driver')
	        		->validate()
						->ifNotInArray(array('mongodb'))
						->thenInvalid('The %s driver is not supported')
					->end()
				->end()
				->scalarNode('secret')->isRequired()->cannotBeEmpty()->end()
				->scalarNode('system_accounts')->end()
        	->end();
        
        $this->addAccountSection($rootNode);

        return $treeBuilder;
    }
    
    private function addAccountSection(ArrayNodeDefinition $node)
    {
    	$node
    		->children()
    			->arrayNode('account')
    				->children()
    					->scalarNode('class')->end()
    				->end()
    			->end()
    		->end()
    	;
    }
}

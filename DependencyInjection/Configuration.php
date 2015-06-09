<?php

namespace FDevs\CatalogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
        $rootNode = $treeBuilder->root('f_devs_catalog');

        $supportedDrivers = ['mongodb'];
        $supportedAdmins = ['sonata', 'none'];

        $rootNode
            ->children()
                ->scalarNode('admin_driver')
                    ->defaultValue('sonata')
                    ->validate()
                    ->ifNotInArray($supportedAdmins)
                    ->thenInvalid('The admins bundle %s is not supported. Please choose one of '.json_encode($supportedAdmins))
                    ->end()
                ->end()
                ->scalarNode('db_driver')
                    ->defaultValue('mongodb')
                    ->validate()
                    ->ifNotInArray($supportedDrivers)
                    ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                ->end()
                ->arrayNode('item_types')
                    ->defaultValue(['base' => 'base'])
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('base_sort')
                    ->defaultValue([])
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('template')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('list')->defaultValue('FDevsCatalogBundle:Default:list.html.twig')->end()
                        ->scalarNode('item')->defaultValue('FDevsCatalogBundle:Default:item.html.twig')->end()
                    ->end()
                ->end()
                ->scalarNode('data_class')->defaultValue('FDevs\CatalogBundle\Model\Item')->end()
                ->scalarNode('item_form')->defaultValue('fdevs_catalog_item')->end()
            ->end();

        return $treeBuilder;
    }
}

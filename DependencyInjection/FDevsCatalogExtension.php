<?php

namespace FDevs\CatalogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class FDevsCatalogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias().'.base_sort', $config['base_sort']);
        $container->setParameter($this->getAlias().'.backend_type_'.$config['db_driver'], true);
        $container->setParameter($this->getAlias().'.manager_name', null);
        $container->setParameter($this->getAlias().'.item_types', $config['item_types']);
        $container->setParameter($this->getAlias().'.data_class', $config['data_class']);
        $container->setParameter($this->getAlias().'.template.list', $config['template']['list']);
        $container->setParameter($this->getAlias().'.template.item', $config['template']['item']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $loader->load(sprintf('%s.xml', $config['db_driver']));
        if ($config['admin_driver'] !== 'none') {
            $loader->load(sprintf('admin/%s.xml', $config['admin_driver']));
        }
    }
}

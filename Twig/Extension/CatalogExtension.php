<?php

namespace FDevs\CatalogBundle\Twig\Extension;

use FDevs\CatalogBundle\Service\CatalogManager;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatalogExtension extends \Twig_Extension
{
    /** @var string */
    private $templateList;
    /** @var string */
    private $templateItem;
    /** @var \FDevs\CatalogBundle\Service\CatalogManager */
    private $manager;

    /**
     * init.
     *
     * @param string         $templateItem
     * @param string         $templateList
     * @param CatalogManager $manager
     */
    public function __construct($templateItem, $templateList, CatalogManager $manager)
    {
        $this->templateItem = $templateItem;
        $this->templateList = $templateList;
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fdevs_catalog';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'catalog_list',
                [$this, 'catalogFunction'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
            new \Twig_SimpleFunction(
                'catalog_item',
                [$this, 'itemFunction'],
                ['is_safe' => ['html'], 'needs_environment' => true]
            ),
        ];
    }

    public function catalogFunction(\Twig_Environment $env, $type, array $options = [])
    {
        $data = $this->setOptions($options);
        $data['list'] = $this->manager->getList($type);

        return $env->render($data['tpl_list'], $data);
    }

    public function itemFunction(\Twig_Environment $env, $id, array $options = [])
    {
        $data = $this->setOptions($options);
        $data['item'] = $this->manager->getItem($id);

        return $env->render($data['tpl_item'], $data);
    }

    private function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setOptional(['tpl_list', 'tpl_item'])
            ->setDefaults(
                [
                    'tpl_list' => $this->templateList,
                    'tpl_item' => $this->templateItem,
                ]
            )
            ->setAllowedTypes(['tpl_list' => 'string', 'tpl_item' => 'string']);
    }

    private function setOptions(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        $options = $resolver->resolve($options);

        return $options;
    }
}

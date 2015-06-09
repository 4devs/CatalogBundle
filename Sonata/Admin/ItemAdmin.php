<?php

namespace FDevs\CatalogBundle\Sonata\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ItemAdmin extends Admin
{
    /** @var string */
    private $typeItem = 'fdevs_catalog_item';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.group_item')
            ->add('item', $this->typeItem, ['label' => false])
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('type')
            ->add('tags');
    }

    /**
     * set type item
     *
     * @param string $typeItem
     *
     * @return self
     */
    public function setTypeItem($typeItem)
    {
        $this->typeItem = $typeItem;

        return $this;
    }
}

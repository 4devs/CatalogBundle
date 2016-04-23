<?php

namespace FDevs\CatalogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class DocumentModelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fdevs_catalog_model';
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'document';
    }
}

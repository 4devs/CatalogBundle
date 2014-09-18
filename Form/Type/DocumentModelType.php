<?php

namespace FDevs\CatalogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class DocumentModelType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_catalog_model';
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'document';
    }

}

<?php

namespace FDevs\CatalogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    /** @var array */
    private $itemTypes = [];

    /** @var string */
    private $dataClass;

    /** @var string */
    private $tagClass = 'FDevs\Tag\Model\Tag';

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'image',
                'fdevs_image',
                ['filesystem' => 'catalog', 'validation_options' => ['max_file_size' => 1000]]
            )
            ->add('url', 'url', ['required' => false])
            ->add('type', 'choice', ['choices' => $options['item_types']])
            ->add('tags', 'fdevs_catalog_model', ['multiple' => true, 'class' => $options['tag_class']])
            ->add('description', 'trans_textarea', ['label' => 'form.description']);
    }


    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefined(['item_types', 'tag_class'])
            ->setDefaults(
                [
                    'tag_class'    => $this->tagClass,
                    'item_types'   => $this->itemTypes,
                    'inherit_data' => true,
                    'data_class'   => $this->dataClass
                ]
            )
            ->setAllowedTypes(['item_types' => 'array', 'tag_class' => 'string']);
    }

    /**
     * set Tags
     *
     * @param array $itemTypes
     *
     * @return $this
     */
    public function setItemTypes(array $itemTypes = [])
    {
        $this->itemTypes = $itemTypes;

        return $this;
    }

    /**
     * @param string $dataClass
     *
     * @return $this
     */
    public function setDataClass($dataClass)
    {
        $this->dataClass = $dataClass;

        return $this;
    }

    /**
     * @param string $tagClass
     *
     * @return $this
     */
    public function setTagClass($tagClass)
    {
        if ($tagClass) {
            $this->tagClass = $tagClass;
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_catalog_item';
    }

}

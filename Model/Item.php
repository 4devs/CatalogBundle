<?php

namespace FDevs\CatalogBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use FDevs\PageBundle\Model\Page;
use FDevs\Tag\TagInterface;
use FDevs\Locale\Model\LocaleText;
use Doctrine\Common\Collections\Collection;

class Item extends Page
{

    /**
     * @var \MongoId $id
     */
    protected $id;

    /**
     * @var string $image
     */
    protected $image;

    /**
     * @var array|Collection|TagInterface[]
     */
    protected $tags = [];

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var array|Collection|LocaleText[]
     */
    protected $description;

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new \DateTime();
        $this->tags = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add tag
     *
     * @param TagInterface $tag
     */
    public function addTag(TagInterface $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Remove tag
     *
     * @param TagInterface $tag
     */
    public function removeTag(TagInterface $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return array|Collection|TagInterface $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array|Collection|\FDevs\Locale\Model\LocaleText[]
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param array|Collection|\FDevs\Locale\Model\LocaleText[] $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}

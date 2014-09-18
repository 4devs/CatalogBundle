<?php

namespace FDevs\CatalogBundle\Model;

use FDevs\PageBundle\Model\Page;

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
     * @var \FDevs\TagBundle\Model\Tag
     */
    protected $tags = array();

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $url
     */
    protected $url;

    public function __construct()
    {
        parent::__construct();
        $this->createdAt = new \DateTime();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param \FDevs\TagBundle\Model\Tag $tag
     */
    public function addTag(\FDevs\TagBundle\Model\Tag $tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * Remove tag
     *
     * @param \FDevs\TagBundle\Model\Tag $tag
     */
    public function removeTag(\FDevs\TagBundle\Model\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection $tags
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
}

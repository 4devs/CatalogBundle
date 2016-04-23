<?php

namespace FDevs\CatalogBundle\Service;

use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use FDevs\CatalogBundle\Exception\NotFoundException;

class CatalogManager
{
    /** @var array */
    private $types = [];

    /** @var \Doctrine\Common\Persistence\ManagerRegistry */
    private $managerRegistry;

    /** @var string */
    private $class;

    /** @var array */
    private $baseOrder = [];

    /**
     * init.
     *
     * @param ManagerRegistry $managerRegistry
     * @param string          $class
     * @param array           $types
     * @param array           $baseOrderBy
     */
    public function __construct(ManagerRegistry $managerRegistry, $class, array $types = [], array $baseOrderBy = [])
    {
        $this->types = $types;
        $this->managerRegistry = $managerRegistry;
        $this->class = $class;
        $this->baseOrder = $baseOrderBy;
    }

    /**
     * get list items by type.
     *
     * @param string     $type
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array
     */
    public function getList($type, array $orderBy = null, $limit = null, $offset = null)
    {
        if (!isset($this->types[$type])) {
            throw new NotFoundException(sprintf('type "%s" not found', $type));
        }
        $orderBy = $orderBy ?: $this->baseOrder;

        return $this->getRepository()->findBy(['type' => $type], $orderBy, $limit, $offset);
    }

    /**
     * get Item by Id.
     *
     * @param string $id
     *
     * @return \FDevs\CatalogBundle\Model\Item
     */
    public function getItem($id)
    {
        $item = $this->getRepository()->find($id);
        if (!$item) {
            throw new NotFoundException(sprintf('item with id "%s" not found', $id));
        }

        return $item;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function getRepository()
    {
        return $this->managerRegistry->getManager()->getRepository($this->class);
    }
}

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

    public function __construct(ManagerRegistry $managerRegistry, $class, array $types = [])
    {
        $this->types = $types;
        $this->managerRegistry = $managerRegistry;
        $this->class = $class;
    }

    public function getList($type)
    {
        if (!isset($this->types[$type])) {
            throw new NotFoundException(sprintf('type "%s" not found', $type));
        }

        return $this->getRepository()->findBy(['type' => $type]);

    }

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

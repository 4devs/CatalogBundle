<?php

namespace FDevs\CatalogBundle\Controller;

use FDevs\CatalogBundle\Exception\NotFoundException;
use FDevs\CatalogBundle\Model\Item;
use FDevs\CatalogBundle\Service\CatalogManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;
    /** @var string */
    private $templateList;
    /** @var string */
    private $templateItem;
    /** @var \FDevs\CatalogBundle\Service\CatalogManager */
    private $manager;

    public function __construct(
        EngineInterface $templating,
        CatalogManager $manager,
        $templateItem,
        $templateList
    ) {
        $this->templating = $templating;
        $this->templateItem = $templateItem;
        $this->templateList = $templateList;
        $this->manager = $manager;
    }

    public function listAction($type)
    {
        try {
            $list = $this->manager->getList($type);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->templating->renderResponse(
            $this->templateList,
            ['list' => $list, 'tpl_item' => $this->templateItem]
        );
    }

    public function itemAction($id)
    {
        try {
            $item = $this->manager->getItem($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->templating->renderResponse($this->templateItem, ['item' => $item]);
    }

    /**
     * @param string $templateItem
     *
     * @return $this
     */
    public function setTemplateItem($templateItem)
    {
        $this->templateItem = $templateItem;

        return $this;
    }

    /**
     * @param string $templateList
     *
     * @return $this
     */
    public function setTemplateList($templateList)
    {
        $this->templateList = $templateList;

        return $this;
    }

}

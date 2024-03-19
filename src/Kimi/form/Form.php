<?php

namespace Kimi\form;

use Closure;
use Kimi\form\lib\CustomForm;
use Kimi\form\lib\MenuForm;
use Kimi\form\lib\ModalForm;
use Kimi\exception\ContentException;
use Kimi\form\content\Content;
use Kimi\form\content\custom\CustomContentInterface;
use Kimi\form\content\menu\MenuContentInterface;
use Kimi\form\content\modal\ModalContentInterface;
use Kimi\model\Model;

/**
 * Class Form implements the form with Content elements for Model,
 */
class Form
{
    protected Content $content;
    protected Model $model;

    /**
     * @param Content $content
     * @param Model $model
     */
    public function __construct(Content $content, Model $model)
    {
        $this->content = $content;
        $this->model   = $model;
    }


    /**
     * @return Closure|null
     */
    protected function onClose(): ?Closure
    {
        return null;
    }


    /**
     * @return Closure
     */
    protected function onSubmit(): Closure
    {
        return $this->getModel()->processResponse();
    }


    /**
     * @return Content
     */
    public function getContent(): Content
    {
        return $this->content;
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }


    /**
     * @return CustomForm
     * @throws ContentException
     */
    public function newCustom(): CustomForm
    {
        $content = $this->getContent();

        if (!$content instanceof CustomContentInterface) {
            throw new ContentException('content is not for custom form');
        }

        return new CustomForm(
            $content->getTitle(),
            $content->getElements(),
            $this->onSubmit(),
            $this->onClose()
        );
    }


    /**
     * @return MenuForm
     * @throws ContentException
     */
    public function newMenu(): MenuForm
    {
        $content = $this->getContent();

        if (!$content instanceof MenuContentInterface) {
            throw new ContentException('content is not for menu form');
        }

        return new MenuForm(
            $content->getTitle(),
            $content->getName(),
            $content->getList(),
            $this->onSubmit(),
            $this->onClose()
        );
    }


    /**
     * @return ModalForm
     * @throws ContentException
     */
    public function newModal(): ModalForm
    {
        $content = $this->getContent();

        if (!$content instanceof ModalContentInterface) {
            throw new ContentException('content is not for modal form');
        }

        return new ModalForm(
            $content->getTitle(),
            $content->getLabel(),
            $this->onSubmit(),
        );
    }
}

<?php

namespace Rudolf\Component\Plugins;

use Rudolf\Component\Hooks\Filter;
use Rudolf\Component\Html\Foot;
use Rudolf\Component\Html\Head;

class DomPlugins
{
    /**
     * @var Head
     */
    private $head;

    /**
     * @var Foot
     */
    private $foot;

    /**
     * DomPlugins constructor.
     *
     * @param Head $head
     * @param Foot $foot
     */
    public function __construct(Head $head, Foot $foot)
    {
        $this->head = $head;
        $this->foot = $foot;
    }

    public function front()
    {
        if (Filter::isHas('head_stylesheets')) {
            $head_stylesheets = Filter::apply('head_stylesheets', $this->head->getStylesheetsArray());
            $this->head->setStylesheetsArray($head_stylesheets);
        }

        if (Filter::isHas('head_scripts')) {
            $head_scripts = Filter::apply('head_scripts', $this->head->getScriptsArray());
            $this->head->setScriptsArray($head_scripts);
        }

        if (Filter::isHas('foot_scripts')) {
            $foot_scripts = Filter::apply('foot_scripts', $this->foot->getScriptsArray());
            $this->foot->setScriptsArray($foot_scripts);
        }

        if (Filter::isHas('head_before')) {
            $head_before = Filter::apply('head_before', $this->head->getBeforeArray());
            $this->head->setBeforeArray($head_before);
        }

        if (Filter::isHas('head_after')) {
            $head_after = Filter::apply('head_after', $this->head->getAfterArray());
            $this->head->setAfterArray($head_after);
        }

        if (Filter::isHas('foot_before')) {
            $foot_before = Filter::apply('foot_before', $this->foot->getBeforeArray());
            $this->foot->setBeforeArray($foot_before);
        }

        if (Filter::isHas('foot_after')) {
            $foot_after = Filter::apply('foot_after', $this->foot->getAfterArray());
            $this->foot->setAfterArray($foot_after);
        }
    }

    public function admin()
    {
        if (Filter::isHas('admin_head_stylesheets')) {
            $head_stylesheets = Filter::apply('admin_head_stylesheets', $this->head->getStylesheetsArray());
            $this->head->setStylesheetsArray($head_stylesheets);
        }

        if (Filter::isHas('admin_head_scripts')) {
            $head_scripts = Filter::apply('admin_head_scripts', $this->head->getScriptsArray());
            $this->head->setScriptsArray($head_scripts);
        }

        if (Filter::isHas('admin_foot_scripts')) {
            $foot_scripts = Filter::apply('admin_foot_scripts', $this->foot->getScriptsArray());
            $this->foot->setScriptsArray($foot_scripts);
        }

        if (Filter::isHas('admin_head_before')) {
            $head_before = Filter::apply('admin_head_before', $this->head->getBeforeArray());
            $this->head->setBeforeArray($head_before);
        }

        if (Filter::isHas('admin_head_after')) {
            $head_after = Filter::apply('admin_head_after', $this->head->getAfterArray());
            $this->head->setAfterArray($head_after);
        }

        if (Filter::isHas('admin_foot_before')) {
            $foot_before = Filter::apply('admin_foot_before', $this->foot->getBeforeArray());
            $this->foot->setBeforeArray($foot_before);
        }

        if (Filter::isHas('admin_foot_after')) {
            $foot_after = Filter::apply('admin_foot_after', $this->foot->getAfterArray());
            $this->foot->setAfterArray($foot_after);
        }
    }
}

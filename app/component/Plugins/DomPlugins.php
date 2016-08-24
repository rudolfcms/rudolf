<?php

namespace Rudolf\Component\Plugins;

use Rudolf\Component\Hooks\Filter;

class DomPlugins
{
    public function __construct($head, $foot)
    {
        if (Filter::isHas('head_stylesheets')) {
            $head_stylesheets = Filter::apply('head_stylesheets', $head->getStylesheetsArray());
            $head->setStylesheetsArray($head_stylesheets);
        }

        if (Filter::isHas('head_scripts')) {
            $head_scripts = Filter::apply('head_scripts', $head->getScriptsArray());
            $head->setScriptsArray($head_scripts);
        }

        if (Filter::isHas('foot_scripts')) {
            $foot_scripts = Filter::apply('foot_scripts', $foot->getScriptsArray());
            $foot->setScriptsArray($foot_scripts);
        }

        if (Filter::isHas('head_before')) {
            $head_before = Filter::apply('head_before', $head->getBeforeArray());
            $head->setBeforeArray($head_before);
        }

        if (Filter::isHas('head_after')) {
            $head_after = Filter::apply('head_after', $head->getAfterArray());
            $head->setAfterArray($head_after);
        }

        if (Filter::isHas('foot_before')) {
            $foot_before = Filter::apply('foot_before', $foot->getBeforeArray());
            $foot->setBeforeArray($foot_before);
        }

        if (Filter::isHas('foot_after')) {
            $foot_after = Filter::apply('foot_after', $foot->getAfterArray());
            $foot->setAfterArray($foot_after);
        }
    }
}

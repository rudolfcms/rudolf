<?php

namespace Rudolf\Modules\Dashboard;

use Rudolf\Component\Helpers\Navigation\MenuItem;
use Rudolf\Framework\View\AdminView;

class View extends AdminView
{
    public function dashboard()
    {
        $this->pageTitle = _('Dashboard');
        $this->head->setTitle($this->pageTitle);

        $this->template = 'dashboard';
    }

    public function getMenuCollection()
    {
        $items = array_filter($this->getMenuItems()->getAll(), function($a) {
            /** @var MenuItem $a */
            return 0 === $a->getParentId() && 'main' === $a->getType();
        });

        usort($items, function($a, $b) {
            /** @var MenuItem $a */
            /** @var MenuItem $b */
            return $a->getPosition() > $b->getPosition();
        });

        return $items;
    }
}

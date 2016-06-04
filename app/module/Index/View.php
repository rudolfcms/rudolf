<?php
namespace Rudolf\Modules\Index;

use Rudolf\Modules\Articles\Roll\View as ArticlesView;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;

class View extends ArticlesView
{
    public function setData($data, Pagination $pagination)
    {
        $this->rollView($data, $pagination);

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();

        if (1 !== $page) {
            $this->head->setTitle(sprintf(_('Page %1$s of %2$s'), $page, $allPages));
        }

        $this->template = 'index';
    }
}

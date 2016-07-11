<?php
namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Modules\A_front\FView;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;

class View extends FView
{
    public function setData($data, $pagination, $info = false)
    {
        $this->loop = new Loop($data, $pagination,
            'Rudolf\\Modules\\Albums\\One\\Album',
            '/albums/kategorie/' . $info['slug']
        );
        
        $this->categoryInfo = $info;

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();

        $titleBefore = null;

        if (1 !== $page) {
            $titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages) .' ';
        }

        $this->head->setTitle($titleBefore . $this->categoryTitle(true));

        $this->template = 'albums-category';
    }

    /**
     * Returns category title
     * 
     * @param bool $strip
     * 
     * @return string
     */
    public function categoryTitle($strip = false)
    {
        $title = _('Albumy z kategorii') . ' <i>' . $this->categoryInfo['title'] . '</i>';

        if (true === $strip) {
            return strip_tags($title);
        }

        return $title;
    }

    /**
     * Returns category description
     * 
     * @return string
     */
    public function categoryDescription()
    {
        return $this->categoryInfo['description'];
    }
}

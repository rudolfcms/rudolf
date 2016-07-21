<?php

namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Helpers\Pagination\TagsGenerator;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    public function setData($data, $pagination, $info = false)
    {
        $path = '/albums/kategorie/'.$info['slug'];
        $this->loop = new Loop($data, $pagination,
            'Rudolf\\Modules\\Albums\\One\\Album',
            $path
        );

        $tags = new TagsGenerator($pagination, $this->head);
        $tags->setPath($path);
        $tags->create();

        $this->categoryInfo = $info;

        $page = $pagination->getPageNumber();
        $allPages = $pagination->getAllPages();

        $titleBefore = null;

        if (1 !== $page) {
            $titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages).' &ndash; ';
        }

        $this->head->setTitle($titleBefore.$this->categoryTitle(true));

        $this->template = 'albums-category';
    }

    /**
     * Returns category title.
     * 
     * @param bool $strip
     * 
     * @return string
     */
    public function categoryTitle($strip = false)
    {
        $title = _('Albums from category').' <i>'.$this->categoryInfo['title'].'</i>';

        if (true === $strip) {
            return strip_tags($title);
        }

        return $title;
    }

    /**
     * Returns category description.
     * 
     * @return string
     */
    public function categoryDescription()
    {
        return $this->categoryInfo['description'];
    }
}

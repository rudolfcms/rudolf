<?php

namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Helpers\Pagination\TagsGenerator;
use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    /**
     * @var Loop
     */
    protected $loop;

    /**
     * @var array
     */
    protected $categoryInfo;

    /**
     * @param array $data
     * @param Pagination $pagination
     * @param array $info
     */
    public function setData(array $data, Pagination $pagination, $info = [])
    {
        $path = '/foto/kategorie/'.$info['slug'];
        $this->loop = new Loop(
            $data,
            $pagination,
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
        $pageInfo = null;

        if (1 !== $page) {
            $titleBefore = sprintf(_('Page %1$s of %2$s'), $page, $allPages).' &ndash; ';
            $pageInfo = '/page/'.$page;
        }

        $this->head->setTitle($titleBefore.$this->categoryTitle(true));
        $this->head->setCanonical(DIR.$path.$pageInfo);

        $this->template = 'albums-category';
    }

    /**
     * Returns category title.
     *
     * @param bool $strip
     * @param bool $before
     *
     * @return string
     */
    public function categoryTitle($strip = false, $before = true)
    {
        $title = '<i>'.$this->categoryInfo['title'].'</i>';

        if (true === $strip) {
            $title = strip_tags($title);
        }

        if (true === $before) {
            $title = _('Albums from category').' '.$title;
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
        return $this->categoryInfo['content'];
    }

    /**
     * Returns if category description exist
     *
     * @return boolean
     */
    public function isCategoryDescription()
    {
        return !empty($this->categoryInfo['content']);
    }
}

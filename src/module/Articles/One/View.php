<?php

namespace Rudolf\Modules\Articles\One;

use Rudolf\Framework\View\FrontView;

class View extends FrontView
{
    /**
     * @var Article
     */
    protected $article;

    /**
     * Set articles data.
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->article = new Article($data);

        $this->head->setTitle($this->article->title());
        $this->head->setCanonical($this->article->url());

        $this->template = 'article-one';
    }
}

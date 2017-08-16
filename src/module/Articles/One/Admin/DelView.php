<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class DelView extends AdminView
{
    use CategoryAddon;

    /**
     * @var Article
     */
    protected $article;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $templateType;

    /**
     * Set data to delete article.
     *
     * @param array $article
     */
    public function delArticle(array $article)
    {
        $this->article = new Article($article);

        $this->pageTitle = _('Delete article');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->article->delUrl();

        $this->templateType = 'del';

        $this->template = 'articles-del';
    }
}

<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class DelView extends AdminView
{
    use CategoryAddon;

    /**
     * Set data to delete article.
     * 
     * @param array $article
     */
    public function delArticle($article)
    {
        $this->article = new Article($article);

        $this->pageTitle = _('Delete article');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->article->delUrl();

        $this->templateType = 'del';

        $this->template = 'articles-del';
    }
}

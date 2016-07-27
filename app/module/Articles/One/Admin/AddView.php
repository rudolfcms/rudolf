<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class AddView extends AdminView
{
    use CategoryAddon;

    /**
     * Set data do add article.
     * 
     * @param array $article
     */
    public function addArticle($article)
    {
        $this->article = new Article($article);

        $this->pageTitle = _('Add article');
        $this->head->setTitle($this->pageTitle);

        $this->path = DIR.'/admin/articles/add';

        $this->templateType = 'add';

        $this->template = 'articles-one';
    }
}

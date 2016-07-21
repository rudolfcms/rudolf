<?php

namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Framework\View\AdminView;
use Rudolf\Modules\Categories\CategoryAddon;

class View extends AdminView
{
    use CategoryAddon;

    /**
     * Set data to edit article.
     * 
     * @param array $article
     */
    public function editArticle($article)
    {
        $this->article = new Article($article);

        $this->pageTitle = _('Edit article');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->article->editUrl();

        $this->templateType = 'edit';

        $this->template = 'articles-one';
    }

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

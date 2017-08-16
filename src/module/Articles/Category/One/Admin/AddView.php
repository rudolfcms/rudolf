<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Framework\View\AdminView;

class AddView extends AdminView
{
    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $templateType;

    /**
     * @param array $category
     */
    public function add(array $category)
    {
        $this->category = new Category($category);

        $this->pageTitle = _('Add category');
        $this->head->setTitle($this->pageTitle);

        $this->path = DIR.'/admin/articles/categories/add';

        $this->templateType = 'add';

        $this->template = 'category-one';
    }
}

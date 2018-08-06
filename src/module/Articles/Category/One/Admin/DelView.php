<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Framework\View\AdminView;

class DelView extends AdminView
{
    /**
     * @var Category
     */
    protected $category;

    /**
     * @var string
     */
    protected $path;

    /**
     * Set data to delete category.
     *
     * @param array $category
     */
    public function delCategory(array $category)
    {
        $this->category = new Category($category);

        $this->pageTitle = _('Delete category');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->category->delUrl();

        $this->templateType = 'del';

        $this->template = 'categories-del';
    }
}

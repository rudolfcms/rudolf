<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Framework\View\AdminView;

class EditView extends AdminView
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
     * @param array $category
     */
    public function edit(array $category)
    {
        $this->category = new Category($category);

        $this->pageTitle = _('Edit category');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->category->editUrl();

        $this->templateType = 'edit';

        $this->template = 'category-one';
    }
}

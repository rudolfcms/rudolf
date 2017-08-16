<?php

namespace Rudolf\Modules\Albums\Category\One\Admin;

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
     * @var string
     */
    protected $templateType;

    /**
     * @param array $category
     */
    public function edit($category)
    {
        $this->category = new Category($category);

        $this->pageTitle = _('Edit category');
        $this->head->setTitle($this->pageTitle);

        $this->path = $this->category->editUrl();

        $this->templateType = 'edit';

        $this->template = 'category-one';
    }
}

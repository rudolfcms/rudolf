<?php

namespace Rudolf\Modules\Appearance\One\Admin;

use Rudolf\Framework\View\AdminView;

class EditorView extends AdminView
{
    public function editor(array $filesList, array $file)
    {
        $this->pageTitle = _('Theme editor');
        $this->head->setTitle($this->pageTitle);

        $this->filesList = $filesList;

        $this->file = $file;

        $this->template = 'appearance-editor';
    }
}

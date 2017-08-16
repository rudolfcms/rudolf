<?php

namespace Rudolf\Modules\Pages\One\Admin;

use Rudolf\Component\Forms\Form;
use Rudolf\Component\Html\Text;

class FormCheck extends Form
{
    /**
     * @var array
     */
    protected $dataValidated;

    public function check()
    {
        $data = array_merge([
            'parent_id' => 0,
            'title' => '',
            'description' => '',
            'keywords' => '',
            'content' => '',
            'slug' => '',
            'published' => '',
        ], $this->data);

        $data = array_map(function ($a) {
            return trim($a);
        }, $data);

        if (empty($data['slug'])) {
            $data['slug'] = Text::sluger($data['title']);
        } else {
            $data['slug'] = Text::sluger($data['slug']);
        }

        $data['published'] = $data['published'] ? 1 : 0;

        $this->validator
            ->checkChar('title', $data['title'], 3, 255, [
                    'short' => _('Title is too short. Min is 3 characters'),
                    'long' => _('Title is too long. Max is 255 characters'),
                ])
            ->checkEmpty('title', $data['title'], false, [
                    'empty' => _('The title does not be empty! Min 3 characters'),
                ])
            ->checkChar('description', $data['description'], 0, 255, [
                    'long' => _('Description is too long. Max is 255 characters'),
                ])
            ->checkChar('keywords', $data['keywords'], 0, 255, [
                    'long' => _('Keywords is too long. Max is 255 characters'),
                ])
            ->checkChar('slug', $data['slug'], 0, 255, [
                    'long' => _('URL is too long. Max is 255 characters'),
                ])
            ->checkIsInt('parent_id', $data['parent_id']);

        $this->dataValidated = $data;
    }
}

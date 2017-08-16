<?php

namespace Rudolf\Modules\Galleries\One\Admin;

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
            'title' => '',
            'slug' => '',
            'thumb_width' => '',
            'thumb_height' => '',
        ], $this->data);

        $data = array_map(function ($a) {
            return trim($a);
        }, $data);

        if (empty($data['slug'])) {
            $data['slug'] = Text::sluger($data['title']);
        } else {
            $data['slug'] = Text::sluger($data['slug']);
        }

        $this->validator
            ->checkChar('title', $data['title'], 3, 255, [
                    'short' => _('Title is too short. Min is 3 characters'),
                    'long' => _('Title is too long. Max is 255 characters'),
                ])
            ->checkEmpty('title', $data['title'], false, [
                    'empty' => _('The title does not be empty! Min 3 characters'),
                ])
            ->checkIsInt('thumb_width', $data['thumb_width'], [
                    'not_int' => _('The thumb width must be integer'),
                ])
            ->checkIsInt('thumb_height', $data['thumb_height'], [
                    'not_int' => _('The thumb height must be integer'),
                ]);

        $this->dataValidated = $data;
    }
}

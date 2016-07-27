<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Forms\Form;
use Rudolf\Component\Html\Text;

class FormCheck extends Form
{
    /**
     */
    public function check()
    {
        $data = array_merge([
            'title' => '',
            'date' => '',
            'content' => '',
            'slug' => '',
            'author' => '',
            'category_id' => '',
            'thumb' => '',
            'album' => '',
            'photos' => '',
            'published' => '',
        ], $this->data);

        $data = array_map(function ($a) {
            return trim($a);
        }, $data);

        if (empty($data['date'])) {
            $data['date'] = date('Y-m-d H:i:s');
        }
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
            ->checkChar('author', $data['author'], 0, 64, [
                    'long' => _('Author is too long. Max is 64 characters'),
                ])
            ->checkDatetime('date', $data['date'], 'Y-m-d H:i:s', [
                    'invalid' => _('Date is invalid. Require date in Y-m-d H:i:s format'),
                ])
            //->checkChar('content', $data['content'])
            ->checkIsInt('category_id', $data['category_id'], [
                    'not_int' => _('Category ID must be integer'),
                ])
            ->checkChar('slug', $data['slug'], 0, 255, [
                    'long' => _('URL is too long. Max is 255 characters'),
                ])
            ->checkEmpty('thumb', $data['thumb'], false, [
                    'empty' => _('The thumb address does not be empty! Min 3 characters'),
                ])
            ->checkChar('thumb', $data['thumb'], 0, 255, [
                    'long' => _('Thumb is too long. Max is 255 characters'),
                ])
            ->checkEmpty('album', $data['album'], false, [
                    'empty' => _('The album address does not be empty! Min 3 characters'),
                ])
            ->checkChar('album', $data['album'], 0, 255, [
                    'long' => _('Album is too long. Max is 255 characters'),
                ])
            ->checkIsInt('photos', $data['photos']);

        $this->dataValidated = $data;
    }
}

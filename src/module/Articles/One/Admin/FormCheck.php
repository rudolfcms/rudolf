<?php

namespace Rudolf\Modules\Articles\One\Admin;

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
            'description' => '',
            'keywords' => '',
            'date' => '',
            'content' => '',
            'slug' => '',
            'author' => '',
            'category_ID' => 0,
            'thumb' => '',
            'album' => '',
            'photos' => '',
            'homepage_hidden' => '',
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
        $data['homepage_hidden'] = $data['homepage_hidden'] ? 1 : 0;

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
            ->checkChar('author', $data['author'], 0, 64, [
                    'long' => _('Author is too long. Max is 64 characters'),
                ])
            ->checkDatetime('date', $data['date'], 'Y-m-d H:i:s', [
                    'invalid' => _('Date is invalid. Require date in Y-m-d H:i:s format'),
                ])
            //->checkChar('content', $data['content'])
            ->checkIsInt('category_ID', $data['category_ID'], [
                    'not_int' => _('Category ID must be integer'),
                ])
            ->checkChar('slug', $data['slug'], 0, 255, [
                    'long' => _('URL is too long. Max is 255 characters'),
                ])
            ->checkChar('thumb', $data['thumb'], 0, 255, [
                    'long' => _('Thumb is too long. Max is 255 characters'),
                ])
            ->checkChar('album', $data['album'], 0, 255, [
                    'long' => _('Album is too long. Max is 255 characters'),
                ])
            ->checkIsInt('photos', $data['photos']);

        $this->dataValidated = $data;
    }
}

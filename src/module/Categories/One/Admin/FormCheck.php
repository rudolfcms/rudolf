<?php

namespace Rudolf\Modules\Categories\One\Admin;

use Rudolf\Component\Forms\Form;
use Rudolf\Component\Html\Text;

class FormCheck extends Form
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $dataValidated;

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function check()
    {
        /** @var array $data */
        $data = array_merge([
            'title' => '',
            'description' => '',
            'keywords' => '',
            'content' => '',
            'slug' => '',
            'type' => $this->type,
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
                    'short' => _('Keywords is too short. Min is 3 characters'),
                    'long' => _('Keywords is too long. Max is 255 characters'),
                ])
            ->checkChar('type', $data['type'], 0, 255, [
                    'long' => _('Type is too long. Max is 255 characters'),
                ])
            //->checkChar('content', $data['content'])
            ->checkChar('slug', $data['slug'], 0, 255, [
                    'long' => _('URL is too long. Max is 255 characters'),
                ]);

        $this->dataValidated = $data;
    }
}

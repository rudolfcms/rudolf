<?php

namespace Rudolf\Modules\Albums;

use Rudolf\Framework\Model\FrontModel;

abstract class Model extends FrontModel
{
    /**
     * Returns part of query.
     *
     * @return string
     */
    protected function queryPart($part)
    {
        switch ($part) {
            case 'full':
                return "
                    SELECT album.id,
                           album.category_ID,
                           album.title,
                           album.author,
                           album.date,
                           album.added,
                           album.modified,
                           album.adder_ID,
                           album.modifier_ID,
                           album.views,
                           album.slug,
                           album.album,
                           album.thumb,
                           album.photos,
                           album.published,
                           adder.nick AS adder_nick,
                           adder.first_name AS adder_first_name,
                           adder.surname AS adder_surname,
                           adder.email AS adder_email,
                           modifier.nick AS adder_nick,
                           modifier.first_name AS modifier_first_name,
                           modifier.surname AS modifier_surname,
                           modifier.email AS modifier_email,
                           category.title AS category_title,
                           category.slug AS category_url
                    FROM {$this->prefix}albums AS album
                    LEFT JOIN {$this->prefix}users AS adder ON album.adder_ID = adder.id
                    LEFT JOIN {$this->prefix}users AS modifier ON album.modifier_ID = modifier.id
                    LEFT JOIN {$this->prefix}categories AS category ON album.category_ID = category.id
                ";
                break;

            default:
                return "SELECT * FROM {$this->prefix}albums ";
            break;
        }
    }
}

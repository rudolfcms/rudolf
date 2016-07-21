<?php

namespace Rudolf\Modules\Articles;

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
                    SELECT article.id,
                           article.category_ID,
                           article.title,
                           article.keywords,
                           article.description,
                           article.content,
                           article.author,
                           article.date,
                           article.added,
                           article.modified,
                           article.adder_ID,
                           article.modifier_ID,
                           article.views,
                           article.slug,
                           article.album,
                           article.thumb,
                           article.photos,
                           article.published,
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
                    FROM {$this->prefix}articles AS article
                    LEFT JOIN {$this->prefix}users AS adder ON article.adder_ID = adder.id
                    LEFT JOIN {$this->prefix}users AS modifier ON article.modifier_ID = modifier.id
                    LEFT JOIN {$this->prefix}categories AS category ON article.category_ID = category.id
                ";
                break;

            default:
                return "SELECT * FROM {$this->prefix}articles ";
            break;
        }
    }
}

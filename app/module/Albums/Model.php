<?php
namespace Rudolf\Modules\Albums;

use Rudolf\Component\Abstracts\AModel;

abstract class Model extends AModel
{
    /**
     * Returns part of query
     * 
     * @return string
     */
    protected function queryPart($part)
    {
        switch ($part) {
            case 'full':
                return "SELECT album.id, album.category_ID, album.title,
                    album.author, album.date,
                    album.added, album.modified, album.adder_ID, album.modifier_ID, album.views,
                    album.slug, album.album, album.thumb, album.photos, album.published,

                    adder.nick as adder_nick, adder.first_name as adder_first_name,
                    adder.surname as adder_surname, adder.email as adder_email,

                    modifier.nick as adder_nick, modifier.first_name as modifier_first_name,
                    modifier.surname as modifier_surname, modifier.email as modifier_email,

                    category.title as category_title, category.slug as category_url

                    FROM {$this->prefix}albums as album

                    -- join on adder_ID
                    LEFT JOIN {$this->prefix}users as adder ON album.adder_ID = adder.id

                    -- join on modifier_ID
                    LEFT JOIN {$this->prefix}users as modifier ON album.modifier_ID = modifier.id

                    -- join on category_ID
                    LEFT JOIN {$this->prefix}categories as category ON album.category_ID = category.id ";
                break;

            default:
                return "SELECT * FROM {$this->prefix}albums ";
            break;
        }
    }
}
<?php

namespace Rudolf\Modules\Galleries;

use Rudolf\Framework\Model\BaseModel;

abstract class Model extends BaseModel
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
                    SELECT gallery.id,
                           gallery.title,
                           gallery.added,
                           gallery.modified,
                           gallery.adder_ID,
                           gallery.modifier_ID,
                           gallery.slug,
                           adder.nick AS adder_nick,
                           adder.first_name AS adder_first_name,
                           adder.surname AS adder_surname,
                           adder.email AS adder_email,
                           modifier.nick AS adder_nick,
                           modifier.first_name AS modifier_first_name,
                           modifier.surname AS modifier_surname,
                           modifier.email AS modifier_email
                    FROM {$this->prefix}galleries AS gallery
                    LEFT JOIN {$this->prefix}users AS adder ON gallery.adder_ID = adder.id
                    LEFT JOIN {$this->prefix}users AS modifier ON gallery.modifier_ID = modifier.id
                ";
                break;

            default:
                return "SELECT * FROM {$this->prefix}galleries ";
            break;
        }
    }
}

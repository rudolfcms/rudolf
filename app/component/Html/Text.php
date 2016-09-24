<?php

namespace Rudolf\Component\Html;

use Coduo\PHPHumanizer\StringHumanizer;

class Text
{
    /**
     * It truncates text.
     * 
     * @param string $str         text to cut
     * @param int    $length      truncate text length
     * @param string $ellipsis
     * @param string $allowedTags
     *
     * @return $str truncate text
     */
    public static function truncate($str, $length, $ellipsis = '...', $allowedTags = '')
    {
        return StringHumanizer::truncateHtml($str, $length, $allowedTags, $ellipsis);
    }

    /**
     * Excape string.
     * 
     * @param string $content
     * 
     * @return string
     */
    public static function escape($content)
    {
        return htmlspecialchars($content);
    }

    public static function sluger($string)
    {
        return strtolower(
            trim(
                preg_replace('~[^0-9a-z]+~i', '-',
                    html_entity_decode(
                        preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1',
                            htmlentities($string, ENT_QUOTES, 'UTF-8')
                        ), ENT_QUOTES, 'UTF-8'
                    )
                ), '-')
            );
    }
}

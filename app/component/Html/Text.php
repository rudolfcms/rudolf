<?php

namespace Rudolf\Component\Html;

use Cocur\Slugify\Slugify;
use HtmlTruncator\Truncator;

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
        $str = strip_tags($str, $allowedTags);
        return Truncator::truncate($str, $length, [
            'ellipsis' => $ellipsis,
            'length_in_chars' => true,
        ]);
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
        $slugify = new Slugify();
        return $slugify->slugify($string);
    }
}

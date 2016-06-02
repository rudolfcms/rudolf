<?php
namespace Rudolf\Component\Html;

class Text
{   
    /**
     * It truncates text.
     * 
     * @param string $str text to cut
     * @param int $length truncate text length
     * @param string $ellipsis
     *
     * @return $str truncate text
     */
    public static function truncate($str, $length, $ellipsis = '...')
    {
        $tmp['length'] = strlen($str);

        if ($tmp['length'] > $length) {
            while($str[$length] != ' ' && ++$length < $tmp['length']);
            return trim(substr($str, 0, $length), ',') . $ellipsis;
        } else {
            return $str;
        }
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
}

<?php

namespace Rudolf\Component\Html;

class Foot
{
    use DocumentPart;

    /**
     * Make all elements before </body>.
     *
     * @param bool $return
     * @param int $nesting
     *
     * @return string|null
     */
    public function make($return = false, $nesting = 1)
    {
        $html[] = $this->before(true);
        $html[] = $this->scripts(true, $nesting);
        $html[] = $this->after(true);

        // trimmmmmmmmmmmmm
        foreach ($html as $key => $value) {
            $html[$key] = trim($value);
        }

        $html = implode("\n".str_repeat("\t", $nesting), array_filter($html)).PHP_EOL;

        if (false === $return) {
            echo $html;
            return null;
        }

        return $html;
    }
}

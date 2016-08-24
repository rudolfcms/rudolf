<?php

namespace Rudolf\Component\Html;

class Foot
{
    use DocumentPart;

    /**
     * @var array
     */
    private $pageScripts;

    /**
     * Make all elements before </body>.
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

        $return = implode("\n".str_repeat("\t", $nesting), array_filter($html)).PHP_EOL;

        if (true === $return) {
            return $return;
        }

        echo $return;
    }
}

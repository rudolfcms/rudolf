<?php

namespace Rudolf\Component\Html;

trait DocumentPart
{
    /**
     * @var array
     */
    private $before;

    /**
     * @var array
     */
    private $after;

    /**
     * @var array
     */
    private $pageScripts = [];

    /**
     * Get tags before.
     *
     * @param bool $return
     * @param int  $nesting
     *
     * @return null|string
     */
    public function before($return = false, $nesting = 1)
    {
        if (empty($this->before)) {
            return;
        }

        $html = implode("\n".str_repeat("\t", $nesting), $this->before).PHP_EOL;

        if (true === $return) {
            return $html;
        }

        echo $html;
    }

    /**
     * Get before array.
     *
     * @return array
     */
    public function getBeforeArray()
    {
        return $this->before;
    }

    public function setBeforeArray($array)
    {
        //$this->before = array_merge($this->before, $array);
        $this->before = $array;
    }

    /**
     * Set tags before others.
     *
     * @param string $before
     */
    public function setBefore($before)
    {
        $this->before[] = $before;
    }

    /**
     * Get tags after.
     *
     * @param bool $return
     * @param int  $nesting
     *
     * @return null|string
     */
    public function after($return = false, $nesting = 1)
    {
        if (empty($this->after)) {
            return;
        }

        $html = implode("\n".str_repeat("\t", $nesting), $this->after).PHP_EOL;

        if (true === $return) {
            return $html;
        }

        echo $html;
    }

    /**
     * Get after array.
     *
     * @return array
     */
    public function getAfterArray()
    {
        return $this->after;
    }

    public function setAfterArray($array)
    {
        //$this->after = array_merge($this->after, $array);
        $this->after = $array;
    }

    /**
     * Set tags after others.
     *
     * @param string $after
     */
    public function setAfter($after)
    {
        $this->after[] = $after;
    }

    /**
     * Get scripts links.
     *
     * @param bool $return
     *
     * @return void|string
     */
    public function scripts($return = false, $nesting = 1)
    {
        if (empty($this->pageScripts)) {
            return false;
        }

        foreach ($this->pageScripts as $key => $value) {
            $html[] = sprintf('<script src="%1$s"></script>', $value);
        }

        $html = implode("\n".str_repeat("\t", $nesting), $html).PHP_EOL;

        if (true === $return) {
            return $html;
        }

        echo $html;
    }

    /**
     * Get stylesheet array.
     *
     * @return array
     */
    public function getScriptsArray()
    {
        return $this->pageScripts;
    }

    public function setScriptsArray($array)
    {
        //$this->pageScripts = array_merge($this->pageScripts, $array);
        $this->pageScripts = $array;
    }

    /**
     * Set page stylesheet.
     *
     * @param string $href Script location
     * @param string $version Version
     */
    public function setScript($href, $version = '')
    {
        if ($version) {
            $href .= '?v='.$version;
        }

        $this->pageScripts[] = $href;
    }
}

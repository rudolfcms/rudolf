<?php

namespace Rudolf\Component\Html;

class Head
{
    use DocumentPart;

    /**
     * @var string
     */
    private $pageTitle;

    /**
     * @var string
     */
    private $pageCharset;

    /**
     * @var array
     */
    private $pageStylesheets = [];

    /**
     * @var string
     */
    private $pageFavicon;

    /**
     * @var string
     */
    private $canonical;

    /**
     * Make all elements inside <head>.
     *
     * @param bool $return
     * @param int $nesting
     * @return string|array|null
     */
    public function make($return = false, $nesting = 1)
    {
        $html = [];

        $html[] = $this->before(true);
        $html[] = sprintf('<meta charset="%1$s">', $this->charset(true));
        $html[] = sprintf('<title>%1$s</title>', $this->title(true));
        $html[] = $this->stylesheets(true, $nesting);
        $html[] = $this->scripts(true, $nesting);
        $html[] = $this->favicon(true);
        $html[] = $this->canonical(true);
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

    /**
     * Get page title.
     *
     * @param bool $return
     *
     * @return string
     */
    public function title($return = false)
    {
        $title = trim($this->pageTitle.' | '.GENERAL_SITE_NAME, ' | ');

        if (false === $return) {
            echo $title;
            return null;
        }

        return $title;
    }

    public function setTitle($title)
    {
        $this->pageTitle = $title;
    }

    /**
     * Get page charset.
     *
     * @param bool $return
     *
     * @return string
     */
    public function charset($return = false)
    {
        $charset = empty($this->pageCharset) ? 'utf-8' : $this->pageCharset;

        if (false === $return) {
            echo $charset;
            return null;
        }

        return $charset;
    }

    public function setCharset($pageCharset)
    {
        $this->pageCharset = $pageCharset;
    }

    /**
     * Get favicon links.
     *
     * @param bool $return
     *
     * @return string
     */
    public function favicon($return = false)
    {
        if (empty($this->pageFavicon)) {
            return false;
        }

        $link = sprintf('<link rel="shortcut icon" href="%1$s">', $this->pageFavicon);

        if (true === $return) {
            echo $link;
            return null;
        }

        return $link;
    }

    /**
     * Set page favicon.
     *
     * @param string $favicon Favicon location
     */
    public function setFavicon($favicon)
    {
        $this->pageFavicon = $favicon;
    }

    /**
     * Get canonical link.
     *
     * @param bool $return
     *
     * @return string
     */
    public function canonical($return = false)
    {
        if (empty($this->canonical)) {
            return false;
        }

        $canonical = sprintf(
            '<link rel="canonical" href="%1$s">',
            (new Url())->getOrigin().$this->canonical
        );

        if (false === $return) {
            echo $canonical;
            return null;
        }

        return $canonical;
    }

    /**
     * Set canonical link.
     *
     * @param string $href
     */
    public function setCanonical($href)
    {
        $this->canonical = $href;
    }

    /**
     * Get stylesheets links.
     *
     * @param bool $return
     * @param int  $nesting
     *
     * @return string
     */
    public function stylesheets($return = false, $nesting = 1)
    {
        if (empty($this->pageStylesheets)) {
            return false;
        }

        $html = [];

        foreach ($this->pageStylesheets as $key => $value) {
            $html[] = sprintf('<link rel="stylesheet" href="%1$s">', $value);
        }

        $html = implode("\n".str_repeat("\t", $nesting), $html).PHP_EOL;

        if (false === $return) {
            echo $html;
            return null;
        }

        return $html;
    }

    /**
     * Get stylesheet array.
     *
     * @return array
     */
    public function getStylesheetsArray()
    {
        return $this->pageStylesheets;
    }

    /**
     * Set page stylesheet.
     *
     * @param string $href    Stylesheet location
     * @param string $version Version
     */
    public function setStylesheet($href, $version = '')
    {
        if ($version) {
            $href .= '?v='.$version;
        }

        $this->pageStylesheets[] = $href;
    }
    public function setStylesheetsArray($array)
    {
        //$this->pageStylesheets = array_merge($this->pageStylesheets, $array);
        $this->pageStylesheets = $array;
    }
}

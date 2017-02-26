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
     * Make all elements inside <head>.
     */
    public function make($return = false, $nesting = 1)
    {
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

        $return = implode("\n".str_repeat("\t", $nesting), array_filter($html)).PHP_EOL;

        if (true === $return) {
            return $return;
        }

        echo $return;
    }

    /**
     * Get page title.
     * 
     * @param bool $return
     * 
     * @return void|string
     */
    public function title($return = false)
    {
        $title = trim($this->pageTitle.' | '.GENERAL_SITE_NAME, ' | ');

        if (true === $return) {
            return $title;
        }

        echo $title;
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
     * @return void|string
     */
    public function charset($return = false)
    {
        $charset = (empty($this->pageCharset)) ? 'utf-8' : $this->pageCharset;

        if (true === $return) {
            return $charset;
        }

        echo $charset;
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
     * @return void|string
     */
    public function favicon($return = false)
    {
        if (empty($this->pageFavicon)) {
            return false;
        }

        $link = sprintf('<link rel="shortcut icon" href="%1$s">', $this->pageFavicon);

        if (true === $return) {
            return $link;
        }

        echo $link;
    }

    /**
     * Set page favicon.
     * 
     * @param string $href Favicon location
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
     * @return void|string
     */
    public function canonical($return = false)
    {
        if (empty($this->canonical)) {
            return false;
        }

        $canonical = sprintf('<link rel="canonical" href="%1$s">',
            (new Url())->getOrigin().$this->canonical
        );

        if (true === $return) {
            return $canonical;
        }

        echo $canonical;
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
     * 
     * @return void|string
     */
    public function stylesheets($return = false, $nesting = 1)
    {
        if (empty($this->pageStylesheets)) {
            return false;
        }

        foreach ($this->pageStylesheets as $key => $value) {
            $html[] = sprintf('<link rel="stylesheet" href="%1$s">', $value);
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
    public function getStylesheetsArray()
    {
        return $this->pageStylesheets;
    }

    /**
     * Set page stylesheet.
     * 
     * @param string $href Stylesheet location
     */
    public function setStylesheet($href)
    {
        $this->pageStylesheets[] = $href;
    }
    public function setStylesheetsArray($array)
    {
        //$this->pageStylesheets = array_merge($this->pageStylesheets, $array);
        $this->pageStylesheets = $array;
    }
}

<?php
namespace Rudolf\Component\Html;

class Paging
{
    private $info;

    private $path;

    private $classes;

    private $nesting;

    /**
     * Constructor
     *
     * @param array $nav with data for loop
     *      <page> - current page
     *      <forstart> -
     *      <forend> -
     *      <allpages> - all pages
     *      <prev> - prev page
     *      <next> - next page
     *
     * @param string $path path with a slash at the beginning and at the end without him, like: '/kg'
     * @param array $classes Specifies a pagination appearance
     *      <ul> - main ul class
     *      <current> - current active li class
     * @param int $nesting
     */
    public function __construct($info = [], $path = '', $classes = [], $nesting = 0)
    {
        $this->setInfo($info);
        $this->setPath($path);
        $this->setClasses($classes);
        $this->setNesting($nesting);
    }

    public function setInfo(array $info)
    {
        $this->info = $info;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return DIR . $this->path;
    }

    public function setClasses(array $classes)
    {
        $this->classes = array_merge([
            'ul' => '',
            'current' => 'current'
        ], $classes);
    }

    public function getClasses()
    {
        return $this->classes;
    }

    public function setNesting($nesting)
    {
        $this->nesting = $nesting;
    }

    public function getNesting()
    {
        return $this->nesting;
    }

    public function create()
    {
        $nav = $this->getInfo();
        $path = $this->getPath();
        $classes = $this->getClasses();
        $nesting = $this->getNesting();

        $html[] = sprintf('<ul%1$s>', ($classes['ul']) ? ' class="' . $classes['ul'].'"' : '');
        if (!isset($classes['current'])) {
            $classes['current'] = 'current';
        }

        $nest = str_repeat("\t", $nesting);
        $tab = str_repeat("\t", 1 + $nesting);

        if ($nav['page'] > 1) {
            $html[] = sprintf('%1$s<li><a href="%2$s">«</a></li>', $tab, $path.'/page/' . $nav['prev']);
        }
        if ($nav['forstart'] > 1) {
            $html[] = sprintf('%1$s<li><a href="%2$s">1</a></li>', $tab, $path.'/page/1');
        }
        if ($nav['forstart'] > 2) {
            $html[] = sprintf('%1$s<li><a>...</a></li>', $tab);
        }
        for($nav['forstart']; $nav['forstart'] < $nav['forend']; $nav['forstart']++) {
            if ($nav['forstart'] == $nav['page']) {
                $html[] = sprintf(
                    '%1$s<li class="%2$s"><a href="%3$s">%4$s</a></li>',
                    $tab,
                    $classes['current'],
                    $path . '/page/' . $nav['forstart'],
                    $nav['forstart']
                );
            }
            if ($nav['forstart'] != $nav['page']) {
                $html[] = sprintf(
                    '%1$s<li><a href="%2$s">%3$s</a></li>',
                    $tab,
                    $path . '/page/' . $nav['forstart'],
                    $nav['forstart']
                );
            }
        }
        if ($nav['forstart'] < $nav['allpages']) {
            $html[] = sprintf('%1$s<li><a>...</a></li>', $tab);
        }
        if ($nav['forstart'] - 1 < $nav['allpages']) {
            $html[] = sprintf(
                '%1$s<li><a href="%2$s">%3$s</a></li>',
                $tab,
                $path . '/page/' . $nav['allpages'],
                $nav['allpages']
            );
        }
        if ($nav['page'] < $nav['allpages']) {
            $html[] = sprintf(
                '%1$s<li><a href="%2$s">»</a></li>',
                $tab,
                $path . '/page/' . $nav['next']
            );
        }
        $html[] = $nest . '</ul>'."\n";

        return implode("\n", $html);
    }
}

<?php

namespace Rudolf\Component\Html;

class Paging
{
    /**
     * @var array
     */
    private $info;

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $classes;

    /**
     * @var int
     */
    private $nesting;

    /**
     * Constructor.
     *
     * @param array  $info     with data for loop
     *                        <page> - current page
     *                        <forstart> -
     *                        <forend> -
     *                        <allpages> - all pages
     *                        <prev> - prev page
     *                        <next> - next page
     * @param string $path    path with a slash at the beginning and at the end without him, like: '/kg'
     * @param array  $classes Specifies a pagination appearance
     *                        <ul> - main ul class
     *                        <current> - current active li class
     * @param int    $nesting
     */
    public function __construct(array $info = [], $path = '', array $classes = [], $nesting = 0)
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
        return DIR.$this->path;
    }

    public function setClasses(array $classes)
    {
        $this->classes = array_merge([
            'ul' => '',
            'li_current' => '',
            'a' => '',
            'a_current' => '',
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

    /**
     * Put value is not empty.
     *
     * @param string       $attribute
     * @param string|array $value
     *
     * @return string
     */
    private function isAttribute($attribute, $value)
    {
        if (is_array($value)) {
            array_filter($value);
            $value = trim(implode(' ', $value));

            return !empty($value) ? ' '.$attribute.'="'.$value.'"' : '';
        }

        return (isset($value) and !empty($value)) ? ' '.$attribute.'="'.trim($value).'"' : '';
    }

    public function create()
    {
        $nav = $this->getInfo();
        $path = $this->getPath();
        $classes = $this->getClasses();
        $nesting = $this->getNesting();

        $html[] = sprintf('<ul%1$s>', $this->isAttribute('class', $classes['ul']));

        $nest = str_repeat("\t", $nesting);
        $tab = str_repeat("\t", 1 + $nesting);

        if ($nav['page'] > 1) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s href="%4$s">«</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a']),
                $path.'/page/'.$nav['prev']
            );
        }
        if ($nav['forstart'] > 1) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s href="%4$s">1</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a']),
                $path.'/page/1'
            );
        }
        if ($nav['forstart'] > 2) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s>...</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a'])
            );
        }
        for ($nav['forstart']; $nav['forstart'] < $nav['forend']; ++$nav['forstart']) {
            if ((int) $nav['forstart'] === $nav['page']) {
                $html[] = sprintf(
                    '%1$s<li%2$s><a%3$s href="%4$s">%5$s</a></li>',
                    $tab,
                    $this->isAttribute('class', [$classes['li'], $classes['li_current']]),
                    $this->isAttribute('class', [$classes['a'], $classes['a_current']]),
                    $path.'/page/'.$nav['forstart'],
                    $nav['forstart']
                );
            }
            if ((int) $nav['forstart'] !== $nav['page']) {
                $html[] = sprintf(
                    '%1$s<li%2$s><a%3$s href="%4$s">%5$s</a></li>',
                    $tab,
                    $this->isAttribute('class', $classes['li']),
                    $this->isAttribute('class', $classes['a']),
                    $path.'/page/'.$nav['forstart'],
                    $nav['forstart']
                );
            }
        }
        if ($nav['forstart'] < $nav['allpages']) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s>...</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a'])
            );
        }
        if ($nav['forstart'] - 1 < $nav['allpages']) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s href="%4$s">%5$s</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a']),
                $path.'/page/'.$nav['allpages'],
                $nav['allpages']
            );
        }
        if ($nav['page'] < $nav['allpages']) {
            $html[] = sprintf(
                '%1$s<li%2$s><a%3$s href="%4$s">»</a></li>',
                $tab,
                $this->isAttribute('class', $classes['li']),
                $this->isAttribute('class', $classes['a']),
                $path.'/page/'.$nav['next']
            );
        }
        $html[] = $nest.'</ul>'."\n";

        return implode("\n", $html);
    }
}

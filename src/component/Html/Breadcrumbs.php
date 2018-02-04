<?php

namespace Rudolf\Component\Html;

class Breadcrumbs
{
    /**
     * @var array
     */
    private $elements;

    /**
     * @var array
     */
    private $address;

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
     * @param array $elements Array with menu elements
     * @param array $address  Address elements array
     * @param array $classes  Array which classes to use in breadcrumbs
     * @param int   $nesting  Generated code nesting
     */
    public function __construct(array $elements = [], array $address = [], array $classes = [], $nesting = 0)
    {
        $this->setElements($elements);
        $this->setAddress($address);
        $this->setNesting($nesting);
    }

    public function setElements(array $elements)
    {
        $this->elements = $elements;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function setAddress(array $address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setClasses(array $classes)
    {
        $this->classes = array_merge([
            'ul' => '',
            'li_active' => '',
        ], $classes);
    }

    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param int $nesting
     */
    public function setNesting($nesting)
    {
        $this->nesting = $nesting;
    }

    public function getNesting()
    {
        return $this->nesting;
    }

    public function getStructure()
    {
        $menu = $this->getElements();
        $address = $this->getAddress();

        if (empty($menu) || empty($address)) {
            return false;
        }

        $array = [];

        // temp workaround
        foreach ($menu as $key => $value) {
            if (isset($value['slug'])) {
                $array[$value['slug']][$value['parent_id']] = $value;
            }
        }
        if (isset($value['slug'])) {
            $menu = $array;
        }

        $url = null;
        $array = [];

        for ($pid = 0, $i = 0; $i < $c = count($address); ++$i) {
            if (isset($menu[$address[$i]][$pid]) && $pid === (int) $menu[$address[$i]][$pid]['parent_id']) {
                $array[$i] = array($url.'/'.$address[$i], $menu[$address[$i]][$pid]['title']);
                $pid = $menu[$address[$i]][$pid]['id'];
                $url .= '/'.$address[$i];
            }
        }

        return $array;
    }

    public function create($withStart = true)
    {
        $elements = $this->getStructure();
        if (empty($elements)) {
            return false;
        }

        $nesting = $this->getNesting();
        $classes = $this->getClasses();

        $html[] = sprintf(
            '<ul'.'%1$s'.'>',
            $classes['ul'] ? ' class="'.$classes['ul'].'"' : ''
        );

        $tab = str_repeat("\t", $nesting + 1);

        if (true === $withStart) {
            $html[] = $tab.'<li><a href="'.DIR.'/">Start</a></li>';
        }

        for ($i = 0; $i < (count($elements) - 1); ++$i) {
            $html[] = sprintf(
                '%1$s<li><a href="%2$s">%3$s</a></li>',
                $tab, // nesting
                DIR.$elements[$i][0],
                $elements[$i][1]
            );
        }

        $html[] = sprintf(
            '%1$s'.'<li'.'%2$s'.'>'.'%3$s'.'</li>',
            $tab, // nesting
            $classes['li_active'] ? ' class="'.$classes['li_active'].'"' : '',
            $elements[$i][1]
        );

        $html[] = str_repeat("\t", $nesting).'</ul>';

        return implode("\n", $html);
    }
}

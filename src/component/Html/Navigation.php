<?php

namespace Rudolf\Component\Html;

use Rudolf\Component\Helpers\Navigation\MenuItem;
use Rudolf\Component\Helpers\Navigation\MenuItemCollection;

class Navigation
{
    /**
     * @var int
     */
    private $rootID = 0;

    /**
     * @var string
     */
    private $type;

    /**
     * @var MenuItemCollection
     */
    private $menuItemsCollection;

    /**
     * @var array
     */
    private $currents = [];

    /**
     * @var array
     */
    private $classes = [];

    /**
     * @var int
     */
    private $nesting;

    /**
     * @var array
     */
    private $before = [];

    /**
     * @var array
     */
    private $after = [];

    /**
     * @var array
     */
    private $config = [];

    /**
     * Set items.
     *
     * @param MenuItemCollection $items
     */
    public function setItems(MenuItemCollection $items)
    {
        $this->menuItemsCollection = $items;
    }

    /**
     * Set active elements slugs, use to mark current items.
     *
     * @param array|string $currents
     */
    public function setCurrent($currents)
    {
        if (!is_array($currents)) {
            $address = explode('/', trim($currents, '/'));

            $currents = [];
            $temp     = '';
            foreach ($address as $key => $value) {
                $currents[] = ltrim($temp = $temp.'/'.$value, '/');
            }
        }

        $this->currents = $currents;
    }

    /**
     * Menu creator.
     * @link   http://pastebin.com/GAFvSew4
     * @author J. Bruni - original author
     * @return string|bool
     */
    public function create()
    {
        $root_id  = $this->getRootID();
        $items    = $this->sortItems($this->getItems());
        $currents = $this->getCurrents();
        $classes  = $this->getClasses();
        $before   = $this->getBefore();
        $after    = $this->getAfter();
        $nesting  = $this->getNesting();
        $config   = $this->getConfig();

        if (empty($items)) {
            return false;
        }

        foreach ($items as $item) {
            if (null !== $item->getParentId()) {
                $children[$item->getParentId()][] = $item;
            }
        }

        // loop will be false if the root has no children (i.e., an empty menu!)
        $loop = !empty($children[$root_id]);

        // initializing $parent as the root
        $parent       = $root_id;
        $parent_stack = [];

        $html = [];

        $html[] = $before['root_ul'];

        // HTML wrapper for the menu (open)
        $html[] = sprintf(
            '%1$s'.'<ul'.'%2$s'.'>',
            # %1$s tab if text before
            !empty($before['root_ul']) ? str_repeat("\t", $nesting) : '',

            # %2$s root ul class
            $this->isAtribute('class', $classes['root_ul'])
        );

        $html[] = !empty($before['first_root_li']) ? str_repeat("\t", $nesting + 1).$before['first_root_li'] : '';

        // loop
        while ($loop && (($item = $this->each($children[$parent])) || ($parent > $root_id))) {
            if (is_object($item['value'])) {
                /**
                 * @var MenuItem $obj
                 */
                $obj  = $item['value'];
                $item = [
                    'id'        => $obj->getId(),
                    'parent_id' => $obj->getParentId(),
                    'title'     => $obj->getTitle(),
                    'slug'      => $obj->getSlug(),
                    'caption'   => $obj->getCaption(),
                    'ico'       => $obj->getIco(),
                ];
            }

            // HTML for menu item containing children (close)
            if ($item === false) {
                $parent = array_pop($parent_stack);
                $html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 + $nesting).'</ul>';
                $html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting).'</li>';
            } // HTML for menu item containing children (open)
            elseif (!empty($children[$item['id']])) {
                $tab = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting);

                /*
                 * <li> with <ul>
                 */
                $html[] = sprintf(
                    '%1$s'.'<li'.'%2$s'.'>%3$s<a'
                    .'%4$s'.' href="'.'%5$s'.'">%6$s%7$s'.'%8$s'.'%9$s</a>%10$s',
                    # %1$s tabulation
                    $tab,

                    # %2$s li class (active)
                    $this->isAtribute(
                        'class',
                        [
                            $classes['li'],
                            $classes['li_with_ul'],
                            $this->isActive($item['slug'], $currents) ? $classes['li_active'] : '',
                        ]
                    ),

                    # %3$s text before li a
                    $before['li_with_ul_a'],

                    # %4$s a title=""
                    $this->isAtribute('title', $item['caption']),

                    # %5$s a href=""
                    $item['slug'],

                    # %6$s ico
                    $this->addContainerWithIcoIf(
                        $item['ico'],
                        $config['li_a_ico-container'],
                        $config['li_a_ico-class_base']
                    ),

                    # %7$s before text in li a
                    $before['li_with_ul_a_text'],

                    # %8$s text inside item
                    $this->addContainerWithSelectorIf($item['title'], $config['li_a_text-container']),

                    # %9$s after text in li a
                    $after['li_with_ul_a_text'],

                    # %10$s text after li a
                    $after['li_with_ul_a']
                );

                /*
                 * sub <ul> in <li>
                 */
                $html[] = sprintf(
                    '%1$s'.'<ul'.'%2$s'.'>',
                    # %1$s tabulation
                    $tab."\t",

                    # %2$s sub ul class
                    $this->isAtribute('class', $classes['sub_ul'])
                );

                $parent_stack[] = $item['parent_id'];
                $parent         = $item['id'];
            } // HTML for menu item with no children (aka "leaf")
            else {
                $html[] = sprintf(
                    '%1$s'.'<li'.'%2$s'.'>%3$s<a'
                    .'%4$s'.' href="'.'%5$s'.'">%6$s%7$s'.'%8$s'.'%9$s</a>%10$s',
                    # %1$s tabulation
                    str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting),

                    # %2$s li class (active)
                    $this->isAtribute(
                        'class',
                        [
                            $classes['li'],
                            $classes['li_without_ul'],
                            $this->isActive($item['slug'], $currents) ? $classes['li_active'] : '',
                        ]
                    ),

                    # %3$s text before li a
                    $before['li_a'],

                    # %4$s a title=""
                    $this->isAtribute('title', $item['caption']),

                    # %5$s a href=""
                    $item['slug'],

                    # %6$s ico
                    $this->addContainerWithIcoIf(
                        $item['ico'],
                        $config['li_a_ico-container'],
                        $config['li_a_ico-class_base']
                    ),

                    # %7$s before text in li a
                    $before['li_a_text'],

                    # %8$s text inside item
                    $this->addContainerWithSelectorIf($item['title'], $config['li_a_text-container']),

                    # %9$s after text in li a
                    $after['li_a_text'],

                    # %10$s text after li a
                    $after['li_a']
                );
            }
        }

        $html[] = !empty($after['last_root_li']) ? str_repeat("\t", $nesting + 1).$after['last_root_li'] : '';

        // HTML wrapper for the menu (close)
        $html[] = str_repeat("\t", $nesting).'</ul>';

        $html[] = $after['root_ul'];

        return implode("\n", array_filter($html))."\n";
    }

    /**
     * @return int
     */
    public function getRootID()
    {
        return $this->rootID;
    }

    /**
     * Set root ID.
     *
     * @param int $id ID of element to start create tree. Set 0 to create full tree
     */
    public function setRootID($id)
    {
        $this->rootID = (int)$id;
    }

    /**
     * @param array $items
     *
     * @return MenuItem[]
     */
    protected function sortItems(array $items)
    {
        usort(
            $items,
            function ($a, $b) {
                /** @var MenuItem $a */
                /** @var MenuItem $b */
                return $a->getPosition() > $b->getPosition();
            }
        );

        return $items;
    }

    /**
     * @return MenuItem[]
     */
    public function getItems()
    {
        return $this->menuItemsCollection->getByType($this->getType());
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Menu type defined in menu_types table.
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getCurrents()
    {
        $currents = $this->currents;

        // add actual app dir to currents slug
        foreach ($currents as $key => $value) {
            $currents[$key] = DIR.'/'.$value;
        }

        return $currents;
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return array_merge(
            [
                'root_ul'       => '',
                'li'            => '',
                'li_active'     => '',
                'li_with_ul'    => '',
                'li_without_ul' => '',
                'sub_ul'        => '',
            ],
            $this->classes
        );
    }

    /**
     * Set classes to use in menu.
     *
     * @param array $classes
     *      'root_ul' (string) Main <ul>
     *      `li` (string) Each <li>
     *      'li_active' (string)
     *      'li_with_ul' (string) <li> with <ul>
     *      'li_without_ul' (string) <li> without <ul>
     *      'sub_ul' (string) <ul> inside <li>
     */
    public function setClasses(array $classes)
    {
        $this->classes = $classes;
    }

    /**
     * @return array
     */
    public function getBefore()
    {
        return array_merge(
            [
                'root_ul'           => '',
                'first_root_li'     => '',
                'li_a'              => '',
                'li_a_text'         => '',
                'li_with_ul_a'      => '',
                'li_with_ul_a_text' => '',
            ],
            $this->before
        );
    }

    /**
     * Put string before elements.
     *
     * @param array $before
     *      'root_ul' (string) Main <ul>
     *      'first_root_li' (string) First <li> in main <ul>
     *      'li_a' (string) In <li> before <a>
     *      'li_a_text' (string) In <li><a> before text inside
     *      'li_with_ul_a' (string) In <li> with <ul> before <a>
     *      'li_with_ul_a_text' (string) In <li><a> with <ul> before text inside
     */
    public function setBefore(array $before)
    {
        $this->before = $before;
    }

    /**
     * @return array
     */
    public function getAfter()
    {
        return array_merge(
            [
                'root_ul'           => '',
                'last_root_li'      => '',
                'li_a'              => '',
                'li_a_text'         => '',
                'li_with_ul_a'      => '',
                'li_with_ul_a_text' => '',
            ],
            $this->after
        );
    }

    /**
     * Put string after elements.
     *
     * @param array $after Texts after
     *                     'root_ul' (string) Main <ul>
     *                     'last_root_li' (string) Last <li> in main <ul>
     *                     'li_a' (string) In <li> after <a>
     *                     'li_a_text' (string) In <li><a> before text inside
     *                     'li_with_ul_a' (string) In <li> with <ul> after <a>
     *                     'li_with_ul_a_text' (string) In <li><a> with <ul> after text inside
     */
    public function setAfter(array $after)
    {
        $this->after = $after;
    }

    /**
     * @return mixed
     */
    public function getNesting()
    {
        return $this->nesting;
    }

    /**
     * Set generated menu code nesting.
     *
     * @param int $nesting
     */
    public function setNesting($nesting)
    {
        $this->nesting = $nesting;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return array_merge(
            [
                'li_a_text-container' => '',
                'li_a_ico-container'  => '',
                'li_a_ico-class_base' => '',
            ],
            $this->config
        );
    }

    /**
     * Set config.
     *
     * @param array $config
     *                      'li_a_text-container' (string) Selector container for text in <li><a>
     *                      'li_a_ico-container' (string) Selector container for ico in <li><a>
     *                      'li_a_ico-class_base' (string) Base class of icon container
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Put value is not empty.
     *
     * @param string       $atribute
     * @param string|array $value
     *
     * @return string
     */
    private function isAtribute($atribute, $value)
    {
        if (is_array($value)) {
            array_filter($value);
            $value = trim(implode(' ', $value));

            return !empty($value) ? ' '.$atribute.'="'.$value.'"' : '';
        }

        return (isset($value) and !empty($value)) ? ' '.$atribute.'="'.trim($value).'"' : '';
    }

    protected function each(&$arr)
    {
        $key    = key($arr);
        $result = ($key === null) ? false : [$key, current($arr), 'key' => $key, 'value' => current($arr)];
        next($arr);

        return $result;
    }

    /**
     * Check is item active.
     *
     * @param string $slug  Current slug
     * @param array  $array Active slugs
     *
     * @return bool
     */
    private function isActive($slug, $array)
    {
        return in_array($slug, $array);
    }

    private function addContainerWithIcoIf($ico, $selector, $classBase)
    {
        if (empty($ico) || empty($selector)) {
            return false;
        }

        return '<'.$selector.' class="'.$classBase.' '.$ico.'"></'.$selector.'> ';
    }

    private function addContainerWithSelectorIf($inside, $selector)
    {
        if (empty($selector)) {
            return $inside;
        }

        return '<'.$selector.'>'.$inside.'</'.$selector.'>';
    }
}

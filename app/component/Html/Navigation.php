<?php

namespace Rudolf\Component\Html;

use Rudolf\Component\Helpers\Navigation\MenuItemCollection;

class Navigation
{
    private $rootID = 0;

    private $type;

    private $items = [];

    private $currents = [];

    private $classes = [];

    private $nesting;

    private $before = [];

    private $after = [];

    private $config = [];

    /**
     * Set root ID.
     * 
     * @param id $id ID of element to start create tree. Set 0 to create full tree
     */
    public function setRootID($id)
    {
        $this->rootID = is_numeric($id) ? $id : 0;
    }

    public function getRootID()
    {
        return $this->rootID;
    }

    /**
     * Menu type definited in menu_types table.
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * Set items.
     *
     * @param MenuItemCollection $items
     */
    public function setItems(MenuItemCollection $items)
    {
        $this->menuItemsCollection = $items;
    }

    public function getItems()
    {
        return $this->menuItemsCollection->getByType($this->getType());
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
            $temp = '';
            foreach ($address as $key => $value) {
                $currents[] = ltrim($temp = $temp.'/'.$value, '/');
            }
        }

        $this->currents = $currents;
    }

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
     * Set classes to use in menu.
     *
     * 'classes' (array) 
     *      'root_ul' (string) Main <ul>
     *      `li` (string) Each <li>
     *      'li_active' (string)
     *      'li_with_ul' (string) <li> with <ul>
     *      'li_whitout_ul' (string) <li> without <ul>
     *      'sub_ul' (string) <ul> inside <li>
     */
    public function setClasses(array $classes)
    {
        $this->classes = $classes;
    }

    public function getClasses()
    {
        return array_merge([
            'root_ul' => '',
            'li' => '',
            'li_active' => '',
            'li_with_ul' => '',
            'li_whitout_ul' => '',
            'sub_ul' => '',
        ], $this->classes);
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

    public function getNesting()
    {
        return $this->nesting;
    }

    /**
     * Put string before elements.
     *
     * 'before' (array)
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

    public function getBefore()
    {
        return array_merge([
            'root_ul' => '',
            'first_root_li' => '',
            'li_a' => '',
            'li_a_text' => '',
            'li_with_ul_a' => '',
            'li_with_ul_a_text' => '',
        ], $this->before);
    }

    /**
     * Put string after elements.
     *
     * 'after' (array) Texts after:
     *      'root_ul' (string) Main <ul>
     *      'last_root_li' (string) Last <li> in main <ul>
     *      'li_a' (string) In <li> after <a>
     *      'li_a_text' (string) In <li><a> before text inside
     *      'li_with_ul_a' (string) In <li> with <ul> after <a>
     *      'li_with_ul_a_text' (string) In <li><a> with <ul> after text inside
     */
    public function setAfter(array $after)
    {
        $this->after = $after;
    }

    public function getAfter()
    {
        return array_merge([
            'root_ul' => '',
            'last_root_li' => '',
            'li_a' => '',
            'li_a_text' => '',
            'li_with_ul_a' => '',
            'li_with_ul_a_text' => '',
        ], $this->after);
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

    public function getConfig()
    {
        return array_merge([
            'li_a_text-container' => '',
            'li_a_ico-container' => '',
            'li_a_ico-class_base' => '',
        ], $this->config);
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

            return (!empty($value)) ? ' '.$atribute.'="'.$value.'"' : '';
        }

        return (isset($value) and !empty($value)) ? ' '.$atribute.'="'.trim($value).'"' : '';
    }

    private function addContainerWithSelectorIf($inside, $selector)
    {
        if (empty($selector)) {
            return $inside;
        }

        return '<'.$selector.'>'.$inside.'</'.$selector.'>';
    }

    private function addContainerWithIcoIf($ico, $selector, $classBase)
    {
        if (empty($ico) or empty($selector)) {
            return false;
        }

        return '<'.$selector.' class="'.$classBase.' '.$ico.'"></'.$selector.'> ';
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

    /**
     * Menu creator.
     *
     * @link http://pastebin.com/GAFvSew4
     *
     * @author J. Bruni - original author
     *
     * @return string|bool
     */
    public function create()
    {
        $root_id = $this->getRootID();
        $items = $this->getItems();
        $currents = $this->getCurrents();
        $classes = $this->getClasses();
        $before = $this->getBefore();
        $after = $this->getAfter();
        $nesting = $this->getNesting();
        $config = $this->getConfig();

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
        $parent = $root_id;
        $parent_stack = array();

        $this->html[] = $before['root_ul'];

        // HTML wrapper for the menu (open)
        $this->html[] = sprintf('%1$s'.'<ul'.'%2$s'.'>',
            # %1$s tab if text before
            (!empty($before['root_ul'])) ? str_repeat("\t", $nesting) : '',

            # %2$s root ul class
            $this->isAtribute('class', $classes['root_ul'])
        );

        $this->html[] = (!empty($before['first_root_li'])) ? str_repeat("\t", $nesting + 1).$before['first_root_li'] : '';

        // loop
        while ($loop && (($item = each($children[$parent])) || ($parent > $root_id))) {
            if (is_object($item['value'])) {
                $item = [
                    'id' => $item['value']->getId(),
                    'parent_id' => $item['value']->getParentId(),
                    'title' => $item['value']->getTitle(),
                    'slug' => $item['value']->getSlug(),
                    'caption' => $item['value']->getCaption(),
                    'ico' => $item['value']->getIco(),
                ];
            }

            // HTML for menu item containing childrens (close)
            if ($item === false) {
                $parent = array_pop($parent_stack);
                $this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 + $nesting).'</ul>';
                $this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting).'</li>';
            }

            // HTML for menu item containing childrens (open)
            elseif (!empty($children[$item['id']])) {
                $tab = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting);

                /*
                 * <li> with <ul>
                 */
                $this->html[] = sprintf('%1$s'.'<li'.'%2$s'.'>%3$s<a'
                    .'%4$s'.' href="'.'%5$s'.'">%6$s%7$s'.'%8$s'.'%9$s</a>%10$s',
                    # %1$s tabulation
                    $tab,

                    # %2$s li class (active)
                    $this->isAtribute('class', [
                        $classes['li'],
                        $classes['li_with_ul'],
                        ($this->isActive($item['slug'], $currents)) ? $classes['li_active'] : '',
                    ]),

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
                $this->html[] = sprintf('%1$s'.'<ul'.'%2$s'.'>',
                    # %1$s tabulation
                    $tab."\t",

                    # %2$s sub ul class
                    $this->isAtribute('class', $classes['sub_ul'])
                );

                array_push($parent_stack, $item['parent_id']);
                $parent = $item['id'];
            }

            // HTML for menu item with no children (aka "leaf")
            else {
                $this->html[] = sprintf('%1$s'.'<li'.'%2$s'.'>%3$s<a'
                    .'%4$s'.' href="'.'%5$s'.'">%6$s%7$s'.'%8$s'.'%9$s</a>%10$s',
                    # %1$s tabulation
                    str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting),

                    # %2$s li class (active)
                    $this->isAtribute('class', [
                        $classes['li'],
                        $classes['li_whitout_ul'],
                        ($this->isActive($item['slug'], $currents)) ? $classes['li_active'] : '',
                    ]),

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

        $this->html[] = (!empty($after['last_root_li'])) ? str_repeat("\t", $nesting + 1).$after['last_root_li'] : '';

        // HTML wrapper for the menu (close)
        $this->html[] = str_repeat("\t", $nesting).'</ul>';

        $this->html[] = $after['root_ul'];

        return implode("\n", array_filter($this->html))."\n";
    }
}

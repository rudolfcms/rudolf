<?php

namespace Rudolf\Modules\Appearance\Menu;

use Rudolf\Component\Helpers\Navigation\MenuItem;
use Rudolf\Component\Html\Navigation as BaseNavigation;

class Navigation extends BaseNavigation
{
    /**
     * Menu creator.
     * @link   http://pastebin.com/GAFvSew4
     * @author J. Bruni - original author
     * @return string|bool
     */
    public function create()
    {
        $root_id = $this->getRootID();
        $items   = $this->sortItems($this->getItems());
        $nesting = $this->getNesting();

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

        // HTML wrapper for the menu (open)
        $html[] = '<ul>';

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
                    'position'  => $obj->getPosition(),
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
                    '%1$s'.'<li>%2$s - <a'.'%3$s'.' href="'.'%4$s'.'">%5$s</a> – pozycja: %6$s'.
                    ' <a href="'.DIR.'/admin/appearance/menu/edit-item/%2$s" class="btn btn-primary btn-xs">Edytuj</a>'.
                    ' <a href="'.DIR.'/admin/appearance/menu/del-item/%2$s" class="btn btn-danger btn-xs">Usuń</a>',
                    # %1$s tabulation
                    $tab,

                    $item['id'],

                    # %2$s a title=""
                    $this->isAttribute('title', $item['caption']),

                    # %3$s a href=""
                    $item['slug'],

                    # %4$s text inside item
                    $item['title'],

                    $item['position']
                );

                /*
                 * sub <ul> in <li>
                 */
                $html[] = sprintf(
                    '%1$s'.'<ul>',
                    # %1$s tabulation
                    $tab."\t"
                );

                $parent_stack[] = $item['parent_id'];
                $parent         = $item['id'];
            } // HTML for menu item with no children (aka "leaf")
            else {
                $html[] = sprintf(
                    '%1$s'.'<li>%2$s - <a'.'%3$s'.' href="'.'%4$s'.'">%5$s</a> – pozycja: %6$s'.
                    ' <a href="'.DIR.'/admin/appearance/menu/edit-item/%2$s" class="btn btn-primary btn-sm btn-xs">Edytuj</a>'.
                    ' <a href="'.DIR.'/admin/appearance/menu/del-item/%2$s" class="btn btn-danger btn-sm btn-xs">Usuń</a>',

                    # %1$s tabulation
                    str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting),

                    $item['id'],

                    # %2$s a title=""
                    $this->isAttribute('title', $item['caption']),

                    # %3$s a href=""
                    $item['slug'],

                    # %4$s text inside item
                    $item['title'],

                    $item['position']
                );
            }
        }

        // HTML wrapper for the menu (close)
        $html[] = str_repeat("\t", $nesting).'</ul>';

        return implode("\n", array_filter($html))."\n";
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
}

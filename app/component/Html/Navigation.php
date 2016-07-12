<?php
namespace Rudolf\Component\Html;

use Rudolf\Component\Libs\MenuBuilder;

class Navigation
{
    /**
     * It create page navigation
     * 
     * @param string $type Menu type
     * @param array $items Array of navigation items
     * @param array $currents Current pages slug
     * @param array $classes
     * @param int $nesting
     * @param array $before
     * @param array $after
     * 
     * @return string
     */
    public function createPageNavigation($type, $items, $currents, $classes = '', $nesting = 0, $before = '', $after = '')
    {
        // filter items
        foreach ($items as $key => $value) {
            if ($type === $value['menu_type']) {
                $newItems[$key] = $items[$key];

                if (isset($items[$key]['type'])) {
                    switch ($items[$key]['type']) {
                        case 'absolute':
                            // $newItems[$key];
                            break;
                        case 'app':
                        default:
                            $newItems[$key]['slug'] = DIR . '/' . $value['slug'];
                            break;
                    }
                }
            }
        }

        // add actual app dir to currents slug
        foreach ($currents as $key => $value) {
            $currents[$key] = DIR . '/' . $value;
        }

        if (empty($newItems)) {
            return false;
        }

        // print_r($newItems);

        // sort items
        usort($newItems, [$this, 'sortByPosition']);

        // build menu
        $builder = new MenuBuilder();
        $builder->setParams([
            'root_id' => 0,
            'items' => $newItems,
            'currents' => $currents,
            'classes' => $classes,
            'before' => $before,
            'after' => $after,
            'nesting' => $nesting
        ]);

        return $builder->renderMenu();
    }

    private function sortByPosition($a, $b)
    {
        if (isset($a['position']) and isset($b['position']))
        return $a['position'] - $b['position'];
    }
}

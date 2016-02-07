<?php
/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 */

namespace Rudolf\Libs;

/**
 * This class includes methods for menu builder.
 */
class MenuBuilder {
	/**
	 * Menu items
	 */
	protected $items = array();
	
	/**
	 * HTML contents
	 */
	protected $html  = array();
	
	/**
	 * Build the HTML for the menu 
	 */
	public function getMenuHtml($root_id = 0, $items, $sPrefix = '/', $classes = [], $current = false, $nesting = 0)	{
		$this->html  = array();
		$this->items = $items;
		$nesting = (int) $nesting;

		$rootUlNesting = str_repeat("\t", $nesting);

		foreach ($this->items as $item)
			$children[$item['parent_id']][] = $item;
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty($children[$root_id]);
		
		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();
		
		// HTML wrapper for the menu (open)
		$this->html[] = '<ul>';
		
		while($loop && (($option = each($children[$parent])) || ($parent > $root_id)))	{
			if($option === false) {
				$parent = array_pop($parent_stack);
				
				// HTML for menu item containing childrens (close)
				$this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 + $nesting) . '</ul>';
				$this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting) . '</li>';
			} elseif(!empty($children[$option['value']['id']])) {
				$tab = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting);
				
				// HTML for menu item containing childrens (open)
				$this->html[] = sprintf(
					'%1$s<li%5$s><a %2$shref="%3$s">%4$s</a>',
					$tab,   // %1$s = tabulation
					($option['value']['caption']) ? 'title="'.$option['value']['caption'].'" ' : '', // %2$s = caption title=""
					$sPrefix . $option['value']['slug'],   // %3$s = link (URL)
					$option['value']['title'],   // %4$s = title
					($option['value']['slug'] === $current) ? ' class="'.$classes[0].'"' : ''
				); 

				$ulSub = sprintf('<ul%1$s>', (isset($classes[1])) ? ' class="'.$classes[1].'"' : '');
				$this->html[] = $tab . "\t" . $ulSub;
				
				array_push($parent_stack, $option['value']['parent_id']);
				$parent = $option['value']['id'];
			} else
				// HTML for menu item with no children (aka "leaf") 
				$this->html[] = sprintf(
					'%1$s<li%5$s><a %2$shref="%3$s">%4$s</a></li>',
					str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting),   // %1$s = tabulation
					($option['value']['caption']) ? 'title="'.$option['value']['caption'].'" ' : '', // %2$s = caption title=""
					$sPrefix . $option['value']['slug'],   // %3$s = link (URL)
					$option['value']['title'],   // %4$s = title
					($option['value']['slug'] === $current) ? ' class="'.$classes[0].'"' : ''
				);
		}
		
		// HTML wrapper for the menu (close)
		$this->html[] = $rootUlNesting . '</ul>'."\n";
		
		return implode("\r\n", $this->html);
	}
}

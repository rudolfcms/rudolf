<?php
/**
 * Generate HTML for multi-dimensional menu from MySQL database
 * with ONE QUERY and WITHOUT RECURSION 
 * @author J. Bruni
 */

namespace Rudolf\Component\Libs;

/**
 * This class includes methods for menu builder.
 */
class MenuBuilder {

	/**
	 * @var array $items Menu items
	 */
	private $items = array();
	
	/**
	 * @var array $html HTML contents
	 */
	private $html  = array();

	/**
	 * Set params
	 * 
	 * @param array $params 
	 * 			'root_id' (int) Root ID
	 * 			
	 * 			'items' (array) Menu items
	 * 				'id' (int) Unique item id
	 * 				'parent_id' (int) Parent ID
	 * 				'title' (string) Text in <li><a>
	 * 				'slug' (string) Url in <li><a href="">
	 * 				'caption' (string) Text in <li><a title="">
	 * 			
	 * 			'currents' (array) Active elements slugs
	 * 			
	 * 			'classes' (array) Classes to use in menu
	 * 				'root_ul' (string) Main <ul>
	 * 				'li_with_ul' (string) <li> with <ul>
	 * 				'li_whitout_ul' (string) <li> without <ul>
	 * 				'sub_ul' (string) <ul> inside <li>
	 * 				'li_active' (string)
	 * 			
	 * 			'before' (array) Texts before
	 * 				'root_ul' (string) Main <ul>
	 * 				'first_root_li' (string) First <li> in main <ul>
	 * 				'li_a' (string) In <li> before <a>
	 * 				'li_a_text' (string) In <li><a> before text inside
	 * 				'li_with_ul_a' (string) In <li> with <ul> before <a>
	 * 				'li_with_ul_a_text' (string) In <li><a> with <ul> before text inside
	 * 			
	 * 			'after' (array) Texts after
	 * 				'root_ul' (string) Main <ul>
	 * 				'last_root_li' (string) Last <li> in main <ul>
	 * 				'li_a' (string) In <li> after <a>
	 * 				'li_a_text' (string) In <li><a> before text inside
	 * 				'li_with_ul_a' (string) In <li> with <ul> after <a>
	 * 				'li_with_ul_a_text' (string) In <li><a> with <ul> after text inside
	 * 			
	 * 			'nesting' (int) Menu nesting
	 * 
	 * @return string
	 */
	public function setParams($params) {
		$this->setRootID($params['root_id']);
		$this->setItems($params['items']);
		$this->setCurrents($params['currents']);
		$this->setClasses($params['classes']);
		$this->setBefore($params['before']);
		$this->setAfter($params['after']);
		$this->setNesting($params['nesting']);
	}

	/**
	 * Set root ID
	 * 
	 * @param id $id ID of element to start create tree. Set 0 to create full tree
	 */
	public function setRootID($id) {
		$this->rootID = is_numeric($id) ? $id : 0;
	}

	/**
	 * Set menu items
	 * 
	 * @param array $items
	 */
	public function setItems($items) {
		$this->items = $items;
	}

	/**
	 * Set currents
	 * 
	 * @param array $currents Slugs of current active items
	 */
	public function setCurrents($currents) {
		$this->currents = (array) $currents;
	}

	/**
	 * Set classes
	 * 
	 * @param array $classes Classes to use in menu
	 */
	public function setClasses($classes) {
		$this->classes = (array) $classes;
	}

	/**
	 * Set texts before
	 * 
	 * @param array $before Text before
	 */
	public function setBefore($before) {
		$this->before = (array) $before;
	}

	/**
	 * Set texts after
	 * 
	 * @param array $after
	 */
	public function setAfter($after) {
		$this->after = (array) $after;
	}

	/**
	 * Set nesting
	 * 
	 * @param int $nesting
	 */
	public function setNesting($nesting) {
		$this->nesting = is_numeric($nesting) ? $nesting : 0;
	}

	/**
	 * Get root ID
	 * 
	 * @return int
	 */
	public function getRootID() {
		return $this->rootID;
	}

	/**
	 * Get items
	 * 
	 * @return array
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * Get currents
	 * 
	 * @return array
	 */
	public function getCurrents() {
		return $this->currents;
	}

	/**
	 * Get classes
	 * 
	 * @return array
	 */
	public function getClasses() {
		return array_merge([
			'root_ul' => '',
			'li_with_ul' => '',
			'li_whitout_ul' => '',
			'sub_ul' => '',
			'li_active' => ''
		], $this->classes);
	}

	/**
	 * Get before
	 * 
	 * @return array
	 */
	public function getBefore() {
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
	 * Get after
	 * 
	 * @return array
	 */
	public function getAfter() {
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
	 * Get nesting
	 * 
	 * @return int
	 */
	public function getNesting() {
		return $this->nesting;
	}

	/**
	 * Render menu
	 * 
	 * @return string
	 */
	public function renderMenu() {
		$root_id = $this->getRootID();
		$items = $this->getItems();
		$currents = $this->getCurrents();
		$classes = $this->getClasses();
		$before = $this->getBefore();
		$after = $this->getAfter();
		$nesting = $this->getNesting();

		foreach ($items as $item) {
			if(isset($item['parent_id']))
				$children[$item['parent_id']][] = $item;
		}
		
		// loop will be false if the root has no children (i.e., an empty menu!)
		$loop = !empty($children[$root_id]);
		
		// initializing $parent as the root
		$parent = $root_id;
		$parent_stack = array();

		$this->html[] = $before['root_ul'];

		// HTML wrapper for the menu (open)
		$this->html[] = sprintf('%1$s' . '<ul' . '%2$s' . '>',
			# %1$s tab if text before
			(!empty($before['root_ul'])) ? str_repeat("\t", $nesting) : '',

			# %2$s root ul class
			$this->isAtribute('class', $classes['root_ul'])
		);

		$this->html[] = (!empty($before['first_root_li'])) ? str_repeat("\t", $nesting + 1) . $before['first_root_li'] : '';

		// loop
		while($loop && (($option = each($children[$parent])) || ($parent > $root_id)))	{
			
			// HTML for menu item containing childrens (close)
			if($option === false) {
				$parent = array_pop($parent_stack);
				$this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 + $nesting) . '</ul>';
				$this->html[] = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting) . '</li>';
			}
			
			// HTML for menu item containing childrens (open)
			elseif(!empty($children[$option['value']['id']])) {
				$tab = str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting);

				/*
				 * <li> with <ul>
				 */
				$this->html[] = sprintf('%1$s'.'<li'.'%2$s'.'>%3$s<a'.'%4$s'.' href="'.'%5$s'.'">%6$s'.'%7$s'.'%8$s</a>%9$s',
					# %1$s tabulation
					$tab, 

					# %2$s li class (active)
					$this->isAtribute('class', [
						$classes['li_with_ul'],
						($this->isActive($option['value']['slug'], $currents)) ? $classes['li_active'] : ''
					]),
					
					# %3$s text before li a 
					$before['li_with_ul_a'],
					
					# %4$s a title=""
					$this->isAtribute('title', $option['value']['caption']),
					
					# %5$s a href=""
					$option['value']['slug'],
					
					# %6$s before text in li a
					$before['li_with_ul_a_text'],

					# %7$s text inside item
					$option['value']['title'],
					
					# %8$s after text in li a
					$after['li_with_ul_a_text'],
					
					# %9$s text after li a
					$after['li_with_ul_a']
				);

				/*
				 * sub <ul> in <li>
				 */
				$this->html[] = sprintf('%1$s' . '<ul' . '%2$s' . '>',
					# %1$s tabulation
					$tab ."\t",

					# %2$s sub ul class
					$this->isAtribute('class', $classes['sub_ul'])
				);
				
				array_push($parent_stack, $option['value']['parent_id']);
				$parent = $option['value']['id'];
			} 

			// HTML for menu item with no children (aka "leaf") 
			else {
				$this->html[] = sprintf('%1$s'.'<li'.'%2$s'.'>%3$s<a'.'%4$s'.' href="'.'%5$s'.'">%6$s'.'%7$s'.'%8$s</a>%9$s',
					# %1$s tabulation
					str_repeat("\t", (count($parent_stack) + 1) * 2 - 1 + $nesting),

					# %2$s li class (active)
					$this->isAtribute('class', [
						$classes['li_whitout_ul'],
						($this->isActive($option['value']['slug'], $currents)) ? $classes['li_active'] : ''
					]),
					
					# %3$s text before li a 
					$before['li_a'], 
					
					# %4$s a title=""
					$this->isAtribute('title', $option['value']['caption']),
					
					# %5$s a href=""
					$option['value']['slug'],
					
					# %6$s before text in li a
					$before['li_a_text'],

					# %7$s text inside item
					$option['value']['title'],
					
					# %8$s after text in li a
					$after['li_a_text'],
					
					# %9$s text after li a
					$after['li_a']
				);
			}
		}

		$this->html[] = (!empty($after['last_root_li'])) ? str_repeat("\t", $nesting + 1) . $after['last_root_li'] : '';
		
		// HTML wrapper for the menu (close)
		$this->html[] = str_repeat("\t", $nesting) . '</ul>';

		$this->html[] = $after['root_ul'];
		
		return implode("\r\n", array_filter($this->html)) . "\n";
	}

	/**
	 * Put value is not empty
	 * 
	 * @param string $atribute
	 * @param string|array $value
	 * 
	 * @return string
	 */
	private function isAtribute($atribute, $value) {
		if(is_array($value)) {
			array_filter($value);
			$value = trim(implode(' ', $value));
			return (!empty($value)) ? ' '. $atribute .'="' . $value .'"' : '';
		}
		return (isset($value) and !empty($value)) ? ' '. $atribute .'="' . trim($value) .'"' : '';
	}

	/**
	 * Check is item active
	 * 
	 * @param string $slug Current slug
	 * @param array $array Active slugs
	 * 
	 * @return bool
	 */
	private function isActive($slug, $array) {
		return in_array($slug, $array);
	}
}

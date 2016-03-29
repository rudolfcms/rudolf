<?php

namespace Rudolf\Forms;

class AdminFields {
	
	/**
	 * Returns textarea
	 * 
	 * @param string $content
	 * @param string $name
	 * @param string $class
	 * @param string $id
	 * @param string $placeholder
	 * @param int $cols
	 * @param int $rows
	 * 
	 * @return string
	 */
	public function textarea($content, $name, $class, $id, $placeholder ='', $cols = 30, $rows = 10) {
		$html = sprintf('<textarea name="%2$s" id="%3$s" placeholder="%5$s" cols="%6$s" rows="%7$s">%1$s</textarea>',
			$content, 
			$name,
			$class,
			$id,
			$placeholder,
			$cols,
			$rows
		);

		// to do: add hook

		return $html;
	}

	/**
	 * Returns input type date or datetime
	 * 
	 * @param string $date
	 * @param string $name
	 * @param string $class
	 * @param string $id
	 * @param string $placeholder
	 * 
	 * @return string
	 */
	public function datetimeInput($date, $name, $class, $id, $placeholder = '') {
		$html = sprintf('<input type="datetime" value="%1$s" name="%2$s" class="%3$s" id="%4$s" placeholder="%5$s"/>',
			$date,
			$name,
			$class,
			$id,
			$placeholder
		);

		// to do: add hook

		return $html;
	}

	/**
	 * Returns input with path to file
	 * 
	 * @param $string path
	 * @param string $name
	 * @param string $class
	 * @param string $id
	 * @param string $placeholder
	 * 
	 * @return string
	 */
	public function pathInput($path, $name, $class, $id, $placeholder = '') {
		$html = sprintf('<input type="text" value="%1$s" name="%2$s" class="%3$s" id="%4$s" placeholder="%5$s"/>',
			$date,
			$name,
			$class,
			$id,
			$placeholder
		);

		// to do: add hook

		return $html;
	}
}

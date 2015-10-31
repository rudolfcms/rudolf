<?php

/**
 * This file is part of lcms.
 * 
 * Abstract view.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Abstracts
 * @version 0.1
 */

namespace lcms\Abstracts;

abstract class View {
	public function render($side = 'front', $type = 'html') {
		if('front' !== $side or 'admin' !== $side) {
			$side = 'front';
		}

		switch ($type) {
			case 'json':
				$this->renderJson();
				break;
			
			default:
				$this->renderHtml($side);
				break;
		}
	}

	private function renderHtml($side) {
		$file = LTHEMES_ROOT . '/'. $side .'/'. FRONT_THEME .'/'. 'templates/'. $this->template .'.html.php';
		
		if(is_file($file)) {
			include $file;
		}
	}

	private function renderJson() {
		header('Content-Type: application/json');
		echo json_encode($this->data);
	}
}

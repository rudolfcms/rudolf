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

	public $path;

	public function render($side = 'front', $type = 'html') {
		if('front' !== $side or 'admin' !== $side) {
			$this->side = 'front';
			$this->path = LTHEMES . '/front/' . FRONT_THEME;
		} else {
			$this->side = $side;
		}

		switch ($type) {
			case 'json':
				$this->renderJson();
				break;
			
			default:
				$this->renderHtml();
				break;
		}
	}

	private function renderHtml() {
		$file = LTHEMES_ROOT . '/'. $this->side .'/'. FRONT_THEME . '/templates/' . $this->template .'.html.php';
		
		try {
			if(is_file($file)) {
				include $file;
			} else {
				throw new \ErrorException("Template file $this->template does not exist!");
			}
		} catch (\ErrorException $e) {
			die($e);
		}
	}

	private function renderJson() {
		header('Content-Type: application/json');
		echo json_encode($this->data);
	}
}

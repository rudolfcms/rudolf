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

	/**
	 * @var string Server-side path to theme catalog
	 */
	public $themePath;

	/**
	 * @var object
	 */
	public $theme;

	/**
	 * Render page
	 * 
	 * @param string $side front|admin
	 * @param string $type html|json
	 * 
	 * @return void
	 */
	public function render($side = 'front', $type = 'html') {
		if('front' !== $side or 'admin' !== $side) {
			$this->side = 'front';
		} else {
			$this->side = $side;
		}
		
		$this->themePath = LTHEMES .'/front/'. FRONT_THEME;

		$this->loadConfig();

		switch ($type) {
			case 'json':
				$this->renderJson();
				break;
			
			default:
				$this->renderHtml();
				break;
		}
	}

	/**
	 * Render page in html
	 * 
	 * @return void
	 */
	private function renderHtml() {
		$file = LTHEMES_ROOT .'/'. $this->side .'/'. FRONT_THEME .'/templates/'. $this->template .'.html.php';
		
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

	/**
	 * Render page in json
	 * 
	 * @return void
	 */
	private function renderJson() {
		header('Content-Type: application/json');
		echo json_encode($this->data);
	}
	
	/**
	 * Load theme config class
	 */
	private function loadConfig() {
		$file = LTHEMES_ROOT .'/front/'. FRONT_THEME .'/'. FRONT_THEME .'.php';
		
		if(is_file($file)) {
			include $file;
			$class = ucfirst(FRONT_THEME);
			$this->theme = new $class();
		}
	}
}

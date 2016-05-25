<?php
/**
 * This file is part of Rudolf articles module.
 * 
 * This is the model of articles module.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\Roll
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\Roll;
use Rudolf\Modules\A_front\FView;

class View extends FView {

	public function rollView($data, $pagination) {
		$this->roll = new Roll($data, $pagination);

		$this->template = 'index';
	}
}

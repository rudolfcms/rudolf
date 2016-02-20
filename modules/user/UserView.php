<?php

namespace Rudolf\Modules\user;
use Rudolf\Modules\_admin\AdminView;

class UserView extends AdminView {

	public function userCard() {
		$this->template = 'profile';
	}
}

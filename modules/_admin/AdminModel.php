<?php

namespace Rudolf\Modules\_admin;

class AdminModel extends \Rudolf\Abstracts\Model {
	public function auth() {
		return new \Rudolf\Auth\Auth($this->pdo, $this->prefix);
	}
}

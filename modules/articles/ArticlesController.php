<?php
namespace Modules\articles;
use Modules\articles;

class ArticlesController {
	public function index($page) {
		echo $page;
	}

	public function one($a, $b, $c) {
		echo $a . $b . $c;
	}
}

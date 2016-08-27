<?php

namespace Rudolf\Modules\Search;

use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
	public function search()
	{
        $view = new View();
        $view->search();
        $view->render();
	}
}

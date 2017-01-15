<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\View\HttpErrorFrontView;

class HttpErrorFrontController extends FrontController
{
    public function index()
    {
        // todo: integrate Response with BaseController
        $response = new Response('', 404);
        $response->setHeader(['cache-Control', 'no-cache, must-revalidate']);
        $response->send();

        $view = new HttpErrorFrontView();
        $view->error404();
        $view->render();
    }
}

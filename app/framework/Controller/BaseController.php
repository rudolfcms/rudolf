<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Component\Http\Response;

abstract class BaseController
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    /**
     * Redirect to `up`, if curent page is 1.
     * 
     * @param int $page
     * @param int $code
     * 
     * @return int|redirection
     */
    protected function firstPageRedirect($page, $code = 301, $location = '..')
    {
        if (1 == $page) {
            $this->redirect($location, $code);
        } elseif (0 === $page) {
            return 1;
        }

        return $page;
    }

    protected function redirect($path = DIR, $code = 301, $response = '')
    {
        $response = new Response($response, $code);
        $response->setHeader(['Location', $path]);
        $response->send();
        exit;
    }

    public function redirectTo($path)
    {
        $this->redirect($path);
    }
}

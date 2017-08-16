<?php

namespace Rudolf\Framework\Controller;

use Rudolf\Component\Http\Response;

abstract class BaseController
{
    /**
     * @var string
     */
    protected $request;

    /**
     * BaseController constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;

        if (method_exists($this, 'init')) {
            $this->init();
        }
    }

    /**
     * Redirect to `up`, if current page is 1.
     *
     * @param int $page
     * @param int $code
     *
     * @return int
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

    /**
     * @param string $path
     * @param int $code
     */
    protected function redirect($path = DIR, $code = 301)
    {
        $response = new Response('', $code);
        $response->setHeader(['Location', $path]);
        $response->send();
        exit;
    }

    /**
     * @param string $path
     */
    public function redirectTo($path)
    {
        $this->redirect($path);
    }
}

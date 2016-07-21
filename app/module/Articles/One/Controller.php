<?php

namespace Rudolf\Modules\Articles\One;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
     * Get one article.
     * 
     * @param int    $year
     * @param int    $month
     * @param string $slug
     */
    public function getOne($year, $month, $slug)
    {
        $article = new Model();

        $results = $article->getOneByDate($year, $month, $slug);
        if (false === $results) {
            throw new HttpErrorException('No article found (error 404)', 404);
        }

        $article->addView();

        $view = new View();
        $view->setData($results);
        $view->setFrontData($this->frontData);
        $view->render();
    }
}

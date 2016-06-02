<?php
namespace Rudolf\Modules\Articles\One;

use Rudolf\Modules\A_front\FController;
use Rudolf\Component\Http\HttpErrorException;

class Controller extends FController
{
    /**
     * Get one article
     * 
     * @param int $year
     * @param int $month
     * @param string $slug
     * 
     * @return void
     */
    public function getOne($year, $month, $slug)
    {
        $model = new Model();
        $view = new View();

        $results = $model->getOneByDate($year, $month, $slug);
        if (false === $results) {
            throw new HttpErrorException('No article found (error 404)', 404);
        }

        $model->addView();

        $view->setData($results);
        $view->setFrontData($this->frontData, '');

        $view->render();
    }
}

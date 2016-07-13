<?php
namespace Rudolf\Modules\Albums\One;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\FrontController;

class Controller extends FrontController
{
    /**
     * Get one album
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

        $results = $model->getOneByDate($year, $month, $slug);
        if (false === $results) {
            throw new HttpErrorException('No album found (error 404)', 404);
        }

        $model->addView();

        $response = new Response('', 301);
        $response->setHeader(['Location', $results['album']]);
        $response->send();
        exit;
    }
}

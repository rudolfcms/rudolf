<?php
namespace Rudolf\Modules\Albums\One;

use Rudolf\Modules\A_front\FController;
use Rudolf\Component\Http\Response;
use Rudolf\Component\Http\HttpErrorException;

class Controller extends FController
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

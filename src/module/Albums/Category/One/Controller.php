<?php

namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Albums\Roll\Model as AlbumsList;
use Rudolf\Modules\Categories\One\Model as CategoryInfo;

class Controller extends FrontController
{
    /**
     * Get albums by category.
     *
     * @param string $slug
     * @param int    $page
     *
     * @throws HttpErrorException
     */
    public function getCategory($slug, $page)
    {
        $page = $this->firstPageRedirect($page, 301, '../../'.$slug); // łork eraułnd

        $category = new CategoryInfo();

        $categoryInfo = $category->getCategoryInfo($slug, 'albums');
        if (empty($categoryInfo)) {
            throw new HttpErrorException('Category not found (error 404)', 404);
        }

        $list = new AlbumsList();
        $total = $list->getTotalNumber([
            'published' => 1,
            'category_ID' => $categoryInfo['id'],
        ]);

        $conf = (new Module('albums'))->getConfig();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        if ($pagination->getAllPages() < $page and $pagination->getAllPages() > 1) {
            throw new HttpErrorException('No albums page found (error 404)', 404);
        }

        $results = $list->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        $view = new View();
        $view->setData($results, $pagination, $categoryInfo);
        $view->render();
    }
}

<?php
namespace Rudolf\Modules\Albums\Category\One;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Albums\Roll;
use Rudolf\Modules\Categories;

class Controller extends FrontController
{
    /**
     * Get albums by category
     * 
     * @param string $slug
     * @param int $page
     * 
     * @return void
     */
    public function getCategory($slug, $page)
    {
        $page = $this->firstPageRedirect($page, 301, '../../'. $slug); // łork eraułnd
        
        $categories = new Categories\One\Model();
        
        //$albumsCategory = new Model();
        $list = new Roll\Model();
        $view = new View();

        $categoryInfo = $categories->getCategoryInfo($slug, 'albums');
        if (empty($categoryInfo)) {
            throw new HttpErrorException('Category not found (error 404)', 404);
        }

        $module = new Module('albums');
        $config = $module->getConfig();
        $onPage = $config['on_page'];
        $navNumber = $config['nav_number'];

        $pagination = new Pagination(
            $list->getTotalNumber([
                'published' => 1,
                'category_id' => $categoryInfo['id']
            ]),
            $page, $onPage, $navNumber
        );

        $results = $list->getList($pagination, [$config['sort'], $config['order']]);

        $view->setData($results, $pagination, $categoryInfo);
        $view->setFrontData($this->frontData, 'albums/kategorie/'. $slug);

        $view->render();
    }
}

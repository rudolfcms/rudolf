<?php
namespace Rudolf\Modules\Articles\Category;

use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Component\Modules\Module;
use Rudolf\Modules\A_front\FController;
use Rudolf\Modules\Articles\Roll;
use Rudolf\Modules\Categories;

class Controller extends FController
{
    /**
     * Get articles by category
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
        
        //$articlesCategory = new Model();
        $list = new Roll\Model();
        $view = new View();

        $categoryInfo = $categories->getCategoryInfo($slug, 'articles');
        if (empty($categoryInfo)) {
            throw new HttpErrorException('Category not found (error 404)', 404);
        }

        $module = new Module('articles');
        $config = $module->getConfig();
        $onPage = $config['on_page'];
        $navNumber = $config['nav_number'];

        $pagination = new Pagination($list->getTotalNumber([
                'published' => 1,
                'category_id' => $categoryInfo['id']
            ]), $page, $onPage, $navNumber);

        $results = $list->getList($pagination, [$config['sort'], $config['order']]);

        $view->setData($results, $pagination, $categoryInfo);
        $view->setFrontData($this->frontData, '');

        $view->render();
    }
}

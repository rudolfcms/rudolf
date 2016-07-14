<?php
namespace Rudolf\Modules\Articles\Category\One;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\HttpErrorException;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\Controller\FrontController;
use Rudolf\Modules\Articles\Roll\Model as ArticlesList;
use Rudolf\Modules\Categories\One\Model as CategoriesModel;

class Controller extends FrontController
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

        $categories = new CategoriesModel();

        $categoryInfo = $categories->getCategoryInfo($slug, 'articles');
        if (empty($categoryInfo)) {
            throw new HttpErrorException('Category not found (error 404)', 404);
        }

        $list = new ArticlesList();
        $total = $list->getTotalNumber([
            'published' => 1,
            'category_id' => $categoryInfo['id']
        ]);

        $conf = (new Module('articles'))->getConfig();

        $pagination = new Pagination($total, $page, $conf['on_page'], $conf['nav_number']);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        if ($pagination->getAllPages() < $page) {
            throw new HttpErrorException('No articles page found (error 404)', 404);
        }
        
        $results = $list->getList($limit, $onPage, [$conf['sort'], $conf['order']]);

        $view = new View();
        $view->setData($results, $pagination, $categoryInfo);
        $view->setFrontData($this->frontData, 'artykuly/kategorie/'. $slug);
        $view->render();
    }
}

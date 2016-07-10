<?php
namespace Rudolf\Modules\Articles\Category;

use Rudolf\Modules\A_front\FModel
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;

class Model extends FModel
{
    /**
     * Returns array with article categories list
     *
     * @param int $page
     * @param string|array $where
     * @param array $paginationConfig
     *
     * @return array
     */
    public function getList(Pagination $pagination, $orderBy = ['id', 'desc'])
    {
        // if page number is greater than number of all elements
        if ($pagination->getPageNumber() > $pagination->getAllPages()) {
            //$page = 1;
            return false;
        }

        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $clausule = $this->createWhereClausule(['type'=>'articles']);
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}categories ".
            "WHERE $clausule ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        

        if (!empty($results)) {
            return $results;
        }
        return false;
    }
}
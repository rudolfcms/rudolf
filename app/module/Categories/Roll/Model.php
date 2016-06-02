<?php
namespace Rudolf\Modules\Categories\Roll;

use Rudolf\Component\Abstracts\AModel;
use Rudolf\Component\Libs\Pagination;

class Model extends AModel
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

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}categories ".
            "ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        

        if (!empty($results)) {
            return $results;
        }
        return false;
    }

    /**
     * Returns total number of articles items
     * 
     * @return int
     */
    public function getTotalNumber()
    {
        return $this->countItems('categories');
    }
}

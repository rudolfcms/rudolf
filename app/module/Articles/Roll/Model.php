<?php
namespace Rudolf\Modules\Articles\Roll;

use Rudolf\Modules\Articles;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;

class Model extends Articles\Model
{
    /**
     * @var int Number of all items
     */
    public $total;

    /**
     * Returns array with articles list
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

        $clausule = $this->createWhereClausule($this->where);
        
        $stmt = $this->pdo->prepare($this->queryPart('full') .
            "WHERE $clausule ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

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
     * @param array|string $where
     * 
     * @return int
     */
    public function getTotalNumber($where = ['published'=>1])
    {
        $this->where = $where;
        return $this->countItems('articles', $where);
    }
}

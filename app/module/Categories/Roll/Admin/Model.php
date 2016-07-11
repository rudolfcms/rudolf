<?php
namespace Rudolf\Modules\Categories\Roll\Admin;

use Rudolf\Modules\Categories\Roll;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;

class Model extends Roll\Model
{
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

        $type = $this->where['type'];
        $stmt = $this->pdo->prepare("SELECT category.id, category.title, category.slug,
            COUNT(items.id) as total 

            FROM {$this->prefix}categories as category 
            
            LEFT JOIN {$this->prefix}$type as items ON category.id=items.category_ID

            WHERE category.type = '$type' GROUP BY items.category_ID

            ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage
        ");
        
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }
        return false;
    }

    public function getAll($type)
    {
        $stmt = $this->pdo->prepare("SELECT category.id, category.title, category.slug,
            COUNT(items.id) as total 

            FROM {$this->prefix}categories as category 
            
            LEFT JOIN {$this->prefix}$type as items ON category.id=items.category_ID

            WHERE category.type = '$type' GROUP BY items.category_ID
        ");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }
        return false;
    }
}

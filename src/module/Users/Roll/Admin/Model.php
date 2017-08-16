<?php

namespace Rudolf\Modules\Users\Roll\Admin;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    /**
     * Returns array with users list.
     *
     * @param int   $limit
     * @param int   $onPage
     * @param array $orderBy
     *
     * @return array|bool
     */
    public function getList($limit = 0, $onPage = 10, $orderBy = ['id', 'desc'])
    {
        $stmt = $this->pdo->prepare("
            SELECT user.id,
                   user.nick,
                   user.first_name,
                   user.surname,
                   user.email,
                   user.active,
                   user.dt
            FROM {$this->prefix}users AS user

            ORDER BY $orderBy[0] $orderBy[1] LIMIT $limit, $onPage");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (!empty($results)) {
            return $results;
        }

        return false;
    }

    /**
     * Returns total number of users items.
     *
     * @return int
     */
    public function getTotalNumber()
    {
        return $this->countItems('users');
    }
}

<?php

namespace Rudolf\Modules\Articles\One;

use Rudolf\Modules\Articles;

class Model extends Articles\Model
{
    /**
     * @var array
     */
    private $results;

    /**
     * Returns article data based on year, month and slug.
     *
     * @param int    $year
     * @param int    $month
     * @param string $slug
     *
     * @return bool|array
     */
    public function getOneByDate($year, $month, $slug)
    {
        $stmt = $this->pdo->prepare($this->queryPart('full').
            'WHERE YEAR(article.date) = :year AND MONTH(article.date) = :month AND article.slug = :slug');
        $stmt->bindValue(':year', $year, \PDO::PARAM_INT);
        $stmt->bindValue(':month', $month, \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $slug, \PDO::PARAM_STR);
        $stmt->execute();
        $this->results = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($this->results)) {
            return false;
        }

        return $this->results;
    }

    /**
     * Returns article data based on id.
     *
     * @param int $id
     *
     * @return bool|array
     */
    public function getOneById($id)
    {
        $stmt = $this->pdo->prepare($this->queryPart('full').
            'WHERE article.id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $this->results = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($this->results)) {
            return false;
        }

        return $this->results;
    }

    /**
     * Increment article views.
     */
    public function addView()
    {
        $info = $this->results;

        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}articles SET views = :v
            WHERE id = :id");
        $stmt->bindValue(':v', ++$info['views'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $info['id'], \PDO::PARAM_INT);
        $stmt->execute();
    }
}

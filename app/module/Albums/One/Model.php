<?php
namespace Rudolf\Modules\Albums\One;

use Rudolf\Modules\A_front\Model as FModel;

class Model extends FModel
{
    /**
     * Returns album data based on year, month and slug
     *
     * @param int $year
     * @param int $month
     * @param string $slug
     *
     * @return bool|array
     */
    public function getOneByDate($year, $month, $slug)
    {
        $stmt = $this->pdo->prepare("SELECT album.id, album.album, album.views
            FROM {$this->prefix}albums as album
            WHERE YEAR(album.date) = :year AND MONTH(album.date) = :month AND album.slug = :slug
        ");
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
     * Returns album data based on id
     *
     * @param int $id
     *
     * @return bool|array
     */
    public function getOneById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * WHERE album.id = :id');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $this->results = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($this->results)) {
            return false;
        }

        return $this->results;
    }

    /**
     * Increment album views
     */
    public function addView()
    {
        $info = $this->results;

        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}albums SET views = :v WHERE id = :id");
        $stmt->bindValue(':v', ++$info['views'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $info['id'], \PDO::PARAM_INT);
        $stmt->execute();
    }
}

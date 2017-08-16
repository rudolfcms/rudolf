<?php

namespace Rudolf\Modules\Albums\One;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * @var bool|array
     */
    private $results;

    /**
     * Returns album data based on year, month and slug.
     *
     * @param int    $year
     * @param int    $month
     * @param string $slug
     *
     * @return bool|array
     */
    public function getOneByDate($year, $month, $slug)
    {
        $stmt = $this->pdo->prepare("
            SELECT album.id,
                   album.category_ID,
                   album.title,
                   album.author,
                   album.date,
                   album.added,
                   album.modified,
                   album.adder_ID,
                   album.modifier_ID,
                   album.views,
                   album.slug,
                   album.album,
                   album.thumb,
                   album.photos,
                   album.published,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   adder.email AS adder_email,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname,
                   modifier.email AS modifier_email,
                   category.title AS category_title,
                   category.slug AS category_url
            FROM {$this->prefix}albums AS album
            LEFT JOIN {$this->prefix}users AS adder ON album.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON album.modifier_ID = modifier.id
            LEFT JOIN {$this->prefix}categories AS category ON album.category_ID = category.id
            WHERE YEAR(album.date) = :year
              AND MONTH(album.date) = :month
              AND album.slug = :slug
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
     * Returns album data based on id.
     *
     * @param int $id
     *
     * @return array
     */
    public function getOneById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT album.id,
                   album.category_ID,
                   album.title,
                   album.author,
                   album.date,
                   album.added,
                   album.modified,
                   album.adder_ID,
                   album.modifier_ID,
                   album.views,
                   album.slug,
                   album.album,
                   album.thumb,
                   album.photos,
                   album.published,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   adder.email AS adder_email,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname,
                   modifier.email AS modifier_email,
                   category.title AS category_title,
                   category.slug AS category_url
            FROM {$this->prefix}albums AS album
            LEFT JOIN {$this->prefix}users AS adder ON album.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON album.modifier_ID = modifier.id
            LEFT JOIN {$this->prefix}categories AS category ON album.category_ID = category.id
            WHERE album.id = :id
        ");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $this->results = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $this->results;
    }

    /**
     * Increment album views.
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

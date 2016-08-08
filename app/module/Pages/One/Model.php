<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Framework\Model\FrontModel;

class Model extends FrontModel
{
    /**
     * Returns page id by path.
     * 
     * @param array $path
     * @param array $pages
     * 
     * @return int|bool
     */
    public function getPageIdByPath(array $path, array $pages)
    {
        // temp workaround
        foreach ($pages as $key => $value) {
            $array[$value['slug']][$value['parent_id']] = $value;
        }
        $pages = $array;

        for ($pid = 0, $i = 0; $i < count($path); ++$i) {
            $pidInArray = isset($pages[$path[$i]][$pid]) ? $pages[$path[$i]][$pid] : false;

            if (false === $pidInArray) {
                return false;
            }

            if (isset($pidInArray['parent_id']) && $pid == $pidInArray['parent_id']) {
                $pid = $pidInArray['id'];
            } else {
                return false;
            }
        }

        return $pid;
    }

    /**
     * Returns page data.
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getOneById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT page.id, page.parent_id, page.title, page.content, page.keywords, page.views,
                   page.description, page.published, page.slug, page.added, page.modified,
                   adder.nick AS adder_nick,
                   adder.first_name AS adder_first_name,
                   adder.surname AS adder_surname,
                   modifier.nick AS adder_nick,
                   modifier.first_name AS modifier_first_name,
                   modifier.surname AS modifier_surname
            FROM {$this->prefix}pages as page
            LEFT JOIN {$this->prefix}users AS adder ON page.adder_ID = adder.id
            LEFT JOIN {$this->prefix}users AS modifier ON page.modifier_ID = modifier.id
            WHERE page.id = :id
        ");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }

        return $results[0];
    }

    public function addToPageUrl(array $page, array $pagesList)
    {
        foreach ($pagesList as $key => $value) {
            $pages[$value['id']] = $value;
        }

        $url = $page['slug'];
        $current = $pages[$page['id']];

        if (0 === $current['parent_id']) {
            return $url;
        } else {
            $pid = $page['parent_id'];
            while ($pid != 0) {
                $url = $pages[$pid]['slug'].'/'.$url;
                $pid = $pages[$pid]['parent_id'];
            }
        }

        $page['url'] = DIR.'/'.$url;

        return $page;
    }
}

<?php
namespace Rudolf\Modules\Pages;

use Rudolf\Component\Abstracts\AModel;

class Model extends AModel
{
    
    /**
     * Returns page id by path
     * 
     * @param array $path
     * @param array $pages
     * 
     * @return int|bool
     */
    public function getPageIdByPath($path, $pages = false)
    {
        if (false === $pages) {
            $pages = $this->getPagesList();
        }

        for ($pid = 0, $i = 0; $i < count($path); ++$i) {
            $pidInArray = $pages[$path[$i]][$pid];
            
            if (isset($pidInArray['parent_id']) && $pid == $pidInArray['parent_id']) {
                $pid = $pidInArray['id'];
            } else {
                return false;
            }
        }
        return $pid;
    }

    /**
     * Returns pages list
     * 
     * @return array
     */
    public function getPagesList()
    {
        $stmt = $this->pdo->prepare("SELECT id, parent_id, slug, title, published FROM {$this->prefix}pages");
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();

        if (empty($results)) {
            return false;
        }
        $i = 0;

        foreach ($results as $key => $value) {
            $array[$value['slug']][$value['parent_id']] = array(
                'id' => $value['id'],
                'parent_id' => $value['parent_id'],
                'slug' => $value['slug'],
                'title' => $value['title'],
                'published' => $value['published']
            );
        }

        return $array;
    }

    /**
     * Returns page data
     * 
     * @param int $id
     * 
     * @return array
     */
    public function getPageById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}pages WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
        
        if (empty($results)) {
            return false;
        }
        return $results[0];
    }
}

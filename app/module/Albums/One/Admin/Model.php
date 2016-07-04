<?php
namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Modules\A_admin\AdminModel;
use Rudolf\Component\Alerts;

class Model extends AdminModel
{
    /**
     * Update article by id
     * 
     * @param array $post
     * @param int $id
     * 
     * @return int
     */
    public function update($post, $id)
    {
        $userInfo = self::$auth->getUser();

        $id = $id;
        //$category_ID = (int) $post['category_ID'];
        $f['title'] = (string) $post['title'];
        $f['author'] = (string) $post['author'];
        $f['date'] = (string) $post['date'];
        $f['modified'] = date('Y-m-d H:i:s');
        $f['modifier'] = (int) $userInfo['id'];
        $f['slug'] = (string) $post['slug'];
        $f['album'] = (string) $post['album'];
        $f['thumb'] = (string) $post['thumb'];
        $f['photos'] = (string) $post['photos'];
        $f['published'] = (bool) (!isset($post['published'])) ? 0 : 1;

        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}albums SET 
            title = :title, author = :author, date = :date, modified = :modified,
            modifier_ID = :modifier, slug = :slug, album = :album, thumb = :thumb,
            photos = :photos, published = :published
            WHERE id = :id
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':author', $f['author'], \PDO::PARAM_STR);
        $stmt->bindValue(':date', $f['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':modified', $f['modified'], \PDO::PARAM_STR);
        $stmt->bindValue(':modifier', $f['modifier'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':album', $f['album'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb', $f['thumb'], \PDO::PARAM_STR);
        $stmt->bindValue(':photos', $f['photos'], \PDO::PARAM_INT);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $status = $stmt->execute();

        if ($status) {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'success', 'Udało się zmodyfikować!'
            ));
        } else {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'warning', 'Coś się zepsuło! Wpis nie został zmodyfikowany'
            ));
        }

        return $status;
    }

    /**
     * Delete article
     * 
     * @param int $id Article ID
     */
    public function delete($id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->prefix}albums WHERE id = :id");
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $status = $query->execute();

        if ($status) {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'success', 'Pomyślnie usunięto!'
            ));
        } else {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'warning', 'Coś się zepsuło! Wpis nie został usunięty'
            ));
        }
    }

    /**
     * Add article
     * 
     * @param array $post
     * 
     * @return int Article ID
     */
    public function add($post)
    {
        $userInfo = self::$auth->getUser();

        $f['title'] = (string) $post['title'];
        $f['author'] = (string) $post['author'];
        $f['date'] = (string) $post['date'];
        // $f['modified'] = date('Y-m-d H:i:s');
        // $f['modifier'] = (int) $userInfo['id'];
        $f['added'] = date('Y-m-d H:i:s');
        $f['adder'] = (int) $userInfo['id'];
        $f['slug'] = (string) $post['slug'];
        $f['album'] = (string) $post['album'];
        $f['thumb'] = (string) $post['thumb'];
        $f['photos'] = (string) $post['photos'];
        $f['published'] = (bool) (!isset($post['published'])) ? 0 : 1;

        $stmt = $this->pdo->prepare("INSERT INTO {$this->prefix}albums 
            (title, author, date, added, adder_ID, slug, album, thumb, photos, published) 
            VALUES
            (:title, :author, :date, :added, :adder, :slug, :album, :thumb, :photos, :published)
        ");
        $stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
        $stmt->bindValue(':author', $f['author'], \PDO::PARAM_STR);
        $stmt->bindValue(':date', $f['date'], \PDO::PARAM_STR);
        $stmt->bindValue(':added', $f['added'], \PDO::PARAM_STR);
        $stmt->bindValue(':adder', $f['adder'], \PDO::PARAM_INT);
        $stmt->bindValue(':slug', $f['slug'], \PDO::PARAM_STR);
        $stmt->bindValue(':album', $f['album'], \PDO::PARAM_STR);
        $stmt->bindValue(':thumb', $f['thumb'], \PDO::PARAM_STR);
        $stmt->bindValue(':photos', $f['photos'], \PDO::PARAM_INT);
        $stmt->bindValue(':published', $f['published'], \PDO::PARAM_INT);
        $status = $stmt->execute();

        if ($status) {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'success', 'Udało się dodać!'
            ));
        } else {
            Alerts\AlertsCollection::add(new Alerts\Alert(
                'warning', 'Coś się zepsuło! Nie udało się dodać albumu'
            ));
            return false;
        }

        return $this->pdo->lastInsertId();
    }
}

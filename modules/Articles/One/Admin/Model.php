<?php
/**
 * This file is part of Rudolf Articles module.
 *
 * One article model.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles\One\Admin
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles\One\Admin;
use Rudolf\Modules\A_admin\AdminModel;

class Model extends AdminModel {

	/**
	 * Update article by id
	 * 
	 * @param array $post
	 * @param int $id
	 * 
	 * @return bool
	 */
	public function update($post, $id) {
		$userInfo = self::$auth->getUser();

		$id = $id;
		//$category_ID = (int) $post['category_ID'];
		$f['title'] = (string) $post['title'];
		$f['keywords'] = (string) $post['keywords'];
		$f['description'] = (string) $post['description'];
		$f['content'] = (string) $post['content'];
		$f['author'] = (string) $post['author'];
		$f['date'] = (string) $post['date'];
		$f['modified'] = date('Y-m-d H:i:s');
		$f['modifier'] = (int) $userInfo['id'];
		$f['slug'] = (string) $post['slug'];
		$f['album'] = (string) $post['album'];
		$f['thumb'] = (string) $post['thumb'];
		$f['photos'] = (string) $post['photos'];
		$f['published'] = (bool) (!isset($post['published'])) ? 0 : 1;

		$stmt = $this->pdo->prepare("UPDATE {$this->prefix}articles SET 
			title = :title, keywords = :keywords, description = :description, content = :content,
			author = :author, date = :date, modified = :modified, modifier_ID = :modifier, slug = :slug,
			album = :album, thumb = :thumb, photos = :photos, published = :published
			WHERE id = :id
		");
		$stmt->bindValue(':title', $f['title'], \PDO::PARAM_STR);
		$stmt->bindValue(':keywords', $f['keywords'], \PDO::PARAM_STR);
		$stmt->bindValue(':description', $f['description'], \PDO::PARAM_STR);
		$stmt->bindValue(':content', $f['content'], \PDO::PARAM_STR);
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
		$stmt->execute();

	}
}

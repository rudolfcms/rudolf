<?php
/**
 * This file is part of Rudolf Articles module.
 *
 * Abstract articles model.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Modules\Articles
 * @version 0.1
 */
 
namespace Rudolf\Modules\Articles;
use Rudolf\Abstracts\AModel;

abstract class Model extends AModel {

	/**
	 * Returns part of query
	 * 
	 * @return string
	 */
	protected function queryPart($part) {
		switch ($part) {
			case 'full':
				return "SELECT article.id, article.category_ID, article.title, article.keywords,
					article.description, article.content, article.author, article.date,
					article.added, article.modified, article.adder_ID, article.modifier_ID, article.views,
					article.slug, article.album, article.thumb, article.photos, article.published,

					adder.nick as adder_nick, adder.first_name as adder_first_name,
					adder.surname as adder_surname,	adder.email as adder_email,

					modifier.nick as adder_nick, modifier.first_name as modifier_first_name,
					modifier.surname as modifier_surname, modifier.email as modifier_email,

					category.title as category_title, category.slug as category_url

					FROM {$this->prefix}articles as article

					-- join on adder_ID
					LEFT JOIN {$this->prefix}users as adder ON article.adder_ID = adder.id

					-- join on modifier_ID
					LEFT JOIN {$this->prefix}users as modifier ON article.modifier_ID = modifier.id

					-- join on category_ID
					LEFT JOIN {$this->prefix}categories as category ON article.category_ID = category.id ";
				break;

			default:
				return "SELECT * FROM {$this->prefix}articles ";
			break;
		}
	}
}
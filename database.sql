CREATE TABLE IF NOT EXISTS `lcms_albums` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'category id',
  `title` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `author` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'id in table users',
  `date` datetime NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL COMMENT 'id in table `users`',
  `views` int(11) DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `album` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `thumb` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `photos` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'category id',
  `title` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `author` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'id in table users',
  `date` datetime NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL COMMENT 'id in table `users`',
  `views` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `album` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `thumb` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `photos` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `keywords` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `slug` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` int(11) NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `thumb_width` int(11) NOT NULL,
  `thumb_height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `caption` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `type` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `module_name` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_menu_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;


CREATE TABLE IF NOT EXISTS `lcms_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `keywords` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `description` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `added_by` int(11) NOT NULL COMMENT 'id in table users',
  `added` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL COMMENT 'id in table `users`',
  `views` int(11) DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8_polish_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `lcms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(32) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=0 ;


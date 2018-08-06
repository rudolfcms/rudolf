CREATE TABLE IF NOT EXISTS `rudolf_albums` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adder_ID` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_ID` int(11) unsigned DEFAULT NULL,
  `views` int(11) unsigned DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_articles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_ID` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adder_ID` int(11) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_ID` int(11) unsigned DEFAULT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` int(11) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `homepage_hidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `added` datetime NOT NULL,
  `adder_ID` int(11) unsigned NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_ID` int(11) unsigned DEFAULT NULL,
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_galleries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adder_ID` int(11) NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_ID` int(11) DEFAULT NULL,
  `thumb_width` int(11) NOT NULL,
  `thumb_height` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `item_type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_menu_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `keywords` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `description` varchar(128) CHARACTER SET ucs2 COLLATE ucs2_polish_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adder_ID` int(11) unsigned NOT NULL,
  `added` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `modifier_ID` int(11) DEFAULT NULL,
  `views` int(11) unsigned NOT NULL DEFAULT '0',
  `slug` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nick` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `rudolf_users_sessions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  `expire` datetime NOT NULL,
  `ip` varchar(45) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `cookie` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

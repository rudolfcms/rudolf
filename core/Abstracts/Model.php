<?php

/**
 * This file is part of lcms.
 * 
 * Abstract model.
 * 
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package lcms\Abstracts
 * @version 0.1
 */

namespace lcms\Abstracts;
use \PDO;

abstract class Model {

	protected $pdo;
	protected $prefix;

	private static $db;

	private static $config;

	public function __construct() {
		if(!is_object(self::$db)) {
			self::$config = include LCONFIG_ROOT . '/database.php';
			self::$db = $this->connect();
		}
		$this->pdo = self::$db;
		$this->prefix = self::$config['prefix'];
	}

	private function connect() {

        $dns = self::$config['engine'] 
        	.':dbname='. self::$config['database'] 
        	.';charset='. self::$config['charset'] 
        	.';host='. self::$config['host'];

		$conn = new PDO($dns, self::$config['user'], self::$config['pass']);
		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	}
}

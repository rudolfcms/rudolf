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

	/**
	 * @var object PDO
	 */
	protected $pdo;

	/**
	 * @var string Tables prefix
	 */
	protected $prefix;

	/**
	 * @var object PDO
	 */
	private static $db;

	/**
	 * @var array
	 */
	private static $config;

	/**
	 * Constructor
	 * 
	 * Initialize connection with database
	 */
	public function __construct() {
		if(!is_object(self::$db)) {
			self::$config = include LCONFIG_ROOT . '/database.php';
			self::$db = $this->connect();
		}

		$this->pdo = self::$db;
		$this->prefix = self::$config['prefix'];
	}

	/**
	 * Create connection with database
	 * 
	 * @return object PDO
	 */
	private function connect() {

        $dns = self::$config['engine'] 
        	.':dbname='. self::$config['database'] 
        	.';charset='. self::$config['charset'] 
        	.';host='. self::$config['host'];

		$conn = new PDO($dns, self::$config['user'], self::$config['pass']);
		$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $conn;
	}

	/**
	 * Count items in table
	 * 
	 * @param string $table (without prefix)
	 * @param string|array $where
	 * 
	 * @return int
	 */
	protected function countItems($table, $where = null) {
		$table = $this->prefix . $table;
		$cachedFileName = $table . '_' . md5(json_encode($where));

		$file = LTEMP . '/' . self::$config['engine'] . '/' . $cachedFileName;

		if(is_file($file)) {
			return file_get_contents($file);
		}

		$clausule = null;
		if(is_array($where)) {
			$clausule = 'WHERE ';

			foreach ($where as $key => $value) {
				$condition = $key . '=' . $value . ' and ';
				$clausule .= trim($condition, '0=');
			}

			$clausule = trim($clausule, 'and ');
		} elseif(is_string($where)) {
			$clausule = 'WHERE ' . $where;
		}

		try {
			$stmt = $this->pdo->query("SELECT COUNT(*) as count FROM $table $clausule");
		} catch (\PDOException $e) {
			echo '<pre>Mysql error: ' . $e->getMessage().'</pre>';
			exit;
		}	
		$result = $stmt->fetch(PDO::FETCH_OBJ);

		$fp = fopen($file, 'w');
		fputs($fp, $result->count);
		fclose($fp);

		return $result->count;
	}
}

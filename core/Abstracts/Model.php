<?php
/**
 * This file is part of Rudolf.
 *
 * Abstract model.
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 * @package Rudolf\Abstracts
 * @version 0.1
 */

namespace Rudolf\Abstracts;
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
			self::$config = include CONFIG_ROOT . '/database.php';
			try {
				self::$db = $this->connect();
			} catch (\PDOException $e) {
				die($e);
			}
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

		$file = TEMP . '/' . self::$config['engine'] . '/' . $cachedFileName;

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
			echo '<code>Mysql error: '.$e->getMessage().'<br/><br/>In: '.$e->getFile().' on '.$e->getLine().'</code>';
			exit;
		}	
		$result = $stmt->fetch(PDO::FETCH_OBJ);

		$fp = fopen($file, 'w');
		fputs($fp, $result->count);
		fclose($fp);

		return $result->count;
	}
}

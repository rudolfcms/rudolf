<?php

namespace Rudolf\Framework\Model;

use PDO;
use RuntimeException;

abstract class BaseModel
{
    /**
     * @var PDO
     */
    protected $pdo;

    /**
     * @var string Tables prefix
     */
    protected $prefix;

    /**
     * @var PDO
     */
    private static $db;

    /**
     * @var array
     */
    protected static $config;

    /**
     * Constructor.
     *
     * Initialize connection with database
     */
    public function __construct()
    {
        if (!is_object(self::$db)) {
            self::$config = include CONFIG_ROOT.'/database.php';
            self::$db = $this->connect();
        }

        $this->pdo = self::$db;
        $this->prefix = self::$config['prefix'];
    }

    /**
     * Create connection with database.
     *
     * @return PDO
     */
    private function connect()
    {
        $dns = self::$config['engine']
            .':dbname='.self::$config['database']
            .';charset='.self::$config['charset']
            .';host='.self::$config['host'];

        $conn = new PDO($dns, self::$config['user'], self::$config['pass']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    /**
     * Count items in table.
     *
     * @param string       $table (without prefix)
     * @param string|array $where
     *
     * @return int
     * @throws RuntimeException
     */
    protected function countItems($table, $where = [])
    {
        $table = $this->prefix.$table;
        $cachedFileName = $table.'_'.md5(json_encode($where));

        $file = TEMP_ROOT.'/'.self::$config['engine'].'/'.$cachedFileName;

        if (!file_exists(TEMP_ROOT.'/'.self::$config['engine'])
            && !mkdir(TEMP_ROOT.'/'.self::$config['engine'], 0755)
            && !is_dir(TEMP_ROOT.'/'.self::$config['engine'])) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', TEMP_ROOT.'/'.self::$config['engine']));
        }

        if (is_file($file)) {
            return file_get_contents($file);
        }

        $clause = $this->createWhereClausule($where);

        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS count
            FROM $table
            WHERE $clause
        ");

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $fp = fopen($file, 'wb');
        fwrite($fp, $result->count);
        fclose($fp);

        return $result->count;
    }

    /**
     * Create where clausule for pdo.
     *
     * @param array|string $where
     *
     * @return string
     */
    public function createWhereClausule($where)
    {
        if (is_array($where)) {
            $clause = null;

            foreach ($where as $key => $value) {
                $condition = $key.'=\''.$value.'\' and ';
                $clause .= trim($condition, '0=');
            }

            $clause = trim($clause, 'and ');
        } elseif (is_string($where)) {
            $clause = $where;
        } else {
            $clause = '1=1';
        }

        return $clause;
    }
}

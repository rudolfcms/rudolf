<?php

namespace Rudolf\Framework\Model;

use PDO;

abstract class BaseModel
{
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
     * @return object PDO
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
     */
    protected function countItems($table, $where = null)
    {
        $table = $this->prefix.$table;
        $cachedFileName = $table.'_'.md5(json_encode($where));

        $file = TEMP_ROOT.'/'.self::$config['engine'].'/'.$cachedFileName;

        if (!file_exists(TEMP_ROOT.'/mysql')) {
            mkdir(TEMP_ROOT.'/mysql', 0755);
        }

        if (is_file($file)) {
            return file_get_contents($file);
        }

        $clausule = $this->createWhereClausule($where);

        $stmt = $this->pdo->query("
            SELECT COUNT(*) AS count
            FROM $table
            WHERE $clausule
        ");

        $result = $stmt->fetch(PDO::FETCH_OBJ);

        $fp = fopen($file, 'w');
        fputs($fp, $result->count);
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
            $clausule = null;

            foreach ($where as $key => $value) {
                $condition = $key.'=\''.$value.'\' and ';
                $clausule .= trim($condition, '0=');
            }

            $clausule = trim($clausule, 'and ');
        } elseif (is_string($where)) {
            $clausule = $where;
        } else {
            $clausule = '1=1';
        }

        return $clausule;
    }
}

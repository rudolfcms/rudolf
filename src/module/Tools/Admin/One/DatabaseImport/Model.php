<?php

namespace Rudolf\Modules\Tools\Admin\One\DatabaseImport;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    public function clear()
    {
        $tables = $this->pdo->query('SHOW TABLES');

        foreach ($tables as $table) {
            $this->pdo->exec('DROP TABLE IF EXISTS ' . $table[0]);
        }
    }

    public function import($content)
    {
        $this->pdo->exec($content);

        return substr_count($content, ";\n") + 1;
    }
}

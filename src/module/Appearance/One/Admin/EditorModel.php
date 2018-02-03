<?php

namespace Rudolf\Modules\Appearance\One\Admin;

use Rudolf\Framework\Model\AdminModel;

class EditorModel extends AdminModel
{
    /**
     * @var string
     */
    private $root;

    public function __construct()
    {
        parent::__construct();

        $this->root = THEMES_ROOT.'/front/'.FRONT_THEME.'/';
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function getFilesListByPath($path)
    {
        return array_diff(
            scandir($this->root.$path, SCANDIR_SORT_ASCENDING),
            array('.', '..')
        );
    }

    /**
     * @param string $path
     *
     * @return array
     */
    public function getFileInfo($path)
    {
        $file = $this->root.$path;

        if (!file_exists($file)) {
            $file = $this->root.'templates/_head.html.php';
        }

        return [
            'name' => str_replace($this->root, '', $file),
            'content' => file_get_contents($file),
            'last-modified' => date('Y-m-d H:i:s', filemtime($file)),
            'size' => filesize($file),
            'perms' => decoct(fileperms($file) & 0777),
        ];
    }

    /**
     * @param string $path
     * @param string $data
     *
     * @return bool|int
     */
    public function saveFile($path, $data)
    {
        $file = $this->root.$path;

        if (!file_exists($file) || !is_file($file) || !is_writable($file)) {
            return false;
        }

        return file_put_contents($file, $data, LOCK_EX);
    }
}

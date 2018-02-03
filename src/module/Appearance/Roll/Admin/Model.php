<?php

namespace Rudolf\Modules\Appearance\Roll\Admin;

use Rudolf\Framework\Model\AdminModel;

class Model extends AdminModel
{
    /**
     * @var array
     */
    private $themes;

    public function __construct()
    {
        parent::__construct();

        $this->themes = $this->getThemesList();
    }

    /**
     * @return array
     */
    private function getThemesList()
    {
        return array_diff(
            scandir(THEMES_ROOT.'/front', SCANDIR_SORT_ASCENDING),
            array('.', '..')
        );
    }

    /**
     * @return int
     */
    public function getTotalNumber()
    {
        return count($this->themes);
    }

    /**
     * @param int $limit
     * @param int $onPage
     *
     * @return array
     */
    public function getList($limit, $onPage)
    {
        $array = [];

        if (empty($this->themes)) {
            return $array;
        }

        $i = 1;
        foreach ($this->themes as $key => $value) {
            $path = THEMES_ROOT.'/front/'.$value.'/theme.php';

            if (file_exists($path)) {
                include_once $path;
            }

            $array[] = [
                'id' => $i++,
                'path' => str_replace(['/theme.php', 'public/'], '', $path),
                'name' => $value,
                'description' => $value::DESCRIPTION,
                'full-name' => $value::NAME,
                'author' => $value::AUTHOR,
                'version' => $value::VERSION,
                'active' => FRONT_THEME === $value,
            ];
        }

        return array_slice($array, $limit, $onPage);
    }
}

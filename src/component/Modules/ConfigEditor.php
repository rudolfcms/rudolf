<?php

namespace Rudolf\Component\Modules;

class ConfigEditor
{
    /**
     * @var array
     */
    private $modules;

    public function __construct()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->modules = include CONFIG_ROOT.'/modules.php';
    }

    public function getStatus($name)
    {
        if (isset($this->modules[$name])) {
            return $this->modules[$name];
        }

        return;
    }

    public function save()
    {
        $var_str = var_export($this->modules, true);
        $var = "<?php return $var_str;\n";

        file_put_contents(CONFIG_ROOT.'/modules.php', $var);

        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        $this->refresh();
    }

    /**
     * Activate non-active modules.
     *
     * @param string $name module name
     */
    public function activate($name)
    {
        $this->modules[$name] = 1;
    }

    /**
     * Deactivate active modules.
     *
     * @param string $name module name
     */
    public function deactivate($name)
    {
        $this->modules[$name] = 0;
    }

    /*
     * Refresh modules list, and if find new, merge with modules.php config
     */
    // private function regenerateList()
    // {
    //     foreach (glob($this->path.'/*', GLOB_ONLYDIR) as $dir) {
    //         $modules[str_replace($this->path.'/', '', $dir)] = 0;
    //     }

    //     $this->modules = array_merge($modules, $this->modules);

    //     $this->save();
    // }
}

<?php

namespace Rudolf\Component\Plugins;

class ConfigEditor
{
    /**
     * @var array
     */
    private $plugins;

    public function __construct()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->plugins = include CONFIG_ROOT.'/plugins.php';
    }

    public function getStatus($name)
    {
        if (isset($this->plugins[$name])) {
            return $this->plugins[$name];
        }

        return;
    }

    public function save()
    {
        $var_str = var_export($this->plugins, true);
        $var = "<?php return $var_str;\n";

        file_put_contents(CONFIG_ROOT.'/plugins.php', $var);

        opcache_reset();

        $this->refresh();
    }

    /**
     * Activate non-active plugins.
     *
     * @param string $name module name
     */
    public function activate($name)
    {
        $this->plugins[$name] = 1;
    }

    /**
     * Deactivate active plugins.
     *
     * @param string $name module name
     */
    public function deactivate($name)
    {
        $this->plugins[$name] = 0;
    }

    /*
     * Refresh plugins list, and if find new, merge with plugins.php config
     */
    // private function regenerateList()
    // {
    //     foreach (glob($this->path.'/*', GLOB_ONLYDIR) as $dir) {
    //         $plugins[str_replace($this->path.'/', '', $dir)] = 0;
    //     }

    //     $this->plugins = array_merge($plugins, $this->plugins);

    //     $this->save();
    // }
}

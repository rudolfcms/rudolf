<?php

namespace Rudolf\Component\Modules;

class ConfigEditor
{
    /**
     * @var array
     */
    private $path;

    /**
     * @var array
     */
    private $modules;

    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Acticate non-active modules.
     * 
     * @param string $name module name
     */
    public function activate($name)
    {
        $this->modules[$name] = true;
    }

    /**
     * Deactivate active modules.
     * 
     * @param string $name module name
     */
    public function deactivate($name)
    {
        $this->modules[$name] = false;
    }

    /**
     * Add new module to list.
     * 
     * @param string $name module name
     */
    public function add($name)
    {
        $this->modules[$name] = false;
    }

    /**
     * Delete module from list.
     * 
     * @param string $name module name
     */
    public function delete($name)
    {
        unset($this->modules[$name]);
    }

    /**
     * Refresh modules list, and if find new, merge with modules.php config
     */
    private function regenerateList()
    {
        foreach (glob($this->path.'/*', GLOB_ONLYDIR) as $dir) {
            $modules[str_replace($this->path.'/', '', $dir)] = 0;
        }

        $modules = array_merge($modules, $this->modules);

        $var_str = var_export($modules, true);
        $var = "<?php return $var_str;\n";

        file_put_contents($this->path.'/modules.php', $var);
    }
}

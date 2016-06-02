<?php
namespace Rudolf\Component\Modules;

class ModulesManager
{
    /**
     * holds path to modules directory
     * 
     * @access private
     * 
     * @var string
     */
    private $path;

    /**
     * holds modules list
     * 
     * @access private
     * 
     * @var array
     */
    private $modules;

    /**
     * Constructor
     * 
     * Run modules manager service
     * 
     * @param string $path from-root path to modules directory
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->modules = include $this->path . '/index.php';
    }

    /**
     * Returns the modules array
     * 
     * @return array $modules
     */
    public function getList()
    {
        return $this->modules;
    }

    /**
     * Acticate non-active modules
     * 
     * @param string $name module name
     * 
     * @return void
     */
    public function activate($name)
    {
        $this->modules[$name] = true;

        self::regenerateList();
    }

    /**
     * Deactivate active modules
     * 
     * @param string $name module name
     * 
     * @return void
     */
    public function deactivate($name)
    {
        $this->modules[$name] = false;

        self::regenerateList();
    }

    /**
     * Add new module to list
     * 
     * @param string $name module name
     * 
     * @return void
     */
    public function add($name)
    {
        $this->modules[$name] = false;

        self::regenerateList();
    }

    /**
     * Refresh list modules and add all to list
     * 
     * @return bool
     */
    public function refresh()
    {
        $array = array();

        foreach (glob($this->path . '/*', GLOB_ONLYDIR) as $dir) {
            $dir = str_replace($this->path . '/', '', $dir);
            $array[] = $dir;
        }

        $this->modules = $array;
    }

    /**
     * Delete module from list
     * 
     * @param string $name module name
     * 
     * @return void
     */
    public function delete($name)
    {
        unset($this->modules[$name]);

        self::regenerateList();
    }

    /**
     * Generate modules list and save to index.php file in modules directory
     * 
     * @return void 
     */
    private function regenerateList()
    {
        ksort($this->modules);

        $var_str = var_export($this->modules, true);
        $var = "<?php return $var_str;\n";
        
        file_put_contents($this->path . '/index.php', $var);
    }
}

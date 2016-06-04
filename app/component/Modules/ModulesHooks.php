<?php
namespace Rudolf\Component\Modules;

use Rudolf\Component\Routing\RouteCollection;

class ModulesHooks
{
    private $list;

    public function __construct(array $list, $path = '/modules') {
        $this->modulesList = $list;
        $this->path = $path;
    }

    public function addHooks() {
        for ($i=0; $i < $c = count($this->modulesList); $i++) {
            $file = $this->path . '/' . $this->modulesList[$i] . '/hooks.php';
            
            if (is_file($file)) {
                include $file;
            }
        }
    }
}

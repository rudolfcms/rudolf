<?php

namespace Rudolf\Modules\Appearance;

class ThemeConfigEditor
{
    /**
     * @var array
     */
    private $site;

    public function __construct()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->site = include CONFIG_ROOT.'/site.php';
    }

    public function save()
    {
        $var_str = var_export($this->site, true);
        $var = "<?php return $var_str;\n";

        file_put_contents(CONFIG_ROOT.'/site.php', $var);

        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        $this->refresh();
    }

    /**
     * Activate non-active site.
     *
     * @param string $name module name
     */
    public function setThemeName($name)
    {
        $this->site['front_theme'] = $name;
    }
}

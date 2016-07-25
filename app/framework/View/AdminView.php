<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Helpers\Navigation\MenuItemCollection;
use Rudolf\Component\Html\Breadcrumbs;
use Rudolf\Component\Html\Navigation;
use Rudolf\Component\Modules\Module;

class AdminView extends BaseView
{
    /**
     * @var array
     */
    private static $userInfo;

    private static $menuItemsCollection;

    protected static $request;

    public function __construct()
    {
        $module = new Module('dashboard');
        $this->config = $module->getConfig();

        parent::__construct();
    }

    public static function setAdminData(MenuItemCollection $collection, $request)
    {
        self::$menuItemsCollection = $collection;
        self::$request = $request;
    }

    /**
     * Create page nav.
     *
     * @param string $type
     * @param int    $nesting
     * @param array  $classes
     * @param array  $before
     * @param array  $after
     *
     * @return string
     */
    public function pageNav($type, $nesting = 0, $classes, $before = [], $after = [], $config = [])
    {
        $nav = new Navigation();
        $nav->setType($type);
        $nav->setItems(self::$menuItemsCollection);
        $nav->setCurrent(self::$request);
        $nav->setClasses($classes);
        $nav->setNesting($nesting);
        $nav->setBefore($before);
        $nav->setAfter($after);
        $nav->setConfig($config);

        return $nav->create();
    }

    public function breadcrumb($nesting = 0, $classes = [])
    {
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->setElements($this->getBreadcrumbElements());
        $breadcrumbs->setAddress(explode('/', trim(self::$request, '/')));
        $breadcrumbs->setClasses($classes);
        $breadcrumbs->setNesting($nesting);

        return $breadcrumbs->create($withStart = false);
    }

    private function getBreadcrumbElements()
    {
        $array = [];
        foreach (self::$menuItemsCollection->getAll() as $key => $value) {
            $slug = explode('/', trim($value->getSlug(), '/'));
            $slug = end($slug);
            $array[$slug][$value->getParentId()] = array(
                'id' => $value->getId(),
                'parent_id' => $value->getParentId(),
                'slug' => $slug,
                'title' => $value->getTitle(),
            );
        }
        $array['admin'][0] = array_merge(
            end($array['dashboard']),
            ['id' => 0, 'slug' => 'admin', 'parent_id' => 0, 'title' => 'Admin']
        );
        $overview = end($array['overview']);
        $array['overview'][0] = array_merge(
            $overview,
            ['parent_id' => 0]
        );
        $array['dashboard'][0] = [
            'title' => _('Dashboard'),
            'id' => 0,
            'parent_id' => 0,
            'slug' => 'dashboard'
        ];

        return $array;
    }

    protected function pageTitle()
    {
        return $this->pageTitle;
    }

    public function adminDir()
    {
        return DIR.'/'.$this->config['admin_path'];
    }

    public static function setUserInfo($userInfo)
    {
        self::$userInfo = $userInfo;
    }

    /**
     * @return string
     */
    protected function getUserName()
    {
        return self::$userInfo['first_name'];
    }

    /**
     * @return string
     */
    protected function getUserFullName()
    {
        return self::$userInfo['first_name'].' '.self::$userInfo['surname'];
    }

    /**
     * @return string
     */
    protected function getUserEmail()
    {
        return self::$userInfo['email'];
    }

    /**
     * @return string
     */
    protected function getUserNick()
    {
        return self::$userInfo['nick'];
    }

    /**
     * @return string
     */
    protected function getUserRegisterDate()
    {
        return self::$userInfo['dt'];
    }

    /**
     * Get all alerts.
     *
     * @param array
     */
    protected function alerts($classes = [])
    {
        if (!$this->isAlerts()) {
            return false;
        }

        $classes = array_merge([
            'danger' => 'danger',
            'error' => 'error',
            'warning' => 'warning',
            'success' => 'success',
            'info' => 'info',
        ], $classes);

        $a = AlertsCollection::getAll();

        foreach ($a as $key => $alert) {
            $html[] = $this->alert($alert->getType(), $alert->getMessage(), $classes);
        }

        return implode("\n", $html);
    }

    protected function isAlerts()
    {
        if (AlertsCollection::isAlerts()) {
            return true;
        }

        return false;
    }

    /**
     * Get code for one alert.
     *
     * @param string $type
     * @param string $message
     * @param array  $classes
     *
     * @return string
     */
    protected function alert($type, $message, $classes = '')
    {
        $html[] = sprintf('<div class="alert alert-%1$s %1$s">', $classes[$type]);
        $html[] = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $html[] = sprintf('<strong>%1$s!</strong> %2$s', ucfirst($type), $message);
        $html[] = '</div>';

        return implode('', $html);
    }
}

<?php

namespace Rudolf\Framework\View;

use Rudolf\Component\Alerts\AlertsCollection;
use Rudolf\Component\Forms\AdminFields;
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

    /**
     * @var MenuItemCollection
     */
    private static $menuItemsCollection;

    /**
     * @var string
     */
    protected static $request;

    /**
     * @var array
     */
    private $config;

    /**
     * @var AlertsCollection
     */
    private $alertsCollection;

    /**
     * @var AdminFields
     */
    protected $adminFields;

    /**
     * @var string
     */
    protected $templateType;

    public function init()
    {
        $this->config = (new Module('dashboard'))->getConfig();
        $this->domPlugins->admin();
        $this->alertsCollection = new AlertsCollection();
        $this->adminFields = new AdminFields();
    }

    /**
     * @param MenuItemCollection $collection
     * @param string $request
     */
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
     * @param array  $config
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

    /**
     * @param int $nesting
     * @param array $classes
     * @return bool|string
     */
    public function breadcrumb($nesting = 0, $classes = [])
    {
        $breadcrumbs = new Breadcrumbs();
        $breadcrumbs->setElements($this->getBreadcrumbElements());
        $breadcrumbs->setAddress(explode('/', trim(self::$request, '/')));
        $breadcrumbs->setClasses($classes);
        $breadcrumbs->setNesting($nesting);

        return $breadcrumbs->create($withStart = false);
    }

    /**
     * @return array
     */
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
            'slug' => 'dashboard',
        ];

        return $array;
    }

    /**
     * @return string
     */
    protected function pageTitle()
    {
        return $this->pageTitle;
    }

    /**
     * @return string
     */
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
     * @param array $classes
     *
     * @return string
     */
    protected function alerts($classes = [])
    {
        if (!$this->isAlerts()) {
            return false;
        }

        $classes = array_merge([
            'error' => 'danger',
            'warning' => 'warning',
            'success' => 'success',
            'info' => 'info',
        ], $classes);

        $a = $this->alertsCollection->getAll();

        $html = [];

        foreach ($a as $key => $alert) {
            $html[] = $this->alert($alert->getType(), $alert->getMessage(), $classes);
        }

        return implode("\n", $html);
    }

    /**
     * @return bool
     */
    protected function isAlerts()
    {
        if ($this->alertsCollection->isAlerts()) {
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
    protected function alert($type, $message, $classes = [])
    {
        $html[] = sprintf('<div class="alert alert-%1$s %1$s">', $classes[$type]);
        $html[] = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

        switch ($type) {
            case 'warning':
                $title = _('Warning');
                break;
            case 'success':
                $title = _('Success');
                break;
            case 'info':
                $title = _('Info');
                break;

            case 'error':
            default:
                $title = _('Error');
                break;
        }
        $html[] = sprintf('<strong>%1$s!</strong> %2$s', $title, $message);
        $html[] = '</div>';

        return implode('', $html);
    }
}

<?php
namespace Rudolf\Component\Alerts;

use \Exception;

class AlertsCollection
{
    /**
     * @var array
     */
    private static $collection;

    /**
     * Add alert to collection
     * 
     * @param Alert $alert Alert object
     * 
     * @throws Exception
     * 
     * @return void
     */
    public static function add($alert)
    {
        if (!$alert instanceof IAlert) {
            throw new Exception("Must implement IAlert!");
        }

        self::$collection[] = $alert;
    }

    /**
     * Get alerts by type
     * 
     * @param string $type Alert type
     * 
     * @return Alert array
     */
    public static function getByType($type)
    {
        $collection = self::$collection;

        foreach (self::$collection as $key => $value) {
            if ($type === $value->getType()) {
                $newCollection[] = $value;
            }
        }

        if (empty($newCollection)) {
            return false;
        }

        return $newCollection;
    }

    /**
     * Checks whether were any alert
     * 
     * @return bool
     */
    public static function isAlerts()
    {
        return (bool) !empty(self::$collection);
    }

    /**
     * Delete all alerts
     * 
     * @return void
     */
    public function deleteAll()
    {
        self::$collection = array();
    }

    /**
     * Get all alerts
     * 
     * @return Alert array
     */
    public static function getAll()
    {
        return self::$collection;
    }
}

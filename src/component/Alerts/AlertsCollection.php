<?php

namespace Rudolf\Component\Alerts;

use Exception;

class AlertsCollection
{
    /**
     * @var array
     */
    private static $collection = array();

    /**
     * Construct.
     */
    public function __construct()
    {
        $collectionFromSession = [];

        if (isset($_SESSION['rudolf_alerts'])) {
            foreach ($_SESSION['rudolf_alerts'] as $key => $value) {
                $collectionFromSession[] = new Alert($value['type'], $value['message']);
            }

            self::$collection = array_merge(self::$collection, $collectionFromSession);

            unset($_SESSION['rudolf_alerts']);
        }
    }

    /**
     * Add alert to collection.
     *
     * @param Alert $alert Alert object
     *
     * @throws Exception
     */
    public static function add($alert)
    {
        if (!$alert instanceof IAlert) {
            throw new Exception('Must implement IAlert!');
        }

        self::$collection[] = $alert;
    }

    /**
     * Get alerts by type.
     *
     * @param string $type Alert type
     *
     * @return Alert[]|bool
     */
    public function getByType($type)
    {
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
     * Checks whether were any alert.
     *
     * @return bool
     */
    public function isAlerts()
    {
        return !empty(self::$collection);
    }

    /**
     * Delete all alerts.
     */
    public function deleteAll()
    {
        self::$collection = array();
    }

    /**
     * Get all alerts.
     *
     * @return Alert[]
     */
    public function getAll()
    {
        return self::$collection;
    }
}

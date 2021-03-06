<?php

namespace Rudolf\Tests\Component\Alerts;

use Rudolf\Component\Alerts\Alert;
use Rudolf\Component\Alerts\AlertsCollection;

class AlertsCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testAdd()
    {
        $fakeAlert = new FakeAlert('fake', 'alert');

        $collection = new AlertsCollection();
        $collection::add($fakeAlert);
    }

    /**
     * @throws \Exception
     */
    public function testGetByType()
    {
        $alert[0] = new Alert('info', 'Just info for you');
        $alert[1] = new Alert('info', 'Oranges is orange');

        $collection = new AlertsCollection();
        $collection::add($alert[0]);
        $collection::add($alert[1]);

        $alerts = $collection->getByType('success');

        $this->assertFalse($alerts);
    }

    /**
     * @throws \Exception
     */
    public function testGetByTypeSuccess()
    {
        $alert[0] = new Alert('success', 'Yea! Success every time');
        $alert[1] = new Alert('success', 'Yea! Success again and again');

        $collection = new AlertsCollection();
        $collection::add($alert[0]);
        $collection::add($alert[1]);

        $successAlerts = $collection->getByType('success');

        $this->assertInstanceOf(Alert::class, $successAlerts[0]);
    }

    /**
     * @throws \Exception
     */
    public function testGetByTypeDanger()
    {
        $alert[0] = new Alert('danger', 'May be better');
        $alert[1] = new Alert('danger', 'Oh no');

        $collection = new AlertsCollection();
        $collection::add($alert[0]);
        $collection::add($alert[1]);

        $dangerAlerts = $collection->getByType('danger');

        $this->assertInstanceOf(Alert::class, $dangerAlerts[1]);
    }

    /**
     * @throws \Exception
     */
    public function testIsAlerts()
    {
        $alertSuccess = new Alert('success', 'Yea! All success');

        $collection = new AlertsCollection();
        $collection::add($alertSuccess);

        $this->assertTrue($collection->isAlerts());
    }

    /**
     * @throws \Exception
     */
    public function testGetAll()
    {
        $alert[0] = new Alert('success', 'Yea! All success');
        $alert[1] = new Alert('danger', 'May be better');
        $alert[2] = new Alert('info', 'Oranges is orange');

        $collection = new AlertsCollection();
        $collection->deleteAll();
        $collection::add($alert[0]);
        $collection::add($alert[1]);
        $collection::add($alert[2]);

        $allAlerts = $collection->getAll();

        $this->assertCount(count($allAlerts), $alert);
    }
}

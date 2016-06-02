<?php
use Rudolf\Component\Routing;
use Rudolf\Component\Modules\Module;

$module = new Module('koxy');
$config = $module->getConfig();

$collection->add('koxy', new Routing\Route(
    '(page/<page>)?',
    'Rudolf\Modules\Koxy\Controller',
    array(
        'page' => "[1-9][0-9]*$"
    ),
    array(
        'page' => 0
    ),
    $config['priority']
));

$collection->add('koxy/vote', new Routing\Route(
    'ajax/koxy/vote/<type>',
    'Rudolf\Modules\Koxy\Controller::vote',
    array(
        'name' => "[a-z]+"
    )
));

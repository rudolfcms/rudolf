<?php
use Rudolf\Component\Routing;
use Rudolf\Component\Modules;

$module = new Modules\Module('dashboard');
$config = $module->getConfig();

$collection->add('user/login', new Routing\Route(
    'user/login(/redirect-to/<page>)?',
    'Rudolf\Modules\Users\Login\Controller::login',
    array( // wyrazenia regularne dla parametrow
        'page' => ".*$"
    ),
    array( // wartosci domyslne
        'page' => 'dashboard'
    )
));

$collection->add('user/logout', new Routing\Route(
    'user/logout',
    'Rudolf\Modules\Users\Login\Controller::logout'
));

$collection->add('user/profile', new Routing\Route(
    'user',
    'Rudolf\Modules\Users\Profile\Controller::profile'
));

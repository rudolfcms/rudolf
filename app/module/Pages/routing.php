<?php
use Rudolf\Component\Routing;

$collection->add('pages', new Routing\Route(
    '<page>',
    'Rudolf\Modules\Pages\Controller::page',
    array(
        'page' => "[a-z0-9-\/]*?(?<!\/)$" // without end slash
        //'page' => "[a-z0-9-\/]*?$" // with end slash
    ),
    [],
    2000
));

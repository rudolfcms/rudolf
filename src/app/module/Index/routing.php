<?php

use Rudolf\Component\Routing;

$collection->add('index', new Routing\Route(
    '(page/<page>)?',
    'Rudolf\Modules\Index\Controller',
    array(
        'page' => '[1-9][0-9]*$',
    ),
    array(
        'page' => 0,
    )
));

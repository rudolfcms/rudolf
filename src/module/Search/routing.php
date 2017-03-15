<?php

use Rudolf\Component\Routing\Route;

$collection->add('search/search', new Route(
    'search(/)?',
    'Rudolf\Modules\Search\Controller::search'
));

<?php

use Rudolf\Component\Routing\Route;

$collection->add('search/search', new Route(
    'szukaj/?',
    'Rudolf\Modules\Search\Controller::search'
));

<?php

namespace Rudolf\Modules\Search;

use Rudolf\Framework\View\FrontView;
use Rudolf\Component\Modules\Module;

class View extends FrontView
{
    public function search()
    {
        $this->head->setTitle(_('Search'));
        $this->head->setCanonical(DIR.'/search');
        $this->template = 'search';
    }

    public function searchID()
    {
        return (new Module('search'))->getConfig()['search_id'];
    }
}

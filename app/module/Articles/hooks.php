<?php

use Rudolf\Component\Hooks\Filter;

Filter::add('head_after', function ($after) {
    $after[] = '<link href="'.DIR.'/rss/" rel="alternate" type="application/rss+xml" title="Kanał z artykułami">';

    return $after;
});

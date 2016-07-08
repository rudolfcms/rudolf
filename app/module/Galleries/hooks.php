<?php
namespace Rudolf\Modules\Galleries;

use Rudolf\Component\Hooks;

$galleriesParser = new Parser();
Hooks\Filter::add('content_filter', array($galleriesParser, 'parseContent'));

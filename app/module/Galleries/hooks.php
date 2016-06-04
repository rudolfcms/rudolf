<?php

use Rudolf\Component\Hooks;

function galleryCodeReplasdfasdasasdfjasldkfjlkasdjflkj($content) {
	return str_replace('Dzień', 'asdf', $content);
}

Hooks\Filter::add('content_filter', 'galleryCodeReplasdfasdasasdfjasldkfjlkasdjflkj');

<?php

namespace Rudolf\Component\Helpers\Pagination;

use Rudolf\Component\Html\Head;

class TagsGenerator
{
    private $calc;

    private $head;

    private $path;

    public function __construct(ICalc $calc, Head $head, $path = '')
    {
        $this->calc = $calc;
        $this->head = $head;
        $this->setPath($path);
    }

    public function setPath($path)
    {
        $this->path = str_replace('//', '/', DIR.'/'.$path.'/');
    }

    public function create()
    {
        if ($this->calc->getPrev() > 0) {
            $this->head->setAfter(sprintf(
                '<link rel="prev" href="'.'%1$s'.'page/'.'%2$s'.'">',
                $this->path,
                $this->calc->getPrev()
            ));
        }

        if ($this->calc->getAllPages() >= $this->calc->getNext()) {
            $this->head->setAfter(sprintf(
                '<link rel="next" href="'.'%1$s'.'page/'.'%2$s'.'">',
                $this->path,
                $this->calc->getNext()
            ));
        }
    }
}

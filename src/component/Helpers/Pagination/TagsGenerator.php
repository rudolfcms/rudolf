<?php

namespace Rudolf\Component\Helpers\Pagination;

use Rudolf\Component\Html\Head;

class TagsGenerator
{
    /**
     * @var ICalc
     */
    private $calc;

    /**
     * @var Head
     */
    private $head;

    /**
     * @var string
     */
    private $path;

    /**
     * TagsGenerator constructor.
     * @param ICalc $calc
     * @param Head $head
     * @param string $path
     */
    public function __construct(ICalc $calc, Head $head, $path = '')
    {
        $this->calc = $calc;
        $this->head = $head;
        $this->setPath($path);
    }

    /**
     * @param string $path
     */
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

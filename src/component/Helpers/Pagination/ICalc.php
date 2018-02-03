<?php

namespace Rudolf\Component\Helpers\Pagination;

interface ICalc
{
    public function nav();

    public function getAllPages();

    public function getPrev();

    public function getNext();

    public function getPageNumber();
}

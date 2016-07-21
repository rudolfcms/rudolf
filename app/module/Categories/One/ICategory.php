<?php

namespace Rudolf\Modules\Categories\One;

interface ICategory
{
    public function setData($category);
    public function id();
    public function title();
    public function keywords();
    public function description();
    public function views();
    public function slug();
    public function url();
}

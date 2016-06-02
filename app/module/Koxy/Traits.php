<?php
namespace Rudolf\Modules\Koxy;

trait Traits {
    public function path()
    {
        return $this->article['path'];
    }

    public function likes()
    {
        return $this->article['likes'][0];
    }

    public function dislikes()
    {
        return $this->article['likes'][1];
    }
}

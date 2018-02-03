<?php

namespace Rudolf\Modules\Koxy\One;

class Kox
{
    /**
     * @var array Kox data
     */
    protected $kox;

    /**
     * Constructor.
     *
     * @param array $koxy
     */
    public function __construct(array $koxy = [])
    {
        $this->setData($koxy);
    }

    /**
     * Set koxy data.
     *
     * @param array $kox
     */
    public function setData(array $kox)
    {
        $this->kox = array_merge(
            [
                'path' => '',
                'likes' => [0, 0],
            ],
            $kox
        );
    }

    public function path()
    {
        return $this->kox['path'];
    }

    public function likes()
    {
        return $this->kox['likes'][0];
    }

    public function dislikes()
    {
        return $this->kox['likes'][1];
    }
}

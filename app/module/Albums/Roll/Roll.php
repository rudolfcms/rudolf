<?php
namespace Rudolf\Modules\Albums\Roll;

use Rudolf\Modules\Albums\One\Album;
use Rudolf\Component\Libs\Pagination;
use Rudolf\Component\Html\Navigation;
    
class Roll
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $current = -1;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructor
     * 
     * @param array $data
     * @param Pagination $pagination
     * @param string $path
     */
    public function __construct($data, $pagination, $path = '')
    {
        $this->data = $data;
        $this->pagination = $pagination;
        $this->path = $path;
    }

    /**
     * Chech, is any albums to display
     * 
     * @return bool
     */
    public function isAlbums()
    {
        return is_array($this->data);
    }

    /**
     * Returns number of album to display on page
     * 
     * @return int
     */
    public function total()
    {
        return count($this->data);
    }

    /**
     * Whether there are more posts available in the loop
     *
     * @return bool
     */
    public function haveAlbums()
    {
        if ($this->current + 1 < $this->total()) {
            return true;
        }
        return false;
    }

    /**
     * Set the current album
     *
     * @return void
     */
    public function album()
    {
        $this->current += 1;
        $album = new Album();
        $album->setData($this->data[$this->current]);

        return $album;
    }

    /**
     * Return navigation
     * 
     * @param array $classes
     *      ul
     *      current
     * @param int $navNumber
     * 
     * @return string
     */
    public function nav($classes, $nesting = 2)
    {
        $nav = new Navigation();
        $calculations = $this->pagination->nav();
        
        return $nav->createPagingNavigation($calculations, $this->path, $classes, $nesting);
    }

    /**
     * Checks if pagination is needed
     * 
     * @return bool
     */
    public function isPagination()
    {
        return 1 < $this->pagination->getAllPages();
    }
}

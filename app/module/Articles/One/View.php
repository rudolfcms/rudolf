<?php
namespace Rudolf\Modules\Articles\One;

use Rudolf\Modules\A_front\FView;

class View extends FView
{
    /**
     * Set articles data
     * 
     * @param array $data
     */
    public function setData($data)
    {
        $this->article = new Article($data);

        $this->head->setTitle($this->article->title());

        $this->template = (isset($data['template'])) ? $data['template'] : 'article-once';
    }
}

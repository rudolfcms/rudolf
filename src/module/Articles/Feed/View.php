<?php

namespace Rudolf\Modules\Articles\Feed;

use Rudolf\Component\Feed;
use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Helpers\Pagination\Loop;
use Rudolf\Component\Html\Url;
use Rudolf\Component\Modules\Module;
use Rudolf\Framework\View\FrontView;
use Rudolf\Modules\Articles\One\Article;

class View extends FrontView
{
    /**
     * @var Pagination
     */
    protected $pagination;

    /**
     * @param array $data
     * @param Pagination $pagination
     */
    public function setArticles(array $data, Pagination $pagination)
    {
        $this->data = $data;
        $this->pagination = $pagination;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function rss2()
    {
        /** @var array $config */
        $config = (new Module('articles'))->getConfig();
        $domain = (new Url())->getOrigin();

        $generator = new Feed\RSS2Generator();
        $generator->setTitle($config['feed_title']);
        $generator->setLink($domain.'/rss');
        $generator->setDescription($config['feed_description']);

        $loop = new Loop($this->data, $this->pagination, Article::class);

        $array = [];

        while ($loop->haveItems()) {
            /**
             * @var Article $article
             */
            $article = $loop->item();
            $item = new Feed\RSS2Item();

            $item->setTitle($article->title());
            $item->setLink($domain.$article->url());
            $item->setDescription($article->content());
            $item->setAuthor($article->author());
            $item->setPubDate($article->date('D, d M Y H:i:s T'));
            $array[] = $item->getItem();
        }

        $generator->setItems($array);

        return $generator->generate();
    }

    public function atom()
    {
    }
}

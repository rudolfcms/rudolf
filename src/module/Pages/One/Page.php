<?php

namespace Rudolf\Modules\Pages\One;

use Rudolf\Component\Hooks;
use Rudolf\Component\Html\Text;

class Page
{
    protected $page;

    public function __construct(array $page = [])
    {
        $this->setData($page);
    }

    public function id()
    {
        return $this->page['id'];
    }

    public function setData($page)
    {
        $this->page = array_merge(
            [
                'id' => 0,
                'parent_id' => 0,
                'title' => '',
                'description' => '',
                'keywords' => '',
                'slug' => '',
                'published' => '',
                'content' => '',
                'views' => '',
            ],
            (array) $page
        );
    }

    public function url()
    {
        if (!isset($this->page['url'])) {
            return sprintf(
                '%1$s/%2$s',
                DIR,
                Text::escape($this->page['slug'])
            );
        }

        return $this->page['url'];
    }

    public function modified()
    {
        return $this->page['modified'];
    }

    public function added()
    {
        return $this->page['added'];
    }

    /**
     * Returns page title.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function title($type = '')
    {
        $title = $this->page['title'];
        if ('raw' === $type) {
            return $title;
        }

        return Text::escape($title);
    }

    /**
     * @param bool $truncate
     * @param bool $stripTags
     * @param bool $escape
     * @param bool $raw
     *
     * @return mixed|string
     * @throws \HtmlTruncator\InvalidHtmlException
     */
    public function content($truncate = false, $stripTags = false, $escape = false, $raw = false)
    {
        $content = $this->page['content'];

        if (true === $stripTags) {
            $content = strip_tags($content);
        }

        if (false !== $truncate && strlen($content) > $truncate) {
            $content = Text::truncate($content, $truncate);
        }

        if (true === $escape) {
            $content = Text::escape($content);
        }

        if (false === $raw) {
            $content = Hooks\Filter::apply('content_filter', $content);

            return $content;
        }

        return $content;
    }

    /**
     * Returns the keywords.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function keywords($type = '')
    {
        $keywords = $this->page['keywords'];
        if ('raw' === $type) {
            return $keywords;
        }

        return Text::escape($keywords);
    }

    /**
     * Returns the description.
     *
     * @param string $type
     *
     * @return string
     */
    public function description($type = '')
    {
        $description = $this->page['description'];
        if ('raw' === $type) {
            return $description;
        }

        return Text::escape($description);
    }

    public function views()
    {
        return $this->page['views'];
    }
}

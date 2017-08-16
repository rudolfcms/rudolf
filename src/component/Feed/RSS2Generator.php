<?php

namespace Rudolf\Component\Feed;

/**
 * This file is part of Rudolf articles module.
 *
 * RSS2 Feed generator
 *
 * @see http://cyber.law.harvard.edu/rss/rss.html
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 *
 * @version 0.1
 */
class RSS2Generator
{
    ##################################################################
    ## Required

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     */
    private $description;

    ##################################################################
    ## Optional

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $copyright;

    /**
     * @var string
     */
    private $managingEditor;

    /**
     * @var string
     */
    private $webMaster;

    /**
     * @var string
     */
    private $pubDate;

    /**
     * @var string
     */
    private $lastBuildDate;

    /**
     * @var string
     */
    private $category;

    /**
     * @var string
     */
    private $generator;

    /**
     * @var string
     */
    private $docs;

    /**
     * @var array
     */
    private $cloud;

    /**
     * @var int
     */
    private $ttl;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $rating;

    /**
     * @var string
     */
    private $textInput;

    /**
     * @var string
     */
    private $skipHours;

    /**
     * @var string
     */
    private $skipDays;

    /**
     * @var array
     */
    private $items;

    /**
     * Set channel title.
     *
     * The name of the channel.
     * It's how people refer to your service. If you have an HTML
     * website that contains the same information as your RSS file,
     * the title of your channel should be the same as the title
     * of your website.
     *
     * @example GoUpstate.com News Headlines
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set channel link.
     *
     * The URL to the HTML website corresponding to the channel.
     *
     * @example http://www.goupstate.com/
     *
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * Set channel descritpion.
     *
     * Phrase or sentence describing the channel.
     *
     * @example The latest news from GoUpstate.com, a Spartanburg Herald-Journal Web site.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set channel description.
     *
     * The language the channel is written in.
     * This allows aggregators to group all Italian language sites,
     * for example, on a single page. A list of allowable values for
     * this element, as provided by Netscape, is here [#1]. You may also
     * use values defined [#2] by the W3C.
     *
     * @link http://cyber.law.harvard.edu/rss/languages.html
     * @link http://www.w3.org/TR/REC-html40/struct/dirlang.html#langcodes
     *
     * @example en-us
     *
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Set channel copyright.
     *
     * Copyright notice for content in the channel.
     *
     * @example Copyright 2002, Spartanburg Herald-Journal
     *
     * @param string $copyright
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    /**
     * Set channel managing editor.
     *
     * Email address for person responsible for editorial content.
     *
     * @example geo@herald.com (George Matesky)
     *
     * @param string
     */
    public function setManagingEditor($managingEditor)
    {
        $this->managingEditor = $managingEditor;
    }

    /**
     * Set channel web master.
     *
     * Email address for person responsible for technical issues
     * relating to channel.
     *
     * @example betty@herald.com (Betty Guernsey)
     *
     * @param string
     */
    public function setWebMaster($webMaster)
    {
        $this->webMaster = $webMaster;
    }

    /**
     * Set channel pub date.
     *
     * The publication date for the content in the channel.
     * For example, the New York Times publishes on a daily basis,
     * the publication date flips once every 24 hours. That's when
     * the pubDate of the channel changes. All date-times in RSS conform
     * to the Date and Time Specification of RFC 822, with the exception
     * that the year may be expressed with two characters or four
     * characters (four preferred).
     *
     * @link http://asg.web.cmu.edu/rfc/rfc822.html
     *
     * @example Sat, 07 Sep 2002 00:00:01 GMT
     *
     * @param string $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * Set channel last build date.
     *
     * The last time the content of the channel changed.
     *
     * @example Sat, 07 Sep 2002 09:42:31 GMT
     *
     * @param string $lastBuildDate
     */
    public function setLastBuildDate($lastBuildDate)
    {
        $this->lastBuildDate = $lastBuildDate;
    }

    /**
     * Set channel category.
     *
     * Specify one or more categories that the channel belongs to.
     * Follows the same rules as the <item>-level category element.
     *
     * @link http://cyber.law.harvard.edu/rss/rss.html#ltcategorygtSubelementOfLtitemgt
     * @link http://cyber.law.harvard.edu/rss/rss.html#syndic8
     *
     * @example Newspapers
     *
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Set channel generator.
     *
     * A string indicating the program used to generate the channel.
     *
     * @example MightyInHouse Content System v2.3
     *
     * @param string $generator
     */
    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    /**
     * Set channel docs.
     *
     * A URL that points to the documentation for the format
     * used in the RSS file. It's probably a pointer to this page.
     * It's for people who might stumble across an RSS file on
     * a Web server 25 years from now and wonder what it is.
     *
     * @example http://blogs.law.harvard.edu/tech/rss
     *
     * @param string $docs
     */
    public function setDocs($docs = 'http://blogs.law.harvard.edu/tech/rss')
    {
        $this->docs = $docs;
    }

    /**
     * Set channel cloud.
     *
     * Allows processes to register with a cloud to be notified
     * of updates to the channel, implementing a lightweight
     * publish-subscribe protocol for RSS feeds.
     *
     * @link http://cyber.law.harvard.edu/rss/rss.html#ltcloudgtSubelementOfLtchannelgt
     *
     * @example <cloud
     *               domain="rpc.sys.com"
     *               port="80"
     *               path="/RPC2"
     *               registerProcedure="pingMe"
     *               protocol="soap"
     *          />
     *
     * @param string $domain
     * @param int    $port
     * @param string $path
     * @param string $registerProcedure
     * @param string $protocol
     */
    public function setCloud($domain, $port, $path, $registerProcedure, $protocol)
    {
        $this->cloud = [
            'domain' => $domain,
            'port' => $port,
            'path' => $path,
            'registerProcedure' => $registerProcedure,
            'protocol' => $protocol,
        ];
    }

    /**
     * Set channel ttl.
     *
     * ttl stands for time to live.It's a number of minutes
     * that indicates how long a channel can be cached
     * before refreshing from the source.
     *
     * @link http://cyber.law.harvard.edu/rss/rss.html#ltttlgtSubelementOfLtchannelgt
     *
     * @example 60
     *
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * Set channel image.
     *
     * Specifies a GIF, JPEG or PNG image that can be displayed
     * with the channel.
     *
     * @link http://cyber.law.harvard.edu/rss/rss.html#ltimagegtSubelementOfLtchannelgt
     *
     * @param string $url The URL of a GIF, JPEG or PNG image that represents the channel
     * @param string $title Describes the image, it's used in the ALT attribute of the
     *                      HTML <img> tag when the channel is rendered in HTML
     * @param string $link The URL of the site, when the channel is rendered, the image
     *                      is a link to the site. (Note, in practice the image <title> and <link> should
     *                      have the same value as the channel's <title> and <link>
     * @param int $width
     * @param int $height
     * @param string $description
     */
    public function setImage($url, $title, $link, $width = 88, $height = 31, $description = '')
    {
        $this->image = [
            'url' => $url,
            'title' => $title,
            'link' => $link,
            'width' => $width,
            'height' => $height,
            'description' => $description,
        ];
    }

    /**
     * The PICS rating for the channel.
     *
     * @link http://www.w3.org/PICS/
     *
     * @param
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Set channel text input.
     *
     * Specifies a text input box that can be displayed
     * with the channel.
     *
     * @link http://cyber.law.harvard.edu/rss/rss.html#lttextinputgtSubelementOfLtchannelgt
     *
     * @param string $title       The label of the Submit button in the text input area
     * @param string $description Explains the text input area
     * @param string $name        The name of the text object in the text input area
     * @param string $link        The URL of the CGI script that processes text input requests
     */
    public function setTextInput($title, $description, $name, $link)
    {
        $this->textInput = [
            'title' => $title,
            'description' => $description,
            'name' => $name,
            'link' => $link,
        ];
    }

    /**
     * Set channel skip hours.
     *
     * A hint for aggregators telling them which hours
     * they can skip.
     *
     * @link http://cyber.law.harvard.edu/rss/skipHoursDays.html#skiphours
     *
     * @param array $skipHours
     */
    public function setSkipHours(array $skipHours)
    {
        $this->skipHours = $skipHours;
    }

    /**
     * Set channel skip days.
     *
     * A hint for aggregators telling them which days
     * they can skip.
     *
     * @link http://cyber.law.harvard.edu/rss/skipHoursDays.html#skipdays
     *
     * @param
     */
    public function setSkipDays(array $skipDays)
    {
        $this->skipDays = $skipDays;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * Generate rss canal.
     *
     * @return string
     */
    public function generate()
    {
        $t = "\t"."\t";

        $xml[] = "<?xml version='1.0' encoding='UTF-8'?>";
        $xml[] = '<rss version="2.0">';

        $xml[] = "\t".'<channel>';
        $xml[] = $t.'<title>'.$this->title.'</title>';
        $xml[] = $t.'<link>'.$this->link.'</link>';
        $xml[] = $t.'<description>'.$this->description.'</description>';

        $xml = array_merge($xml, $this->items);

        $xml[] = "\t".'</channel>';
        $xml[] = '</rss>';

        return trim(implode("\n", $xml));
    }
}

<?php

namespace Rudolf\Component\Images;

use PHPixie\Image as ImageManipulator;

class Resizer
{
    private $type = 'internal';
    private $cacheExtension = '.jpg';
    private $cacheDirectory = TEMP_ROOT.'/imageresizer/';
    private $allowedTypes = ['gif', 'png', 'jpeg'];

    /**
     * Constructor.
     */
    public function __construct()
    {
        if (!file_exists($this->cacheDirectory)) {
            mkdir($this->cacheDirectory, 0775);
        }
    }

    /**
     * Run resizer as cache proxy.
     *
     * @param int    $width
     * @param int    $height
     * @param string $src    Base64 encoded url
     */
    public function runAsProxy($width, $height, $src)
    {
        $this->width = $width;
        $this->height = $height;
        $this->src = base64_decode(strtr($src, '-_', '+/='));

        if (true === $this->tryServeCache()) {
            exit;
        }

        if (preg_match('/^https?:\/\/[^\/]+/i', $this->src)) {
            $this->serveExternal();
        } else {
            $this->serveInternal();
        }
    }

    /**
     * Try to serve image from cache.
     *
     * @return bool
     */
    private function tryServeCache()
    {
        $file = $this->createCacheName();
        if (file_exists($file)) {
            return $this->serveFromCache($file);
        }

        return false;
    }

    /**
     * Server image from cache.
     *
     * @param string $file Full path to cache file
     *
     * @return bool
     */
    private function serveFromCache($file)
    {
        header('Content-Type: '.$this->getImageType($file, $returnFull = true));
        echo file_get_contents($file);

        return true;
    }

    /**
     * Create cache file name based on src, width, height end extension.
     *
     * @param bool $onlyFilename
     *
     * @return string
     */
    private function createCacheName($onlyFilename = false)
    {
        $filename = sha1($this->src).'_'.$this->width.'x'.$this->height.$this->cacheExtension;

        if (true === $onlyFilename) {
            return $filename;
        }

        return $this->cacheDirectory.$filename;
    }

    /**
     * Serve image from external location.
     */
    private function serveExternal()
    {
        $cacheFile = $this->createCacheName();

        $manipulator = new ImageManipulator();
        $image = $manipulator->load(file_get_contents($this->src));
        $image->fill($this->width, $this->height, true);
        $image->save($cacheFile);

        $this->serveFromCache($cacheFile);
    }

    /**
     * Serve image from internal location.
     */
    private function serveInternal()
    {
        $file = $this->getAbsoluteInternalPath();

        if (!file_exists($file)) {
            throw new \Exception('Image not found', 1);
        };

        $cacheFile = $this->createCacheName();

        $manipulator = new ImageManipulator();
        $image = $manipulator->read($file);
        $image->fill($this->width, $this->height, true);
        $image->save($cacheFile);

        $this->serveFromCache($cacheFile);
    }

    /**
     * Get image type by mimetype.
     *
     * @param string $file
     *
     * @return string
     */
    public function getImageType($file, $returnFull = false)
    {
        $type = explode('/', mime_content_type($file));

        if ('image' !== $type[0]) {
            throw new \Exception('File is not image!');
        } elseif (!in_array($type[1], $this->allowedTypes)) {
            throw new \Exception('Unacceptable image type!');
        }

        if (true === $returnFull) {
            return implode('/', $type);
        }

        return $type[1];
    }

    /**
     * Get absolute path to internal image.
     *
     * @return string
     */
    private function getAbsoluteInternalPath()
    {
        if (file_exists($this->src)) {
            return $this->src;
        }

        $file = WEB_ROOT.str_replace(DIR, '', $this->src);

        if (file_exists($file)) {
            return $file;
        }

        return $this->src;
    }
}

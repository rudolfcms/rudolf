<?php

namespace Rudolf\Component\Images;

class Resizer
{
    private $type = 'internal';
    private $cacheExtension = '.cache';
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
        // print_r($this->src);
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
        $temp = $this->fetchFromRemote($this->src);
    }

    /**
     * @return string Temp filename
     */
    private function fetchFromRemote($src)
    {
        return;
    }

    /**
     * Serve image from internal location.
     */
    private function serveInternal()
    {
        $file = $this->getAbsoluteInternalPath();

        if (!file_exists($file)) {
            throw new Exception('Image not found', 1);
        };

        $cacheFile = $this->createCacheName();

        // $this->resize($file, $cacheFile, $this->width, $this->height);
        $this->resizeAndCrop($file, $cacheFile, $this->width, $this->height);
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

    /**
     * Resize image and crop.
     *
     * @param string $file   Source image
     * @param string $target Target image filename
     * @param int    $width  New image width
     * @param int    $height New image Height
     *
     * @return bool
     */
    public function resizeAndCrop($file, $target, $width, $height)
    {
        $mimetype = $this->getImageType($file);
        list($newWidth, $newHeight) = getimagesize($file);

        // Loop through until we get the dimensions we want.
        $n = 0;
        while ($newWidth > $width && $newHeight > $height) {
            echo $width;
            $newWidth /= 1.002;
            $newHeight /= 1.002;
            ++$n;
        }
        $newWidth = floor($newWidth);
        $newHeight = floor($newHeight);

        // Create the temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'resizer');

        $this->resize($file, $tempFile, $newWidth, $newHeight);

        // Create images to crop
        $canvas = imagecreatetruecolor($width, $height);

        // for png
        imagealphablending($canvas, false);
        imagesavealpha($canvas, true);

        switch ($mimetype) {
            case 'gif':
                $image = imagecreatefromgif($tempFile);
                break;
            case 'png':
                $image = imagecreatefrompng($tempFile);
                break;
            case 'jpeg':
            default:
                $image = imagecreatefromjpeg($tempFile);
                break;
        }

        imagecopyresampled($canvas, $image, 0, 0, 0, 0, $width, $height, $width, $height);

        // What image are we creating?
        switch ($mimetype) {
            case 'gif':
                imagegif($canvas, $target, 100);
                break;
            case 'png':
                imagepng($canvas, $target, 9);
                break;
            case 'jpeg':
            default:
                imagejpeg($canvas, $target, 100);
                break;
        }
        imagedestroy($canvas);
        imagedestroy($image);

        // Delete the temporary file
        unlink($tempFile);
    }

    /**
     * Resize image.
     *
     * @param string $file   Source image
     * @param string $target Target image filename
     * @param int    $width  New image width
     * @param int    $height New image Height
     *
     * @return bool
     */
    public function resize($file, $target, $width, $height)
    {
        $type = $this->getImageType($file);

        switch ($type) {
            case 'gif':
                $src = imagecreatefromgif($file);
                break;
            case 'png':
                $src = imagecreatefrompng($file);
                break;
            case 'jpeg':
            default:
                $src = imagecreatefromjpeg($file);
                break;
        }

        list($oldWidth, $oldHeight) = getimagesize($file);
        $tmp = imagecreatetruecolor($width, $height);

        // for png
        imagealphablending($tmp, false);
        imagesavealpha($tmp, true);

        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);

        switch ($type) {
            case 'jpg':
                imagejpeg($tmp, $target, 100);
                break;
            case 'jpeg':
                imagejpeg($tmp, $target, 100);
                break;
            case 'gif':
                imagegif($tmp, $target, 100);
                break;
            case 'png':
                imagepng($tmp, $target, 9);
                break;
            case 'wbm':
                imagewbmp($tmp, $target, 100);
                break;
            default:
                imagejpeg($tmp, $target, 100);
                break;
        }
        imagedestroy($src);
        imagedestroy($tmp);

        return true;
    }
}

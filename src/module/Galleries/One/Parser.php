<?php

namespace Rudolf\Modules\Galleries\One;

use Rudolf\Component\Hooks;
use Rudolf\Component\Images\Image;
use Rudolf\Component\Modules\Module;

class Parser
{
    private $allowedExtension = [
        'jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF',
    ];

    /**
     * @var array
     */
    private $config;

    /**
     * Parser constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->config = (new Module('galleries'))->getConfig();
    }

    /**
     * Parse content.
     *
     * @param string $content
     *
     * @return string $content replaced string with gallery code
     */
    public function parseContent($content)
    {
        preg_match_all('/(\{{gallery:.*\}})/sU', $content, $array);

        if (!empty($array[0])) {
            $model = new Model();

            /** @var array[] $array */
            foreach ($array[0] as $gallery) {
                $id = str_replace(['}}', '{{gallery:'], '', $gallery);

                $info = $model->getGalleryInfoById($id);

                $codeGallery = $this->createGallery($info);
                if ($codeGallery) {
                    $content = str_replace(
                        '{{gallery:'.$id.'}}',
                        '<div class="gallery-container">'.$codeGallery.'</div>',
                        $content
                    );
                }
            }
        }

        return $content;
    }

    /**
     * It create gallery code.
     *
     * @param array $info array with gallery information
     * @param bool  $onlyArray
     *
     * @return string|array
     */
    public function createGallery($info, $onlyArray = false)
    {
        $serverPath = $this->config['path_root'].'/'.$info['slug'];
        $webPath = $this->config['path_web'].'/'.$info['slug'];

        $imagesArray = $this->getImagesArray($serverPath);
        if (!$imagesArray) {
            return false;
        }

        if (Hooks\Filter::isHas('images_gallery_viewer')) {
            return Hooks\Filter::apply('images_gallery_viewer', $imagesArray, $info);
        }

        $w = $info['thumb_width'];
        $h = $info['thumb_height'];

        $gallery = [];

        for ($i = 0; $i < $c = count($imagesArray); ++$i) {
            $gallery[] = [
                'photo' => $webPath.'/'.$imagesArray[$i],
                'thumb' => Image::resize($webPath.'/'.$imagesArray[$i], $w, $h),
                'alt' => $imagesArray[$i],
                'width' => $w,
                'height' => $h,
            ];
        }

        if (true === $onlyArray) {
            return $gallery;
        }

        $codeGallery = [];

        foreach ($gallery as $key => $value) {
            $codeGallery[] = sprintf(
                '<a href="%1$s">'.
                    '<img src="%2$s" alt="%3$s" width="%4$s" height="%5$s">'.
                '</a>',
                $value['photo'],
                $value['thumb'],
                $value['alt'],
                $value['width'],
                $value['height']
            );
        }

        return implode("\n", $codeGallery);
    }

    /**
     * It returns array list of gallery images.
     *
     * @param string $imagesDir string with images directory
     *
     * @return array|bool $array array with images list
     */
    private function getImagesArray($imagesDir)
    {
        foreach (glob($imagesDir.'/*') as $file) {
            if (in_array(pathinfo($file)['extension'], $this->allowedExtension)) {
                $array[] = str_replace($imagesDir.'/', '', $file);
            }
        }
        if (empty($array)) {
            return false;
        }
        sort($array);

        return $array;
    }
}

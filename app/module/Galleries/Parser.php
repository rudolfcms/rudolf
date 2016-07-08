<?php
namespace Rudolf\Modules\Galleries;

use Rudolf\Component\Hooks;
use Rudolf\Component\Modules\Module;
use Rudolf\Component\Images\Image;

class Parser
{
    public function __construct()
    {
        $this->image = new Image();

        $module = new Module('galleries');
        $this->config = $module->getConfig();;
    }

    /**
     * Parse content
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

            foreach ($array[0] as $gallery) {
                $id = str_replace('{{gallery:', '', str_replace('}}', '', $gallery));

                $info = $model->getGalleryInfoById($id);

                $galleryCode =  $this->createGallery($info);
                if ($galleryCode) {
                    $content = str_replace('{{gallery:'. $id .'}}',
                        '<div class="gallery-container">'. $galleryCode .'</div>',
                        $content
                    );
                   // $this->info[] = array('url'=>$id, 'name'=> $info['title']);
                }
            }
            //$this->hooks->add_filter('add_admin_top_menu', array($this, 'adminAddons'), 10, 1);
        }
        return $content;
    }

    // public function adminAddons($array)
    // {
    //     if (count($this->info) === 1) {
    //         $array[] =  array(
    //             'name' => 'Edytuj galerię',
    //             'url' => APP_DIR . '/admin/'. $this->config['admin_url'] .'/edit/'. $this->info[0]['url'],
    //             'icon' => 'fa-camera',
    //         );
    //     }
    //     else {
    //         $array[] =  array(
    //             'name' => 'Edytuj galerie',
    //             'url' => APP_DIR . '/admin/'. $this->config['admin_url'] .'/edit',
    //             'icon' => 'fa-camera',
    //             'child' => $this->info
    //         );
    //     }
    //     return $array;
    // }

    /**
     * It create gallery code
     *
     * @param array $info array with gallery information
     *
     * @return string
     */
    public function createGallery($info)
    {
        $path = $this->config['path_root'] . '/' . $info['url'];
        $galleryPath = $this->config['path_web'] . '/' . $info['url'];

        $imagesArray = $this->imagesArray($path);
        if (!$imagesArray) {
            return false;
        }

        // if ($this->hooks->has_filter('images_gallery_viewer')) {
        //  return $this->hooks->apply_filters('images_gallery_viewer', $imagesArray, $info);
        // }
        
        $w = $info['thumb_width'];
        $h = $info['thumb_height'];
        $galleryCode = '';

        for ($i=0; $i < count($imagesArray); $i++) {
            $galleryCode .= sprintf('
                <a href="%1$s" data-group="%2$s">
                    <img src="%3$s" width="%4$s" height="%5$s" alt="%2$s"/>
                </a>',
                $galleryPath . '/photos/' . $imagesArray[$i], // image source
                $imagesArray[$i], // gallery name
                $this->image->resize($galleryPath .'/thumbs/'. $imagesArray[$i], $w, $h), // image path
                $w, // width thumb
                $h // height thumb
            );
        }

        return $galleryCode;
    }

    /**
     * It returns array list of gallery images
     * 
     * @param string $imagesDir string with images directory
     *
     * @return array $array array with images list
     */
    private function imagesArray($imagesDir)
    {
        $imagesDir .= '/thumbs';
        $dir = opendir($imagesDir);

        $allows = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');

        $array = null;

        if (is_dir($imagesDir)) {
            if ($dh = opendir($imagesDir)) {
                while (($file = readdir($dh)) !== false) {
                    if (is_file($imagesDir . '/' . $file) && $file != "." && $file != "..") {
                        $file_info = pathinfo($imagesDir . '/' . $file);
                        if (in_array($file_info['extension'], $allows)) {
                            $array[] = $file;
                        }
                    }
                }
                closedir($dh);
            }
            if (empty($array)) {
                return false;
            }
            sort($array);
            return $array;
        }
        else {
            return false;
        }
    }
}

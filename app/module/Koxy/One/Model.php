<?php
namespace Rudolf\Modules\Koxy\One;

use Rudolf\Component\Abstracts\AModel;

class Model extends AModel
{

    private $extension = 'png';	

    public function vote($type, $post)
    {
        $id = str_replace('.'.$this->extension, '', $post['id']);

        $file = UPLOADS_ROOT . '/moments-db/' . $id . '.txt';

        if (file_exists($file)) {
            $content = file_get_contents($file);
            $contentArray = explode(':', $content);
        } else {
            file_put_contents($file, '0:0');
            $contentArray = [0, 0];
        }
        
        if (!isset($_COOKIE['vote_' . $id])) {
            switch ($type) {
                case 'down':
                    $type = 'down';
                    $contentArray[1]++;
                    break;

                case 'up':
                    $type = 'up';
                    $contentArray[0]++;
                    break;

                default:
                    return ['coś się popsuło'];
                    break;
            }

            file_put_contents($file, implode(':', $contentArray));

            setcookie('vote_' . $id, $type,  time() + (3600 * 24 * 365 * 5), DIR);
        }

        return [
            'up' => $contentArray[0],
            'down' => $contentArray[1]
        ];
    }
}
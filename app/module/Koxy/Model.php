<?php
namespace Rudolf\Modules\Koxy;

use Rudolf\Component\Abstracts\AModel;
use Rudolf\Component\Libs\Pagination;

class Model extends AModel
{
    private $web_root = WEB_ROOT;

    private $extension = 'png';

    public function getList(Pagination $pagination, $orderBy = ['id', 'DESC'])
    {
        // if page number is greater than number of all elements
        if ($pagination->getPageNumber() > $pagination->getAllPages()) {
            //$page = 1;
            return false;
        }

        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $catalog = UPLOADS_ROOT . '/moments/';

        if (($array = glob($catalog  . '*.' . $this->extension)) == false) {
            return false;
        }

        foreach ($array as $key => $value) {
            $a[]['path'] = str_replace($this->web_root, '', $value);
        }

        if ($orderBy[1] === 'DESC') {
            rsort($a);
        }

        $a = array_slice($a, $limit, $onPage);

        foreach ($a as $key => $value) {
            $file = UPLOADS_ROOT . str_replace('.'.$this->extension, '.txt', $value['path']);
            $file = str_replace('content/uploads/moments', 'moments-db', $file);

            if (file_exists($file)) {
                $content = file_get_contents($file);
                $contentArray = explode(':', $content);
                
                $likes[$key]['likes'] = [$contentArray[0], $contentArray[1]];
            } else {
                $likes[$key]['likes'] = [0, 0];
            }
        }

        foreach ($a as $key => $value) {
            $returnArray[$key] = [
                'path' => $value['path'],
                'likes' => $likes[$key]['likes']
            ];
        }

        return $returnArray;
    }

    /**
     * Returns total number of kox items
     * 
     * @return int
     */
    public function getTotalNumber()
    {
        $catalog = UPLOADS_ROOT . '/moments/';

        if (($array = glob($catalog  . '*.' . $this->extension)) != false) {
            return count($array);
        }

        return false;
    }

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

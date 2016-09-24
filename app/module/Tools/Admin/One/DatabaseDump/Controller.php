<?php

namespace Rudolf\Modules\Tools\Admin\One\DatabaseDump;

use Ifsnop\Mysqldump\Mysqldump;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function show()
    {
        if (!empty($_POST)) {
            $opts = [
                'default-character-set' => Mysqldump::UTF8MB4,
            ];

            if (isset($_POST['full'])) {
                $opts['extended-insert'] = false; // item per line
            }

            if (isset($_POST['data'])) {
                $opts['no-create-info'] = true;
                $opts['skip-comments'] = true;
                $opts['exclude-tables'] = ['rudolf_users_sessions'];
            }

            $filename = 'rudolf_dump_'.date('Y-m-d_H-i-s').'.sql';
            $dbconf = include CONFIG_ROOT.'/database.php';
            $dns = $dbconf['engine']
                .':dbname='.$dbconf['database']
                .';charset='.$dbconf['charset']
                .';host='.$dbconf['host'];

            $dump = new Mysqldump($dns, $dbconf['user'], $dbconf['pass'], $opts);
            $dump->start();

            $response = new Response($source = ob_get_contents());
            $response->setHeader(['Content-Type', 'application/octet-stream']);
            $response->setHeader(['Content-Disposition', 'attachment; filename="'.$filename.'"']);
            $response->setHeader(['Content-Length', strlen($source)]);
            $response->send();
            exit;
        }
        $view = new View();
        $view->setData($data = []);
        $view->render('admin');
    }
}

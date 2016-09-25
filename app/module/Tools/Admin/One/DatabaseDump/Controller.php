<?php

namespace Rudolf\Modules\Tools\Admin\One\DatabaseDump;

use MySQLDump;
use mysqli;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;

class Controller extends AdminController
{
    public function show()
    {
        if (isset($_POST['backup'])) {
            $dbconf = include CONFIG_ROOT.'/database.php';
            $dump = new MySQLDump(new mysqli(
                $dbconf['host'],
                $dbconf['user'],
                $dbconf['pass'],
                $dbconf['database'])
            );
            $filename = 'rudolf_'.$dbconf['database'].'_'.date('Y-m-d_H-i-s').'.sql';

            ignore_user_abort(TRUE);

            ob_start();
            $dump->write();
            $source = ob_get_clean();

            $response = new Response();

            if (isset($_POST['gziped'])) {
                ini_set('zlib.output_compression', TRUE);
                $output = gzencode($source, 9);
                $response->setHeader(['Content-Encoding', 'gzip']);
                $response->setHeader(['Content-Type', 'application/x-gzip']);
                $response->setHeader(['Content-Disposition', 'attachment; filename="'.$filename.'.gz"']);
            } else {
                $output = $source;
                $response->setHeader(['Content-Disposition', 'attachment; filename="'.$filename.'"']);
                $response->setHeader(['Content-Type', 'application/sql']);
            }
            $response->setContent($output);
            $response->setHeader(['Connection', 'close']);
            $response->setHeader(['Content-Length', strlen($output)]);
            $response->setHeader(['Expires', gmdate('D, d M Y H:i:s') . ' GMT']);
            $response->setHeader(['Cache-Control', 'no-cache']);

            echo $response->send();
            exit;
        }

        $view = new View();
        $view->setData($data = []);
        $view->render('admin');
    }
}

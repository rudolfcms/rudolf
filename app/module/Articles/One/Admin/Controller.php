<?php
namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Modules\A_admin\AdminController;
use Rudolf\Modules\Articles\One;
use Rudolf\Http\Response;

class Controller extends AdminController
{
    public function edit($id)
    {
        $model = new Model();

        // if data was send
        if (isset($_POST['update'])) {
            $model->update($_POST, $id);
        }

        $one = new One\Model();
        $article = $one->getOneById($id);
        
        $view = new View();
        $view->editArticle($article);
        $view->setActive(['admin/articles']);
        $view->render('admin');
    }

    public function add()
    {
        $model = new Model();

        // if data was send
        if (isset($_POST['add'])) {
            $id = $model->add($_POST);

            if ($id) {
                $location = DIR . '/admin/articles/edit/' . $id;
                $response = new Response('', 301);
                $response->setHeader(['Location', $location]);
                $response->send();
                exit();
            }
        }

        $view = new View();
        $view->addArticle($_POST);
        $view->setActive(['admin/articles', 'admin/articles/add']);
        $view->render('admin');
    }
}

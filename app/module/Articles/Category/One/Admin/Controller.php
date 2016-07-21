<?php

namespace Rudolf\Modules\Articles\Category\One\Admin;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;

class Controller extends AdminController
{
    public function edit($id)
    {
        $model = new One\Model();

        // if data was send
        if (isset($_POST['update'])) {
            $model->update($_POST, $id);
        }

        $category = $model->getCategoryInfoById($id);

        $view = new View();
        $view->edit($category);
        $view->setActive([
            'admin/articles',
            'admin/articles/categories',
        ]);
        $view->render('admin');
    }

    public function add()
    {
        $model = new One\Model();

        // if data was send
        if (isset($_POST['add'])) {
            $id = $model->add($_POST);

            if ($id) {
                $location = DIR.'/admin/articles/edit/'.$id;
                $response = new Response('', 301);
                $response->setHeader(['Location', $location]);
                $response->send();
                exit();
            }
        }

        $view = new View();
        $view->add($_POST);
        $view->setActive([
            'admin/articles',
            'admin/articles/categories',
            'admin/articles/categories/add',
        ]);
        $view->render('admin');
    }
}

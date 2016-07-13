<?php
namespace Rudolf\Modules\Albums\Category\One\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\Roll\Admin as Roll;

class Controller extends AdminController
{
    public function getList($page) {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');
        
        $list = new Roll\Model();
        $pagination = new Pagination($list->getTotalNumber(['type'=>'albums']), $page);
        $results = $list->getList($pagination);

        $view = new View();

        $view->setData($results, $pagination);

        $view->setActive([
            'admin/albums',
            'admin/albums/categories',
            'admin/albums/categories/list'
        ]);

        $view->render('admin');
    }

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
            'admin/albums',
            'admin/albums/categories'
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
                $location = DIR . '/admin/albums/edit/' . $id;
                $response = new Response('', 301);
                $response->setHeader(['Location', $location]);
                $response->send();
                exit();
            }
        }

        $view = new View();
        $view->add($_POST);
         $view->setActive([
            'admin/albums',
            'admin/albums/categories',
            'admin/albums/categories/add'
        ]);
        $view->render('admin');
    }
    
    public function redirect()
    {
        $response = new Response('', 301);
        $response->setHeader(['Location', DIR . '/admin/albums/categories/list']);
        $response->send();
        exit;
    }
}

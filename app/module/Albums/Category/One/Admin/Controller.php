<?php

namespace Rudolf\Modules\Albums\Category\One\Admin;

use Rudolf\Component\Helpers\Pagination\Calc as Pagination;
use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Categories\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as AlbumsList;

class Controller extends AdminController
{
    public function getList($page)
    {
        $page = $this->firstPageRedirect($page, 301, $location = '../../list');

        $list = new AlbumsList();
        $total = $list->getTotalNumber(['type' => 'albums']);

        $pagination = new Pagination($total, $page);
        $limit = $pagination->getLimit();
        $onPage = $pagination->getOnPage();

        $results = $list->getList($limit, $onPage);

        $view = new View();
        $view->setData($results, $pagination);
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
        $view->render('admin');
    }

    public function add()
    {
        $model = new One\Model();

        // if data was send
        if (isset($_POST['add'])) {
            $id = $model->add($_POST);

            if ($id) {
                $this->redirect(DIR.'/admin/albums/edit/'.$id);
            }
        }

        $view = new View();
        $view->add($_POST);
        $view->render('admin');
    }
}

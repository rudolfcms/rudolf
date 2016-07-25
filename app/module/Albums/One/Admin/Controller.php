<?php

namespace Rudolf\Modules\Albums\One\Admin;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Albums\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class Controller extends AdminController
{
    public function edit($id)
    {
        $model = new Model();
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('albums');

        // if data was send
        if (isset($_POST['update'])) {
            $model->update($_POST, $id);
        }

        $one = new One\Model();
        $album = $one->getOneById($id);

        $view = new View();
        $view->editAlbum($album);
        $view->setCategories($categoriesList);
        $view->render('admin');
    }

    public function del($id)
    {
        $model = new Model();

        // if data was send
        if (isset($_POST['delete'])) {
            $model->delete($id);
        }

        $one = new One\Model();
        $album = $one->getOneById($id);

        $view = new View();
        $view->delAlbum($album);
        $view->render('admin');
    }

    public function add()
    {
        $model = new Model();
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('albums');

        // if data was send
        if (isset($_POST['add'])) {
            $id = $model->add($_POST);

            if ($id) {
                $this->redirect(DIR.'/admin/albums/edit/'.$id);
            }
        }

        $view = new View();
        $view->addAlbum($_POST);
        $view->setCategories($categoriesList);
        $view->render('admin');
    }
}

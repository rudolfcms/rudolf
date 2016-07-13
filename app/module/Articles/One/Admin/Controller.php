<?php
namespace Rudolf\Modules\Articles\One\Admin;

use Rudolf\Component\Http\Response;
use Rudolf\Framework\Controller\AdminController;
use Rudolf\Modules\Articles\One;
use Rudolf\Modules\Categories\Roll\Admin\Model as CategoriesRoll;

class Controller extends AdminController
{
    public function edit($id)
    {
        $model = new Model();
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('articles');

        // if data was send
        if (isset($_POST['update'])) {
            $model->update($_POST, $id);
        }

        $one = new One\Model();
        $article = $one->getOneById($id);
        
        $view = new View();
        $view->editArticle($article);
        $view->setCategories($categoriesList);
        $view->setActive(['admin/articles']);
        $view->render('admin');
    }

    public function del($id) {
        $model = new Model();

        // if data was send
        if (isset($_POST['delete'])) {
            $model->delete($id);
        }

        $one = new One\Model();
        $article = $one->getOneById($id);
        
        $view = new View();
        $view->delArticle($article);
        $view->setActive(['admin/articles']);
        $view->render('admin');
    }

    public function add()
    {
        $model = new Model();
        $categories = new CategoriesRoll();
        $categoriesList = $categories->getAll('articles');

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
        $view->setCategories($categoriesList);
        $view->setActive(['admin/articles', 'admin/articles/add']);
        $view->render('admin');
    }
}

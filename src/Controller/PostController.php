<?php

namespace App\Controller;


use App\Core\BaseController;
use App\Core\Request;
use App\Core\View;
use App\Model\CommentModel;
use App\Model\PostModel;

class PostController extends BaseController
{
    // TODO delete
    /** @var PostModel|null */
    private $model = null;

    public function __construct()
    {
        $this->model = new PostModel();
    }

    public function indexAction($prams = [], Request $request)
    {
        $posts = $this->model->getAll();
        return View::render(['posts' => $posts]);
    }


    public function detailsAction($prams = [], Request $request)
    {
        $commentModel = new CommentModel();

        $id = isset($prams['id']) ? $prams['id'] : null;
        $post = $this->model->getById($id);
        $comments = $commentModel->getByPostId($id);
        return View::render(['post' => $post,'comments'=>$comments]);
    }
}

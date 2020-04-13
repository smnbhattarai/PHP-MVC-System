<?php

namespace App\Controllers;

use \Core\View;
use App\Models\Post;

class Posts extends \Core\Controller
{

    public function indexAction()
    {
        $posts = Post::getAll();
        View::renderTemplate('Posts/index.html', ['posts' => $posts]);
    }

    public function addNewAction()
    {

    }

    public function editAction()
    {

    }

}
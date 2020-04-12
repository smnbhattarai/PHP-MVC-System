<?php

namespace App\Controllers;

class Posts extends \Core\Controller
{

    public function indexAction()
    {
        echo "Hello from index of posts.<hr>";
        echo htmlspecialchars(print_r($_GET, true));
    }

    public function addNewAction()
    {
        echo 'Hello from addNew on Posts';

    }

    public function editAction()
    {
        echo 'Hello from Posts edit. <hr>';
        echo htmlspecialchars(print_r($this->route_params, true));
    }

}
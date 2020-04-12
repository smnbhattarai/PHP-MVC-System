<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{
    public function indexAction()
    {
        View::render('Home/index.php', ['name' => 'John Doe', 'colors' => ['red', 'green', 'blue']]);
    }

    protected function before()
    {
        //echo "{before} ";
    }

    protected function after()
    {
        //echo " {after}";
    }
}
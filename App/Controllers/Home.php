<?php

namespace App\Controllers;

class Home extends \Core\Controller
{
    public function indexAction()
    {
        echo "Hello from index action of Home controller";
    }

    protected function before()
    {
        echo "{before} ";
    }

    protected function after()
    {
        echo " {after}";
    }
}
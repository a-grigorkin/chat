<?php

namespace core\controllers;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view('index');
    }
}
<?php

namespace core\controllers;

abstract class Controller
{
    protected $_router;

    public function __construct($router)
    {
        $this->_router = $router;
    }

    protected function view($view)
    {
        require_once __DIR__ . '/../../views/' . $view . '.php';
    }
}
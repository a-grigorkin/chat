<?php

namespace core;

class Router
{
    private $params;

    public function __construct()
    {
        $path = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
        $this->params = array_slice($path, 3);

        switch ($path[1])
        {
            case 'chat':
                $controller = '\core\controllers\\' . ucfirst($path[1]) . 'Controller';
                break;

            default:
                $controller = '\core\controllers\\' . 'IndexController';
        }

        $controller = new $controller($this);

        if (array_key_exists(2, $path))
        {
            $action = $path[2] . 'Action';
        }
        else
        {
            $action = 'indexAction';
        }

        $controller->$action();
    }

    /**
     * Returns a query string parameter value or false.
     *
     * @param $n
     * @return $this->params[$n]
     * @return false
     */
    public function getParam($n)
    {
        return isset($this->params[$n]) ? $this->filter($this->params[$n]) : false;
    }

    /**
     * Returns a specific $_POST value or false.
     *
     * @param $k
     * @return $_POST[$k]
     * @return false
     */
    public function postParam($k)
    {
        return isset($_POST[$k]) ? $this->filter($_POST[$k]) : false;
    }

    /**
     * Prevents XSS attacks.
     *
     * @param $str
     * @param bool $isTrim
     * @return string
     */
    private function filter($str, $isTrim = true)
    {
        $str = htmlspecialchars(strip_tags($str));

        if ($isTrim)
        {
            $str = trim($str);
        }

        return $str;
    }
}
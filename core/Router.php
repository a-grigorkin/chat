<?php

namespace core;

class Router
{
    // Action parameters.
    private $params = array();

    /**
     * Router constructor.
     */
    public function __construct()
    {
        // Split the query string into parts...
        $path = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
        // ...and extract action parameter values.
        $this->params = array_slice($path, 3);

        // Select a controller class.
        switch ($path[1])
        {
            case 'chat':
                $controller = '\core\controllers\\' . ucfirst($path[1]) . 'Controller';
                break;

            default:
                $controller = '\core\controllers\\' . 'IndexController';
        }

        // Select an action method.
        if (array_key_exists(2, $path))
        {
            $action = $path[2] . 'Action';
        }
        else
        {
            $action = 'indexAction';
        }

        // Create a controller based on the selected class.
        $controller = new $controller($this);

        // Call the controller's action method.
        $controller->$action();
    }

    /**
     * Returns a query string parameter value or false.
     *
     * @param $n
     * @return $this->params[$n]
     * @return false
     */
    public function GET($n)
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
    public function POST($k)
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
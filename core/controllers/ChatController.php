<?php

namespace core\controllers;

use core\library\Chat;

class ChatController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if ($this->_router->GET(0) === false) // || !token
        {
            throw new \Exception('No user ID');
        }

        define('USER_ID', $this->_router->GET(0));

        if (!isset($_SESSION['chat']))
        {
            $_SESSION['chat'] = new Chat();

            $_SESSION['counter_event_id'] = -1;
            $_SESSION['counter_message_id'] = -1;
            $_SESSION['counter_user_id'] = -1;
        }
    }

    public function getAction()
    {
        if ($this->_router->GET(1) !== false)
        {
            $_SESSION['chat']->updateLastReceivedEvents($this->_router->GET(1));
        }

        // Remove old events.
        $_SESSION['chat']->removeEvents(0);

        echo json_encode($_SESSION['chat']);
    }

    public function sendAction()
    {
        if ($this->_router->POST('name') !== false && $this->_router->POST('message') !== false)
        {
            $_SESSION['chat']->addMessage($this->_router->POST('name'), $this->_router->POST('message'));
        }
    }
}
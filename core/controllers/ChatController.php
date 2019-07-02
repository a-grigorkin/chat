<?php

namespace core\controllers;

use core\library\Chat;

class ChatController extends Controller
{
    public function __construct($router)
    {
        parent::__construct($router);

        if ($this->_router->getParam(0) === false) // || !token
        {
            throw new \Exception('No user ID');
        }

        define('USER_ID', $this->_router->getParam(0));

        if (!isset($_SESSION['chat']))
        {
            $_SESSION['chat'] = new Chat();

            $_SESSION['user_id_counter'] = -1;
            $_SESSION['message_id_counter'] = -1;
        }
    }

    public function getAction()
    {
        if ($this->_router->getParam(1) !== false)
        {
            $_SESSION['chat']->updateLastReceivedMessages($this->_router->getParam(1));
        }

        // Remove old messages.
        $_SESSION['chat']->removeMessages(0);

        echo json_encode($_SESSION['chat']);
    }

    public function sendAction()
    {
        if ($this->_router->postParam('name') !== false && $this->_router->postParam('message') !== false)
        {
            $_SESSION['chat']->addMessage($this->_router->postParam('name'), $this->_router->postParam('message'));
        }
    }
}
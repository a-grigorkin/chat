<?php

namespace core\library;

/**
 * Class Chat
 *
 * Represents the chat with its users and messages.
 *
 * @package core\library
 */
class Chat implements \JsonSerializable
{
    private $users = array();
    private $messages = array();

    private $lastReceivedMessages = array();
    private $removedMessagesTimestamp;

    public function __construct()
    {
        $this->removedMessagesTimestamp = time();
    }

    public function addUser($name)
    {
        $this->users[User::getNextId()] = new User($name);
    }

    public function addMessage($name, $text)
    {
        $this->messages[Message::getNextId()] = new Message($name, $text);
    }

    /**
     * Returns new messages corresponding to the USER_ID.
     *
     * @return array
     */
    private function getMessages()
    {
        $messages = array();

        foreach ($this->messages as $key => $message)
        {
            if ($key > $this->lastReceivedMessages[USER_ID])
            {
                $messages[] = $message;
            }
        }

        return $messages;
    }

    public function updateLastReceivedMessages($messageId)
    {
        $this->lastReceivedMessages[USER_ID] = $messageId;
    }

    /**
     * Removes old messages every $period seconds.
     *
     * @param $period
     */
    public function removeMessages($period)
    {
        if (time() > ($this->removedMessagesTimestamp + $period))
        {
            foreach (array_keys($this->messages) as $key)
            {
                // If the current message has already been received...
                if ($key <= min($this->lastReceivedMessages))
                {
                    // ...remove it.
                    unset($this->messages[$key]);
                }
                else
                {
                    break;
                }
            }

            $this->removedMessagesTimestamp = time();
        }
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();

        $object->messages = $this->getMessages();

        return $object;
    }
}
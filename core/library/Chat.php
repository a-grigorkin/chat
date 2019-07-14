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
    private $events = array();

    private $lastReceivedEvents = array();
    private $removedEventsTimestamp;

    public function __construct()
    {
        $this->removedEventsTimestamp = time();
    }

    public function addUser($name)
    {
        $this->users[User::getNextId()] = new User($name);
    }

    public function addMessage($name, $text)
    {
        $this->events[Event::getNextId()] = new Event(new Message($name, $text));
    }

    /**
     * Returns new events corresponding to the USER_ID.
     *
     * @return array
     */
    private function getEvents()
    {
        $events = array();

        foreach ($this->events as $key => $event)
        {
            if ($key > $this->lastReceivedEvents[USER_ID])
            {
                $events[] = $event;
            }
        }

        return $events;
    }

    public function updateLastReceivedEvents($eventId)
    {
        $this->lastReceivedEvents[USER_ID] = $eventId;
    }

    /**
     * Removes old events from the queue every $period seconds.
     *
     * @param $period
     */
    public function removeEvents($period)
    {
        if (time() > ($this->removedEventsTimestamp + $period))
        {
            foreach (array_keys($this->events) as $key)
            {
                // If the current event has already been received...
                if ($key <= min($this->lastReceivedEvents))
                {
                    // ...remove it.
                    unset($this->events[$key]);
                }
                else
                {
                    break;
                }
            }

            $this->removedEventsTimestamp = time();
        }
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();

        $object->events = $this->getEvents();

        return $object;
    }
}
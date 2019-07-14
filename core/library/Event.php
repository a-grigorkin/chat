<?php

namespace core\library;

class Event implements \JsonSerializable
{
    private $event;

    private $eventId;
    private $eventType;

    /**
     * Event constructor.
     * @param $event
     */
    public function __construct($event)
    {
        $this->event = $event;

        $this->eventId = $_SESSION['counter_event_id'] = self::getNextId();
        try
        {
            $this->eventType = strtolower((new \ReflectionClass($event))->getShortName());
        }
        catch (\ReflectionException $e)
        {
            // handle the exception here...
        }
    }

    public static function getNextId()
    {
        return ($_SESSION['counter_event_id'] + 1);
    }

    public function jsonSerialize()
    {
        $this->event->eventId = $this->eventId;
        $this->event->eventType = $this->eventType;

        return $this->event;
    }
}
<?php

namespace core\library;

class Message implements \JsonSerializable
{
    private $id;
    private $time;
    private $name;
    private $text;

    /**
     * Message constructor.
     * @param $name
     * @param $text
     */
    public function __construct($name, $text)
    {
        $this->id = $_SESSION['counter_message_id'] = self::getNextId();
        $this->time = date('H:i:s');
        $this->name = $name;
        $this->text = $text;
    }

    public static function getNextId()
    {
        return ($_SESSION['counter_message_id'] + 1);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
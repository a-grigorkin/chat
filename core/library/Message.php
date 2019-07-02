<?php

namespace core\library;

class Message implements \JsonSerializable
{
    private $id;
    private $time;
    private $name;
    private $text;

    public function __construct($name, $text)
    {
        $_SESSION['message_id_counter'] = self::getNextId();

        $this->id = $_SESSION['message_id_counter'];
        $this->time = date('H:i:s');
        $this->name = $name;
        $this->text = $text;
    }

    public static function getNextId()
    {
        return ($_SESSION['message_id_counter'] + 1);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
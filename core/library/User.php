<?php

namespace core\library;

class User implements \JsonSerializable
{
    private $id;
    private $name;

    public function __construct($name)
    {
        $_SESSION['user_id_counter'] = self::getNextId();

        $this->id = $_SESSION['user_id_counter'];
        $this->name = $name;
    }

    public static function getNextId()
    {
        return ($_SESSION['user_id_counter'] + 1);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
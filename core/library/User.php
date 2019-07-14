<?php

namespace core\library;

class User implements \JsonSerializable
{
    private $id;
    private $name;

    /**
     * User constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->id = $_SESSION['counter_user_id'] = self::getNextId();
        $this->name = $name;
    }

    public static function getNextId()
    {
        return ($_SESSION['counter_user_id'] + 1);
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
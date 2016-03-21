<?php
namespace fmanager\models;

use \ArrayAccess;
use fmanager\configs\database;
use fmanager\libraries\database\connection;

class base implements ArrayAccess
{
    private $data = [];

    static private $dbConnection;

    public function __construct($id)
    {
        $this->data = self::getDBConnection()->select(static::Table, static::PrimaryKey . '=' . $id)[0];
    }

    static public function getAll()
    {
        return self::getDBConnection()->select(static::Table);
    }

    static private function getDBConnection()
    {
        if (!empty(self::$dbConnection)) {
            return self::$dbConnection;
        }

        return self::$dbConnection = new connection(database::Provider . ":host=" . database::Host . ";port=" . database::Port . ";dbname=" . database::Database, database::User, database::Password);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function retrieve()
    {
        return $this->data;
    }
}
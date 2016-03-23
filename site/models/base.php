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
        if (!is_integer($id)) {
            $id = '"'.$id.'"';
        }

        $this->data = self::getDBConnection()->select(static::Table, (static::PrimaryKey . '=' . $id));

        if (empty($this->data)) {
            throw new \Exception('Unable to retrieve data from ' .  static::Table . ' Table where '. static::PrimaryKey .' = ' . $id);
        }

        $this->data = $this->data[0];
    }

    static protected function insert ($data) {
        return self::getDBConnection()->insert(static::Table, $data);
    }

    static public function delete ($id) {
        self::getDBConnection()->delete(static::Table, static::PrimaryKey .'='. $id);
    }

    protected function update ($data, $where) {
        self::getDBConnection()->update(static::Table, $data, $where);
    }

    static public function getAll()
    {
        return self::getDBConnection()->select(static::Table);
    }

    static protected function getDBConnection()
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

    public function retrieve($masked = false)
    {
        if ($masked) {
            $mask = static::mask();

            $result = [];

            foreach ($this->data as $key => $value) {
                $result[$mask[$key]] = $value;
            }

            return $result;
        }

        return $this->data;
    }
}
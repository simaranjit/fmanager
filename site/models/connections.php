<?php
namespace fmanager\models;

/**
 * Class connections
 * @package fmanager\models
 */
class connections extends base
{
    const Table = 'connections';
    const PrimaryKey = self::ConnectionID;

    const ConnectionID = 'connectionid';
    const CustomerID = 'customerid';
    const Host = 'host';
    const Username = 'username';
    const Password = 'password';
}
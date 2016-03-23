<?php
namespace fmanager\models;

/**
 * Class session
 * @package fmanager\models
 */
class session extends base
{
    const Table = 'sessions';
    const PrimaryKey = self::SessionID;

    const SessionID = 'sessionid';
    const CustomerID = 'customerid';
    const CreatedAt = 'createdat';
    const UpdatedAt = 'updatedat';

    const SessionIDMask = 'session_id';
    const CustomerIDMask = 'customer_id';
    const CreatedAtMask = 'created_at';
    const UpdatedAtMask = 'updated_at';

    static public function mask()
    {
        return [
            self::SessionID => self::SessionIDMask,
            self::CustomerID => self::CustomerIDMask,
            self::CreatedAt => self::CreatedAtMask,
            self::UpdatedAt => self::UpdatedAtMask
        ];
    }

    static public function create($sessionID, $customerID)
    {
        $data = [self::SessionID => $sessionID,
            self::CustomerID => $customerID,
            self::CreatedAt => time(),
            self::UpdatedAt => time()];

        return parent::insert($data);
    }

    static public function deleteOnCustomer ($customerID) {
        self::getDBConnection()->delete(self::Table, self::CustomerID . '=' . $customerID);
    }
}
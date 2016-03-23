<?php
namespace fmanager\models;

use fmanager\libraries\exception\json;

class customers extends base
{
    const Table = 'customers';
    const PrimaryKey = self::CustomerID;

    const CustomerID = 'customerid';
    const FirstName = 'firstname';
    const LastName = 'lastname';
    const Email = 'email';
    const PasswordHash = 'passwordhash';
    const IsValidated = 'isvalidated';
    const ValidationHash = 'validationhash';
    const CreatedAt = 'createdat';

    const CustomerIDMask = 'customer_id';
    const FirstNameMask = 'first_name';
    const LastNameMask = 'last_name';
    const EmailMask = 'email';
    const IsValidatedMask = 'is_validated';
    const CreatedAtMask = 'created_at';

    static public function mask()
    {
        return [
            self::CustomerID => self::CustomerIDMask,
            self::FirstName => self::FirstNameMask,
            self::LastName => self::LastNameMask,
            self::Email => self::Email,
            self::IsValidated =>self::IsValidatedMask,
            self::CreatedAt => self::CreatedAtMask
        ];
    }

    static public function create ($firstName, $lastName, $email, $passwordHash, $isValidated = false, $validationHash = '') {
       return parent::insert([
            self::FirstName => $firstName,
            self::LastName => $lastName,
            self::Email => $email,
            self::PasswordHash => $passwordHash,
            self::IsValidated => $isValidated,
            self::ValidationHash => $validationHash,
            self::CreatedAt => time()
        ]);
    }

    static public function getOnEmail ($email) {
        $result = self::getDBConnection()->select(self::Table, 'email="'.$email.'"');

        if (empty($result)) {
            throw new \Exception('Invalid credentials provided', json::UNAUTHORIZED);
        }
        return $result[0];
    }
}
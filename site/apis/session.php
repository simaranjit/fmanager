<?php
namespace fmanager\apis;

use fmanager\models;
use fmanager\libraries;
use fmanager\libraries\exception\json;

class session extends base {
    const Model = models\session::class;

    static public function inherit () {
        return [
            self::METHOD_GET,
            self::METHOD_POST,
            self::METHOD_DELETE
        ];
    }

    public function get ($id) {
        try {
            $this->success((new models\session($id))->retrieve(true));
        } catch (\Exception $e) {
            throw new json($e->getMessage(), json::NOT_FOUND);
        }
    }

    public function post() {
        $parameters = $this->getParameters();
        $arguments = $this->getArguments();

        $email = $parameters['email'];
        $password = $parameters['password'];

        $customer = models\customers::getOnEmail($email);

        $sessionID = libraries\session\id::generate(80);

        // Remove old sessions
        models\session::deleteOnCustomer($customer[models\customers::CustomerID]);
        models\session::create($sessionID, $customer[models\customers::CustomerID]);

        $this->success((new models\session($sessionID))->retrieve(true));
;    }

    public function delete ($id) {
        models\session::delete($id);

        $this->success();
    }
}
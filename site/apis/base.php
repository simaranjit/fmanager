<?php
namespace fmanager\apis;

use fmanager\libraries\exception\json;

class base
{
    const METHOD_GET = 'GET';
    const METHOD_GETBATCH = 'GETBATCH';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_DELETEBATCH = 'DELETEBATCH';

    // Nodes
    const STATUS = 'status';
    const STATUS_OK = 200;
    const DATA = 'data';

    public function getBatch()
    {
        if (!in_array(self::METHOD_GETBATCH, static::inherit())) {
            throw new json('Method not supported', json::NOT_IMPLEMENTED);
        }
    }

    public function get($id)
    {
        if (!in_array(self::METHOD_GET, static::inherit())) {
            throw new json('Method not supported', json::NOT_IMPLEMENTED);
        }

    }

    public function post()
    {
        if (!in_array(self::METHOD_POST, static::inherit())) {
            throw new json('Method not supported', json::NOT_IMPLEMENTED);
        }
        // Validated by username and password
        echo 'in post';
    }

    public function put()
    {
        if (!in_array(self::METHOD_PUT, static::inherit())) {
            throw new json('Method not supported', json::NOT_IMPLEMENTED);
        }

        echo 'in put';
    }

    public function delete()
    {
        if (!in_array(self::METHOD_DELETE, static::allowAccessTo())) {
            throw new json('Method not supported', json::NOT_IMPLEMENTED);
        }

        echo 'in delete';
    }

    public function success($packet = [])
    {
        $response['status'] = self::STATUS_OK;

        if (!empty($packet)) {
            $response['data'] = $packet;
        }
        die(json_encode($response));
    }

    protected function getArguments()
    {
        $parameters = $_GET;

        unset($parameters['_q']);

        return $parameters;
    }

    protected function getParameters()
    {
        return $_POST;
    }
}
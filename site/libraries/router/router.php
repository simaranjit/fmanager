<?php
namespace fmanager\libraries\router;

use fmanager\libraries\exception;

class router
{
    public function route()
    {
        if (isset($_GET['_q'])) {
            $query = $_GET['_q'];

            if (!empty($query)) {
                $queryChunks = explode('/', $query);

                // Handling of APIs
                if ($queryChunks[0] == 'api') {
                    header('content-type: application/json');

                    if (empty($queryChunks[1])) {
                        throw new exception\json('API not found', exception\base::NOT_FOUND);
                    }

                    if (!file_exists('apis/' . $queryChunks[1] . '.php')) {
                        throw new exception\json('API not found', exception\base::NOT_FOUND);
                    }

                    $class = 'fmanager\\apis\\' . $queryChunks[1];
                    $object = new $class();

                    $method = $_SERVER['REQUEST_METHOD'];

                    // Override method if needed
                    if ($method == 'GET' && empty($queryChunks[2])) {
                        $method = 'GetBatch';
                    }

                    if ($method == 'DELETE' && empty($queryChunks[2])) {
                        $method = 'DeleteBatch';
                    }

                    if (!method_exists($object, $method)) {
                        throw new exception\json($method . ' method is not supported by this API', exception\base::METHOD_NOT_ALLOWED);
                    }

                    if (empty($queryChunks[2])) {
                        $object->$method();
                    } else {
                        $object->$method($queryChunks[2]);
                    }
                }
            }
        } else {
            include('views/default/index.tpl.php');
        }
    }
}

try {
    (new router())->route();
} catch (\Exception $exception) {
    echo $exception->getMessage();
}

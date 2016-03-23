<?php
namespace fmanager\libraries\exception;

class json extends base
{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        http_response_code(empty($code) ? 200 : $code);

        $response['status'] = $code;
        $response['data'] = [
            'message' => $message,
            'title' => $this->getTItle($code),
            'description' => ''
        ];

        $response['stacktrace'] = $this->getTraceAsString();

        parent::__construct(json_encode($response), $code, $previous);
    }
}
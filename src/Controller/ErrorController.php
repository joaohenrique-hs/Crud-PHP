<?php

class ErrorController
{
    public function index()
    {
        http_response_code(404);
        echo json_encode('Resource not found');
    }
}

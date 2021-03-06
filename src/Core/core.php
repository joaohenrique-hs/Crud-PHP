<?php

class Core
{
    public function start()
    {
        $_REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');

        $INITE = strpos($_REQUEST_URI, '?');

        if ($INITE) {
            $_REQUEST_URI = substr($_REQUEST_URI, 0, $INITE);
        }

        $_REQUEST_URI = substr($_REQUEST_URI, 1);

        $URL = explode('/', $_REQUEST_URI);

        $URL[0] = ($URL[0] != '' ? $URL[0] : 'Post');

        $Controller = $URL[0] . 'Controller';

        if (class_exists($Controller)) {
            $Method = 'index';
            if (isset($URL[1])) {
                if (method_exists($Controller, $URL[1])) {
                    $Method = $URL[1];
                    if (isset($URL[2])) {
                        $params = $URL[2];
                    }
                } else {
                    $params = $URL[1];
                }
            }
            $Controller::$Method($params);
        } else {
            http_response_code(404);
        }
    }
}

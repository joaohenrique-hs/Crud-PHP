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

        $_REQUEST_URI_PASTA = substr($_REQUEST_URI, 12);

        $URL = explode('/', $_REQUEST_URI_PASTA);

        //--------------------------------------------------------------------

        $URL[0] = ($URL[0] != '' ? $URL[0] : 'Home');

        $Controller = $URL[0] . 'Controller';

        if (class_exists($Controller)) {
            $Method = 'index';
            if (isset($URL[1])) {
                if (method_exists($Controller, $URL[1])) {
                    $Method = $URL[1];
                    if(isset($URL[2])){
                        $params = $URL[2];
                    }
                }
                else{
                    $params = $URL[1];
                }
            }
            $Controller::$Method($params);
        } else {
            ErroController::index();
        }
    }



    /*public function start()
    {
        $urlGet = 0;
        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'] . 'Controller');
        } else {
            $controller = 'HomeController';
        }
        if (isset($urlGet['metodo'])) {
            $acao = $urlGet['metodo'];
        } else {
            $acao = 'index';
        }

        if (!class_exists($controller)) {
            $controller = 'ErroController';
        }
        if (isset($urlGet['id']) && $urlGet['id'] != null) {
            $id = $urlGet['id'];
        } else {
            $id = null;
        }


        call_user_func_array(array(new $controller, $acao), array('id' => $id));
    }
    */
}

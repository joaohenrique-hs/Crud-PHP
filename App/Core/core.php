<?php

class Core
{
    public function start($URL)
    {
        $URL[0] = ($URL[0] != '' ? $URL[0] : 'Home');
        
        $Controller = $URL[0] . 'Controller';

        if (class_exists($Controller)) {
            $Controller::index();
        }
        else{
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

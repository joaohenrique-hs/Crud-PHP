<?php

require_once 'App/Core/core.php';

require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/ErroController.php';
require_once 'App/Controller/PostController.php';
require_once 'App/Controller/SobreController.php';
require_once 'App/Controller/AdminController.php';

require_once 'App/Models/Postagem.php';
require_once 'App/Models/Comentario.php';

require_once 'lib/Database/Connection.php';

require_once 'vendor/autoload.php';

//-------------------------------------------------

$template = file_get_contents("App/Template/estrutura.html");

$_REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');

$INITE = strpos($_REQUEST_URI, '?');

if ($INITE) {
    $_REQUEST_URI = substr($_REQUEST_URI, 0, $INITE);
}

$_REQUEST_URI_PASTA = substr($_REQUEST_URI, 12);

$URL = explode('/', $_REQUEST_URI_PASTA);

ob_start();
$core = new Core;
$core->start($URL);
$retorno = ob_get_contents();
ob_end_clean();

$home = file_get_contents($retorno);

$tplPronto = str_replace('{{conteudo}}', $retorno, $template);

echo $tplPronto;

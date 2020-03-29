<?php

require_once 'App/Core/core.php';

require_once 'App/Controller/HomeController.php';
require_once 'App/Controller/ErrorController.php';
require_once 'App/Controller/PostController.php';
require_once 'App/Controller/AdminController.php';

require_once 'App/Models/Post.php';
require_once 'App/Models/Comment.php';

require_once 'lib/Database/Connection.php';

//-------------------------------------------------

ob_start();
$core = new Core;
$core->start();
$retorno = ob_get_contents();
ob_end_clean();

echo $retorno;

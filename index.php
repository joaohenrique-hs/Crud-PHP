<?php

require_once 'src/Core/core.php';

require_once 'src/Controller/ErrorController.php';
require_once 'src/Controller/PostController.php';
require_once 'src/Controller/AdminController.php';

require_once 'src/Models/Post.php';
require_once 'src/Models/Comment.php';

require_once 'lib/Database/Connection.php';

//-------------------------------------------------

ob_start();
$core = new Core;
$core->start();
$retorno = ob_get_contents();
ob_end_clean();

echo $retorno;

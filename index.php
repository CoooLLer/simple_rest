<?php

use App\Core\Kernel;

require_once 'db_cfg.php';

require_once 'config.php';

require_once 'routes.php';

require_once 'App/Core/Autoloader.php';

spl_autoload_register('App\Core\Autoloader::loader');

$kernel = Kernel::getInstance();
$kernel->init($config, $routes);
$kernel->run();
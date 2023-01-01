<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(basename(__DIR__), [
    'boilerplate_module_event' => 'install/index.php',
]);

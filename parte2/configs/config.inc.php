<?php

define("__DEBUG__", true);
define("__ROOT_DIR__", dirname(__DIR__));
define("__SITE_URL__", "http://localhost/test_at/parte2/");

include "database.php";

include __ROOT_DIR__ . '/vendor/autoload.php';
include __DIR__ . "/bootstrap.php";

//file di configurazione dell'applicazione
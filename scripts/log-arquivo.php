<?php

include_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$pathLogs = __DIR__ . '/../logs/';

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler($pathLogs.'exemplo1.log', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');
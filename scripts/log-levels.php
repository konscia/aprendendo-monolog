<?php

include_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$pathLogs = __DIR__ . '/../logs/';

// create a log channel
$log = new Logger('Teste Leveis');

unlink($pathLogs.'debug.log');
unlink($pathLogs.'info.log');
unlink($pathLogs.'notice.log');
unlink($pathLogs.'warning.log');
unlink($pathLogs.'error.log');
unlink($pathLogs.'critical.log');
unlink($pathLogs.'alert.log');
unlink($pathLogs.'emergency.log');
unlink($pathLogs.'default.log');

$log->pushHandler(new StreamHandler($pathLogs.'debug.log', Logger::DEBUG));
$log->pushHandler(new StreamHandler($pathLogs.'info.log', Logger::INFO));
$log->pushHandler(new StreamHandler($pathLogs.'notice.log', Logger::NOTICE));
$log->pushHandler(new StreamHandler($pathLogs.'warning.log', Logger::WARNING));
$log->pushHandler(new StreamHandler($pathLogs.'error.log', Logger::ERROR));
$log->pushHandler(new StreamHandler($pathLogs.'critical.log', Logger::CRITICAL));
$log->pushHandler(new StreamHandler($pathLogs.'alert.log', Logger::ALERT));
$log->pushHandler(new StreamHandler($pathLogs.'emergency.log', Logger::EMERGENCY));

$log->pushHandler(new StreamHandler($pathLogs.'default.log'));

$log->debug("Debug 1");
$log->info("Info 1");
$log->notice("Notice 1");
$log->warning("Warning 1");
$log->error("Error 1");
$log->critical("Critical 1");
$log->alert("Alerta 1");
$log->emergency("Emergência 1");

$log->debug("Debug 2");
$log->info("Info 2");
$log->notice("Notice 2");
$log->warning("Warning 2");
$log->error("Error 2");
$log->critical("Critical 2");
$log->alert("Alerta 2");
$log->emergency("Emergência 2");

echo "Debug deve ter 16 linhas: " . count(file($pathLogs.'debug.log'))." \n";
echo "Info deve ter 14 linhas: " . count(file($pathLogs.'info.log'))." \n";
echo "Notice deve ter 12 linhas: " . count(file($pathLogs.'notice.log'))." \n";
echo "Warning deve ter 10 linhas: " . count(file($pathLogs.'warning.log'))." \n";
echo "Error deve ter 08 linhas: " . count(file($pathLogs.'error.log'))." \n";
echo "Critical deve ter 06 linhas: " . count(file($pathLogs.'critical.log'))." \n";
echo "Alert deve ter 04 linhas: " . count(file($pathLogs.'alert.log'))." \n";
echo "Emergency deve ter 02 linhas: " . count(file($pathLogs.'emergency.log'))." \n";

echo "Default deve ter 16 linhas, é Debug: " . count(file($pathLogs.'default.log'))." \n";

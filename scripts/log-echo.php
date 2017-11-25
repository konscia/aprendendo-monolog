<?php

include_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class SimpleEchoHandler extends StreamHandler {

    public function __construct($level, $dateFormat = "d/m/Y H:i:s") {

        /*
         * Define como saída do logger a saída do PHP, que funciona tanto
         * como o "echo" do navegador como a saída do console para ações em terminal.
         * Ref: https://github.com/Seldaek/monolog/issues/183
         */
        parent::__construct("php://output", $level);

        /*
         * Cria um formatador simples para mensagem de erro e dados de contexto
         * Foram omitidos os dados extras e o nome do canal pois para um log simples, não são importants
         */
        $eol = $this->getEndOfLine();
        $output = "%datetime%: %level_name% - %message% {$eol} %context% {$eol}{$eol}";
        $formatter = new LineFormatter($output, $dateFormat);

        $this->setFormatter($formatter);
    }

    private function getEndOfLine()
    {
        if (php_sapi_name() == "cli") {
            return PHP_EOL;
        } else {
            return "<br />";
        }
    }
}

// create a log channel
$log = new Logger('canal');
$log->pushHandler(new SimpleEchoHandler(\Psr\Log\LogLevel::DEBUG));

// add records to the log
$log->info('Foo', ['banana']);
$log->warning('Foo');
$log->error('Bar', ['frutas' => ['banana', 'maca']]);
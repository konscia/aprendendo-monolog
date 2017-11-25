<?php

include_once __DIR__ . "/../vendor/autoload.php";

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/*
 * Criei esta classe aqui mesmo apenas
 * para facilitar a leitura do exemplo
 */
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

//Cria o Logger, que implementa a interface adequada do Monolog
$log = new Logger('canal');
//Configura como manipulador dos logs a nossa classe mais abaixo, que é um tipo de stream handler
$log->pushHandler(new SimpleEchoHandler(\Psr\Log\LogLevel::INFO));

header('Content-Type: text/html; charset=utf-8');
//Adiciona alguns Logs com mensagens de contexto, em diferentes níveis e também com exemplo de uma mensagem com bastante informação.
$log->info('Mensagem de Informação', ['info' => 'valor']);
$log->warning('Aviso');
$log->error('Erro, atenção', ['server' => $_SERVER]);
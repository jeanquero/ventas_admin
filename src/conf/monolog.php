<?php
require __DIR__.'/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

Class MonoLog {
    private $logger;
    public function __construct()
    {
        // Create the logger
        $this->logger = new Logger('my_logger');
        $this->logger->pushHandler(new StreamHandler(__DIR__.'/../log/my_app.log', Logger::DEBUG));
        $this->logger->pushHandler(new FirePHPHandler());
    }

    /**
     * @param $mensaje
     * @param $type 'warring','error','info'
     */
    public function Logger($mensaje, $type){
        if($type == 'warning'){
            $this->logger->warning($mensaje);
        }
        if($type == 'error'){
            $this->logger->error($mensaje);
        }
        if($type == 'info'){
            $this->logger->info($mensaje);
        }
    }

}



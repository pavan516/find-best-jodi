<?php

namespace App\Helpers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
* Logging By Adnan Hussain Turki
*/
class Log
{
    protected $logger;
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    
    public function error()
    {
        $format = array(
            'date' => 'Y-m-d H:i:s',
            'message' => "[%datetime%][%channel%][%level_name%] : %message% %context% %extra%" . PHP_EOL,
        );
        $filename = __DIR__ . '/../../log/error.log';
        $formatter = new  \Monolog\Formatter\LineFormatter($format['message'], $format['date']); 

        $stream = new \Monolog\Handler\StreamHandler($filename, \Monolog\Logger::DEBUG);
        $stream->setFormatter($formatter);       
        $fingersCrossed = new \Monolog\Handler\FingersCrossedHandler(
            $stream, \Monolog\Logger::ERROR);
        $this->logger->pushHandler($fingersCrossed);  
        return $this->logger;
    }
    public function warning()
    {
        $filename = __DIR__ . '/../../log/warning.log';
        $stream = new \Monolog\Handler\StreamHandler($filename, \Monolog\Logger::DEBUG);
        $fingersCrossed = new \Monolog\Handler\FingersCrossedHandler(
            $stream, \Monolog\Logger::WARNING);
        $this->logger->pushHandler($fingersCrossed);     
        return $this->logger;
    }
    public function info()
    {
        $filename = __DIR__ . '/../../log/info.log';
        $stream = new \Monolog\Handler\StreamHandler($filename, \Monolog\Logger::DEBUG);
        $fingersCrossed = new \Monolog\Handler\FingersCrossedHandler(
            $stream, \Monolog\Logger::INFO);
        $this->logger->pushHandler($fingersCrossed);     
        return $this->logger;
    }
    public function doLog( $message, $request, $type = null)
    {

        $formdata = $request->getParsedBody();
        if (!$formdata) {
            $formdata = "No form data engaged.";
        }else {
            $formdata = implode(',', $formdata);
        }
        switch ($type) {
            case 'error':
                $this->error()->error($message . " | Request : " . $formdata );
                break;
            case 'warning':
                $this->warning()->warning($message . " | Request : " . $formdata );
                break;                     
            default:            
                $this->info()->info($message . " | Request : " . $formdata );
                break;
            
        }


    }
   
}
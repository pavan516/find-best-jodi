<?php

namespace App;
use App\Database\Connection;
use DI\ContainerBuilder;
use DI\Bridge\Slim\App as DIBridge;

use Noodlehaus\Config;

class App extends DIBridge
{
    protected $config;
    protected function configureContainer(ContainerBuilder $builder)
    {
        $Illuminate = new Connection;

        $builder->addDefinitions([
         
            'settings.determineRouteBeforeAppMiddleware' => true,
            'settings.addContentLengthHeader' => false,
            'settings.http_version' => '1.1',                  
        ]);
        $builder->addDefinitions(__DIR__ . "/container.php");
          
            
    }


}
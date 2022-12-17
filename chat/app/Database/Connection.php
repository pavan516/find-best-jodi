<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;
use Noodlehaus\Config;

/**
* For creating connection to database
*/
class Connection 
{
    protected $capsule;
    protected $config;
    function __construct()
    {
        $this->config = new Config(__DIR__ . '/../../config/' . file_get_contents(__DIR__ . '/../../mode.php') . '.php'); 
        $this->capsule = new Capsule;
        $this->capsule-> addConnection([
                    'driver' => $this->config->get('db.driver'),
                    'host' => $this->config->get('db.host'),
                    'database' => $this->config->get('db.name'),
                    'username' => $this->config->get('db.username'),
                    'password' => $this->config->get('db.password'),
                    'charset' => $this->config->get('db.charset'),
                    'collation' => $this->config->get('db.collation'),
                    'prefix' => $this->config->get('db.prefix'),

        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

    }
    public function connection()
    {
        return $this->capsule->getConnection();
    }
    
}



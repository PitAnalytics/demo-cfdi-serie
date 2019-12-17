<?php

namespace App\Config;

class Config{

    //config structure(assoc array)
    private $config;

    //instancia singleton
    private static $instance;

    //funcion de singeton
    public static function instanciate($path){

        if (!self::$instance instanceof self){
    
         self::$instance = new self($path);
        
        }
        return self::$instance;
    }
    //construimos y llamamos la ruta del fichero JSON de configuracion
    public function __construct($path){

        //we open the config json file
        $jsonConfig=file_get_contents($path);

        //we convert the file to the main config structure(assoc array)
        $this->config=json_decode($jsonConfig,true);

    }
    //llamamos toda la configuracion
    public function index(){

        return $this->config;

    }
    //variables globales de controlador y aplicaciones
    public function globals(){

        return $this->config['globals'];

    }
    //GCP config
    public function google($service){

        return $this->config['google'][$service];

    }
    
}

?>
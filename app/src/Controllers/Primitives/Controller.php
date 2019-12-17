<?php

namespace App\Controllers\Primitives;

use Psr\Container\ContainerInterface as Container;

abstract class Controller{

    protected $container;
    protected $config;
    protected $soap=[];
    protected $views;

    //funcio constructor con inyeccion de contenedor
    public abstract function __construct(Container $container);

}

?>
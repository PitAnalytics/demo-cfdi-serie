<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true,'responseChunkSize' => 8096]]);
//
$container=$app->getContainer();
//
$container['config']=function($container){

    return App\Config\Config::instanciate('../app/src/Config/Config.json');

};
//
$container['validacion-cfdi']=function($container){

    return new App\Tools\Cfdi\Validacion;

};

$container['dynamic-views']=function($container){

    $view = new \Slim\Views\Twig('../app/src/Views',['cache'=>false]);
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
  
    return $view;
  
  };

?>
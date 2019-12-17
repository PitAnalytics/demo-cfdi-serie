<?php
/************************/
/*****PSR-7-INTERFACE****/
/************************/
//
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//
/*********************/
/****SLIM-INSTANCE****/
/*********************/
//
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'responseChunkSize' => 8096
    ]
]);
//
/******************/
/****CONTAINER*****/
/******************/
//
require_once '../app/core/container.php';
//
/******************/
/****ROUTER********/
/******************/
//
require_once '../app/core/router.php';
//
/******************/
/****EJECUTAMOS****/
/******************/
$app->run();


?>
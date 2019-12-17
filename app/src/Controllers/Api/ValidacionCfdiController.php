<?php

namespace App\Controllers\Api;

use App\Controllers\Primitives\Controller as Controller;
use Psr\Container\ContainerInterface as Container;

class ValidacionCfdiController extends Controller{
  
  //
  public function __construct(Container $container){

    //
    $this->container=$container;
    $this->setMainInstances();
    $this->setSoapInstances();
    $this->setViewInstances();

  }
  //
  protected function setMainInstances(){

    //
    $this->config=$this->container['config'];
    $this->globals=$this->config->globals();

  }
  //
  protected function setSoapInstances(){

    //
    $this->soap['validacion-cfdi']=$this->container['validacion-cfdi'];

  }
  protected function setViewInstances(){

    $this->views=$this->container['dynamic-views'];

  }
  //
  public function index($request,$response){

    //
    $jsonData = file_get_contents('../app/file/test.json');
    $data=json_decode($jsonData,true);
    $validation=$this->soap['validacion-cfdi']->validarLista($data);
    //
    $viewData['lista']=$validation;
    $this->views->render($response,'Layout/index.php',$viewData);
  }

}


?>
<?php

namespace App\Tools\Cfdi;

use SoapClient as SoapClient;

class Validacion{

  public function validarLista(array $list){

    //
    $result = [];

    foreach ($list as $line) {

      //
      $result[]=$this->validar($line['rfcEmisor'],$line['rfcReceptor'],$line['uuid'],$line['total']);

    }

    //
    return $result;

  }

  public function validar(string $rfcEmisor,string $rfcReceptor,string $uuid,string $total){

    //respuesta en arreglo
    $response=[];

    //url de servicio SAT
    $url = "https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc";

    //contexto de cliente soap
    $opt = array("http"=>array("timeout"=>1));
    $context = stream_context_create($opt);

    //arreglo
    $options=array(
      'trace'=>true,
      'stream_context'=>$context
    );

    //importe y uuid
    $impo = (double)$total;
    $impo = sprintf("%.6f", $impo);
    $impo = str_pad($impo,17,"0",STR_PAD_LEFT);
    $UUID = strtoupper($uuid);

    //
    $CadIdent = "?re=$rfcEmisor&rr=$rfcReceptor&tt=$impo&id=$UUID";

    //
    $prm = array('expresionImpresa'=>$CadIdent);

    //
    try {

      $response=[];

      $soapclient = new SoapClient($url,$options);
      $buscar=$soapclient->Consulta($prm);
      
      $CodResp    = $buscar->ConsultaResult->CodigoEstatus;
      $StatusCFDI = strtoupper($buscar->ConsultaResult->Estado);

      switch ($StatusCFDI) {
        case 'VIGENTE':
          $response['status']=1;
          break;

        case 'CANCELADO':
          $response['status']=0;
          break;

        case 'NO ENCONTRADO':
          $response['status']=-1;
          break;
        
        default:
        $response['status']=-1;
          break;
      }

      if(($CodResp=="S - Comprobante obtenido satisfactoriamente.")){

        $response['codigo']='S';

      }
      else{

        $response['codigo']='N';

      }

      //
      $response['uuid']=$UUID;
      $response['rfcEmisor']=$rfcEmisor;
      $response['rfcReceptor']=$rfcReceptor;
      $response['total']=$total;

    } catch(Exception $e) {

      $response['error']=$e;
    
    }

    return $response;
  
  }

}
?>
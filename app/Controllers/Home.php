<?php

namespace App\Controllers;

use PhpMqtt\Client\ConnectionSettings;
use \PhpMqtt\Client\MqttClient;
use App\Libraries\Ssp;

class Home extends BaseController
{
  public function __construct() {}


  public function index()
  {
    $this->addCss(['lib/fancybox/fancybox.css']);
    $this->addJs(['lib/fancybox/fancybox.umd.js', 'js/web.js','js/leer.js']);

    helper('funciones');
    $datos['banners']=$this->db->query("SELECT * FROM banners WHERE activo=1 limit 3")->getResult();
    $datos['biografias']=$this->db->query("SELECT * FROM biografias order by id asc limit 1")->getResult();
    $datos['videos']=$this->db->query("SELECT * FROM videos order by id desc limit 1")->getResult();
    $datos['campanias']=$this->db->query("SELECT * FROM campanias where estado=1 order by orden asc limit 3")->getResult();
    $datos['fotos']=$this->db->query("SELECT * FROM fotos order by id desc limit 3")->getResult();
    $datos['config']=$this->db->query("SELECT * FROM configuracion limit 1")->getRow();
    $datos['noticias']=$this->db->query("SELECT * FROM noticias order by orden asc limit 3")->getResult();

    $this->showWHeader();
    $this->ShowContent('index',$datos);
    $this->showWFooter();
  }
   
}

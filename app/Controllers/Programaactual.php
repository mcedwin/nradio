<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Programaactual extends BaseController
{
  protected $modelPedido;
  protected $modelSuscribir;
  protected $modelTestimonio;

  public $imagebase = 'static/images/testimonios/';

  public function __construct()
  {
    $this->modelPedido = new GeneralModel('pedidos');
    $this->modelSuscribir = new GeneralModel('suscribir');
    $this->modelTestimonio = new GeneralModel('testimonios');
  }


  public function index()
  {
     helper('formulario');
    $this->addJs(['js/form.js']);
    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    
    $datos['programa'] = $this->db->query("SELECT * FROM programas WHERE portada=1 LIMIT 1")->getRow();
    $datos['title'] = $datos['programa']->titulo;


    $this->showWHeader();
    $this->ShowContent('index', $datos);
    $this->showWFooter();
  }
}

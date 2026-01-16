<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Programacion extends BaseController
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
    $this->addJs(['js/form.js']);
    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    $datos['title'] = 'Contacto';

    $this->showWHeader();
    $this->ShowContent('index', $datos);
    $this->showWFooter();
  }

}

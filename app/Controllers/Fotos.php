<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Fotos extends BaseController
{

  protected $model;
  protected $table = 'fotos';
  protected $mtitle = 'Fotos';

  public $gale_tipo = 1;

  public function __construct()
  {
    $this->model = new GeneralModel($this->table);
  }

  public function index()
  {

    $this->addCss(['lib/fancybox/fancybox.css']);
    $this->addJs(['lib/fancybox/fancybox.umd.js', 'js/web.js']);


    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();
    $datos['noticias'] = $this->db->query("SELECT * FROM noticias where activo=1 order by orden asc limit 3")->getResult();
    $datos['videos']=$this->db->query("SELECT * FROM videos order by id desc limit 1")->getResult();

    $paginacion = \Config\Services::pager();
    $perPage = 12;
    $totalRegistros = $this->model->countAllResults(); 
    $currentPage = $this->request->getVar('page') ?? 1; 
    $offset = ($currentPage - 1) * $perPage;
    $registros = $this->model->getPaginadas($perPage, $offset);

    $datos['registros'] = $registros;
    $datos['pager'] = $paginacion->makeLinks($currentPage, $perPage, $totalRegistros, 'bootstrap');

    $datos['title'] = $this->mtitle;
    $datos['table'] = $this->table;
    $datos['db'] = $this->db;

    $this->showWHeader();
    $this->ShowContent('index', $datos);
    $this->showWFooter();
  }

}

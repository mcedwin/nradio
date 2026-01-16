<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Noticias extends BaseController
{

  protected $model;
  protected $table = 'noticias';
  protected $mtitle = 'Noticias';

  public $gale_tipo = 5;

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
    $totalRegistros = $this->model->where('activo', 1)->countAllResults(); 
    $currentPage = $this->request->getVar('page') ?? 1; 
    $offset = ($currentPage - 1) * $perPage;
    $registros = $this->model->getPaginadas($perPage, $offset,'noticias');

    $datos['registros'] = $registros;
    $datos['pager'] = $paginacion->makeLinks($currentPage, $perPage, $totalRegistros, 'bootstrap');

    $datos['title'] = $this->mtitle;
    $datos['table'] = $this->table;

    $this->showWHeader();
    $this->ShowContent('index', $datos);
    $this->showWFooter();
  }

  public function page($slug)
  {
    helper('formulario');
    $this->addCss(['lib/fancybox/fancybox.css']);
    $this->addJs(['lib/fancybox/fancybox.umd.js', 'js/web.js']);

    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();
    $datos['registro'] = $reg = $this->db->query("SELECT * FROM {$this->table} WHERE slugifyTitulo='{$slug}' LIMIT 1")->getRow();
    $datos['imagenes'] = $this->db->query("SELECT * FROM imagenes WHERE idContenido='{$reg->id}' AND tipo='{$this->gale_tipo}'")->getResult();

    $datos['title'] = $this->mtitle;
    $datos['table'] = $this->table;

    $this->showWHeader();
    $this->ShowContent('page', $datos);
    $this->showWFooter();
  }
}

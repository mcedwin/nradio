<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Audios extends BaseController
{

  protected $model;
  protected $table = 'musica';
  protected $mtitle = 'Audios';

  public $gale_tipo = 2;

  public function __construct()
  {
    $this->model = new GeneralModel($this->table);
  }

  public function index()
  {

    $this->addCss(['lib/miplayer/player.css']);
    $this->addJs(['lib/miplayer/player.js', 'js/audios/main.js']);


    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();
    $datos['noticias'] = $this->db->query("SELECT * FROM noticias where activo=1 order by orden asc limit 3")->getResult();

    $datos['categorias'] = $this->db->query("SELECT * FROM categorias LIMIT 10")->getResult();
    $datos['registros'] = $this->db->query("SELECT * FROM musica WHERE 1")->getResult();

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

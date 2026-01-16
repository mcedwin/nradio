<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Frecuencias extends BaseController
{
  use BaseGaleria;
  protected $model;
  protected $modelImagenes;

  public $gale_tipo = 3;

  public $imagebase = 'static/images/frecuencias/';
  public $imagebaseImagenes = 'static/images/imagenes/';

  public function __construct()
  {
    $this->model = new GeneralModel('frecuencias');
    $this->modelImagenes = new GeneralModel('imagenes');
  }

  public function index()
  {
    if (empty($this->user->id)) return redirect()->to('/admin/login');

    $ssp = new Ssp();

    $this->addCss(array('lib/datatable/datatables.min.css'));
    $this->addJs(array('lib/datatable/datatables.min.js', "js/admin/{$this->controller}/lista.js"));
    $json = isset($_GET['json']) ? $_GET['json'] : false;

    $botonActivo = function ($d, $row) {
      $url = base_url("admin/{$this->controller}/activar/" . $row['id']);
      if ($d == 1) return '<a href="' . $url . '" class="btn btn-sm btn-info activar"><i class="fa-solid fa-check"></i> Activo</a>';
      return '<a href="' . $url . '" class="btn btn-sm btn-light activar">Inactivo</a>';
    };
    $funcGaleria = function ($d, $row) {
      $url = base_url("admin/{$this->controller}/galeria/" . $row['id']);
      return '<a href="' . $url . '" class="btn btn-lg btn-warning galeria"><i class="fa-solid fa-photo-film"></i></a>';
    };
    $funcImagen = function ($d, $row) {
      return '<img src="' . base_url($this->imagebase . $row['imagen']) . '" width="80" >';
    };

    $columns = array(
      array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'titulo', 'dt' => 'Titulo', "field" => "titulo"),
      // array('db' => 'id',  'dt' => 'Galeria', "field" => "id", "formatter" => $funcGaleria),
      array('db' => 'imagen', 'dt' => 'Imagen', "field" => "imagen", "formatter" => $funcImagen),
      //array('db' => 'activo', 'dt' => 'Activo', "field" => "activo", "formatter" => $botonActivo),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    if ($json) {
      $condiciones = array();

      $joinQuery = "FROM {$this->model->table}";

      //$activo = $this->request->getPost('activo');
      //$tipo = $this->request->getPost('tipo');

      if (!empty($activo)) $condiciones[] = " activo = '{$activo}'";

      $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
      echo json_encode(
        $ssp->simple($_POST, $this->getDataConn(), $this->model->getTable(), $this->model->getPrimaryKey(), $columns, $joinQuery, $where)
      );
      exit(0);
    }
    helper('formulario');
    $response['columns'] = $columns;

    $this->showHeader();
    $this->ShowContent('lista', $response);
    $this->showFooter();
  }


  



  public function guardar($id = '')
  {
    $data = $this->validar($this->model->getFields());
    $data['slugifyTitulo'] = slugify1($data['titulo']);
    if (empty($id)) {
      $this->model->insert($data);
      $id = $this->model->getInsertID();

      $path = uniqid() . '.jpg';

      if ($this->guardar_imagen($this->imagebase, $path)) {
        $this->model->update(['id' => $id], ['imagen' => $path]);
      }
    } else {
      // $path = empty($data['imagen']) ? uniqid() . '.jpg' : $data['imagen'];
      $path = uniqid() . '.jpg';
      if ($this->guardar_imagen($this->imagebase, $path)) {
        $data['imagen'] = $path;
      }
      $this->model->update(['id' => $id], $data);
    }

    $a = $this->model->find($id);

    $this->dieMsg(true, '', base_url('admin/frecuencias'));
  }

  public function crear()
  {
    helper('form');
    helper('formulario');
    $this->addJs(array(
      'lib/tinymce/tinymce.min.js',
      'js/admin/frecuencias/form.js',
    ));
    $datos['id'] = '0';
    $datos['titulo'] = 'Nueva frecuencia';
    $datos['fields'] = $this->model->geti();
    $datos['foto'] = $this->noview;
    $datos['utipos'] = $this->db->query("SELECT id, nombre as `text` FROM departamentos")->getResult();
    $this->showHeader(true);
    $this->ShowContent('form', $datos);
    $this->showFooter();
  }

  public function editar($id)
  {
    helper('form');
    helper('formulario');

    $this->addJs(array(
      'lib/tinymce/tinymce.min.js',
      'js/admin/frecuencias/form.js',
    ));

    $datos['id'] = $id;
    $datos['titulo'] = 'Editar frecuencia';

    $datos['fields'] = $this->model->geti($id);
    if (empty($datos['fields']->imagen->value)) $datos['foto'] = $this->noview;
    else $datos['foto'] = base_url($this->imagebase) . ($datos['fields']->imagen->value);

    $datos['utipos'] = $this->db->query("SELECT id, nombre as `text` FROM departamentos")->getResult();

    $this->showHeader(true);
    $this->ShowContent('form', $datos);
    $this->showFooter();
  }



  public function borrar($id)
  {
    $this->dieAjax();
    $this->model->where("id='{$id}'")->delete();
    $this->dieMsg();
  }
  public function activar($id)
  {
    $this->dieAjax();
    $this->db->query("UPDATE " . $this->model->getTable() . " SET activo = NOT activo WHERE id='{$id}'");
    $this->dieMsg();
  }



}

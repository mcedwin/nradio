<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Audios extends BaseController
{
  protected $model;
  protected $modelCategorias;
  public $imagebase = 'static/audios/';

  public function __construct()
  {
    $this->model = new GeneralModel('musica');
    $this->modelCategorias = new GeneralModel('categorias');
  }

  public function index()
  {
    if (empty($this->user->id)) return redirect()->to('/admin/login');

    $ssp = new Ssp();

    $this->addCss(array('lib/datatable/datatables.min.css'));
    $this->addJs(array('lib/datatable/datatables.min.js', "js/admin/{$this->controller}/lista.js"));
    $json = isset($_GET['json']) ? $_GET['json'] : false;

    $columns = array(
      array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'titulo', 'dt' => 'Titulo', "field" => "titulo"),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    $columns2 = array(
      // array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'nombre', 'dt' => 'Nombre', "field" => "nombre"),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    if ($json) {
      $condiciones = array();
      $joinQuery = "FROM {$this->model->table}";


      $tipo = $this->request->getPost('tipo');

      if (!empty($tipo)) $condiciones[] = " idCategoria = '{$tipo}'";

      $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
      echo json_encode(
        $ssp->simple($_POST, $this->getDataConn(), $this->model->getTable(), $this->model->getPrimaryKey(), $columns, $joinQuery, $where)
      );
      exit(0);
    }
    helper('formulario');
    $response['columns'] = $columns;
    $response['columns2'] = $columns2;

    $this->showHeader();
    $this->ShowContent('lista', $response);
    $this->showFooter();
  }


  public function cates()
  {
    if (empty($this->user->id)) return redirect()->to('/admin/login');

    $ssp = new Ssp();

    $columns = array(
      // array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'nombre', 'dt' => 'Nombre', "field" => "nombre"),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    $condiciones = array();
    $joinQuery = "FROM {$this->modelCategorias->table}";
    $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
    echo json_encode(
      $ssp->simple($_POST, $this->getDataConn(), $this->model->getTable(), $this->model->getPrimaryKey(), $columns, $joinQuery, $where)
    );
    exit(0);
  }

  

  public function guardar($id = '')
  {
    $data = $this->validar($this->model->getFields());

    if (empty($id)) {
      $this->model->insert($data);
      $id = $this->model->getInsertID();

      $audio = $this->request->getFile('foto');
      $path = $audio->getName();

      if ($this->guardar_audio($this->imagebase, $path)) {
        $this->model->update(['id' => $id], ['archivo' => $path]);
      }
    } else {

      $audio = $this->request->getFile('foto');
      $path = $audio->getName();

      // $path = empty($data['imagen']) ? uniqid() . '.mp3' : $data['archivo'];
      if ($this->guardar_audio($this->imagebase, $path)) {
        $data['archivo'] = $path;
      }
      $this->model->update(['id' => $id], $data);
    }

    $a = $this->model->find($id);

    $this->dieMsg(true);
  }

  public function crear()
  {
    helper('form');
    helper('formulario');

    $datos['id'] = '0';
    $datos['titulo'] = 'Nuevo audio';
    $datos['fields'] = $this->model->geti();
    $datos['utipos'] = $this->db->query("SELECT id, nombre as `text` FROM categorias")->getResult();
    $datos['foto'] = $this->noview;

    $this->showContent('form', $datos);
  }

  public function editar($id)
  {
    helper('form');
    helper('formulario');
    $datos['id'] = $id;
    $datos['titulo'] = 'Editar audio';

    $datos['fields'] = $this->model->geti($id);
    $datos['utipos'] = $this->db->query("SELECT id, nombre as `text` FROM categorias")->getResult();

    if (empty($datos['fields']->imagen->value)) $datos['foto'] = $this->noview;
    else $datos['foto'] = base_url($this->imagebase) . ($datos['fields']->imagen->value);

    $this->showContent('form', $datos);
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



  public function cate_guardar($id = '')
  {
    $data = $this->validar($this->modelCategorias->getFields());

    if (empty($id)) {
      $this->modelCategorias->insert($data);
    } else {
      $this->modelCategorias->update(['id' => $id], $data);
    }

    $a = $this->modelCategorias->find($id);

    $this->dieMsg(true);
  }

  public function cate_crear()
  {
    helper('form');
    helper('formulario');

    $datos['id'] = '0';
    $datos['titulo'] = 'Nueva categoría';
    $datos['fields'] = $this->modelCategorias->geti();

    $this->showContent('cate_form', $datos);
  }

  public function cate_editar($id)
  {
    helper('form');
    helper('formulario');
    $datos['id'] = $id;
    $datos['titulo'] = 'Editar categoría';

    $datos['fields'] = $this->modelCategorias->geti($id);
    $this->showContent('cate_form', $datos);
  }

  public function cate_borrar($id)
  {
    $this->dieAjax();
    $rows = $this->db->query("SELECT * FROM musica WHERE idCategoria='{$id}'")->getResult();
    if(count($rows)<=0) $this->modelCategorias->where("id='{$id}'")->delete();
    $this->dieMsg();
  }
}

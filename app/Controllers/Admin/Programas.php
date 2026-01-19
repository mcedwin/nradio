<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Programas extends BaseController
{
  protected $model;

  public function __construct()
  {
    $this->model = new GeneralModel('programas');
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


    $columns = array(
      array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'titulo', 'dt' => 'Titulo', "field" => "titulo"),
      array('db' => 'activo', 'dt' => 'Activo', "field" => "activo", "formatter" => $botonActivo),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    if ($json) {
      $condiciones = array();

      $joinQuery = "FROM {$this->model->table}";

      $activo = $this->request->getPost('activo');
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

  public function crear()
  {
    helper('form');
    helper('formulario');

    $datos['id'] = '0';
    $datos['titulo'] = 'Nuevo banner';
    $datos['fields'] = $this->model->geti();
    $datos['foto'] = $this->noview;

    $this->showContent('form', $datos);
  }

  public function guardar($id = '')
  {
    $data = $this->validar($this->model->getFields());

    if (empty($id)) {
      $this->model->insert($data);
      $id = $this->model->getInsertID();


    } else {
      $this->model->update(['id' => $id], $data);
    }

    $a = $this->model->find($id);

    $this->dieMsg(true);
  }

  public function editar($id)
  {
    helper('form');
    helper('formulario');
    $datos['id'] = $id;
    $datos['titulo'] = 'Editar banner';

    $datos['fields'] = $this->model->geti($id);

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
    $this->db->query("UPDATE ".$this->model->getTable()." SET activo = NOT activo WHERE id='{$id}'");
    $this->dieMsg();
  }
}

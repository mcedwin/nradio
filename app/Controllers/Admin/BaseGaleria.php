<?php
namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
trait BaseGaleria 
{
  public function galeria($id)
  {

    $modelImagenes = new GeneralModel('imagenes');

    if (empty($this->user->id)) return redirect()->to('/admin/login');

    $ssp = new Ssp();

    $this->addCss(array('lib/datatable/datatables.min.css'));
    $this->addJs(array('lib/datatable/datatables.min.js', "js/admin/galerias/galeria.js"));
    $json = isset($_GET['json']) ? $_GET['json'] : false;


    $funcImagen = function ($d, $row) {
      return '<img src="' . base_url($this->imagebaseImagenes . $row['imagen']) . '" width="80" >';
    };

    $columns = array(
      array('db' => 'id', 'dt' => 'ID', "field" => "id"),
      array('db' => 'detalle', 'dt' => 'Titulo', "field" => "detalle"),
      array('db' => 'imagen', 'dt' => 'Imagen', "field" => "imagen", "formatter" => $funcImagen),
      array('db' => 'id',  'dt' => 'DT_RowId', "field" => "id"),
    );

    if ($json) {
      $condiciones = array();

      $joinQuery = "FROM {$modelImagenes->table}";

      // $activo = $this->request->getPost('activo');
      //$tipo = $this->request->getPost('tipo');

      // if (!empty($activo)) $condiciones[] = " activo = '{$activo}'";
      $condiciones[] = " tipo = {$this->gale_tipo} and idContenido = '{$id}'";

      $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
      echo json_encode(
        $ssp->simple($_POST, $this->getDataConn(), $modelImagenes->getTable(), $modelImagenes->getPrimaryKey(), $columns, $joinQuery, $where)
      );
      exit(0);
    }

    $response['fields'] = $this->model->geti($id);

    helper('formulario');
    $response['columns'] = $columns;
    $response['id'] = $id;
    $response['tipo'] = $this->gale_tipo;

    $this->showHeader();
    echo view('admin/galerias/galeria', array_merge($this->datos, $response));
    $this->showFooter();
  }

  public function galeria_crear($idContenido)
  {

    // die($this->gale_tipo.'--');
    helper('form');
    helper('formulario');

    $datos['id'] = '0';
    $datos['tipo'] = $this->gale_tipo;
    $datos['idContenido'] = $idContenido;
    $datos['titulo'] = 'Nueva galeria';
    $datos['fields'] = $this->modelImagenes->geti();
    $datos['foto'] = $this->noview;

    echo view('admin/galerias/galeria_form', array_merge($this->datos, $datos));
  }

  public function galeria_guardar($id = '')
  {
    $data = $this->validar($this->modelImagenes->getFields());

    if (empty($id)) {
      $this->modelImagenes->insert($data);
      $id = $this->modelImagenes->getInsertID();

      $path = uniqid() . '.jpg';

      if ($this->guardar_imagen($this->imagebaseImagenes, $path)) {
        $this->modelImagenes->update(['id' => $id], ['imagen' => $path]);
      }
    } else {
      // $path = empty($data['imagen']) ? uniqid() . '.jpg' : $data['imagen'];
      $path = uniqid() . '.jpg';
      if ($this->guardar_imagen($this->imagebaseImagenes, $path)) {
        $data['imagen'] = $path;
      }
      $this->modelImagenes->update(['id' => $id], $data);
    }

    $a = $this->modelImagenes->find($id);

    $this->dieMsg(true);
  }

  public function galeria_editar($id)
  {
    helper('form');
    helper('formulario');
    $datos['id'] = $id;
    $datos['titulo'] = 'Editar galeria';
    
    $datos['fields'] = $reg = $this->modelImagenes->geti($id);
    $datos['tipo'] = $reg->tipo->value;
    $datos['idContenido'] = $reg->idContenido->value;

    if (empty($datos['fields']->imagen->value)) $datos['foto'] = $this->noview;
    else $datos['foto'] = base_url($this->imagebaseImagenes) . ($datos['fields']->imagen->value);

    echo view('admin/galerias/galeria_form', array_merge($this->datos, $datos));
  }

  public function galeria_borrar($id)
  {
    $this->dieAjax();
    $this->modelImagenes->where("id='{$id}'")->delete();
    $this->dieMsg();
  }
}

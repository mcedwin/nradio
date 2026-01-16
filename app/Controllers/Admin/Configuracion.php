<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Configuracion extends BaseController
{
  protected $model;
  public $imagebase = 'static/images/configuracion/';

  public function __construct()
  {
    $this->model = new GeneralModel('configuracion');
  }

  public function index()
  {
    if (empty($this->user->id)) return redirect()->to('/admin/login');

    // $this->addCss(array('lib/datatable/datatables.min.css'));
    $this->addJs(array('lib/tinymce/tinymce.min.js', "js/admin/{$this->controller}/lista.js"));

    // $this->addJs(array("js/admin/{$this->controller}/lista.js"));

    helper('form');
    helper('formulario');

    $datos['id'] = '0';
    $datos['titulo'] = 'Nuevo banner';
    $datos['fields'] = $this->model->geti(1);

    $imgs = ['imagenBiografias','imagenLocales', 'imagenCampanias', 'imagenNoticias', 'imagenTestimonios', 'imagenMultimedias', 'imagenContactenos', 'imagenfrmPedido', 'imagenfrmTestimonio'];
    $datos['list'] = $imgs; 
    foreach ($imgs as $img) {
      if (empty($datos['fields']->{$img}->value)) $datos['img'][$img] = $this->noview;
      else $datos['img'][$img] = base_url($this->imagebase) . ($datos['fields']->{$img}->value);
    }

    // if (empty($datos['fields']->imagenLocales->value)) $datos['imagenLocales'] = $this->noview;
    // else $datos['imagenLocales'] = base_url($this->imagebase) . ($datos['fields']->imagenLocales->value);


    // if (empty($datos['fields']->imagenCampanias->value)) $datos['imagenCampanias'] = $this->noview;
    // else $datos['imagenCampanias'] = base_url($this->imagebase) . ($datos['fields']->imagenCampanias->value);

    $this->showHeader();
    $this->ShowContent('lista', $datos);
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

  public function guardar()
  {
    $data = $this->validar($this->model->getFields());


    // $imgs = ['imagenBiografias','imagenLocales', 'imagenCampanias', 'imagenNoticias', 'imagenTestimonios', 'imagenMultimedias', 'imagenContactenos', 'imagenfrmPedido', 'imagenfrmTestimonio'];

    // foreach ($imgs as $img) {
    //   $path = empty($data[$img]) ? uniqid() . '.jpg' : $data[$img];
    //   if ($this->guardar_imagen1($this->imagebase, $path, $img)) {
    //     $data[$img] = $path;
    //   }
    // }

    $this->model->update(['id' => 1], $data);

    $this->dieMsg(true);
  }

  public function editar($id)
  {
    helper('form');
    helper('formulario');
    $datos['id'] = $id;
    $datos['titulo'] = 'Editar banner';

    $datos['fields'] = $this->model->geti($id);

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
}

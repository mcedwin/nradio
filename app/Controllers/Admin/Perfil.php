<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Perfil extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GeneralModel('user');
    }
   
    public function index()
    {
      if (empty($this->user->id)) return redirect()->to('/admin/login');
        $this->meta->title = "Perfil de miembro";
        helper("formulario");
        $datos['fields'] = $this->model->geti($this->user->id);
        $datos['fields']->password->value = '';
        $datos['tipos'] = $this->model->enum_valores("tipo");
        $this->addJs(array("js/admin/perfil/perfil.js"));
        $this->showHeader();
        $this->ShowContent('perfil',$datos);
        $this->showFooter();
    }

    public function guardar_perfil()
    {
        $data = $this->validar($this->model->getFields());
        // die(print_r($data));
        if (empty($data['password'])) unset($data['password']);
        else $data['password'] = md5($this->request->getPost('password'));

        $this->db->table('user')->update($data, array('id' => $this->user->id));
        $this->dieMsg(true, '', base_url('admin/perfil'));
    }

    public function crear($tipo="")
    {
        helper('form');
        helper('formulario');

        $datos['id'] = '0';
        $datos['titulo'] = 'Nuevo usuario '.($tipo=='paciente'?'paciente':($tipo=='solicitante'?'profesional':'externo'));
        $datos['tipo'] = $tipo;
        $datos['utipos'] = $this->db->query("SELECT id as `id`, nombre as `text` FROM externo_tipo")->getResult();
        $datos['fields'] = $this->model->geti();

        $this->showContent('form', $datos);
    }

    public function guardar($id = '')
    {
        $data = $this->validar($this->model->getFields());

        if (empty($data['password'])) unset($data['password']);
        else $data['password'] = md5($this->request->getPost('password'));

        if (empty($id)) {
            $this->model->insert($data);
            $id = $this->model->getInsertID();
        } else {
            $this->model->update(['id' => $id], $data);
        }

        $a = $this->model->find($id);
        
        $this->dieMsg(true,'','',['id'=>$a->id,'text'=>$a->apellidos.' '.$a->nombres,'email'=>$a->email]);
    }

    public function editar($id,$tipo="")
    {
        helper('form');
        helper('formulario');
        $datos['id'] = $id;
        $datos['tipo'] = $tipo;
        $datos['titulo'] = 'Editar usuario externo';
        $datos['utipos'] = $this->db->query("SELECT id as `id`, nombre as `text` FROM externo_tipo")->getResult();

        $datos['fields'] = $this->model->geti($id);
        $datos['fields']->password->value = '';

        $this->showContent('form', $datos);
    }

    public function borrar($id)
    {
        $this->dieAjax();
        $this->model->where("id='{$id}' AND id!=1")->delete();
        $this->dieMsg();
    }
    public function activar($id)
    {
        $this->dieAjax();
        $this->db->query("UPDATE externo SET activo = NOT activo WHERE id='{$id}'");
        $this->dieMsg();
    }

    public function buscar($tipo)
    {
        $responese = new \StdClass;
        $search = isset($_GET['q']) ? $_GET["q"] : '';
        $datos = array();

        $tipo = $tipo=='paciente'?'1':'2';

        $producto = $this->db->query("SELECT * FROM externo WHERE CONCAT(apellidos,' ',nombres) LIKE '%{$search}%' AND idTipo='{$tipo}' ORDER BY id")->getResult();

        foreach ($producto as $value) {
            $datos[] = array("id" => $value->id, "text" => $value->apellidos . " / " . $value->nombres,'email'=>$value->email);
        }
        $responese->total_count = count($producto);
        $responese->items = $datos;

        echo json_encode($responese);
    }
}

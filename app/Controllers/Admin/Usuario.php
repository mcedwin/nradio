<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Usuario extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GeneralModel('usuario');
        
    }
    
    public function index()
    {
        if (empty($this->user->id)) return redirect()->to('/admin/login');
       // if (empty($this->user->id)) return redirect()->to('login');

        $ssp = new Ssp();

        $this->addCss(array('lib/datatable/datatables.min.css'));
        $this->addJs(array('lib/datatable/datatables.min.js', 'js/admin/usuario/lista.js'));
        $json = isset($_GET['json']) ? $_GET['json'] : false;

        $botonActivo = function ($d, $row) {
            $url = base_url('usuario/activar/' . $row['id']);
            if($d == 1) return '<a href="' .$url. '" class="btn btn-sm btn-info activar"><i class="fa-solid fa-check"></i> Activo</a>';
            return '<a href="' .$url. '" class="btn btn-sm btn-light activar">Inactivo</a>';
        };

        $columns = array(
            array('db' => 'id', 'dt' => 'ID', "field" => "id"),
            array('db' => 'nombres', 'dt' => 'Nombres', "field" => "nombres"),
            array('db' => 'apellidos', 'dt' => 'Apellidos', "field" => "apellidos"),
            array('db' => 'email', 'dt' => 'Email', "field" => "email"),
            array('db' => 'activo', 'dt' => 'Activo', "field" => "activo", "formatter" => $botonActivo),
            array('db' => 'id',  'dt' => 'DT_RowId',        "field" => "id"),
        );

        if ($json) {
            $condiciones = array();

            $joinQuery = "FROM {$this->model->table}";

            $activo = $this->request->getPost('activo');
            $tipo = $this->request->getPost('tipo');

            if(!empty($activo)) $condiciones[] = " activo = '{$activo}'";
            if(!empty($tipo)) $condiciones[] = " idTipo = '{$tipo}'";

            $where = count($condiciones) > 0 ? implode(' AND ', $condiciones) : "";
            echo json_encode(
                $ssp->simple($_POST, $this->getDataConn(), $this->model->getTable(), $this->model->getPrimaryKey(), $columns, $joinQuery, $where)
            );
            exit(0);
        }
        helper('formulario');
        $response['utipos'] = $this->db->query("SELECT id as `id`, nombre as `text` FROM usuario_tipo")->getResult();
        $response['columns'] = $columns;

        $this->showHeader();
        $this->ShowContent('lista', $response);
        $this->showFooter();
    }
    
    public function perfil()
    {
        $this->meta->title = "Perfil de miembro";
        helper("formulario");
        $datos['fields'] = $this->model->geti($this->user->id);
        $datos['fields']->password->value = '';
       // $datos['tipos'] = $this->model->enum_valores("tipo");
        //$datos['fields']->foto->value = base_url('uploads/usuario') . (empty($datos['fields']->foto->value) ? '/sinlogo.png' : '/' . $datos['fields']->foto->value);
        $this->addJs(array("js/usuario/perfil.js"));
        $this->showHeader();
        $this->ShowContent('perfil',$datos);
        $this->showFooter();
    }

    public function guardar_perfil()
    {
        $data = $this->validar($this->model->getFields());
        unset($data['foto']);
        if (empty($data['password'])) unset($data['password']);
        else $data['password'] = md5($this->request->getPost('password'));

        // $path = 'img_' . $this->user->id . '.small.jpg';
        // if ($this->guardar_imagen('uploads/usuario', $path)) {
        //     $data = array_merge($data, array('foto' => $path));
        // }
        $this->db->table('usuario')->update($data, array('id' => $this->user->id));
        $this->dieMsg(true, '', base_url('admin/usuario/perfil'));
    }

    public function crear()
    {
        helper('form');
        helper('formulario');

        $datos['id'] = '0';
        $datos['titulo'] = 'Nuevo usuario';
        $datos['utipos'] = $this->db->query("SELECT id as `id`, nombre as `text` FROM usuario_tipo")->getResult();
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

    public function editar($id)
    {
        helper('form');
        helper('formulario');
        $datos['id'] = $id;
        $datos['titulo'] = 'Editar usuario';
        $datos['utipos'] = $this->db->query("SELECT id as `id`, nombre as `text` FROM usuario_tipo")->getResult();

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
        $this->db->query("UPDATE usuario SET activo = NOT activo WHERE id='{$id}'");
        $this->dieMsg();
    }


    public function buscar()
    {
        $responese = new \StdClass;
        $search = isset($_GET['q']) ? $_GET["q"] : '';
        $datos = array();

        $producto = $this->db->query("SELECT * FROM usuario WHERE CONCAT(apellidos,' ',nombres) LIKE '%{$search}%' ORDER BY id")->getResult();

        foreach ($producto as $value) {
            $datos[] = array("id" => $value->id, "text" => $value->apellidos . " / " . $value->nombres,'email'=>$value->email);
        }
        $responese->total_count = count($producto);
        $responese->items = $datos;

        echo json_encode($responese);
    }
}

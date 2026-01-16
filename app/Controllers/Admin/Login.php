<?php

namespace App\Controllers\Admin;

use App\Libraries\Ssp;
use App\Models\GeneralModel;
use App\Controllers\BaseController;

class Login extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new GeneralModel('user');
    }

    function index()
    {
        if (!empty($this->user->id)) {
            return redirect()->to('banners');
            exit(0);
        }

        helper("formulario");

        $this->addJs(array('js/admin/login/form.js'));

        $datos['fields'] = $this->model->geti();
        $this->showHeader(false);
        $this->showContent('login', $datos);
        $this->showFooter(false);
    }

    public function ingresar($tipo)
    {
        $tabla = 'user';
        
        $usuario  = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $ip = $this->request->getIPAddress();

        $sql = "SELECT id as id,names FROM {$tabla} WHERE activo=1 AND email='{$usuario}' AND password=md5('{$password}') LIMIT 1";
        $result = $this->db->query($sql);

        $session = session();
        if ($result->getNumRows()) {
            $row = $result->getRow();
            $sesdata = array(
                'id'  => $row->id,
                'user'  => $row->names,
                'auth'     => true
            );
            $session->set($sesdata);
            $sql = "UPDATE {$tabla} SET lastip='{$ip}' WHERE id='{$row->id}'";
            $this->db->query($sql);
        } else {
            $this->dieMsg(false, "Error al ingresar sus datos.");
        }
        $this->dieMsg(true, '', base_url('admin/banners'));
    }

    function salir()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    function proc_cambiar($password2)
    {
        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        $ip = $this->request->getIPAddress();

        $sql = "SELECT id as id,email as email,idTipo as type FROM usuario WHERE 
        email='{$email}' AND !(password2 IS NULL) AND !(password2='') 
        AND  password2='{$password2}' LIMIT 1";

        $row = $this->db->query($sql)->getRow();
        if ($row) {
            $sql = "UPDATE usuario SET lastip='{$ip}',password=md5('{$password}'),password2=NULL WHERE id='{$row->id}'";
            $this->db->query($sql);
        } else {
            $this->dieMsg(false, "Error al ingresar sus datos");
        }
        $this->dieMsg(true, '', base_url());
    }


    function cambiar($email, $password2)
    {
        $this->meta->title = "Cambiar contraseña";
        $this->addJs(array("js/login/login.js"));
        $datos['password2'] = $password2;
        $datos['email'] = urldecode($email);
        $this->showHeader(true);
        $this->showContent('cambiar', $datos);
        $this->showFooter();
    }

    function confirmar($email, $password2)
    {
        $email = urldecode($email);
        $this->db->query("UPDATE usuario SET password2=NULL, activo=1 WHERE email='{$email}' AND password2='{$password2}'");
        return redirect()->to('/');
    }

    function recuperar()
    {
        $this->ShowContent('recuperar');
    }

    public function proc_recuperar()
    {
        $email = $this->request->getPost('email');
        $row = $this->db->query("SELECT * FROM usuario WHERE email='{$email}'")->getRow();
        if ($row) {
            $this->sendpassword($row);
        } else {
            $this->dieMsg(false, "Email no encontrado.");
        }
    }

    public function sendpassword($row)
    {
        $plan = $this->db->query("SELECT * FROM config_plantilla WHERE plan_id=2")->getRow();

        $passwordplain  = rand(999999999, 9999999999);
        $newpass = md5($passwordplain);

        $this->db->query("UPDATE usuario SET password2='{$newpass}' WHERE email='{$row->email}'");

        $asunto = $this->traducir($plan->plan_asunto);
        $cuerpo = $this->traducir($plan->plan_cuerpo, ['url' => base_url('login/cambiar/' . urlencode($row->email) . '/' . $newpass)]);

        $em = $this->getMail();
        $em->setTo($row->email);
        $em->setSubject($asunto);
        $em->setMessage($cuerpo);

        if ($em->send(FALSE)) {
            $this->dieMsg();
        } else {
            $this->dieMsg(false, "Error al enviar correo.");
        }
    }

    public function sendpregistro($nombres, $email, $password2)
    {
        $plan = $this->db->query("SELECT * FROM config_plantilla WHERE plan_id=1")->getRow();

        $asunto = $this->traducir($plan->plan_asunto);
        $cuerpo = $this->traducir($plan->plan_cuerpo, ['url' => base_url('login/confirmar/' . urlencode($email) . '/' . $password2)]);

        $em = $this->getMail();
        $em->setTo($email);
        $em->setSubject($asunto);
        $em->setMessage($cuerpo);

        if ($em->send(FALSE)) {
            $this->dieMsg();
        } else {
            $this->dieMsg(false, "Error al enviar correo.");
        }
    }
}

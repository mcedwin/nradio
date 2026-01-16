<?php

namespace App\Controllers;

use App\Models\GeneralModel;

class Contactenos extends BaseController
{
  protected $modelPedido;
  protected $modelSuscribir;
  protected $modelTestimonio;

  public $imagebase = 'static/images/testimonios/';

  public function __construct()
  {
    $this->modelPedido = new GeneralModel('pedidos');
    $this->modelSuscribir = new GeneralModel('suscribir');
    $this->modelTestimonio = new GeneralModel('testimonios');
  }

  public function pedidos()
  {
    $this->addJs(['js/form.js']);
    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    $datos['title'] = 'Envianos tu Pedido';

    $this->showWHeader();
    $this->ShowContent('pedidos', $datos);
    $this->showWFooter();
  }

  public function pedido_guardar($id = '')
  {
    $data = $this->validar($this->modelPedido->getFields());
    $fields = $this->modelPedido->getFields();

    $this->modelPedido->insert($data);

    $this->enviar($data, $fields, 'pedidosdeoracion@iplacosecha.pe', 'Mensaje de Pedido de Oracion');

    $this->dieMsg(true,"SU MENSAJE HA SIDO ENVIADO CORRECTAMENTE, DIOS LE BENDIGA.");
  }


  public function contacto_guardar($id = '')
  {
    $data = $this->validar($this->modelSuscribir->getFields());
    $fields = $this->modelSuscribir->getFields();

    $this->modelSuscribir->insert($data);

    $this->enviar($data, $fields, 'info@iplacosecha.pe', 'Mensaje de Contacto');

    $this->dieMsg(true,'SU MENSAJE HA SIDO ENVIADO CORRECTAMENTE, DIOS LE BENDIGA.');
  }


  public function testimonio_guardar($id = '')
  {
    $data = $this->validar($this->modelTestimonio->getFields());
    $fields = $this->modelTestimonio->getFields();

    $this->modelTestimonio->insert($data);
    $id = $this->modelTestimonio->getInsertID();

    $path = uniqid() . '.jpg';

    if ($this->guardar_imagen($this->imagebase, $path)) {
      $this->modelTestimonio->update(['id' => $id], ['imagen' => $path]);
    }

    $this->enviar($data, $fields, 'info@iplacosecha.pe', 'Mensaje de Testimonio');

    $this->dieMsg(true,'SU TESTIMONIO HA SIDO ENVIADO CORRECTAMENTE, DIOS LE BENDIGA.');
  }

  // public function guardar($id = '')
  // {
  //   $data = $this->validar($this->model->getFields());

  //   if (empty($id)) {
  //     $this->model->insert($data);
  //     $id = $this->model->getInsertID();

  //     $path = uniqid() . '.jpg';

  //     if ($this->guardar_imagen($this->imagebase, $path)) {
  //       $this->model->update(['id' => $id], ['imagen' => $path]);
  //     }
  //   } else {
  //     $path = empty($data['imagen']) ? uniqid() . '.jpg' : $data['imagen'];
  //     if ($this->guardar_imagen($this->imagebase, $path)) {
  //       $data['imagen'] = $path;
  //     }
  //     $this->model->update(['id' => $id], $data);
  //   }

  //   $this->dieMsg(true);
  // }

  public function enviar($data, $fields, $semail, $asunto)
  {
    $email = \Config\Services::email();

    $email->setFrom($data[$fields['email']->name], $data[$fields['nombre']->name]);
    $email->setTo($semail);



    $message = "<div><h4>'.$asunto.'</h4><table borer='0'>";

    foreach ($fields as $field) {
      if (!isset($data[$field->name])) continue;
      $message .= "<tr><td>" . $field->label . ":</td><td> " . $data[$field->name] . "  </td> </tr>";
    }
    $message .= "</table></div>";
    $email->setSubject($asunto);
    $email->setMessage($message);

    if ($email->send()) {
      // $this->dieMsg(true);
      return true;
    } else {
      $this->dieMsg(false, "Error al enviar correo.");
    }
  }

  public function contacto()
  {
    $this->addJs(['js/form.js']);
    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    $datos['title'] = 'Contacto';

    $this->showWHeader();
    $this->ShowContent('contacto', $datos);
    $this->showWFooter();
  }

  public function testimonio()
  {
    $this->addJs(['js/form.js']);
    $datos['config'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    $datos['title'] = 'Cuéntanos tu testimonio';

    $datos['foto'] = $this->noview;

    $this->showWHeader();
    $this->ShowContent('testimonio', $datos);
    $this->showWFooter();
  }
}

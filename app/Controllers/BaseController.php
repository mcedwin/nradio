<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

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
abstract class BaseController extends Controller
{
  /**
   * Instance of the main Request object.
   *
   * @var CLIRequest|IncomingRequest
   */
  protected $request;

  /**
   * An array of helpers to be loaded automatically upon
   * class instantiation. These helpers will be available
   * to all other controllers that extend BaseController.
   *
   * @var list<string>
   */
  protected $helpers = [];
  public $csss = [];
  public $jss = [];
  public $frontVersion = 4;
  public $user;
  public $usizes;
  public $esizes;
  public $meta;
  public $title;
  public $controller;
  public $db;
  public $mc_scripts;
  public $noview;
  protected $datos = [];

  /**
   * Be sure to declare properties for any property fetch you initialized.
   * The creation of dynamic property is deprecated in PHP 8.2.
   */
  // protected $session;

  /**
   * @return void
   */
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {

    $this->db = db_connect();


    $session = session();
    $this->user = (object)[
      'id' => $session->get('id'),
      'name' => $session->get('user'),
      'type' => $session->get('type'),
      'admin' => $session->get('admin'),
    ];

    $this->datos['user'] = $this->user;

    $this->controller = strtolower(class_basename(service('router')->controllerName()));
    $this->datos['controller'] = $this->controller;


    $this->title = 'RADIO VISIÓN - Programacion Radial';
    $this->meta = (object) array(
      'title' => $this->title,
      'description' => 'RADIO VISIÓN - Programacion Radial',
      'image' => '',
      'url' => current_url(),
      'site_name' => 'RADIO VISIÓN - Programacion Radial',
    );

    $this->noview = base_url() . '/sys/assets/img/noview.jpg';

    // Do Not Edit This Line
    parent::initController($request, $response, $logger);

    // Preload any models, libraries, etc, here.

    // E.g.: $this->session = \Config\Services::session();
  }

  public function validar($fields)
  {
    $validation =  \Config\Services::validation();
    $data = array();
    foreach ($this->request->getPost() as $key => $val) {
      if (!isset($fields[$key])) {
        continue;
      }
      if ($fields[$key]->type == 'select') $fields[$key]->type = 'int';
      if ($fields[$key]->type == 'hidden') $fields[$key]->type = 'text';
      if ($fields[$key]->required == true) {
        if (!empty($fields[$key]->valid)) {
          if (!$this->validate([$fields[$key]->name => $fields[$key]->valid])) {
            $errors = $validation->getErrors();
            $this->dieMsg(false, $errors[$fields[$key]->name]);
          }
        }
        if (is_array($val)) {
          if (count($val) <= 0) $this->dieMsg(false, "Campo requerido : " . $fields[$key]->label);
        } else if ($fields[$key]->type != 'bit' && strlen($val) <= 0) $this->dieMsg(false, "Campo requerido : " . $fields[$key]->label);
      }
      if (in_array($fields[$key]->type, array('text', 'varchar', 'url', 'email', 'fore', 'decimal', 'int', 'enum','password','char'))) {
        $data[$key] = $this->request->getPost($key);
        if ($fields[$key]->type == 'int' && empty($val)) $data[$key] = null;
      } else if ($fields[$key]->type == 'date') {
        $data[$key] = ($val);
      } else if ($fields[$key]->type == 'bit') {
        $data[$key] = $this->request->getPost($key) == '1' ? 1 : 0;
      }
    }
    return $data;
  }

  public function getDataConn()
  {
    return array(
      'user' => $this->db->username,
      'pass' => $this->db->password,
      'db' => $this->db->database,
      'host' => $this->db->hostname
    );
  }

  public function dieAjax()
  {
    if (
      isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
    ) {
      return true;
    }
    $this->dieMsg(false, "No es ajax.");
  }

  public function diePermiso($user)
  {

    if (is_null($user) || empty($user)) {

      if ($this->isAjax()) {
        $this->dieMsg(true, "user", base_url('login'));
      } else {
        return redirect()->to('/admin/login');
      }
    }
    return false;
  }

  public function isAjax()
  {
    if (
      isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], 'xmlhttprequest') == 0
    ) {
      return true;
    }
    return false;
  }

  public function addJs($jss)
  {
    if (is_array($jss)) $this->jss = $jss;
    else $this->jss[] = $jss;
  }
  public function addCss($csss)
  {
    if (is_array($csss)) $this->csss = $csss;
    else $this->csss[] = $csss;
  }

  public function showHeader($conmenu = true)
  {
    $strcss = '';

    $this->datos['menu'] = [
      [
        'title' => 'REGISTRO',
        'menu' => [
          // ['url' => 'home', 'base' => 'home', 'name' => 'Inicio', 'ico' => 'fa-solid fa-house', 'menu' => []],
          ['url' => 'admin/banners', 'base' => 'banners', 'name' => 'Banners', 'ico' => 'fa-solid fa-film', 'menu' => []],
          ['url' => 'admin/programas', 'base' => 'programas', 'name' => 'Programas', 'ico' => 'fa-solid fa-film', 'menu' => []],
          ['url' => 'admin/noticias', 'base' => 'noticias', 'name' => 'Noticias', 'ico' => 'fa-regular fa-newspaper', 'menu' => []],

        ]
      ],
      [
        'title' => 'REPORTES',
        'menu' => [
          ['url' => 'admin/frecuencias', 'base' => 'frecuencias', 'name' => 'Frecuencias', 'ico' => 'fa-solid fa-city', 'menu' => []],
        ]
      ],
      [
        'title' => 'MULTIMEDIA',
        'menu' => [
          ['url' => 'admin/fotos', 'base' => 'fotos', 'name' => 'Fotos', 'ico' => 'fa-solid fa-camera', 'menu' => []],

        ]
      ],
      [
        'title' => 'ADMINISTRACIÓN',
        'menu' => [
          ['url' => 'admin/configuracion', 'base' => 'configuracion', 'name' => 'Configuración', 'ico' => 'fa-solid fa-gear', 'menu' => []],
          ['url' => 'admin/audios', 'base' => 'audios', 'name' => 'Audios', 'ico' => 'fa-solid fa-music', 'menu' => []],
        ]
      ],
    ];


    foreach ($this->csss as $css) {
      $strcss .= '<link href="' . ((preg_match('#^htt#', $css) == TRUE) ? '' : base_url('sys/assets') . '/') . $css . '?v=' . $this->frontVersion . '" rel="stylesheet" type="text/css" media="all" />';
    }

    $this->mc_scripts['css'] = $strcss;

    if ($this->title != $this->meta->title) $this->meta->title = $this->meta->title . ' | ' . $this->meta->site_name;
    $this->mc_scripts['meta'] = $this->meta;
    echo view('templates/header', $this->mc_scripts);
    if ($conmenu == true) echo view('templates/menu', $this->datos);
  }

  public function getMail()
  {
    $conf = $this->db->query("SELECT * FROM config")->getRow();

    $email = \Config\Services::email();

    $config['protocol'] = 'smtp';
    $config['SMTPHost'] = $conf->conf_mail_host;
    $config['SMTPUser']  = $conf->conf_mail_user;
    $config['SMTPPass'] = $conf->conf_mail_pass;
    $config['SMTPPort'] = $conf->conf_mail_port;
    $config['SMTPCrypto'] = $conf->conf_mail_crypto;
    $config['SMTPTimeout'] = '60';
    $config['mailType'] = 'html';


    $email->initialize($config);
    $email->setFrom($conf->conf_mail_reply, $conf->conf_mail_nreply);
    return $email;
  }

  public function traducir($mensaje, $add = [])
  {
    $list = (array)$this->user;
    $list = array_merge($list, $add);
    foreach ($list as $id => $item) {
      $mensaje = str_replace('{' . $id . '}', $item, $mensaje);
    }
    return $mensaje;
  }

  public function showContent($path, $response = [])
  {

    $router = service('router');
    $controller  = preg_replace("#.App.Controllers.#", '', $router->controllerName());

    //die(strtolower($controller)."---".$path);
    echo view(str_replace("\\", "/", strtolower($controller)) . '/' . $path, array_merge($this->datos, $response));
  }
  public function showFooter($conmenu = true)
  {
    $strjs = '';

    foreach ($this->jss as $js) {
      $strjs .= '<script type="text/javascript" src="' . ((preg_match('#^htt#', $js) == TRUE) ? '' : base_url('sys/assets') . '/') . $js . '?v=' . $this->frontVersion . '"></script>';
    }

    $datos['js'] = $strjs;
    $datos['conmenu'] = $conmenu;
    echo view('templates/footer', $datos);
  }


  public function showWHeader()
  {
    $this->datos['noticias']=$this->db->query("SELECT * FROM noticias order by orden asc limit 3")->getResult();
    $strcss = '';

    $this->datos['menu'] = [
      ['url' => '/', 'base' => 'home', 'name' => 'INICIO', 'ico' => 'fa-solid fa-house', 'menu' => []],
      ['url' => 'frecuencias', 'base' => 'frecuencias', 'name' => 'NUESTRAS FRECUENCIAS', 'ico' => 'fa-solid fa-film', 'menu' => []],
      ['url' => 'programacion', 'base' => 'programacion', 'name' => 'PROGRAMACIÓN', 'ico' => 'fa-regular fa-newspaper', 'menu' => []],
      ['url' => 'noticias', 'base' => 'noticias', 'name' => 'NOTICIAS', 'ico' => 'fa-regular fa-newspaper', 'menu' => []],
      ['url' => 'contacto', 'base' => 'contacto', 'name' => 'CONTACTENOS', 'ico' => 'fa-regular fa-newspaper', 'menu' => []],
      // ['url' => 'programaactual', 'base' => 'programaactual', 'name' => 'PROGRAMA: LA VOZ DE SALVACIÓN', 'ico' => 'fa-regular fa-newspaper', 'menu' => []],
      ['url' => 'multimedia', 'base' => 'multimedia', 'name' => 'MULTIMEDIA', 'ico' => 'fa-regular fa-newspaper', 'menu' => [
        ['url' => 'fotos', 'base' => 'multimedia', 'name' => 'Fotos'],
        ['url' => 'audios', 'base' => 'multimedia', 'name' => 'Audio'],
      ]],
    ];


    foreach ($this->csss as $css) {
      $strcss .= '<link href="' . ((preg_match('#^htt#', $css) == TRUE) ? '' : base_url('sys/assets') . '/') . $css . '?v=' . $this->frontVersion . '" rel="stylesheet" type="text/css" media="all" />';
    }

    $this->datos['css'] = $strcss;

    if ($this->title != $this->meta->title) $this->meta->title = $this->meta->title . ' | ' . $this->meta->site_name;
    $this->datos['meta'] = $this->meta;
    echo view('templates/webheader', $this->datos);
  }

  public function showWFooter()
  {
    $strjs = '';

    foreach ($this->jss as $js) {
      $strjs .= '<script type="text/javascript" src="' . ((preg_match('#^htt#', $js) == TRUE) ? '' : base_url('sys/assets') . '/') . $js . '?v=' . $this->frontVersion . '"></script>';
    }


    $datos['op1'] = [
      ['url' => '/', 'name' => 'Inicio'],
      ['url' => 'biografias',  'name' => 'Biografía'],
      ['url' => 'frecuencias',  'name' => 'Frecuencias'],
      ['url' => 'campanias',  'name' => 'Campañas'],
      ['url' => 'noticias',  'name' => 'Noticias'],
      ['url' => 'testimonios', 'name' => 'Testimonios'],
    ];
    $datos['op2'] = [
      ['url' => 'fotos',  'name' => 'Fotos'],
      ['url' => 'videos',  'name' => 'Videos'],
      ['url' => 'audios',  'name' => 'Audio'],
      ['url' => 'envianos-tu-pedido',  'name' => 'Pedidos de Oración'],
      ['url' => 'contacto',  'name' => 'Escríbanos'],
      ['url' => 'cuentanos-tu-testimonio',  'name' => 'Cuentanos tu testimonio'],
    ];
 helper('formulario');
    $datos['conf'] = $this->db->query("SELECT * FROM configuracion WHERE 1 LIMIT 1")->getRow();

    $datos['js'] = $strjs;
    echo view('templates/webfooter', $datos);
  }

  public function dieMsg($ret = true, $msg = "", $redirect = "", $data = [])
  {
    if ($ret == false) {
      $this->response->setStatusCode(500, $msg);
      $this->response->send();
      exit(0);
    }
    $resp = ['exito' => $ret, 'mensaje' => $msg, 'redirect' => $redirect, 'data' => $data];
    $this->response->setJSON($resp);
    $this->response->send();
    exit(0);
  }

  function permitir_tipo($tipo)
  {
    if (empty($this->user->id)) redirect("Login");
  }


  public function guardar_imagen($folder, $name)
  {
    $img = $this->request->getFile('foto');
    if (!$img->isValid()) return false;

    $validationRule = [
      'foto' => [
        'label' => 'Image File',
        'rules' => 'uploaded[foto]'
          . '|mime_in[foto,image/jpg,image/jpeg,image/png,image/jfif]'
          . '|max_size[foto,10000]',
      ],
    ];

    if (!$this->validate($validationRule)) {
      $this->response->setStatusCode(500, $this->validator->getErrors()['foto']);
      return false;
    }
    //$img = $this->request->getFile('foto');
    if ($img->isValid() && !$img->hasMoved()) {
      $newName = $name;
      $img->move(FCPATH . $folder, $newName, true);

      // Ruta completa del archivo subido
      //$full_path = FCPATH . $folder . '/' . $newName;
      //die($full_path);
      // Redimensionar imagen
      //$this->resize_user('./' . $folder, $full_path, $name);
      // Eliminar archivo original
      //unlink($full_path);

      return true;
    } else {
      $this->response->setStatusCode(500, 'Error al subir la imagen');
      return false;
    }
  }



  public function guardar_imagen1($folder, $name, $slug)
  {
    $img = $this->request->getFile($slug);
    if (!$img->isValid()) return false;

    $validationRule = [
      $slug => [
        'label' => 'Image File',
        'rules' => 'uploaded[' . $slug . ']'
          . '|mime_in[' . $slug . ',image/jpg,image/jpeg,image/png,image/jfif]'
          . '|max_size[' . $slug . ',10000]',
      ],
    ];

    if (!$this->validate($validationRule)) {
      $this->response->setStatusCode(500, $this->validator->getErrors()[$slug]);
      return false;
    }
    if ($img->isValid() && !$img->hasMoved()) {
      $newName = $name;
      $img->move(FCPATH . $folder, $newName, true);
      return true;
    } else {
      $this->response->setStatusCode(500, 'Error al subir la imagen');
      return false;
    }
  }

  public function guardar_audio($folder, $name)
  {
    $img = $this->request->getFile('foto');
    if (!$img->isValid()) return false;

    $validationRule = [
      'foto' => [
        'label' => 'Audio File',
        'rules' => 'uploaded[foto]'
          . '|mime_in[foto,audio/mpeg,audio/wav,audio/ogg]'
          . '|max_size[foto,100000]',
      ],
    ];

    if (!$this->validate($validationRule)) {
      $this->response->setStatusCode(500, $this->validator->getErrors()['foto']);
      return false;
    }
    if ($img->isValid() && !$img->hasMoved()) {
      $newName = $name;
      $img->move(FCPATH . $folder, $newName, true);


      return true;
    } else {
      $this->response->setStatusCode(500, 'Error al subir el audio');
      return false;
    }
  }

  public function resize_user($folder, $full_path, $fname)
  {
    $sizes = [
      'Pequeño' => [
        'ancho' => 64,
        'alto' => 64,
        'sufijo' => 'thumb',
      ],
      'Mediano' => [
        'ancho' => 250,
        'alto' => 350,
        'sufijo' => 'small',
      ],
    ];

    $image = \Config\Services::image();

    foreach ($sizes as $size) {
      $image->withFile($full_path)
        ->fit($size['ancho'], $size['alto'], 'center')
        ->save($folder . '/' . str_replace('small', $size['sufijo'], $fname));
    }

    return true;
  }





  // public function guardar_imagen1($folder, $name)
  // {
  //   $config['upload_path']          = FCPATH . $folder;
  //   $config['allowed_types']        = 'jpg|png|jfif';
  //   $config['max_size']             = 100000;
  //   $this->load->library('upload', $config);
  //   $this->upload->initialize($config); ///esto esta medio raro
  //   $this->session->set_userdata('uniqueid', uniqid());

  //   if ($this->upload->do_upload('foto')) {
  //     $this->load->helper('Formulario');
  //     $this->resize_user('./' . $folder, $this->upload->data('full_path'), $name);
  //     unlink($this->upload->data('full_path'));
  //     return true;
  //   } else {
  //     if (empty($_FILES['foto']['name'])) {
  //       return false;
  //     }
  //     $this->output->set_status_header(500, 'Error : Posiblemente el tipo de archivo no sea permitido.' . $this->upload->display_errors());
  //     return false;
  //   }
  // }

  // function resize_user1($folder, $full_path, $fname)
  // {
  //   $result = true;
  //   $this->load->library('image_lib');
  //   $counter = 0;
  //   $sizes = array(
  //     'Pequeño' => (object) array(
  //       'ancho' => 64,
  //       'alto' => 64,
  //       'sufijo' => 'thumb',
  //     ),
  //     'Mediano' => (object) array(
  //       'ancho' => 250,
  //       'alto' => 350,
  //       'sufijo' => 'small',
  //     ),
  //   );
  //   foreach ($sizes as $size) {
  //     $counter++;
  //     $config['image_library'] = 'gd2';
  //     $config['source_image'] = $full_path;
  //     $config['maintain_ratio'] = TRUE;
  //     $config['width']         = $size->ancho;
  //     $config['height']       = $size->alto;
  //     $config['new_image'] = $folder . '/' . str_replace('small', $size->sufijo, $fname);
  //     $this->image_lib->clear();
  //     $this->image_lib->initialize($config);
  //     $this->image_lib->resize();
  //   }
  //   return $result;
  // }
}

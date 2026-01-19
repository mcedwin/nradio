<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
  public $fields;
  protected $returnType     = 'object';

  public function __construct($table)
  {

    $datas['user'] = ['table' => 'user', 'primary' => 'id', 'fields' => [
      'names' => array('label' => 'Nombres'),
      'surnames' => array('label' => 'Apellidos'),
      'password' => array('label' => 'Password'),
      'email' => array('label' => 'Email'),
    ]];

    $datas['banners'] = ['table' => 'banners', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo', 'required' => false),
      'subTitulo' => array('label' => 'SubTitulo', 'required' => false),
      'detalle' => array('label' => 'Detalle', 'required' => false),
      'url' => array('label' => 'URL', 'required' => false),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['programas'] = ['table' => 'programas', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo', 'required' => false),
      'horario' => array('label' => 'Horario', 'required' => false),
      'detalle' => array('label' => 'Detalle', 'required' => false),
    ]];
    $datas['noticias'] = ['table' => 'noticias', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo'),
      'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'fecha' => array('label' => 'Fecha', 'type' => 'date'),
      'detalle' => array('label' => 'Descripción'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
      'orden' => array('label' => 'Orden', 'required' => false),
    ]];
    $datas['biografias'] = ['table' => 'biografias', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo'),
      'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'resumen' => array('label' => 'Resumen'),
      'pastor' => array('label' => 'Pastor'),
      'detalle' => array('label' => 'Descripción'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['frecuencias'] = ['table' => 'frecuencias', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo'),
      'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'idDepartamento' => array('label' => 'Departamento', 'type' => 'select'),
      'direccion' => array('label' => 'Lugar'),
      'frecuencia' => array('label' => 'Frecuencia'),
      'detalle' => array('label' => 'Descripción'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['campanias'] = ['table' => 'campanias', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo'),
      'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'fecha' => array('label' => 'Fecha', 'type' => 'date'),
      'hora' => array('label' => 'Hora', 'type' => 'time'),
      'detalle' => array('label' => 'Descripción'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
      'orden' => array('label' => 'Orden', 'required' => false),
    ]];
    $datas['suscribir'] = ['table' => 'suscribir', 'primary' => 'id', 'fields' => [
      'nombre' => array('label' => 'Nombre'),
      'email' => array('label' => 'Email','required' => false),
      'telefono' => array('label' => 'Teléfono', 'type' => 'date'),
      'fecha' => array('label' => 'Fecha', 'type' => 'time'),
      'mensaje' => array('label' => 'Mensaje'),
      'asunto' => array('label' => 'Asunto'),
    ]];

    $datas['fotos'] = ['table' => 'fotos', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo', 'required' => false),
      'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'detalle' => array('label' => 'Detalle', 'required' => false),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['videos'] = ['table' => 'videos', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo', 'required' => false),
      //'slugifyTitulo' => array('label' => 'SubTitulo','required' => false),
      'url' => array('label' => 'URL', 'required' => false),
      'idVideo' => array('label' => 'IDVideo', 'required' => false),
      // 'imagen' => array('label' => 'Imagen','required' => false),
    ]];
    $datas['categorias'] = ['table' => 'categorias', 'primary' => 'id', 'fields' => [
      'nombre' => array('label' => 'Nombre'),
    ]];
    $datas['musica'] = ['table' => 'musica', 'primary' => 'id', 'fields' => [
      'titulo' => array('label' => 'Titulo'),
      'idCategoria' => array('label' => 'Categoría', 'type' => 'select'),
      'archivo' => array('label' => 'Archivo', 'required' => false),
    ]];
    $datas['pedidos'] = ['table' => 'pedidos', 'primary' => 'id', 'fields' => [
      'nombre' => array('label' => 'Nombre'),
      'email' => array('label' => 'Email'),
      'motivo' => array('label' => 'Motivo'),
      'pais' => array('label' => 'Pais'),
      'detalle' => array('label' => 'Descripción'),
      'fecha' => array('label' => 'Fecha'),
    ]];
    $datas['testimonios'] = ['table' => 'testimonios', 'primary' => 'id', 'fields' => [
      'nombre' => array('label' => 'Nombre'),
      'detalle' => array('label' => 'Descripción'),
      'email' => array('label' => 'Email'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['imagenes'] = ['table' => 'imagenes', 'primary' => 'id', 'fields' => [
      'detalle' => array('label' => 'Descripción'),
      'tipo' => array('label' => 'Tipo'),
      'idContenido' => array('label' => 'Contenido'),
      'imagen' => array('label' => 'Imagen', 'required' => false),
    ]];
    $datas['configuracion'] = ['table' => 'configuracion', 'primary' => 'id', 'fields' => [
      'telefono' => array('label' => 'Teléfono'),
      'email' => array('label' => 'Email'),
      'direccion' => array('label' => 'Dirección'),
      'mapa' => array('label' => 'Mapa'),
      // 'frase1' => array('label' => 'Frase 1'),
      // 'frase2' => array('label' => 'Frase 2'),
      // 'frase3' => array('label' => 'Frase 3'),
      // 'frase4' => array('label' => 'Frase 4'),
      // 'frase5' => array('label' => 'Frase 5'),
      // 'frase6' => array('label' => 'Frase 6'),
      // 'frase7' => array('label' => 'Frase 7'),
      // 'frase8' => array('label' => 'Frase 8'),
      // 'frase9' => array('label' => 'Frase 9'),
      // 'frase10' => array('label' => 'Frase 10'),
      // 'activa' => array('label' => 'Frase Activa'),
      // 'versiculo' => array('label' => 'Versiculo'),
      // 'video' => array('label' => 'Video'),
      // 'idVideo' => array('label' => 'idVideo'),
      'facebook' => array('label' => 'Facebook'),
      'twitter' => array('label' => 'Twitter'),
      'youtube' => array('label' => 'Youtube'),
      'instagram' => array('label' => 'Instagram'),
      // 'imagenBiografias' => array('label' => 'Biografía'),
      // 'imagenLocales' => array('label' => 'Locales'),
      // 'imagenCampanias' => array('label' => 'Campañas'),
      // 'imagenNoticias' => array('label' => 'Noticias'),
      // 'imagenTestimonios' => array('label' => 'Testimonios'),
      // 'imagenMultimedias' => array('label' => 'Multimedias'),
      // 'imagenContactenos' => array('label' => 'Contactenos'),
      // 'imagenfrmPedido' => array('label' => 'Form Pedidos'),
      // 'imagenfrmTestimonio' => array('label' => 'Form Testimonios'),
      'contribucion' => array('label' => 'Contribución'),
      // 'esenvivo' => array('label' => 'Es en Vivo','type'=>'bit', 'required' => false),
      // 'urlvivo' => array('label' => 'Url En Vivo', 'required' => false),
    ]];

    $datas['config'] = ['table' => 'config', 'primary' => 'id', 'fields' => [
      'mail_reply' => array('label' => 'Cuenta de correo de respuesta'),
      'mail_nreply' => array('label' => 'Nombre de contacto'),

      'mail_activo' => array('label' => 'Usar una cuenta SMTP para el elvio de correo', 'required' => false),
      'mail_user' => array('label' => 'Usuario', 'required' => false),
      'mail_port' => array('label' => 'Puerto', 'required' => false),
      'mail_pass' => array('label' => 'Contraseña', 'required' => false),
      'mail_crypto' => array('label' => 'Crypto', 'required' => false),

    ]];



    extract($datas[$table]);

    $this->table = $table;
    $this->fields = $fields;
    $this->primaryKey = $primary;

    parent::__construct();
  }

  public function getTable()
  {
    return $this->table;
  }
  public function getPrimaryKey()
  {
    return $this->primaryKey;
  }

  protected function initialize()
  {
    helper('funciones');

    $dfields = $this->db->getFieldData($this->table);
    iniFields($dfields, $this->fields);

    foreach ($this->fields as $field) {
      $this->allowedFields[] = $field->name;
    }
  }

  function getFields()
  {
    return $this->fields;
  }

  function geti($id = '')
  {
    $builder = $this->db->table($this->table);

    if (!empty($id)) {
      $row = $builder->select()->where($this->primaryKey, $id)->get()->getRow();
      foreach ($row as $k => $value) {
        if (!isset($this->fields[$k])) continue;
        $this->fields[$k]->value =  $value;
      }
    }

    return (object)$this->fields;
  }

  function enum_valores($campo)
  {
    $consulta = $this->db->query("SHOW COLUMNS FROM {$this->table} LIKE '$campo'");
    if ($consulta->getNumRows() > 0) {
      $consulta = $consulta->getRow();
      $array = explode(",", str_replace(array("enum", "'", "(", ")"), "", $consulta->Type));
      foreach ($array as $key) {
        $array2[] = (object)array('id' => $key, 'text' => $key);
      }
      return $array2;
    } else {
      return FALSE;
    }
  }

  public function getPaginadas($limit, $offset,$tipo='')
  {
    if($tipo=='noticias'||$tipo=='campanias')
    {
      return $this->where($tipo=='noticias'?'activo':'estado', 1)->orderBy('orden', 'ASC')
      ->findAll($limit, $offset);
    }
    return $this->orderBy('id', 'DESC')
      ->findAll($limit, $offset);
  }
}

<?php

namespace App\Controllers\Admin;

use PhpMqtt\Client\ConnectionSettings;
use \PhpMqtt\Client\MqttClient;
use App\Libraries\Ssp;
use App\Controllers\BaseController;

class Home extends BaseController
{
  public function __construct() {}


  public function index()
  {
    if (empty($this->user->id)) return redirect()->to('/admin/login');

    $this->showHeader();
    $this->ShowContent('index');
    $this->showFooter();
  }
   
}

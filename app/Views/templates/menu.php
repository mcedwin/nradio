<div class="d-flex" id="wrapper">

  <!-- sidebar menu -->
  <div class="sidebar bg-light shadow-sm">
    <div class="menu">

      <!-- menu -->
      <ul class="menu scrollbar m-0">
        <!-- simple menu -->
        <?php
        foreach ($menu as $item) :
        ?>
          <li>
            <span class="name"><?php echo $item['title']; ?></span>
            <ul>
              <?php
              foreach ($item['menu'] as $subitem) :
                $active = "";
                if (preg_match("#{$subitem['base']}#i", $controller)) $active = "active";
              ?>
                <li><a href="<?php echo base_url($subitem['url']); ?>" class="<?php echo $active; ?>"><i class="<?php echo $subitem['ico']; ?>" aria-hidden="true"></i><?php echo $subitem['name']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- website content -->
  <div class="content">
    <nav class="navbar navbar-expand-lg p-0 fixed-top bg-light shadow-sm">
      <div class="container-fluid">
        <span class="navbar-text">
          <a href="#" id="sidebar" class="bars btn btn-light">
            <i class="fa-solid fa-bars"></i>
          </a>
        </span>
        <a class="navbar-brand navbar-title" href="<?php echo base_url('/admin/banners'); ?>">
          <img class="logo" alt="Logo" src="<?php echo base_url('sys/assets/img/logo.png'); ?>">
          <span>CADENA RADIO VISION</span>
        </a>
        <ul class="nav navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <?php if (!empty($user->id)) : ?>
              <a class="btn btn-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Perfil
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="<?php echo base_url('admin/perfil'); ?>" class="dropdown-item">Perfil</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo base_url('admin/login/salir'); ?>" class="dropdown-item">Salir</a>
              </div>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </nav>
    <div class="">
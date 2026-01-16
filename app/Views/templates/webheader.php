<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title><?php echo $meta->title ?></title>
  <meta name="description" content="<?php echo $meta->description ?>" />
  <link rel="stylesheet" href="<?php echo base_url('/sys/assets/lib/bootstrap533/css/bootstrap.min.css') ?>" />
  <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">



  <link rel="stylesheet" href="<?php echo base_url('/sys/assets/lib/fontawesome6/css/all.min.css') ?>" />
  <?php echo $css ?? '' ?>
  <link href="<?php echo base_url('sys/assets/css/wstyle.css') ?>" rel="stylesheet" media="all">

  <!--  Essential META Tags -->
  <meta property="og:title" content="<?php echo $meta->title ?>">
  <meta property="og:type" content="article" />
  <meta property="og:image" content="<?php echo $meta->image ?>">
  <meta property="og:url" content="<?php echo $meta->url ?>">

  <!--  Non-Essential, But Recommended -->
  <meta property="og:description" content="<?php echo $meta->description ?>">
  <meta property="og:site_name" content="<?php echo $meta->site_name ?>">

</head>

<body data-barba="wrapper">
  <nav class="navbar navbar-dark bg-radio1 py-1">
    <div class="container d-flex justify-content-between align-items-center">
      <span class="badge bg-danger pulse-animation">EN VIVO</span>
      <div class="text-white small d-none d-md-block">Escucha: "La rotativa del aire" con los mejores panelistas</div>
      <button class="btn btn-sm btn-outline-light">Escuchar Radio <i class="bi bi-play-fill"></i></button>
    </div>
  </nav>
  <div class="mainbar">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 d-none d-md-block">
          <span class="text-white small">Lunes, 12 de Enero 2026</span>
        </div>
        <div class="col-md-4 text-center">
          <a href="<?php echo base_url('/'); ?>" class="svg"><img src="<?php echo base_url('sys/assets/img/wlogo.png'); ?>"></a>
        </div>
        <div class="col-md-4 text-end">
          <!-- <input type="text" class="form-control form-control-sm d-inline-block w-auto" placeholder="Buscar news..."> -->
        </div>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <?php
          foreach ($menu as $index => $item):
            $active = "";
            if (preg_match("#{$item['base']}#i", $controller)) $active = "active";
            $issub = count($item['menu']) > 0;
          ?>
            <li class="nav-item <?php echo $issub ? 'dropdown' : '' ?>">
              <a class="nav-link <?php echo $issub ? 'dropdown-toggle' : '' ?> <?php echo $active; ?>" href="<?php echo base_url($item['url']); ?>" <?php echo $issub ? 'id="navbarDropdown' . $index . '" role="button" data-bs-toggle="dropdown" aria-expanded="false"' : '' ?>><?php echo $item['name']; ?></a>
              <?php if ($issub): ?>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown<?php echo $index; ?>">
                  <?php
                  foreach ($item['menu'] as $subitem) :
                  ?>
                    <li><a class="dropdown-item" href="<?php echo base_url($subitem['url']); ?>"><?php echo $subitem['name']; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link naranja" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">CONTRIBUCIONES</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container content mt-3">
    <div class="row">
      <div class="col-md-8" data-barba="container" data-barba-namespace="home">
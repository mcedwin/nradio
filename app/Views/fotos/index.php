<div class="page">
  <section class="d-flex align-items-center">

    <div class="container">

      <h1 class="mt-2"><?php echo $title ?></h1>
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
      </nav>

    </div>
  </section>
  <div class="container">
    <div class="row content mt-4">
      <div class="col-md-12">
        <div class="row">
          <?php foreach ($registros as $reg): ?>
            <div class="col-sm-4 col-xs-6 item">
              <a data-fancybox="gallery<?php echo $reg->id ?>" href="<?php echo base_url('static/images/' . $table . '/' . $reg->imagen); ?>" class="img-video">
                <img class="w-100 rounded" src="<?php echo base_url('static/images/' . $table . '/' . $reg->imagen); ?>" class="img-fluid wp-post-image" alt="" decoding="async"> <i class="glyphicon glyphicon-play-circle"></i>
              </a>
              <div style="display:none">
                <?php 
                  $imgs = $db->query("SELECT * FROM imagenes WHERE idContenido='{$reg->id}' AND tipo='1'")->getResult();
                  foreach($imgs as $img):
                ?>
                <a data-fancybox="gallery<?php echo $reg->id ?>" data-caption="<?php echo htmlentities($img->detalle, ENT_QUOTES, 'UTF-8'); ?>" href="<?php echo base_url('static/images/imagenes/' . $img->imagen); ?>">
                  <img src="<?php echo base_url('static/images/imagenes/' . $img->imagen); ?>" />
                </a>
                <?php endforeach; ?>
               </div>
              <h3><?php echo $reg->titulo ?></h3>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="paginacion">
          <?php echo $pager ?>
        </div>
      </div>
     
    </div>
  </div>
</div>
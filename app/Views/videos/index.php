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
              <a data-fancybox href="https://www.youtube.com/watch?v=<?php echo $reg->idVideo ?>" class="img-video">
                <img class="w-100 rounded" src="https://img.youtube.com/vi/<?php echo $reg->idVideo ?>/0.jpg" class="img-fluid wp-post-image" alt="" decoding="async"> <i class="glyphicon glyphicon-play-circle"></i>
              </a>
              <h3><?php echo $reg->titulo ?></h3>
              <ul class="list-inline list-unstyled meta">
                <!-- <li><a href=""><i class="fa fa-calendar"></i> <?php /*echo $reg->fecha*/ ?> </a></li> -->
              </ul>
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
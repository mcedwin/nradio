

      <div id="carouselExampleDark" class="carousel carousel-dark slide">
        <div class="carousel-indicators">
          <?php foreach ($banners as $i => $bn): ?>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? 'class="active" aria-current="true"' : ''; ?> aria-label="Slide <?php echo ($i + 1) ?>"></button>
          <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
          <?php foreach ($banners as $i => $bn): ?>
            <div class="carousel-item <?php echo $i == 0 ? 'active' : ''; ?>" data-bs-interval="10000">
              <img src="<?php echo base_url('static/images/banners/' . $bn->imagen); ?>" class="d-block w-100" alt="<?php echo $bn->titulo ?>">
              <div class="carousel-caption d-none d-md-block">
                <h5><span><?php echo $bn->titulo ?></span></h5>
                <?php if (!empty($bn->detalle)): ?>
                  <p class="pt-2"><span style="background-color:#ba3446"><?php echo $bn->detalle ?></span></p>
                <?php endif; ?>
                <?php if (!empty($bn->subTitulo)): ?>
                  <p><span style="background-color:#3e4095"><?php echo $bn->subTitulo ?></span></p>
                <?php endif; ?>
                <?php if (!empty($bn->url)): ?>
                  <a href="<?php echo $bn->url ?>" class="btn btn-primary">Ver más <i class="fa-solid fa-chevron-right"></i></a>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <h2 class="border-bottom my-3">
        Noticias
      </h2>
      <div class="row">

        <!-- COLUMNA IZQUIERDA -->
        <div class="col-md-12">

          <?php foreach ($noticias as $reg): ?>
            <div class="row mb-3">
              <div class="col-4">
                <a href="<?php echo base_url('noticias/' . $reg->slugifyTitulo) ?>" class="img-video">
                  <img src="<?php echo base_url('static/images/noticias/' . $reg->imagen); ?>" class="img-fluid rounded" alt="noticia">
                </a>
              </div>
              <div class="col-8">
                <a href="<?php echo base_url('noticias/' . $reg->slugifyTitulo) ?>" class="img-video">
                  <h5><?php echo $reg->titulo ?></h5>
                </a>
                <p class="text-muted">
                  <?php echo $reg->detalle ?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>


        </div>



      </div>

      <h2 class="border-bottom my-3">
        Galeria
      </h2>

      <div class="row mb-4">
        <?php foreach ($fotos as $reg): ?>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm galeria-card">
              <a href="<?php echo base_url('fotos#gallery' . $reg->id . '-1') ?>">
                <img src="<?php echo base_url('static/images/fotos/' . $reg->imagen); ?>" class="card-img-top" alt="...">
              </a>
              <div class="card-body text-center">
                <p><?php echo $reg->titulo ?></p>
              </div>
              <a href="<?php echo base_url('fotos#gallery' . $reg->id . '-1') ?>" class="btn btn-secondary w-100 rounded-0"><i class="fa-solid fa-camera"></i></a>
            </div>
          </div>

        <?php endforeach; ?>
      </div>

    
<div class="page">
  <section class="d-flex align-items-center" style="background-image:url('<?php echo base_url('static/images/configuracion/' . $config->imagenBiografias); ?>')">

    <div class="container">

      <h1 class="mt-2"><?php echo $title ?></h1>
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url($table) ?>"><?php echo $title ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $registro->titulo ?></li>
        </ol>
      </nav>

    </div>
  </section>
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <article class="mt-4">
          <h3 class="mb10"><?php echo $registro->titulo ?></h3>
          <div class="row">
            <div class="col-md-8">
              <div>
                <div class="border float-start me-3 mb-2 bg-light">
                  <img src="<?php echo base_url('static/images/' . $table . '/' . $registro->imagen); ?>" alt="" class="d-block img-fluid">
                  <div class="p-2">
                    <small><?php echo $registro->pastor ?></small>
                    <p class="m-0"><?php echo $registro->resumen ?></p>
                  </div>
                </div>
                <div class="detalle mb-4">
                  <?php echo wpautop($registro->detalle) ?>
                </div>
              </div>

              <small>Compartir</small><br>
              <div class="social">
                <a href="https://www.facebook.com/sharer.php?u=<?php echo base_url($table . '/' . $registro->slugifyTitulo) ?>" class="fai fai-facebook customer share"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://twitter.com/share?url=<?php echo base_url($table . '/' . $registro->slugifyTitulo) ?>" class="fai fai-twitter customer share"><i class="fa-brands fa-twitter"></i></a>
              </div>


            </div>
            <div class="col-md-4">
              <?php if (count($imagenes)): ?>
                <div class="card">
                  <div class="card-header">
                    Galería de fotos
                  </div>
                  <div class="card-body">
                    <div class="galeria">
                      <?php foreach ($imagenes as $item): ?>
                        <a href="<?php echo base_url('static/images/imagenes/' . $item->imagen); ?>" data-fancybox="gallery-a" data-caption="<?php echo htmlentities($item->detalle, ENT_QUOTES, 'UTF-8'); ?>">
                          <img src="<?php echo base_url('static/images/imagenes/' . $item->imagen); ?>" />
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </article>
      </div>
    </div>

  </div>

</div>
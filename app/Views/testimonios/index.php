<div class="page">
  <section class="d-flex align-items-center" style="background-image:url('<?php echo base_url('static/images/configuracion/' . $config->imagenBiografias); ?>')">

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
      <div class="col-md-8">
        <?php foreach ($registros as $reg): ?>
          <div class="alert alert-warning">
            <div class="d-flex">
              <div class="me-2">
                <img class="img-fluid rounded border p-1" src="<?php echo base_url('static/images/' . $table . '/' . $reg->imagen); ?>">
                <strong><?php echo $reg->nombre ?></strong>
              </div>
              <div>
                <p>
                  <?php echo $reg->detalle ?>
                </p>
              </div>
            </div>


          </div>

        <?php endforeach; ?>
        <div class="paginacion">
          <?php echo $pager ?>
        </div>
      </div>
      <?php echo view('templates/sidebar') ?>
    </div>
  </div>
</div>
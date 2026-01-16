<div class="page">
  <section class="d-flex align-items-center" >

    <div class="container">

      <h1 class="mt-2"><?php echo $title ?></h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
      </nav>

    </div>
  </section>
  <div class="container">
    <div class="row content mt-4">
      <div class="col-md-3">
      <h3>Departamentos</h3>
        <div class="list-group list-group-flush mb-4 border" style="height:300px; overflow:auto">
          <?php foreach ($depas as $depa): ?>
            <a href="<?php echo base_url('frecuencias/list/'.$depa->id) ?>" class="list-group-item list-group-item-action cdepa" aria-current="true">
              <?php echo $depa->nombre ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-md-9 contdepa">
        <div class="row">
          <?php foreach ($registros as $reg): ?>
            <div class="col-sm-4 col-xs-6 item">
              <a href="<?php echo base_url($table . '/' . $reg->slugifyTitulo) ?>" class="img-video">
                <img class="w-100 rounded" src="<?php echo base_url('static/images/' . $table . '/' . $reg->imagen); ?>" class="img-fluid wp-post-image" alt="" decoding="async"> <i class="glyphicon glyphicon-play-circle"></i>
              </a>
              <h3><a href="<?php echo base_url($table . '/' . $reg->slugifyTitulo) ?>"><?php echo $reg->titulo ?></a></h3>
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
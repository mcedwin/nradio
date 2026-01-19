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
    <div class=" content">

      <div class="row my-4">

        <div class="col-md-12">

          <!-- <h2>Queremos saber de ti</h2>

          <p>Escríbanos, estamos dispuestos a atenderlo.</p><br> -->

          <div class="alert alert-success my-4 alerta" role="alert">
            <strong class="mensaje"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <!-- Contact Form -->
          <form id="form-data" name="form-data" class="form-transparent formulario" action="<?php echo base_url('contactenos/contacto_guardar') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="nombre">Nombre <small>*</small></label>
                  <input name="nombre" class="form-control" type="text" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Email <small>*</small></label>
                  <input name="email" class="form-control" type="text" required="">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="telefono">Telefono </label>
                  <input name="telefono" class="form-control" type="text" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="asunto">Asunto</label>
                  <input name="asunto" class="form-control" type="text">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea name="mensaje" class="form-control required" rows="5" required=""></textarea>
            </div>
            <div id="xmsj"></div>
            <div class="form-group"><br>
              <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-proceso="pedidos">Enviar</button>
              <button type="reset" class="btn btn-default btn-flat btn-theme-colored">Borrar</button>
            </div>
          </form>
        </div>
        <div class="col-md-12 sidebar mt-3">
          <h2 class="animate-onscroll no-margin-top">Ubicanos</h2>
          <div class="contact-map border mb-2">
            <iframe width="100%" height="400" src="<?php echo $config->mapa ?>"></iframe>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 animate-onscroll">
              <h6>Visítenos</h6>
              <p><?php echo $config->direccion; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 animate-onscroll">
              <h6>Llámenos</h6>
              <p><?php echo $config->telefono; ?></p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 animate-onscroll">
              <h6>Escríbanos</h6>
              <p><a href="mailto:<?php echo $config->email; ?>"><?php echo $config->email; ?></a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
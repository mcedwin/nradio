<div class="page">
  <section class="d-flex align-items-center" style="background-image:url('<?php echo base_url('static/images/configuracion/' . $config->imagenBiografias); ?>')">

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
    <div class=" content">


      <div class="row related-events my-4">

        <div class="col-sm-12 col-md-7">
          <div class="contact-wrapper data-form" style="padding:0 !important;margin-bottom: 40px !important;color:#000 !important;">
            <h2 class="line-bottom mt-0 mb-20">Cuéntanos tu testimonio del milagro recibido de parte de Dios a través de las oraciones en la IPC</h2>
            <!-- Contact Form -->

            <div class="alert alert-success my-4 alerta" role="alert">
              <strong class="mensaje"></strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <form id="form-data" name="form-data" class="form-transparent formulario" action="<?php echo base_url('contactenos/testimonio_guardar') ?>" method="post" enctype="multipart/form-data">
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
                    <label for="telefono">Teléfono <small>*</small></label>
                    <input name="telefono" class="form-control required" type="text" required="">
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group text-center">
                    <div class="mb-2 text-center">
                      <img class="img-fluid img-thumbnail" width="200" src="<?php echo $foto; ?>" id="viewfoto">
                    </div>
                    <a href="" class="changephoto btn btn-success btn-sm"><i class="fas fa-edit"></i> Cambiar foto</a>
                    <input type="file" class="inputfile" id="foto" name="foto">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="detalle">Cuentanos tu testimonio ....</label>
                <textarea name="detalle" class="form-control required" rows="5" required=""></textarea>
              </div>
              <div id="xmsj"></div>
              <div class="form-group"><br>
                <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-proceso="pedidos">Enviar</button>
                <button type="reset" class="btn btn-default btn-flat btn-theme-colored">Borrar</button>
              </div>
            </form>

          </div>
        </div>
        <div class="col-sm-12 col-md-5 bg-img-center bg-img-cover p-0 text-center">

          <img src="<?php echo base_url('static/images/configuracion/' . $config->imagenfrmTestimonio); ?>" class="rounded img-fluid" alt="">

        </div>

      </div>

    </div>
  </div>
</div>
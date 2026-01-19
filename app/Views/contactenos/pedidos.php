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
    <div class=" content">


      <div class="row related-events my-4">

        <div class="col-sm-12 col-md-7">
          <div class="contact-wrapper data-form" style="padding:0 !important;margin-bottom: 40px !important;color:#000 !important;">
            <h2 class="line-bottom mt-0 mb-20">Solicite su pedido de oración</h2>
            <p class="mb-30">Las Oraciones serán transmitidas por Cadena Radio Visión E.I.R.L., el mismo dia de sus pedidos de oración, minutos antes de las 8:30 pm. Si usted quiere ayudar a esta obre de Fé puede enviar sus ofrendas a Calle Juan Fanning 457 Chiclayo - Perú..</p>

            <div class="alert alert-success my-4 alerta" role="alert">
              <strong class="mensaje"></strong>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- Contact Form -->
            <form id="form-data" name="form-data" class="form-transparent formulario" action="<?php echo base_url('contactenos/pedido_guardar') ?>" method="post" enctype="multipart/form-data">
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
                    <label for="motivo">Motivo de Oración <small>*</small></label>
                    <input name="motivo" class="form-control required" type="text" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="pais">País</label>
                    <input name="pais" class="form-control" type="text">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="detalle">Solicito Oración por ....</label>
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

          <img src="<?php echo base_url('static/images/configuracion/' . $config->imagenfrmPedido); ?>" class="rounded img-fluid" alt="">

        </div>

      </div>

    </div>
  </div>
</div>
<div class="container-fluid cont-title d-flex justify-content-between">
  <div class="cont-title-text">Banners</div>
</div>
<div class="container-fluid">
  <form class="form-horizontal needs-validation" action="<?= base_url("admin/configuracion/guardar") ?>" method="post" enctype="multipart/form-data" novalidate>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            INFORMACIÓN
          </div>
          <div class="card-body">
            <div class="row">
              <?php
              echo myinput($fields->telefono, '12');
              echo myinput($fields->email, '12');
              echo myinput($fields->direccion, '12');
              echo myinput($fields->mapa, '12');
              echo myinput($fields->frasetop, '12');
              ?>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            REDES SOCIALES
          </div>
          <div class="card-body">
            <div class="row">
              <?php
              echo myinput($fields->facebook, '12');
              echo myinput($fields->twitter, '12');
              // echo myinput($fields->esenvivo, '12');
              // echo myinput($fields->urlvivo, '12');
              ?>
            </div>
          </div>
        </div>
        <!-- <div class="card mt-3">
          <div class="card-header">
            FODOS E IMAGENES
          </div>
          <div class="card-body">
            <?php foreach ($list as $item): ?>
              <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                  <a href="" class="changephoto btn btn-success btn-sm"><i class="fas fa-edit"></i> <?php echo str_replace('imagen', '', $item); ?></a>
                  <input type="file" class="inputfile" id="foto" name="<?php echo $item; ?>">
                </div>
                <div class="col-md-8">
                  <div class="form-group text-center">
                    <div class="mb-2 text-center">
                      <img class="img-fluid img-thumbnail" width="200" src="<?php echo $img[$item]; ?>" id="viewfoto">
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div> -->


        <div class="card mt-3">
          <div class="card-header">
            INFORMACIÓN
          </div>
          <div class="card-body">
            <div class="row">
              <?php
               echo myinput($fields->contribucion, '12');
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>









    <button type="submit" class="btn btn-primary mt-2 mb-4"><i class="fas fa-save"></i> Guardar</button>
  </form>
</div>
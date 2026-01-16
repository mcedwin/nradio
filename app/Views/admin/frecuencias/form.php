<div class="container-fluid cont-title d-flex justify-content-between">
  <div class="cont-title-text"><?php echo $titulo; ?></div>
</div>
<div class="container">

  <form class="form-horizontal needs-validation"  id="formContent" action="<?= base_url("admin/frecuencias/guardar/" . $id) ?>" method="post" enctype="multipart/form-data" novalidate>

    <div class="row">
      <?php
      echo myinput($fields->titulo, '12');
      echo myinput($fields->idDepartamento, '12', '', '', $utipos);
      echo myinput($fields->direccion, '12');
      echo myinput($fields->frecuencia, '12');
      echo myinput($fields->detalle, '12');
      ?>
      <div class="d-none">
        <?php
        echo myinput($fields->imagen, '12');
        ?>
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
    <div class="d-flex justify-content-end mb-4">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    </div>
  </form>
</div>
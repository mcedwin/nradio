<div class="modal-dialog modal-md">
  <div class="modal-content">
    <form class="form-horizontal needs-validation" action="<?= base_url("admin/testimonios/guardar/" . $id) ?>" method="post" enctype="multipart/form-data" novalidate>
      <div class="modal-header">
        <h5 class="modal-title"><?php echo $titulo; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="row">
          <?php
          echo myinput($fields->nombre, '12');
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
      </div>
    </form>
  </div>
</div>
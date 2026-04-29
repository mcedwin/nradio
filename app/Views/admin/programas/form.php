<div class="container-fluid cont-title d-flex justify-content-between">
  <div class="cont-title-text"><?php echo $titulo; ?></div>
</div>
<div class="container">

  <form class="form-horizontal needs-validation"  id="formContent" action="<?= base_url("admin/programas/guardar/" . $id) ?>" method="post" enctype="multipart/form-data" novalidate>

    <div class="row">
      <?php
          echo myinput($fields->titulo, '12');
          echo myinput($fields->horario, '12');
          echo myinput($fields->detalle, '12');
          echo myinput($fields->contenido, '12');
       ?>
    </div>

    <div class="d-flex justify-content-end mb-4">
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    </div>
  </form>
</div>
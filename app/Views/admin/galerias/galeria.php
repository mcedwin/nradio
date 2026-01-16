<div class="container-fluid cont-title d-flex justify-content-between">
  <div class="cont-title-text">Galeria</div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card mb-4">
        <div class="card-header">
          <strong>Noticia</strong>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $fields->titulo->value ?></h5>
          <p class="card-text"><?php echo substr(strip_tags($fields->detalle->value), 0, 100) ?></p>
          <div class="d-flex justify-content-end gap-2">
            <a href="<?php echo base_url('admin/'.$controller.'/editar/'.$id) ?>" class="btn btn-sm btn-secondary">Editar Noticia</a>
            <a href="<?php echo base_url('admin/'.$controller."/galeria_crear/{$id}/0") ?>" class="btn btn-sm btn-success new"><i class="fa-solid fa-plus"></i> Agregar Foto</a>
          </div>

        </div>
      </div>
      <?php echo genDataTable('mitabla', $columns, true); ?>
    </div>
  </div>
</div>
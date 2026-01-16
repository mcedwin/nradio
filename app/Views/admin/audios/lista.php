<div class="container-fluid cont-title d-flex justify-content-between">
  <div class="cont-title-text">Musica</div>
  
</div>
<div class="container-fluid">
  <form class="ocform form-horizontal">
    <div class="row">
      <div class="col-sm-2 pt-2">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="activo" checked id="checkactivo">
          <label class="form-check-label" for="checkactivo">
            Activos
          </label>
          <input type="hidden" name="tipo" id="tipo">
        </div>
      </div>
      <div class="col-sm-5">
        <div class="input-group input-group">
          <input class="form-control " type="search" id="s" name="search[value]" placeholder="Buscar" value="" autocomplete="off">
          <button class="btn btn-outline-secondary" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-md-4">
    <a href="<?php echo base_url('admin/audios/cate_crear') ?>" class="btn btn-sm btn-success new"><i class="fa-solid fa-plus"></i> Categoria</a>
      <?php echo genDataTable('mitabla2', $columns2, true); ?>
    </div>
    <div class="col-md-8">
    <a href="<?php echo base_url('admin/audios/crear') ?>" class="btn btn-sm btn-success new"><i class="fa-solid fa-plus"></i> Audio</a>
      <?php echo genDataTable('mitabla', $columns, true); ?>
    </div>
  </div>

</div>
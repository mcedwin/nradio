<div class="container-fluid cont-title d-flex justify-content-between">
    <div class="cont-title-text">Banners</div>
    <a href="<?php echo base_url('admin/banners/crear') ?>" class="btn btn-sm btn-success new"><i class="fa-solid fa-plus"></i> Banner</a>
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

    <?php echo genDataTable('mitabla', $columns, true); ?>
</div>
<div class="container pt-4">
  <div class="card">
    <div class="card-header">
      Editar perfil
    </div>
    <div class="card-body">
      <form class="formu form-horizontal needs-validation" action="<?php echo base_url('/usuario/guardar_perfil') ?>" method="post" enctype="multipart/form-data" novalidate>
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <?php
              //echo myinput($fields->idTipo, '6', '', '', $tipos);
              echo myinput($fields->nombres, '6');
              echo myinput($fields->email, '6');
              echo myinput($fields->password, '6');
              ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>

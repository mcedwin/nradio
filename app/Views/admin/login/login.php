<div class="container mt-4">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="text-center mb-2 fw-bold">
        <a class="text-secondary text-decoration-none" href="<?php echo base_url('/') ?>"><img class="logo" alt="Logo" src="<?php echo base_url('sys/assets/img/logo.png'); ?>"> LACOSECHA</a>
      </div>


      <div class="card mb-3">
        <div class="card-body">

            <div class="container">
              <form action="<?php echo base_url('admin/login/ingresar/admin') ?>" class="needs-validation mr-2 form-login" method="post" novalidate>
                <div class="form-group mb-2">
                  <label for="">Email</label>
                  <input type="text" class="form-control" maxlength="40" name="email" required>
                </div>
                <div class="form-group mb-2">
                  <label for="">Contraseña</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <div class="text-center">
                  <!-- <p>
                    <a href="<?php echo base_url("login/recuperar/admin"); ?>" class="recuperar">Olvidé mi contraseña.</a>
                  </p> -->
                </div>

                <div class="form-group mb-2">
                  <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
                </div>

              </form>

          </div>
        </div>

      </div>

    </div>
  </div>

</div>

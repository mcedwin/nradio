<div class="container pt-4">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Editar perfil
                </div>
                <div class="card-body">
                    <form class="formu form-horizontal needs-validation" action="<?php echo base_url('/admin/perfil/guardar_perfil') ?>" method="post" enctype="multipart/form-data" novalidate>
           
                     
                                <div class="row">
                                    <?php
                                    echo myinput($fields->names, '6');
                                    echo myinput($fields->surnames, '6');
                                    echo myinput($fields->email, '6');
                                    echo myinput($fields->password, '6');
                                    ?>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
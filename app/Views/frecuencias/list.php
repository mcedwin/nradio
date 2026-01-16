<div class="row">
          <?php foreach ($registros as $reg): ?>
            <div class="col-sm-4 col-xs-6 item">
              <a href="<?php echo base_url($table . '/' . $reg->slugifyTitulo) ?>" class="img-video">
                <img class="w-100 rounded" src="<?php echo base_url('static/images/' . $table . '/' . $reg->imagen); ?>" class="img-fluid wp-post-image" alt="" decoding="async"> <i class="glyphicon glyphicon-play-circle"></i>
              </a>
              <h3><a href="<?php echo base_url($table . '/' . $reg->slugifyTitulo) ?>"><?php echo $reg->titulo ?></a></h3>
              <ul class="list-inline list-unstyled meta">
                <!-- <li><a href=""><i class="fa fa-calendar"></i> <?php /*echo $reg->fecha*/ ?> </a></li> -->
              </ul>
            </div>
          <?php endforeach; ?>
        </div>
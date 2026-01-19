<div class="page">
  <section class="d-flex align-items-center">

    <div class="container">

      <h1 class="mt-2"><?php echo $title ?></h1>
      <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Inicio</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
      </nav>

    </div>
  </section>
  <div class="container">

    <div class="row my-4">
      <div class="col-md-12">
        <div class="row rounded border player">
          <div class="cates col-md-6">
            <div class="d-flex flex-column align-items-stretch gap-2 p-2 align-items-start">
              <a href="" class="catem d-flex align-items-center rounded activo" data-list="0">
                <div class="text-center w-100">TODOS</div>
              </a>
              <?php foreach ($categorias as $cate): ?>
                <a href="#" class="catem d-flex align-items-center rounded" data-list="<?php echo $cate->id ?>">
                  <div class="text-center w-100"><?php echo $cate->nombre ?></div>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-md-6">


            <div id="player">
              <!-- (PART A) CURRENT SONG IMAGE -->

              <!-- (PART B) CONTROLS  -->
              <div id="playControls" style="background-image:url('<?php echo base_url('sys/assets/img/02.jpg') ?>')">
                <!-- (B1) SONG NAME -->
                <div id="playName">Select A Song</div>

                <!-- (B2) SONG TIME -->
                <input id="playTimeR" type="range" value="0" min="0" disabled>
                <div id="playTimeD">
                  <div id="playTimeN">0:00</div>
                  <div id="playTimeT">0:00</div>
                </div>

                <!-- (B3) LAST, PLAY/PAUSE, NEXT, VOLUME -->
                <div id="playButtons">
                  <i id="playLast" class="icon-previous2"></i>
                  <i id="playTog" class="icon-pause2"></i>
                  <i id="playNext" class="icon-next2"></i>
                  <i id="playVolI" class="icon-volume-high"></i>
                  <input id="playVolR" type="range" min="0" max="1" step="0.1" value="1" disabled>
                </div>
              </div>

              <!-- (PART C) PLAYLIST -->
              <div id="playList">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <script>
      var miplay = [];
      <?php
      foreach ($categorias as $cate):
        $ncates[$cate->id] = $cate->nombre;
      ?>
        miplay['<?php echo $cate->id ?>'] = [];
      <?php endforeach; ?>
      <?php
      foreach ($registros as $reg):
        //list($track, $artista) = explode("-", $reg->titulo);
      ?>
        miplay['<?php echo $reg->idCategoria ?>'].push({
          file: "<?php echo base_url('static/audios/' . $reg->archivo); ?>",
          thumb: "sys/assets/img/02.jpg",
          trackName: "<?php echo $reg->titulo ?>",
          trackArtist: "<?php echo $ncates[$reg->idCategoria]; ?>",
          trackAlbum: "Single",
        });
      <?php endforeach; ?>
    </script>
  </div>
</div>
<div class="col-md-4 sidebar">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <div class="card text-black shadow-sm mb-3">
    <div class="card-body p-3">
      <div class="d-flex align-items-center mb-3">
        <div class="flex-shrink-0">
          <div class="bg-danger rounded-circle d-flex align-items-center text-white justify-content-center" style="width: 50px; height: 50px;">
            <i class="bi bi-broadcast fs-3"></i>
          </div>
        </div>
        <div class="flex-grow-1 ms-3">
          <h6 class="mb-0 text-truncate" id="radio-title">Mi Radio Online</h6>
          <small class="text-black-50">En vivo ahora</small>
        </div>
        <div class="flex-shrink-0">
          <div id="equalizer" class="d-flex align-items-end justify-content-center gap-2 mb-2" style="height: 30px;">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
          </div>
        </div>
      </div>

      <audio id="radio-audio">
        <source src="https://radio.magozoft.com/;stream.mp3" type="audio/mpeg">
      </audio>

      <div class="d-flex flex-column gap-2">
        <button class="btn btn-danger w-100" id="btn-play">
          <i class="bi bi-play-fill" id="play-icon"></i> REPRODUCIR
        </button>

      </div>
    </div>
  </div>



  <div class="my-4">
    <h3><span>Últimas noticias</span></h3>
    <ul class="lasts">
      <?php
      foreach ($noticias as $reg):
        list($anio, $mes, $dia) = explode("-", $reg->fecha)
      ?>
        <li class="d-flex ">
          <div class="date text-center p-1 px-3 me-2 rounded flex-shrink-1">
            <span>
              <span class="day"><?php echo $dia ?></span>
              <span class="month"><?php echo $mes ?></span>
            </span>
          </div>

          <div class="event-content w-100">
            <h6><a href="<?php echo base_url('noticias/' . $reg->slugifyTitulo) ?>"><?php echo $reg->titulo ?></a></h6>
          </div>
        </li>
      <?php endforeach; ?>


    </ul>
    <div class="d-flex justify-content-end">
      <a href="<?php echo base_url('noticias') ?>" class="btn btn-sm btn-secondary"><i class="fa-solid fa-angles-right"></i> Mas noticias</a>
    </div>

  </div>


  <div class="card my-3">
    <div class="card-body">
      <a href="https://iplacosecha.pe/" class="d-block text-center">
        <img src="<?php echo base_url('sys/assets/img/webipc.png'); ?>" alt="" class="img-fluid w-100">
      </a>
    </div>
  </div>

</div>
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
    <div class=" content">

      <!-- Introducción -->
      <div>
        <p>
          Disfrute de la Programación de Cadena Radio Vision, Una radio para todos durante las 24 horas del día.
        </p>
      </div>

      <!-- Programación -->
      <div>

        <?php
        foreach ($programas as $reg):
        ?>
        <article>
          <h3><?php echo $reg->titulo ?></h3>
          <p><strong>Horario:</strong> <?php echo $reg->horario ?></p>
          <p>
            <?php echo $reg->detalle ?>
          </p>
        </article>
        <?php endforeach; ?>

      </div>

    </div>
  </div>
</div>
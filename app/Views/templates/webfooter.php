</div>
    <?php echo view('templates/sidebar') ?>
  </div>
</div>
<style>
  .fai {
    padding: 5px;
    font-size: 20px;
    width: 40px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    display: inline-block;
  }

  .fai:hover {
    opacity: 0.7;
  }

  .fai-facebook {
    background: #3B5998;
    color: white;
  }

  .fai-twitter {
    background: #55ACEE;
    color: white;
  }

  .fai-youtube {
    background: #bb0000;
    color: white;
  }

  .fai-instagram {
    background: #125688;
    color: white;
  }
</style>

<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-3 column">
        <h5>CONTRIBUCIONES VOLUNTARIAS</h5>
        <p>
          USTED QUE SIENTE EN SU CORAZON HACER UNA OFRENDA PARA LA OBRA DE DIOS, PUEDE DEPOSITAR SU OFRENDA O PRIMICIA A CUALQUIERA DE NUESTRAS CUENTAS
        </p>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Haga click aquí</a>
      </div>
      <div class="col-sm-6 column">
        <h5>ENLACES</h5>
        <div class="row enlaces">
          <div class="col-md-6">
            <ul>
              <?php foreach ($op1 as $o): ?>
                <li><a href="<?php echo $o['url'] ?>"><?php echo $o['name'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="col-md-6">
            <ul>
              <?php foreach ($op2 as $o): ?>
                <li><a href="<?php echo $o['url'] ?>"><?php echo $o['name'] ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-3 column">
        <h5>SÍGUENOS</h5>
        <p>Síguenos en nuestras redes sociales</p>
        <div class="social">
          <a href="#" class="fai fai-facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="fai fai-twitter"><i class="fa-brands fa-twitter"></i></a>
          <a href="#" class="fai fai-youtube"><i class="fa-brands fa-youtube"></i></a>
          <a href="#" class="fai fai-instagram"><i class="fa-brands fa-square-instagram"></i></a>
        </div>
      </div>
    </div>
   
  </div>
</footer>
<script src="<?php echo base_url('sys/assets/lib/jquery-3.6.3.min.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/lib/bootstrap533/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://unpkg.com/@barba/core"></script>

    <script src="<?php echo base_url('sys/assets/lib/fancybox/fancybox.umd.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/js/scripts.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/js/web.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/js/form.js') ?>"></script>
<?php echo $js ?? ""; ?>
<script>
  var base_url = '<?php echo base_url() ?>';
</script>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">CONTRIBUCIÓN</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php echo wpautop($conf->contribucion) ?>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
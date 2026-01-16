
<?php if($conmenu): ?>
</div>
</div>
<?php endif; ?>
<div id="modales"></div>
<script src="<?php echo base_url('sys/assets/lib/jquery-3.6.3.min.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/lib/bootstrap533/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/lib/perfectScrollbar/perfect-scrollbar.min.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/js/sidebar.menu.js') ?>"></script>
<script src="<?php echo base_url('sys/assets/js/scripts.js') ?>"></script>
<script>
  var base_url = '<?php echo base_url() ?>';
  $(function() {
    new PerfectScrollbar('.scrollbar', {
      wheelSpeed: 2,
      suppressScrollX: false,
    });
  });
</script>
<?php echo $js ?? ""; ?>
</body>

</html>
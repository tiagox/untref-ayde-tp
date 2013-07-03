  <script src="/vendors/jquery/jquery-1.10.1.js"></script>
  <script src="/vendors/jquery-ui/js/jquery-ui-1.10.3.custom.js"></script>
  <script src="/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="/vendors/bootbox/bootbox.js"></script>
  <?php if (isset($jsFiles)) : ?>
  <?php foreach ($jsFiles as $jsFile) : ?>

  <script src="<?= $jsFile ?>"></script>
  <?php endforeach; ?>
  <?php endif; ?>
  </body>
</html>

  <script src="/vendors/jquery/jquery-1.10.1.js"></script>
  <script src="/vendors/bootstrap/js/bootstrap.js"></script>
  <?php if (isset($jsFiles)) : ?>
  <?php foreach ($jsFiles as $jsFile) : ?>

  <script src="<?= $jsFile ?>"></script>
  <?php endforeach; ?>
  <?php endif; ?>
  </body>
</html>

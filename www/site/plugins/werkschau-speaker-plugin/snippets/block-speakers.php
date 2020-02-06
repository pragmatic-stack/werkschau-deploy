<?php
  $speakers = site()->find('speakers')->children()->unlisted();
?>

<?= kirby()->snippet('speakers'); ?>
<!--  -->

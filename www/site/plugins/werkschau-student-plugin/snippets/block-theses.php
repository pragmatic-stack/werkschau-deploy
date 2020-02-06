<?php
  $theses = kirby()->collection('work/theses');
  $tags = $theses->pluck('tags', ',', true);
  $showFilter = $part->showFilter()->bool();
?>

<?php if($showFilter){
  echo 'Filter:';
  foreach ($tags as $tag){
    echo '<span>' . $tag . '</span>';
  }
}
?>

<?= kirby()->snippet('theses'); ?>

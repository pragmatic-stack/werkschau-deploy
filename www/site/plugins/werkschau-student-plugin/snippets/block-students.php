<?php

  $defaults = [
      'blockWidth'        => 'full',
      'displayTitle'      => fromContentByString($part, 'displayTitle'),
      'displayHeadline'   => fromContentByString($part, 'displayHeadline'),
      'showFilter'        => $part->showFilter()->toBool(),
      'takeAll'           => $part->takeAll()->toBool(),
  ];


  // sections page config overwrites block config
  if(isset($options)){
    $settings = array_merge($defaults, $options);
  } else {
    $settings = $defaults;
  }

  if(!$settings['takeAll']) {
    $students = $part->studentSelect()->toPages();

    $settings['students'] = $students;
    $settings['tags'] = $students->pluck('tags', ',', true);
  }

?>

<?= kirby()->snippet('students', ['options' => $settings]); ?>

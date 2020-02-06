<?php

$defaults = [
        'blockWidth'        => 'half',
        'displayTitle'      => fromContentByString($part, 'displayTitle'),
        'displayHeadline'   => fromContentByString($part, 'displayHeadline'),
];

if (isset($blockWidth)) {
    $defaults['blockWidth'] = $blockWidth;
}

// sections page config overwrites block config
if(isset($options)){
    $settings = array_merge($defaults, $options);
} else {
    $settings = $defaults;
}

?>

<section class="<?= getWidthClass($settings['blockWidth']) ?>">

    <?php
    // handle title and headline
    snippet('default-title-headline', ['block' => $part, 'settings' => $settings])
    ?>

    <p><?= $part->description()->markdown(); ?></p>

</section>
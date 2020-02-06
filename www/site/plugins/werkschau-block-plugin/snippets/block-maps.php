<?php
/**
 * block-maps
 * Loads an interactive map from mapbox.com
 * Configuration is made in the Map-Block Settings in the panel
 * JS for initialization is inserted automatically -> see BlockMaps Page Model in ./models/block-maps.php
 *
 * Reference: https://docs.mapbox.com/mapbox-gl-js/example/simple-map/
 */

$defaults = [
    'fullWidthContainer'    => true,
    'blockWidth'            => 'third',
    'displayTitle'          => fromContentByString($part, 'displayTitle'),
    'displayHeadline'       => fromContentByString($part, 'displayHeadline'),
];

// configuration for direct use
if (isset($blockWidth)) {
    $defaults['blockWidth'] = $blockWidth;
}

// sections page config overwrites block config
if(isset($options)){
    $settings = array_merge($defaults, $options);
} else {
    $settings = $defaults;
}

$colClassList = [getWidthClass($settings['blockWidth'])];

if($settings['blockWidth'] == 'full' && $settings['fullWidthContainer'] == true){
    array_push($colClassList, 'p-0');
}

?>

<div <?= attr(['class' => $colClassList]) ?>>

    <?php
        // handle title and headline
        snippet('default-title-headline', ['block' => $part, 'settings' => $settings])
    ?>

    <div id="<?= $part->mapId(); ?>"
         style="height: <?= $part->mapHeight(); ?>px"
         data-mapbox-lng="<?= $part->locationlong() ?>"
         data-mapbox-lat="<?= $part->locationlat() ?>"
         data-mapbox-style="<?= $part->style() ?>"
         data-mapbox-zoom="<?= $part->zoom() ?>"
    ></div>
</div>

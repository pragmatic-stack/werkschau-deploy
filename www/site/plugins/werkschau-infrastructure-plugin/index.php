<?php
/*
 * Dieses Plugin befindet sich aktuell im Entwicklungsmodus
 */

Kirby::plugin('werkschau/infrastructure', [
    'blueprints' => [
        'pages/building'        => __DIR__ . '/blueprints/building.yml',
        'pages/buildings'       => __DIR__ . '/blueprints/buildings.yml',
        'pages/block-building'  => __DIR__ . '/blueprints/block-building.yml',
    ],

    'templates' => [
        'building'       => __DIR__ . '/templates/building.php',
        'buildings'      => __DIR__ . '/templates/buildings.php',
        'block-building' => __DIR__ . '/templates/block-building.php',
    ],
]);
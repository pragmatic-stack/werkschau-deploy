<?php

require_once __DIR__ . '/models/block-maps.php';

require "helpers/getGermanWeekday.php";
require "helpers/getGermanMonth.php";
require "helpers/getGermanMonthShort.php";
require "helpers/createHooks.php";
require "helpers/includePageBlockCss.php";
require "helpers/includePageBlockJs.php";
require "helpers/blockWidthClass.php";
require "helpers/getBlockSnippet.php";

$blueprintsDir = __DIR__ . '/blueprints';
$sectionsDir = __DIR__ . '/sections';
$templatesDir = __DIR__ . '/templates';
$snippetsDir = __DIR__ . '/snippets';
$fieldsDir = __DIR__ . '/fields';

$blueprints = createBlueprintHooks($blueprintsDir, $sectionsDir, $fieldsDir);
$templates = createPhpHooks($templatesDir);
$snippets = createPhpHooks($snippetsDir);

Kirby::plugin('werkschau/block-plugin', [
    'blueprints' => $blueprints,
    'snippets' => $snippets,
    'templates' => $templates,
    'pageModels' => [
        'block-maps' => 'BlockMaps'
    ],
    'controllers' => [
        'sectionspage' => require __DIR__ . '/controllers/sectionspage.php'
    ]
]);
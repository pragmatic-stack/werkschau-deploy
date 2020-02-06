<?php
$blueprintsDir  = __DIR__ . '/blueprints';
$snippetsDir    = __DIR__ . '/snippets';
$sectionsDir    = __DIR__ . '/sections';
$templatesDir   = __DIR__ . '/templates';

require __DIR__ . '/models/speaker.php';

Kirby::plugin('werkschau/speakers', [
    'blueprints' => [
        'pages/speaker'             => $blueprintsDir . '/speaker.yml',
        'pages/speakers'            => $blueprintsDir . '/speakers.yml',
        'pages/speaker-work'        => $blueprintsDir . '/speaker-work.yml',
        'pages/block-speakers'      => $blueprintsDir . '/block-speakers.yml',
        'pages/talk'                => $blueprintsDir . '/talk.yml',
        'pages/talks'               => $blueprintsDir . '/talks.yml',
        'sections/speakers-unlisted'=> $sectionsDir . '/speakers-unlisted.yml',
        'sections/speakers-drafts'  => $sectionsDir . '/speakers-drafts.yml',
        'sections/talks-unlisted'   => $sectionsDir . '/talks-unlisted.yml',
        'sections/talks-drafts'     => $sectionsDir . '/talks-drafts.yml'
    ],

    'pageModels' => [
      'speaker' => 'SpeakerPage'
    ],

    'templates' => [
        'speaker'           => $templatesDir . '/speaker.php',
        'speakers'          => $templatesDir . '/speakers.php',
        'block-speakers'    => $templatesDir . '/block-speakers.php',
        'talk'              => $templatesDir . '/talk.php',
        'talks'             => $templatesDir . '/talks.php'
    ],

    'snippets' => [
        'speakers'          => $snippetsDir . '/speakers.php',
        'block-speakers'    => $snippetsDir . '/block-speakers.php'
    ]
]);

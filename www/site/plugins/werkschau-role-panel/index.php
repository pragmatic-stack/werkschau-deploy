<?php

if (($user = kirby()->user()) && $user->role() == 'student') {
    $dir = __DIR__ . '/blueprints/student/site.yml';
} else {
    $dir = __DIR__ . '/blueprints/site.yml';
}

Kirby::plugin('werkschau/werkschau-role-panel', [
    'blueprints' => [
        'site' => $dir
    ],
]);
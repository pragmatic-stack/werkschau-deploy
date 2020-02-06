<?php
/*
 * Requirements
 * search-form as a snippet
 * search-result-page
 * autocomplete search
 * tag Search
 */

require __DIR__ . '/helpers/getThumbnailUrl.php';

$templatesDir   = __DIR__ . '/templates';
$controllersDir = __DIR__ . '/controllers';
$snippetsDir    = __DIR__ . '/snippets';

Kirby::plugin('werkschau/search', [

    // plugin wide options
    'options' => [
        // define searchable pages by template name
        'searchPages' => ['abschlussarbeit', 'student', 'speaker', 'semesterarbeit', 'talk'],
        // define searchable fields by fieldname
        'searchFields' => ['firstName', 'lastName', 'title', 'student']
    ],

    // register templates
    'templates' => [
        'search-form'          => $templatesDir . '/search-form.php',
        'search-page'          => $templatesDir . '/search-page.php',
        'autocomplete.json'    => $templatesDir . '/autocomplete.json.php',
        'search-contents.json' => $templatesDir . '/search-contents.json.php',
        'search-tags.json'     => $templatesDir . '/search-tags.json.php'
    ],

    // register snippets
    'snippets' => ['search-form' => $snippetsDir . '/search-form.php'],

    // register controllers
    'controllers' => [
        'autocomplete.json'     => require $controllersDir . '/autocomplete.json.php',
        'search-contents.json'  => require $controllersDir . '/search-contents.json.php',
        'search-tags.json'      => require $controllersDir . '/search-tags.json.php',
        'search-page'           => require $controllersDir . '/search-page.php',
    ],

    // register routes for search-page and search endpoints
    'routes' => [
        // Virtual search page for mixed search results
        [
            'pattern'   => 'search',
            'action'    => function () {

                // no route protection -> public page
                return Page::factory([
                    'slug' => 'search',
                    'template' => 'search-page',
                    'content' => [
                        'title' => 'Suche'
                    ]
                ]);
            }
        ],

        // search autocomplete route for json content representations
        [
            'pattern'   => 'search/autocomplete',
            'action'    => function () {

                $customHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;

                // Secure JSON output from direct access in production environment
                if (option('debug') === false && $customHeader !== 'fetch') {
                    go(url('error'));
                }

                return Page::factory([
                    'slug' => 'autocomplete',
                    'template' => 'autocomplete.json',
                    'content' => [
                        'title' => 'Autocomplete Search Api'
                    ]
                ]);
            }
        ],

        // content search api returning results with more information and thumbs
        [
            'pattern'   => 'search/contents',
            'action'    => function () {

                $customHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;

                // Secure JSON output from direct access in production environment
                if (option('debug') === false && $customHeader !== 'fetch') {
                    go(url('error'));
                }

                return Page::factory([
                    'slug' => 'search-contents',
                    'template' => 'search-contents.json',
                    'content' => [
                        'title' => 'Full Content Search Api'
                    ]
                ]);
            }
        ],

        // content search api returning results with more information and thumbs
        [
            'pattern'   => 'search/tags',
            'action'    => function () {

                $customHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;

                // Secure JSON output from direct access in production environment
                if (option('debug') === false && $customHeader !== 'fetch') {
                    go(url('error'));
                }

                return Page::factory([
                    'slug' => 'search-tags',
                    'template' => 'search-tags.json',
                    'content' => [
                        'title' => 'Content Tags Search Api Endpoint'
                    ]
                ]);
            },
            'method'    => 'POST'
        ],
    ],
]);

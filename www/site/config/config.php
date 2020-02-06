<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen.
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */

require __DIR__ . "/../helpers/santisizers.php";
require __DIR__ . "/../helpers/fieldCheckers.php";
require __DIR__ . "/../helpers/vimeoEmbed.php";

// set image driver


return
[
    'debug' => true,
    'thumbs' =>
    [
        // set image driver
        // 'driver' => 'im',
        // These presets return thumbnail URLs
        // ex: $image->thumb('100')
        'presets' =>
        [
            'default'   => ['width' => 1024, 'quality' => 80],
            '1000'      => ['width' => 1000, 'quality' => 80],
            '750'       => ['width' => 750, 'quality' => 80],
            '500'       => ['width' => 500, 'quality' => 80],
            '250'       => ['width' => 250, 'quality' => 80],
            '100'       => ['width' => 100, 'quality' => 80],
            'carousel'  => ['width' => 500, 'height' => 500, 'crop' => 'center', 'quality' => 80],
            'slider'    => ['width' => 1920, 'quality' => 95],
            'blurred'   => ['blur' => true],
            'square-500' =>
                [
                    'width' => 500,
                    'height' => 500,
                    'crop' => 'center',
                    'quality' => 80
                ],
            'square-1000' =>
                [
                    'width' => 1000,
                    'height' => 1000,
                    'crop' => 'center',
                    'quality' => 85
                ],
        ],

        'srcsets' =>
        [
            'default' => [320, 450, 800, 1024, 1300],

            'square' =>
            [
                '340w' =>
                [
                    'width' => 340,
                    'height' => 340,
                    'crop' => 'center',
                    'quality' => 85
                ],
                '450w' =>
                [
                    'width' => 450,
                    'height' => 450,
                    'crop' => 'center',
                    'quality' => 85
                ],
                '800w' =>
                [
                    'width' => 800,
                    'height' => 800,
                    'crop' => 'center',
                    'quality' => 85
                ],
                '1024w' =>
                [
                    'width' => 1024,
                    'height' => 1024,
                    'crop' => 'center',
                    'quality' => 85
                ],
                '1300w' =>
                [
                    'width' => 1300,
                    'height' => 1300,
                    'crop' => 'center',
                    'quality' => 90
                ]
            ]
        ]
    ],
];



/**
 * Returns value for img sizes attribute.
 * This attribute is adding a huge improvement to the srcset attribute and
 * should always be used if the srcset is.
 */
function sizes($version = 'default') {

    if ($version == 'default'):

        $sizes = "
            (min-width: 65em) 25vw,
            (min-width: 56em) 33vw,
            (min-width: 35em) 50vw,
            100vw
        ";

    elseif ($version == 'col_3'):

        $sizes = "
            (min-width: 56em) 33vw,
            (min-width: 35em) 50vw,
            100vw
        ";

    elseif ($version == 'col_3_span_2'):

        $sizes = "
            (min-width: 56em) 66vw,
            100vw
        ";

    elseif ($version == 'col_2'):

        $sizes = "
            (min-width: 35em) 50vw,
            100vw
        ";

    endif;

    return $sizes;
}

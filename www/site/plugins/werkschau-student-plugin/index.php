<?php

$dir = __DIR__;

require $dir . '/helpers/siblingNavigation.php';
require $dir . '/models/student.php';

Kirby::plugin('werkschau/students', [
    'blueprints' => [
        'pages/absolventen'         => $dir . '/blueprints/absolventen.yml',
        'pages/student'             => $dir . '/blueprints/student.yml',
        'pages/students'            => $dir . '/blueprints/students.yml',
        'pages/block-students'      => $dir . '/blueprints/block-students.yml',
        'pages/abschlussarbeit'     => $dir . '/blueprints/abschlussarbeit.yml',
        'pages/semesterarbeit'      => $dir . '/blueprints/semesterarbeit.yml',
        'pages/teamwork'            => $dir . '/blueprints/teamwork.yml',
        'pages/teamworks'           => $dir . '/blueprints/teamworks.yml',
        'sections/works'            => $dir . '/sections/works.yml',
        'sections/student-teamworks'=> $dir . '/sections/student-teamworks.yml',
        'sections/student-drafts'   => $dir . '/sections/student-drafts.yml',
        'sections/student-unlisted' => $dir . '/sections/student-unlisted.yml',
        'sections/teamwork-unlisted'=> $dir . '/sections/teamwork-unlisted.yml',
        'sections/teamworks-drafts' => $dir . '/sections/teamworks-drafts.yml'
    ],

    'controllers' => [
        'student'               => require $dir . '/controllers/student.php',
        'abschlussarbeit'       => require $dir . '/controllers/abschlussarbeit.php',

        // controller for content representation endpoints
        // 'api-students.json'     => require $dir . '/controllers/api-students.json.php',
        'students-slides.json'  => require $dir . '/controllers/students-slides.json.php'
    ],

    'pageModels' => [
        'student' => 'StudentPage',
    ],

    'templates' => [
        'absolventen'           => $dir . '/templates/absolventen.php',
        'student'               => $dir . '/templates/student.php',
        'students'              => $dir . '/templates/students.php',
        'abschlussarbeit'       => $dir . '/templates/abschlussarbeit.php',
        'semesterarbeit'        => $dir . '/templates/semesterarbeit.php',
        'teamwork'              => $dir . '/templates/teamwork.php',
        'block-theses'          => $dir . '/templates/block-theses.php',
        'block-students'        => $dir . '/templates/block-students.php',

        // content representations as json endpoints
        'api-students.json'     => $dir . '/templates/api-students.json.php',
        'students-slides.json'  => $dir . '/templates/students-slides.json.php'
    ],

    'snippets' => [
        'students'          => $dir . '/snippets/students.php',
        'theses'            => $dir . '/snippets/theses.php',
        'block-students'    => $dir . '/snippets/block-students.php',
        'block-theses'      => $dir . '/snippets/block-theses.php',
    ],

    // Virtual Kirby Page for Student Pagination and Lazy Loading
    'routes' => [
        [
            'pattern'   => 'api-students',
            'action'    => function () {

                $customHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;

                // Secure JSON output from direct access in production environment
                if (option('debug') === false && $customHeader !== 'fetch') {
                    go(url('error'));
                }

                return Page::factory([
                    'slug' => 'api-students',
                    'template' => 'api-students.json',
                    'content' => [
                        'title' => 'Students Pagination Api'
                    ]
                ]);
            }
        ],

        [
            'pattern'   => 'api-w/students/slides',
            'action'    => function () {

                $customHeader = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? null;

                // Secure JSON output from direct access in production environment
                if (option('debug') === false && $customHeader !== 'fetch') {
                    go(url('error'));
                }

                return Page::factory([
                    'slug' => 'students-slides',
                    'template' => 'students-slides.json',
                    'content' => [
                        'title' => 'Student Slide Endpoint'
                    ]
                ]);
            }
        ],
    ],

    // Hook to set Student information on subpages
    'hooks' => [
        'page.create:after' => function ($page) {
            // check used template
            if($parent = $page->parent()){
                if($parent->intendedTemplate() == 'student')
                    $page->update(array(
                        'studentId' => $parent->id(),
                        'student' => $parent->firstName() . ' ' . $parent->lastName(),
                        'courseOfStudy' => $parent->courseOfStudy()
                    ));
            }
        },

        'page.changeStatus:before' => function ($page, $status) {
            $modelName = a::get(Page::$models, $page->intendedTemplate()->name());

            if(method_exists($modelName, 'hookChangeStatusBefore')){
                $modelName::hookChangeStatusBefore($page, $status);
            }
        }
    ]


]);
<?php

return function ($page) {

    // get the parent
    $student = $page->parent();
    $works = $page->children()->filterBy('intendedTemplate', 'studienarbeit');

    return [
        'student' => $student,
        'works' => $works,
        'nextThesisUrl' => nextSibling($page),
        'prevThesisUrl' => prevSibling($page),
        'randomThesisUrl' => randomSibling($page)
    ];
};


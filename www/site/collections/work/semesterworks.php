<?php

/**
 *  This collection is used to access all thesis published by students
 *  The following params are accessible for each thesis
 *  ->title() -- the thesis title
 *  ->student() -- the student
 *  ->studiengang() -- the ...
 *  ->beschreibung() -- the description
 *  ->coverbild() -- the coverimage
 */

return function ($site){
    $students = $site->find('students')->children();
    $termpapers = $students->children()->filterBy('template', 'semesterarbeit');

    return $termpapers;
};


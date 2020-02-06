<?php

require __DIR__ . '/../controllers/api-students.json.php';

// handle pagination by request
function handlePagination( \Kirby\Http\Request $request, \Kirby\Cms\Pages $pages){
    return handleStudentPagination($pages, $request);
}

$request = kirby()->request();

echo handlePagination($request, $pages);
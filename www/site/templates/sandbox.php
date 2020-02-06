<?php
$query = "short";
// $query = explode(' ', $query);

$searchPages = option('werkschau.search.searchPages');
$searchFields = ['firstName', 'lastName', 'title', 'student'];

// limit to pages selected
$results = site()->index()->filterBy('template', 'in', $searchPages);

$operations = 0;

forEach($results as $result){
    $found = false;
    // check specified fields
    forEach($searchFields as $fieldString){
        // check if field exists
        if($field = fromContentByString($result, $fieldString))
        {
            if(strpos($field->value(), $query) !== false){
                $found = true;
            }
        }
    }

    if($found == false){
       $results->remove($result);
    }
}


echo 'operations: ' . $operations;

dump($results);

$attrs = attr(['class' => ['container-fluid', 'ws-section--fullwidth']]);

echo '<div ' . $attrs . '></div>';
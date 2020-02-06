<?php
function nextSibling ($page) {
    $siblings = $page->siblings();
    $max = $siblings->count() - 1;
    $current = $siblings->indexOf($page->id());

    if($current < $max) {
        return $siblings->nth($current + 1)->url();
    }

    return null;
};

function prevSibling ($page) {
    $siblings = $page->siblings();
    $current = $siblings->indexOf($page->id());

    if($current > 0) {
        return $siblings->nth($current - 1)->url();
    }

    return null;
};

function randomSibling ($page){
    $siblings = $page->siblings();
    $max = $siblings->count() - 1;
    $current = $siblings->indexOf($page->id());

    $randomThesis = null;
    if($max > 1){
        do {
            $n = random_int(0, $max);
        } while ($n == $current);

        $randomThesis = $siblings->nth($n)->url();
    }

    return $randomThesis;
}
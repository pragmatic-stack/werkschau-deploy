<?php
return function ($page) {
    $title = $page->title();
    $query = get('q');
    $tags  = site()->index()->filterBy('template', 'in', option('werkschau.search.searchPages'))->pluck('tags', ',', true);

    return [
        'title' => $title,
        'query' => $query,
        'tags'  => $tags,
    ];
};

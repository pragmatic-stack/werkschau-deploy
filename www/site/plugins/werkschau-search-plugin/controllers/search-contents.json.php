<?php

return function ($site) {
    $query = get('q');
    $query = str_replace(' ', ' ', $query);

    // define search outreach from plugin options
    $searchPages = option('werkschau.search.searchPages');
    $searchFields = option('werkschau.search.searchFields');

    $results = site()->index()->filterBy('template', 'in', $searchPages);

    forEach($results as $result){
        $found = false;
        // check specified fields
        forEach($searchFields as $fieldString){
            // check if field exists
            if($field = fromContentByString($result, $fieldString))
            {
                // check if field value contains query
                if(strpos(strtolower($field->value()), strtolower($query)) !== false){
                    $found = true;
                }
            }
        }

        // remove result if not found in result fields
        if($found == false){
            $results->remove($result);
        }
    }

    // paginate results
    $results = $results->paginate(10);

    $json['data'] = [];

    foreach ($results as $result){

        $title = $result->title()->value();
        $url   = $result->url();
        $type  = $result->template()->name();
        $thumbUrl = getThumbnailUrl($result);

        // built json for search results
        $json['data'][] = array(
            'title'     => $title,
            'type'      => $type,
            'url'       => $url,
            'thumbUrl'  => $thumbUrl
        );
    }

    return [
        'query' => $query,
        'json' => $json
    ];
};
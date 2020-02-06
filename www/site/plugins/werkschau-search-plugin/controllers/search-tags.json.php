<?php
return function ($site) {
    $body = kirby()->request()->body();
    $tags = '';

    if(sizeof($body->toArray()) > 0) {
        $tags = $body->toArray()['tags'];
    } else {
        $tags = null;
    }

    if($tags != null){
        $results = new \Kirby\Cms\Pages();

        foreach ($tags as $tag){
            $results->add(site()->search(strval($tag), 'tags'));
        }
    } else {
        $results = null;
    }

    $json = [];

    if(!$results->isEmpty()){
        foreach ($results as $result){
            $json['data'][] = array(
                'title' => $result->title()->value(),
                'url'   => $result->url(),
                'type'  => $result->template()->name(),
                'thumbUrl' => getThumbnailUrl($result)
            );
        }

        $results->groupBy('template');
    }

    return [
        'json' => $json,
        'body' => $body,
        'tags' => ['tags' => $tags],
    ];
};
<?php

class Slide {

    public $description;
    public $imgUrl;

    function __construct($description, $imgUrl)
    {
        $this->description = $description;
        $this->imgUrl = $imgUrl;
    }
}


return function ($pages) {
    $query = get('q');

    if($request = kirby()->request()){
        if(array_key_exists( 'page', $request->data())){
            $requestedPage = $request->data()['page'];
            $students = site()->index()->unlisted()->filterBy('template', 'student')->sortBy('title', 'asc')->paginate(9, ['page' => $requestedPage]);

            $json['pages'] = $students->pagination()->pages();
            $json['page']  = $students->pagination()->page();
            $json['total'] = $students->pagination()->total();

        } else {
            $students = $pages->find('students')->children()->published()->sortBy('title', 'asc');
        }
    } else {
        $students = $pages->find('students')->children()->published()->sortBy('title', 'asc');
    }

    $json['data'] = [];

    foreach ($students as $student){
        // slides for frontend slider
        $slides = [];

        $thesis                 = $student->children()->unlisted()->findBy('template', 'abschlussarbeit');
        $comfortZoneImgUrl      = fromContentToFileUrl($student, 'comfortZone', true, 'square-500');
        $comfortZoneDescription = fromContentByString($student, 'comfortZoneDescription');
        $thesisImgUrl           = fromContentToFileUrl($student, 'abschlussarbeit', true, 'square-500');
        $shootingImgUrl         = fromContentToFileUrl($student, 'profileImage', true, 'square-500');

        // generate slides
        if($thesisImgUrl) {
            $slides[] = new Slide($thesis->title()->value(), $thesisImgUrl);
        }

        if( $shootingImgUrl ) {
            $slides[] = new Slide($thesis->title()->value(), $shootingImgUrl);
        }

        if($comfortZoneImgUrl) {
            $slides[] = new Slide($comfortZoneDescription ? $comfortZoneDescription->value() : null, $comfortZoneImgUrl);
        }

        // built json for search results
        $json['data'][] = array(
            'url'        => (string) $student->url(),
            'fullName'   => h($student->title()->toString()),
            'thesisUrl'  => $thesis ? (string) $thesis->url() : null,
            'slides'     => $slides
        );
    }

    return [
        'query' => $query,
        'json' => $json
    ];
};
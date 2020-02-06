<?php
return function ($page) {

    // Student related Data
    $studentName        = $page->firstName() . ' ' . $page->lastName();
    $semesterprojects   = fromContentToPages($page, 'projectWorks');
    $courseOfStudies    = fromContentByString($page, 'courseOfStudy');

    // Thesis related Data
    $thesis             = fromContentToPage($page, 'thesis');
    $thesisHeadline     = fromContentByString($thesis, 'headline');
    $thesisSubHeadline  = fromContentByString($thesis, 'subheadline');
    $thesisDescription  = fromContentByString($thesis, 'beschreibung');
    $thesisBuilding     = fromContentByString($thesis, 'building');
    $thesisRoom         = fromContentByString($thesis, 'room');
    $thesisImages       = $thesis->presentation()->toFiles();
    $thesisTeaserImage  = $thesis->presentation()->first()->toFile()->thumb('1000')->url();
    $vimeoLink          = fromContentWithValue($thesis->vimeoLink());
    $vimeoEmbed         = vimeoEmbedFromLink(fromContentWithValue($thesis->vimeoLink()));

    dump($vimeoEmbed);

    $supervisors        = fromContentByString($thesis, 'dozent')->split(',');

    // Clean $studentName aka "von Münchow-Fix"
    $replace = array("ö", "Ö", "ü", "Ü", "ä", "Ä", " ");
    $with = array("oe", "OE", "ue", "UE", "ae", "AE", "_");
    $cleanStudentName = str_replace($replace, $with, $studentName);

    $profileImage = fromContentToFileUrl($page, 'profileImage');
    $customColors = null;

    // build the thesis building and room
    $thesisRoomAbbrev = isset($thesisBuilding) ? $thesisBuilding->toPage()->kuerzel() : '';

    if(isset($thesisRoom)){
        $convertedRoom = $thesisRoom->toString();
        $convertedRoom = str_split($convertedRoom);

        $part1 = array_slice($convertedRoom, 0, 1, true);
        array_push($part1, '.');
        $part1 = array_merge($part1, array_slice($convertedRoom, 1, sizeof($convertedRoom)-1));
        $thesisRoomAbbrev = $thesisRoomAbbrev . ' ' . (string)implode($part1);
    }

    // Build Social Link Array
    $socialLinks = [];

    if ($website = fromContentByString($page, 'website')) {
        $socialLinks[] = array('value' => $website, 'icon' => 'fas fa-globe');
    }

    if ($email = fromContentByString($page, 'email')) {
        $socialLinks[] = array('value' => $email, 'hrefPrefix' => 'mailto:', 'icon' => 'fas fa-envelope');
    }

    if ($instagram = fromContentByString($page, 'instagram')) {
        $socialLinks[] = array('value' => $instagram, 'icon' => 'fab fa-instagram');
    }

    if ($behance = fromContentByString($page, 'behance')) {
        $socialLinks[] = array('value' => $behance, 'icon' => 'fab fa-behance');
    }

    if ($twitter = fromContentByString($page, 'twitter')) {
        $socialLinks[] = array('value' => $twitter, 'icon' => 'fab fa-twitter');
    }

    if ($facebook = fromContentByString($page, 'facebook')) {
        $socialLinks[] = array('value' => $facebook, 'icon' => 'fab fa-facebook');
    }

    if ($linkedIn = fromContentByString($page, 'linkedIn')) {
        $socialLinks[] = array('value' => $linkedIn, 'icon' => 'fab fa-linkedin');
    }

    // Get Custom Colors if thesis and thesis colors are defined
    if (isset($thesis)) {

        // set the background color from colorfield or null
        $backgroundColor = fromContentWithValue($thesis->backgroundColor());

        // set the typography color from colorfield or null
        $typographyColor = fromContentWithValue($thesis->typographyColor());

        if (isset($backgroundColor) && isset($typographyColor)) {
            $customColors = array(
                'background' => $backgroundColor->value(),
                'typography' => $typographyColor->value()
            );
        }

    } else {
        $customColors = null;
    }

    return [
        'studentName' => $studentName,
        'profileImage' => $profileImage,
        'courseOfStudies' => $courseOfStudies,
        'socialLinks' => $socialLinks,

        'thesis' => $thesis,
        'thesisHeadline' => $thesisHeadline,
        'thesisSubHeadline' => $thesisSubHeadline,
        'thesisDescription' => $thesisDescription,
        'thesisTeaserImage' => $thesisTeaserImage,
        'thesisImages'      => $thesisImages,
        'thesisRoomAbbrev' => $thesisRoomAbbrev,
        'vimeoEmbed' => $vimeoEmbed,
        'vimeoLink' => $vimeoLink,
        'supervisors' => $supervisors,

        'semesterprojects' => $semesterprojects,
        'customColors' => $customColors,

        'nextStudentUrl' => nextSibling($page),
        'prevStudentUrl' => prevSibling($page),
        'randomStudentUrl' => randomSibling($page),
    ];
};

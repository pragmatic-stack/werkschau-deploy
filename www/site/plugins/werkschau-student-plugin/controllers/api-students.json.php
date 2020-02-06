<?php
/**
 * Controllers for pagination request handling
 *
 * @param $pages
 * @param $request
 *
 * @return false|string
 *
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 */

function handleStudentPagination($pages, $request = null){
    /**
     *  ABSOLVENTEN PAGINATION
     *  fullName, url, thesis, thesisUrl,
     *  profileImageUrl, abschlussarbeitImageUrl, comfortZoneUrl
     **/
    $json = [];

    if(isset($request)){
        if(array_key_exists( 'page', $request->data())){
            $requestedPage = $request->data()['page'];
            $data = $pages->find('students')->children()->published()->paginate(9, ['page' => $requestedPage]);

            $json['pages'] = $data->pagination()->pages();
            $json['page']  = $data->pagination()->page();
            $json['total'] = $data->pagination()->total();

        } else {
            $data = $pages->find('students')->children()->published()->sortBy('title', 'asc');
        }
    } else {
        $data = $pages->find('students')->children()->published()->sortBy('title', 'asc');
    }

    $json['data']  = [];

    foreach($data as $student) {

        $thesis                 = $student->children()->findBy('template', 'abschlussarbeit');
        $comfortZone            = fromContentWithValue($student->comfortZone());
        $comfortZoneDescription = fromContentWithValue($student->comfortzonedescription());
        $abschlussarbeitImage   = fromContentWithValue($student->abschlussarbeit());
        $shootingImage          = fromContentWithValue($student->profileImage());

        $json['data'][] = array(
            'url'                       => (string) $student->url(),
            'fullName'                  => h($student->title()->toString()),
            'thesisName'                => $thesis ? h($thesis->title()->value()) : null,
            'thesisUrl'                 => $thesis ? $thesis->url() : null,
            'comfortZoneUrl'            => $comfortZone ? getThumbIfFileOnDisk($comfortZone) : null,
            'comfortZoneDescription'    => (string) h($comfortZoneDescription),
            'abschlussarbeitImageUrl'   => $abschlussarbeitImage ? getThumbIfFileOnDisk($abschlussarbeitImage) : null,
            'shootingBildUrl'           => $shootingImage ? getThumbIfFileOnDisk($shootingImage) : null,
        );
    }

    return json_encode($json);
}


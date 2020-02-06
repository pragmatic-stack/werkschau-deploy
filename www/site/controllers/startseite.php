<?php
/**
 * Startseite Controller to provide data for the startseite.php template
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 */
?>
<?php
return function ($page, $site, $kirby) {

    // prepare students for lazy loading
    $students = site()->find('students')->children()->published()->sortBy('title', 'asc');
    $theses = site()->index()->unlisted()->filterBy('template', 'abschlussarbeit');

    $linkConfig = [];

    $linkConfig[] = array('href' => '#programm', 'title' => 'Programm');
    $linkConfig[] = array('href' => '#absolventen', 'title' => 'Absolventen');
    $linkConfig[] = array('href' => '#anfahrt', 'title' => 'Anfahrt');

    return [
        'students'              => $students,
        'theses'                => $theses,
        'linkConfig'            => $linkConfig,
        'heroSnippet'           => getBlockSnippet($page, 'hero'),
        'infoSnippet'           => getBlockSnippet($page, 'mainInfo', ['blockWidth' => 'half', 'displayTitle' => 'true']),
        'timetableSnippet'      => getBlockSnippet($page, 'timeschedule', ['blockWidth' => 'half']),
        'addressSnippet'        => getBlockSnippet($page, 'address', ['blockWidth' => 'third']),
        'approachPublicSnippet' => getBlockSnippet($page, 'approachPublic', ['blockWidth' => 'third']),
        'approachCarSnippet'    => getBlockSnippet($page, 'approachCar', ['blockWidth' => 'third']),
        'maps'                  => getBlockSnippet($page, 'maps', ['blockWidth' => 'full']),
    ];
};
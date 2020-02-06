<?php
/**
 * Home Controller to provide data for the home.php templates
 *
 * @author      Konstantin Kraska <office@kraska-systems.de>
 * @copyright   2019 Konstantin Kraska
 * @license     MIT <https://opensource.org/licenses/MIT>
 */
?>
<?php

return function ($page, $site, $kirby) {

    $studenten = $site->find('students')->children();
    $abschlussarbeiten = $site->index()->filterBy('template', 'abschlussarbeit');
    $semesterarbeiten = $site->index()->filterBy('template', 'semesterarbeit');
    $events = $site->events()->toStructure();

    return [
        'marquee' => $page->marqueeText()->toPage(),
        'studenten' =>  $studenten,
        'abschlussarbeiten' => $abschlussarbeiten,
        'semesterarbeiten' => $semesterarbeiten,
        'events' => $events
    ];
};

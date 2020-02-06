<?php
function getGermanWeekday($day)
{
    $weekdays = array(
        "Mon" => "Montag",
        "Tue" => "Dienstag",
        "Wed" => "Mittwoch",
        "Thu" => "Donnerstag",
        "Fri" => "Freitag",
        "Sat" => "Samstag",
        "Sun" => "Sonntag"
    );

    return $weekdays[strval($day)];
}
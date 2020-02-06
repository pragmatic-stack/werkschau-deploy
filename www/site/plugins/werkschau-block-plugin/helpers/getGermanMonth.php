<?php
function getGermanMonth($month) {
  $months = array(
    "January" => "Januar",
    "February" => "Februar",
    "March" => "März",
    "April" => "April",
    "May" => "Mai",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "August",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "Dezember"
  );

  return $months[strval($month)];
}

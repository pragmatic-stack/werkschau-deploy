<?php
function getGermanMonthShort($month) {
  $months = array(
    "Jan" => "Jan",
    "Feb" => "Feb",
    "Mar" => "Mär",
    "Apr" => "Apr",
    "May" => "Mai",
    "Jun" => "Jun",
    "Jul" => "Jul",
    "Aug" => "Aug",
    "Sep" => "Sep",
    "Oct" => "Okt",
    "Nov" => "Nov",
    "Dec" => "Dez"
  );

  return $months[strval($month)];
}

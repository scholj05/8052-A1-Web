<?php
$table_name = "pm_reading";
$tz = 'Pacific/Auckland';
$format = 'Y-m-d H:i:s';

date_default_timezone_set($tz);
$currentDate = date($format);
$datetime = new DateTime(date($format), new DateTimeZone($tz));
$yesterday = date_sub($datetime, date_interval_create_from_date_string("1 Day"));
$strYesterday = $yesterday->format($format);
$query = "SELECT * FROM " . $table_name . "WHERE " . $table_name . ".date > \"" . $strYesterday . "\" ORDER BY pm_reading.date DESC";
echo $query;
?>
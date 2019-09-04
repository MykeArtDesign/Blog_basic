<?php
$date1 = $article["publishDate"];
$date2 = time();

$date3 = strtotime($date1)/86400;
$date4 = $date2/86400;
 
$nbJoursTimestamp = $date4 - $date3;
$nbJours = round($nbJoursTimestamp);
 
?>
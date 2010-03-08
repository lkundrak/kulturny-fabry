<?php
include(dirname(__FILE__).'/main.php');

### Musilka
$venue_id = 5;
$url = "http://www.ksomega.cz/?a=musilka-program";

$data = load_url($url);

preg_match_all("/<div class=\"musilka_prg_detail\"><h4>(.*)<\/h4>.*<div>(.*)<\/div>.*<div class=\"musilka_prg_den\">.*<b>([0-9]{2})\. ([0-9]{2})\. ([0-9]{4})\&nbsp;<\/b>[[:space:]]*<br \/>[[:space:]]*([0-9]{1,2}:[0-9]{1,2})\&nbsp;[[:space:]]*<br \/>[[:space:]]*(.*)?\&nbsp;/Usmi", $data, $events);

foreach($events[1] as $key => $title) {
    $title = iconv("windows-1250", "utf-8", $title);
    $description = iconv("windows-1250", "utf-8", $events[2][$key]);
    $entry = iconv("windows-1250", "utf-8", $events[7][$key]);

    add_event($venue_id, $title, $events[5][$key]."-".$events[4][$key]."-".$events[3][$key]." ".$events[6][$key], $entry, $description, "");
}

?>

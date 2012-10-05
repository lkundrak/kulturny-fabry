<?php
include(dirname(__FILE__).'/main.php');

### Mersey
$venue_id = 6;
$url = "http://mersey.cz/cz/program.php";

$data = load_url($url);

preg_match_all("/<span class=\"program_time\">([0-9]{1,2})\. ([0-9]{1,2})\..*<\/span>[[:space:]]*<span class=\"program_text.*\">(.*)<\/span>/Usmi", $data, $events);

foreach($events[3] as $key => $title) {
    add_event($venue_id, $title, date("Y")."-".$events[2][$key]."-".$events[1][$key]." 20:00", "neuvedené", "", "");
}

?>

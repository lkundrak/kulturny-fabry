<?php
include(dirname(__FILE__).'/main.php');

### Desert
$venue_id = 1;
$url = "http://www.dodesertu.com/index.php/program";

$url_prefix = "http://www.dodesertu.com";

$data = load_url($url);

preg_match_all("/<strong>[[:space:]]*([0-9\.]{10}).*([0-9\.]{4,5}) h.*href=\"(.*)\">(.*)<\/a>.*<td headers=\"el_location\" align=\"left\" valign=\"top\">(.*)<\/td>/Usmi", $data, $info);

foreach($info[1] as $index => $date) {
    $data_detail = load_url($url_prefix.$info[3][$index]);
    preg_match_all("/<div class=\"description event_desc\">(.*)<\/div>.*Venue  -->/Usmi", $data_detail, $info_detail);

    $info[5][$index] = trim($info[5][$index]);
    if($info == "-" || $info == "Zdarma" || $info == "") {
        $entry = 0;
    } elseif(eregi(" K", $info[5][$index])) {
        $entry = substr($info[5][$index], 0, -3);
    } else {
        $entry = 0;
    }

    preg_match("/^([0-9]{2})\.([0-9]{2})\.([0-9]{4})/i", trim($date), $date_parsed);

    add_event($venue_id, $info[4][$index], $date_parsed[3]."-".$date_parsed[2]."-".$date_parsed[1]." ".str_replace(".", ":", $info[2][$index]), $entry, trim(strip_tags($info_detail[1][0])), $url_prefix.$info[3][$index]);
}
?>

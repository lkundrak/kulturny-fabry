<?php
include(dirname(__FILE__).'/main.php');

### Faval
$venue_id = 3;
$url = "http://www.faval.cz/index.php?menu=zobraz_program";

$flyer_pre = "http://www.faval.cz/";

$data = load_url($url);

preg_match_all("/<div class=\"prouzek_akce\">.*<td>([0-9\.]*)<\/td>.*<td width=\"100%\">(.*)<\/td>.*class=\"pod_akce_cena\">(.*)<\/td>.*<img src=\"(images\/akce\/.*.jpg)\".*class=\"pod_akce_popis_obrazek\" valign=\"top\">(.*)<\/td>/Usmi", $data, $details);

foreach($details[1] as $key => $date) {
    $description = strip_tags(iconv("windows-1250", "utf-8", $details[5][$key]));
    $title = strip_tags(iconv("windows-1250", "utf-8", $details[2][$key]));
    $entry = iconv("windows-1250", "utf-8", $details[3][$key]);

    preg_match_all("/start ([0-9:]*)/i", $details[5][$key], $start);
    preg_match_all("/([0-9]{1,2})\.([0-9]{1,2})\./i", $details[1][$key], $date_parsed);

    add_event($venue_id, $title, date("Y")."-".$date_parsed[2][0]."-".$date_parsed[1][0]." ".$start[1][0], trim($entry), $description, "", $flyer_pre.$details[4][$key]);
}
?>

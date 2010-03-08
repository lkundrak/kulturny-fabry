<?php
include(dirname(__FILE__).'/main.php');

### Fleda
$venue_id = 2;
$url = "http://fleda.cz/program";

$data = load_url($url);

preg_match_all("/\"(http:\/\/fleda.cz\/program\?prgl=[0-9]*)\"/Usmi", $data, $pages);

foreach(array_unique($pages[1]) as $page) {
    $data = load_url($page);

    preg_match_all("/<a href=\"(http:\/\/fleda.cz\/program\/[a-zA-Z0-9\-\.\_]*\?prgl=[0-9]{1,2})\" title=\"zobrazí více informací o daném programu\">Více zde...<\/a>/Usmi", $data, $links);

    foreach($links[1] as $url) {
        $data_detail = load_url($url);

        preg_match_all("/<div class=\"detail-item-imag\">.*(onclick=\"javascript.*<img src=\"(http:\/\/fleda.cz\/media\/flyer\/.*)\" style.*alt=\"aa\"\/>.*)?<\/div>[[:space:]]*<div class=\"detail-item\">[[:space:]]*<div class=\"bkholder\"><h2 style=\"font-size: 18px\">(.*)<\/h2>.*<h3><span style=\"font-weight: normal; color: white\">(.*)<\/span><\/h3>.*<strong>VSTUP: <\/strong>(.*)<\/div>.*<strong>START: <\/strong>(.*)<\/div>.*<div class=\"detail-item-body\"><p>(.*)<\/p><\/div>/Umsi", $data_detail, $detail);
        
        preg_match("/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})/i", $detail[4][0], $date_parsed);

        add_event($venue_id, $detail[3][0], $date_parsed[3]."-".$date_parsed[2]."-".$date_parsed[1]." ".trim($detail[6][0]), trim($detail[5][0]), strip_tags($detail[7][0]), $url, $detail[2][0]);
    }
}
?>

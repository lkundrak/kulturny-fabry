<?php
include(dirname(__FILE__).'/main.php');

### Perpetuum
$venue_id = 4;
$url = "http://perpetuum.cz/parties/";
$pre_url = "http://perpetuum.cz";

$data = load_url($url);

preg_match_all("/\"(\/parties\/[0-9]{4}\/[0-9]{1,2}\/)\"/Usmi", $data, $months);

foreach($months[1] as $month) {
    $data_month = load_url($pre_url.$month);

    preg_match_all("/href=\"(\/parties\/[0-9]{4}\/[0-9]{1,2}\/[0-9]*-.*\/)\"/Usmi", $data_month, $parties);

    foreach(array_unique($parties[1]) as $party) {
        $data_party = load_url($pre_url.$party);

        preg_match_all("/<div class=\"party_reports-nazev\">(.*)<\/div>.*(class=\"party_reports-flyer-link\" href=\"\/parties\/[0-9]{4}\/[0-9]{1,2}\/[0-9]*-.*\/flyers\/([0-9]*)\/\".*)?When:.*([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4}).*DJs:.*valign=\"top\">(.*)<\/td>.*Entry:.*([0-9]*)\&nbsp;CZK/Usmi", $data_party, $detail);

        if(trim($detail[1][0])) {
            add_event($venue_id, $detail[1][0], $detail[6][0]."-".$detail[5][0]."-".$detail[4][0]." 20:00", $detail[8][0].",-", strip_tags($detail[7][0]), $pre_url.$party, ($detail[3][0] ? $pre_url."/flyerz/".$detail[3][0].".jpg" : "" ));
        }
    }
}
?>

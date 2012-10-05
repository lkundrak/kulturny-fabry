<?php

$sql = "SELECT venue.venue_id, venue.title, venue.url FROM venue";
$q = mysql_query($sql);
while($row = mysql_fetch_array($q)) {
    $_DATA['venues'][] = $row;
}

switch($_GET['a']) {
    default:
    case 'venue':
        $sql = sprintf("SELECT `event`.`event_id`, `event`.`venue_id`, `event`.`when`, `event`.`title`, `event`.`description`, `event`.`entry`, `event`.`flyer`, `event`.`url`, `venue`.`title` AS venue_title, DATE(`event`.`when`) AS day FROM `event` JOIN `venue` ON `venue`.venue_id = `event`.venue_id WHERE `event`.`when`>=CURDATE() ORDER BY `event`.`when` ASC");
        $q = mysql_query($sql) or die(mysql_error());

        while($row = mysql_fetch_array($q)) {

            if($row['entry'] == "0") {
                $row['entry'] = "zdarma";
            } elseif(is_numeric(trim($row['entry']))) {
                $row['entry'] = trim($row['entry']).",-";
            }
            
            $_days = array("pondelok", "utorok", "streda", "štvrtok", "piatok", "sobota", "nedeľa");
            $_DATA['events'][$row['day']][] = $row;
        }

        if(is_numeric($_GET['venue_id'])) {
            $_DATA['venue_id'] = (int)$_GET['venue_id'];
        }

        $_DATA['today'] = date("Y-m-d");
        $_DATA['tomorrow'] = date("Y-m-d", time() + 86400);

        $content = "list";
        break;
}

$Smarty->assign("_DATA", $_DATA);
$Smarty->assign("content", $content);
$Smarty->display("index.tpl");
?>

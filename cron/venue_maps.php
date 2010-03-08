<?php
include(dirname(__FILE__)."/main.php");

$sql = "SELECT venue_id, lat, lng FROM venue";
$q = mysql_query($sql);

while($row = mysql_fetch_array($q)) {
    downloadStaticGMap($row['lat'], $row['lng'], 210, 210, $_DATA['base_path']."img/maps/".$row['venue_id'].".png");
}
?>

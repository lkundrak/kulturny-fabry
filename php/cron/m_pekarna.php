<?php
include(dirname(__FILE__).'/main.php');

# Stara Pekarna
$venue_id = 7;
$main_url = "http://www.starapekarna.cz/?pg=1&m=1";

$data = load_url($main_url);

# Co je za rok?
preg_match("/<span class=\"nazev_programu\">\d+ \/ (\d+)<\/span>/si", $data, $info);
$year = $info[1];

# Vyzobat vsecky eventy
preg_match_all("/<table class=\"program.*?[^>]<\/table>/si", $data, $info);

foreach ($info[0] as $event) {
	# Moze matchnut viac nez jeden; e.g.:
	# "Jazz Brno 2012 a Etno Brno 2012", "Adriano Trindade &  Los Quemados (Brazílie/CZ)"
	if (!preg_match_all("/<span class=\"nazev_programu\">(.*?)<\/span>/si", $event, $lal)) {
		echo("Chybi titulek\n");
		continue;
	}
	$title = trim(implode($lal[1], ", "));

	# Hodina ("13:37" alebo "13.37")!, Den, Mesiac
	if (!preg_match("/
		<div\ title=\"<strong>(\d+)[:\.](\d+)<\/strong>\ -\ <strong>.*?<\/strong>\">
			<span\ class=\"datum_den\">.*?\ (\d+)\.<\/span>
			<span\ class=\"malej\">(\d+)\.<\/span>
		<\/div>/six",
		$event, $lal)) {
		echo("Chybi cas: '$title'\n");
		continue;
	}
	$datetime = sprintf("%04d-%02d-%02d %02d:%02d:00",
		$year, $lal[4], $lal[3], $lal[1], $lal[2], 0);

	# Cena
	$entry = null;
	if (preg_match_all("/
		<span\ class=\"mini\">(.*?):?<\/span>
		<span\ class=\"cena\">\ *(\d+)\ *(.*?)<\/span>/six",
		$event, $lal)) {
		foreach ($lal[1] as $index => $where) {
			if ($entry)
				$entry .= " / ";
			$entry .= $lal[2][$index]." ".$lal[3][$index]." ".$lal[1][$index];
		}
	}

	# Popis; posledny, bez skrateneho
	if (!preg_match_all("/<span class=\"popis_programu\">(?:<span.*?.>)?(.*?)<\/span>/si", $event, $lal)) {
		echo ("Chybi popis: '$title'\n");
		continue;
	};
	$description = array_pop($lal[1]);

	# Link na detaily
	preg_match("/<div class=\"program_link\"><a href=\"(.*?)\"/", $event, $lal);
	if (array_key_exists(1, $lal)) {
		$matched = $lal[1];
	} else {
		$url = null;
	}

	add_event($venue_id, $title, $datetime, $entry, $description, $url);
}

?>

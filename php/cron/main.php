<?php
$dir = dirname(__FILE__);
$_dir = substr($dir, 0, strrpos($dir, "/"));
include_once($_dir.'/lib/autoload.php');

function load_url($url) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($c);
    curl_close($c);

    return $data;
}

function add_event($venue_id, $title, $datetime, $entry, $description, $url, $flyer = "") {
    global $_DATA;
    $title = trim($title);

    $sql = sprintf("SELECT `event_id` FROM `event` WHERE `title`='%s' AND `venue_id`=%s AND `when`='%s'", mysql_escape_string($title), $venue_id, $datetime);
    $q = mysql_query($sql) or die(mysql_error());

    if(mysql_num_rows($q) == 0) {
        if($flyer) {
            $fn = md5(microtime().time());
            rszImage($flyer, $_DATA['base_path']."img/event/$fn.1.png", "image/jpeg", 100, 100, "png");
            rszImage($flyer, $_DATA['base_path']."img/event/$fn.2.png", "image/jpeg", 300, 300, "png");
        }       

        echo $sql = sprintf("INSERT INTO `event` (`venue_id`, `when`, `url`, `title`, `description`, `entry`, `flyer`) VALUES (%s, '%s', '%s', '%s', '%s', '%s', '%s')", $venue_id, $datetime, mysql_escape_string($url), mysql_escape_string($title), mysql_escape_string($description), mysql_escape_string($entry), $fn);
        echo "\n";
        mysql_query($sql) or die(mysql_error());
    }
}

function rszImage($from, $to, $type, $max_w, $max_h, $output = "jpg") {
    switch($type) {
        default:
        case 'image/jpeg':
        case 'image/pjpeg':
            $source = imagecreatefromjpeg($from);
            break;
     
        case 'image/gif':
            $source = imagecreatefromgif($from);
            break;
     
        case 'image/png':
            $source = imagecreatefrompng($from);
            break;
    }    
    
    list($width, $height) = getimagesize($from);
    
    if($width > $max_w || $height > $max_h) {
        $percent = $max_w/$width;
        if($percent*$height > $max_h) {
            $percent = $max_h/$height;
        }    
    } else {
        $percent = 1; 
    }    
    
    $newwidth = $width * $percent;
    $newheight = $height * $percent;
    
    $target = imagecreatetruecolor($newwidth, $newheight);
    //imagecopyresized($target, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagecopyresampled($target, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
    if($output == "jpg") {
        imagejpeg($target, $to);
    } elseif($output == "png") {
        imagepng($target, $to);
    }    
}


?>

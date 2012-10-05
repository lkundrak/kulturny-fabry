<?php
session_start();

$_debug = true;
$_google_api_key = "";

if($_debug) {
	error_reporting(10239 ^E_NOTICE); // E_ALL | E_STRICT
	ini_set("display_errors", "on");
	ini_set("log_errors", "on");
} else {
	error_reporting(6143 ^E_NOTICE); // E_ALL ^E_NOTICE
	ini_set("display_errors", "off");
	ini_set("log_errors", "on");
}

header("Content-Type: text/html; charset=utf-8");

mysql_connect($_ENV['OPENSHIFT_DB_HOST'], $_ENV['OPENSHIFT_DB_USERNAME'], $_ENV['OPENSHIFT_DB_PASSWORD']);
mysql_select_db($_ENV['OPENSHIFT_GEAR_NAME']);

mysql_query("set NAMES 'utf8'");
#mysql_query("set character set utf8");

$_DATA['base_href'] = 'http://'.$_ENV['OPENSHIFT_APP_DNS'].'/';
$_DATA['base_path'] = $_ENV['OPENSHIFT_REPO_DIR'].'php/';

$Smarty = new Smarty();
$Smarty->template_dir = "lib/templates/";
$Smarty->compile_dir = "lib/templates_c/";

if($_debug) {
	$Smarty->debug_tpl = $_DATA['base_path']."lib/templates/debug.tpl";
	$Smarty->debugging = false;
}


function bezDiakritiky($string) {
    $utf_to_ascii = array("\xc3\xa1"=>"a","\xc3\xa4"=>"a","\xc4\x8d"=>"c","\xc4\x8f"=>"d","\xc3\xa9"=>"e","\xc4\x9b"=>"e","\xc3\xad"=>"i","\xc4\xbe"=>"l","\xc4\xba"=>"l","\xc5\x88"=>"n","\xc3\xb3"=>"o","\xc3\xb6"=>"o","\xc5\x91"=>"o","\xc3\xb4"=>"o","\xc5\x99"=>"r","\xc5\x95"=>"r","\xc5\xa1"=>"s","\xc5\xa5"=>"t","\xc3\xba"=>"u","\xc5\xaf"=>"u","\xc3\xbc"=>"u","\xc5\xb1"=>"u","\xc3\xbd"=>"y","\xc5\xbe"=>"z","\xc3\x81"=>"A","\xc3\x84"=>"A","\xc4\x8c"=>"C","\xc4\x8e"=>"D","\xc3\x89"=>"E","\xc4\x9a"=>"E","\xc3\x8d"=>"I","\xc4\xbd"=>"L","\xc4\xb9"=>"L","\xc5\x87"=>"N","\xc3\x93"=>"O","\xc3\x96"=>"O","\xc5\x90"=>"O","\xc3\x94"=>"O","\xc5\x98"=>"R","\xc5\x94"=>"R","\xc5\xa0"=>"S","\xc5\xa4"=>"T","\xc3\x9a"=>"U","\xc5\xae"=>"U","\xc3\x9c"=>"U","\xc5\xb0"=>"U","\xc3\x9d"=>"Y","\xc5\xbd"=>"Z");
    return strtr($string, $utf_to_ascii);
}

function makeSeoUrl($string) {
    $change = array(" " => "-", 
                    "." => "-", 
                    ")" => "",
                    "(" => "",
                    "]" => "",
                    "[" => "",
                    "}" => "",
                    "{" => "",
                    ":" => "",
                    "," => "",
                    "&" => "-"
                );   
     
    
    //$string = strtolower(strtr(strtr($string, "áčďéěíľňóřšťúůýžÁČĎÉĚÍĽŇÓŘŠŤÚŮÝŽ", "acdeeilnorstuuyzACDEEILNORSTUUYZ"), $change));
    
    $string = strtr(strtolower(bezDiakritiky($string)), $change);
    $string = preg_replace("/(-+)-\\1/u", "\\1", $string);
    return preg_replace("/(-+)$/u", "", $string);
}

function download_file($url) {
    if(false === ($handle = fopen($url, "rb"))) {
        return false; 
    }        
    
    $contents = stream_get_contents($handle);
    fclose($handle); 
    
    $tmp_name = tempnam("/tmp", "import");
    $fp = fopen($tmp_name, "wb");
    fwrite($fp, $contents);
    fclose($fp);
    
    return $tmp_name;
}

function downloadStaticGMap($lat, $lng, $w, $h, $dest) {
    global $_google_api_key;
    
    if(false !== ($from = download_file("http://maps.google.com/staticmap?center=".$lat.",".$lng."&zoom=15&size=".$w."x".$h."&maptype=mobile&key=".$_google_api_key."&markers=".$lat.",".$lng.",red"))) {
        rename($from, $dest);
        chmod($dest, 0644);
        return true;
    }        
    
    return false;
}


?>

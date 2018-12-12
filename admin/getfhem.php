<?php
require_once("/sd_p2/web/php_inc/config.inc.php");

if (isset($_GET["geraet"])) {  $geraet=$_GET["geraet"]; }
if (isset($_GET["eigenschaft"])) {  $eigenschaft=$_GET["eigenschaft"]; }

//Hostname und Telnet-Port des FHEM-Servers
$fhemhost = "localhost";
$fhemport = 7072;

//Socket öffnen
$fhemsock = fsockopen($fhemhost, $fhemport, $errno, $errstr, 30);
$fhemcmd = "{ ReadingsVal(\"".$geraet."\",\"".$eigenschaft."\",0);; }\r\nquit\r\n";
//print $fhemcmd."<br>";
fwrite($fhemsock, $fhemcmd);
#while(!feof($fhemsock)) {
if(!feof($fhemsock)) {
    $ergebnis=fgets($fhemsock, 128);
	if ( strlen($ergebnis) > 2 ) {
		$zustand=explode(" ",$ergebnis);
        print trim($zustand[0]);
	}
}
?>

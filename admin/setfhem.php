<?php
//Hostname und Telnet-Port des FHEM-Servers
$fhemhost = "localhost";
$fhemport = 7072;
require_once("/sd_p2/web/php_inc/config.inc.php");

if(is_checked_in()) {
	if (isset($_GET["geraet"])) {  $geraet=$_GET["geraet"]; }
	if (isset($_GET["eigenschaft"])) {  $eigenschaft=$_GET["eigenschaft"]; }
	if (isset($_GET["wert"])) {  $wert=$_GET["wert"]; } else { $wert=""; }
	if (isset($_GET["wert1"])) {  $wert1=$_GET["wert1"]; } else { $wert1=""; }
//Socket öffnen
	$fhemsock = fsockopen($fhemhost, $fhemport, $errno, $errstr, 30);
	$fhemcmd = "set ".$geraet." ".$eigenschaft." ".$wert." ".$wert1." \r\nquit\r\n";
//print $fhemcmd."<br>";
	fwrite($fhemsock, $fhemcmd);
	while(!feof($fhemsock)) {
		$ergebnis=fgets($fhemsock, 128);
	}
#print $geraet." gesetzt auf ".$eigenschaft." = ".$wert." ".$wert1." ";
	echo $fhemcmd;
} else {
	echo "no login";
}	

?>

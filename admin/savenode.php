<?php
require_once("/sd_p2/web/php_inc/sensorhub.inc.php");

if (isset($_GET["onid"])) { $onid=$_GET["onid"]; } else { $onid=999999999; }
if (isset($_GET["nid"])) { $nid=$_GET["nid"]; } else { $nid=999999999; }
if (isset($_GET["nn"])) { $nn=$_GET["nn"]; } else { $nn=" "; }
if (isset($_GET["ni"])) { $ni=$_GET["ni"]; } else { $ni=" "; }
if (isset($_GET["st1"])) { $st1=$_GET["st1"]; } 
if ( $st1*1 == 0 ) { $st1=60; }
if (isset($_GET["st2"])) { $st2=$_GET["st2"]; } 
if ( $st2*1 == 0 ) { $st2=60; }
if (isset($_GET["st3"])) { $st3=$_GET["st3"]; } 
if ( $st3*1 == 0 ) { $st3=60; }
if (isset($_GET["st4"])) { $st4=$_GET["st4"]; } 
if ( $st4*1 == 0 ) { $st4=60; }
if (isset($_GET["rm"])) { $rm=$_GET["rm"]; } 
$rm=$rm*1; 
if (isset($_GET["vd"])) { $vd=$_GET["vd"]; }
if ( $vd*1 == 0 ) { $vd=1; }
if (isset($_GET["bid"])) { $bid=$_GET["bid"]; } 
$bid=$bid*1;

if ( $onid == 0 ) {
$sql ="insert into node (node_id, node_name, add_info, sleeptime1, sleeptime2, sleeptime3, sleeptime4, radiomode, voltagecorrection, battery_id) values('".$nid."', '".$nn."', '".$ni."', ".$st1.", ".$st2.", ".$st3.", ".$st4.", ".$rm.", ".$vd.", ".$bid.")";
	$sensorhub_db->query($sql);
	print "Neuen Node angelegt, NodeID: ".$nid;
} else {
	$sql = " update node set node_name = '".$nn."', add_info = '".$ni."', sleeptime1 = ".$st1.", sleeptime2 = ".$st2.",sleeptime3 = ".$st3.",sleeptime4 = ".$st4.", radiomode = ".$rm.", voltagefactor = ".$vd.", battery_id = ".$bid."  where node_id = '".$onid."' ";
        $sensorhub_db->query($sql);
	print "Update erfolgt für NodeID: ".$onid;
}					   
?>


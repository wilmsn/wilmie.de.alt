<?php
require_once("/sd_p2/web/php_inc/sensorhub.inc.php");

if (isset($_GET["onid"])) { $onid=$_GET["onid"]; } else { $onid=999999999; }
if (isset($_GET["nid"])) { $nid=$_GET["nid"]; } else { $nid=999999999; }
if (isset($_GET["nn"])) { $nn=$_GET["nn"]; } else { $nn=" "; }
if (isset($_GET["ni"])) { $ni=$_GET["ni"]; } else { $ni=" "; }
if (isset($_GET["st1"])) { $st1=$_GET["st1"]; } else { $st1=60; }
if (isset($_GET["st2"])) { $st2=$_GET["st2"]; } else { $st2=60; }
if (isset($_GET["st3"])) { $st3=$_GET["st3"]; } else { $st3=2; }
if (isset($_GET["st4"])) { $st4=$_GET["st4"]; } else { $st4=2; }
if (isset($_GET["rm"])) { $rm=$_GET["rm"]; } else { $rm=0; }
if (isset($_GET["vd"])) { $vd=$_GET["vd"]; } else { $vd=1; }
if (isset($_GET["bid"])) { $bid=$_GET["bid"]; } else { $bid=0; }


if ( $onid == 0 ) {
	$sensorhub_db->query("insert into node (node_id, node_name, add_info, sleeptime1, sleeptime2, sleeptime3, sleeptime4, radiomode, voltagecorrection, battery_id) ".
						 " values('".$nid."', '".$nn."', '".$ni."', ".$st1.", ".$st2.", ".$st3.", ".$st4.", ".$rm.", ".$vd.", ".$bid.") "); 
	print "Neuen Node angelegt, NodeID: ".$nid." insert into node (node_id, node_name, add_info, sleeptime1, sleeptime2, sleeptime3, sleeptime4, radiomode, voltagecorrection, battery_id) ".
						 " values('".$nid."', '".$nn."', '".$ni."', ".$st1.", ".$st2.", ".$st3.", ".$st4.", ".$rm.", ".$vd.", ".$bid.") "; 
} else {
	$sensorhub_db->query(" update node set ".
						"node_name = '".$nn."', ".
						"add_info = '".$ni."', ".
						"sleeptime1 = ".$st1.", ".
						"sleeptime2 = ".$st2.", ".
						"sleeptime3 = ".$st3.", ".
						"sleeptime4 = ".$st4.", ".	
						"radiomode = ".$rm.", ".
						"voltagecorrection = ".$vd.", ".
						"battery_id = ".$bid." ".
						" where node_id = '".$onid."' "); 
	print "Update erfolgt für NodeID: ".$onid;
}					   
?>


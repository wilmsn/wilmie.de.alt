<?php
require_once("/sd_p2/web/php_inc/sensorhubdemo.inc.php");

if (isset($_GET["sensor"]))  {
  $sensor=$_GET["sensor"];
} else { 
  $sensor=0; 
}
if (isset($_GET["num_col"]))  {
  $num_col=$_GET["num_col"];
} else { 
  $num_col=1; 
}

foreach ($sensorhub_db->query("select count(*) / 10 / ".$num_col." from sensordata where sensor_id = ".$sensor) as $row) {
	print $row[0]; 
	}

?>
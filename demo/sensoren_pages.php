<?php
$DB_FILENAME="/var/database/sensorhub_demo.db";
$db = new SQLite3($DB_FILENAME);
if (isset($_GET["sensor"]))  {
  $sensor=$_GET["sensor"];
} else { 
  $sensor=0; 
}
if (isset($_GET["actor"]))  {
  $actor=$_GET["actor"];
} else { 
  $actor=0; 
  if ($sensor=0){$sensor=1;}  ; 
}
if (isset($_GET["num_col"]))  {
  $num_col=$_GET["num_col"];
} else { 
  $num_col=1; 
}
if ( $sensor > 0 ) { 
		$tab="sensor";
		$id=$sensor;
} else { 
		$tab="actor";
		$id=$actor;
}

$query_str="select count(*) / 10 / ".$num_col." from ".$tab."data where ".$tab."_id = ".$id;
$results = $db->query($query_str);
if ($row = $results->fetchArray() ) { print $row[0]; }

?>
<style type="text/css">
table td{
	border:1px solid black; 
    vertical-align:center;
    overflow:hidden; 
	}
table.noborder td.noborder {
	border:0px solid black; 
	}
</style>

<?php
require_once("/sd_p2/web/php_inc/sensorhubdemo.inc.php");

function one_col($sensorhub_db,$mypage,$id) {
	$limit1=($mypage)*10;
	$limit2=10;
	$returnstr="<table><tr><th>Zeitpunkt</th><th>Wert</th></th></tr>";
	foreach ($sensorhub_db->query("select date_format(from_unixtime(utime),'%d.%m.%y %H:%i'), substr(value,1,4) from sensordata ".
	               " where sensor_id = ".$id." order by utime desc LIMIT ".$limit1.", ".$limit2) as $row) {
  	    $returnstr=$returnstr."<tr><td>$row[0]</td><td>$row[1]</td></tr>";
	}
	$returnstr=$returnstr."</table>";
	return $returnstr;
}

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
if (isset($_GET["page"]))  {
  $page=$_GET["page"]*$num_col;
} else { 
  $page=1; 
}

if ( $sensor > 0 ) { 
		$id=$sensor;
}
	echo "<table class=noborder><tr><td>".one_col($sensorhub_db,$page,$id);
    if ($num_col > 1) {
    	echo "</td><td>".one_col($sensorhub_db,$page+1,$id);
	}
    if ($num_col > 2) {
    	echo "</td><td>".one_col($sensorhub_db,$page+2,$id);
	}
    if ($num_col > 3) {
    	echo "</td><td>".one_col($sensorhub_db,$page+3,$id);
	}
    if ($num_col > 4) {
    	echo "</td><td>".one_col($sensorhub_db,$page+4,$id);
	}
	echo "</td></tr></table>";
?>

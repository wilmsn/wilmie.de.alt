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
function one_col($mypage,$id,$tab) {
	$DB_FILENAME="/var/database/sensorhub.db";
	$db = new SQLite3($DB_FILENAME);
	$limit1=($mypage)*10;
	$limit2=10;
	$returnstr="<table><tr><th>Zeitpunkt</th><th>Wert</th></th></tr>";
		$query_str="select strftime('%d.%m.%Y %H:%M',datetime(utime, 'unixepoch', 'localtime')), substr(value,1,4) from ".$tab."data ".
	               " where ".$tab."_id = ".$id." order by utime desc LIMIT ".$limit1.", ".$limit2;
	$results = $db->query($query_str);
    while ($row = $results->fetchArray() ) {
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
if (isset($_GET["page"]))  {
  $page=$_GET["page"]*$num_col;
} else { 
  $page=1; 
}

if ( $sensor > 0 ) { 
		$tab="sensor";
		$id=$sensor;
		$label="Sensor";
} else { 
		$tab="actor";
		$id=$actor;
		$label="Aktor";
}
	echo "<table class=noborder><tr><td>".one_col($page,$id,$tab);
    if ($num_col > 1) {
    	echo "</td><td>".one_col($page+1,$id,$tab);
	}
    if ($num_col > 2) {
    	echo "</td><td>".one_col($page+2,$id,$tab);
	}
    if ($num_col > 3) {
    	echo "</td><td>".one_col($page+3,$id,$tab);
	}
    if ($num_col > 4) {
    	echo "</td><td>".one_col($page+4,$id,$tab);
	}
	echo "</td></tr></table>";
?>

<?php
require_once("/sd_p2/web/php_inc/sensorhub.inc.php");

if (isset($_GET["osid"])) { $osid=$_GET["osid"]; } else { $osid=999999999; }
if (isset($_GET["sid"])) { $sid=$_GET["sid"]; } else { $sid=999999999; }
if (isset($_GET["sn"])) { $sn=$_GET["sn"]; } else { $sn=" "; }
if (isset($_GET["si"])) { $si=$_GET["si"]; } else { $si=" "; }
if (isset($_GET["nid"])) { $nid=$_GET["nid"]; } else { $nid="00"; }
if (isset($_GET["ch"])) { $ch=$_GET["ch"]; } else { $ch=0; }
$ch=$ch*1;
if (isset($_GET["ty"])) { $ty=$_GET["ty"]; } else { $ty='s'; }

if ( $osid == 0 ) {
	$sql = "insert into sensor (sensor_id, sensor_name, add_info, node_id, channel, type) values(".$sid.",'".$sn."', '".$si."', '".$nid."', ".$ch.", '".$ty."' )";
	$sensorhub_db->query($sql);
	print "Neuen Sensor angelegt: ".$sid;
} else {
	$sql = "update sensor set sensor_name = '".$sn."', add_info = '".$si."', node_id = '".$nid."', channel = ".$ch.", type = '".$ty."' where sensor_id = ".$osid;
        $sensorhub_db->query($sql);
	print "Update erfolgt für SensorID: ".$osid; 
}
?>

<?php
require_once("/sd_p2/web/php_inc/sensorhub.inc.php");

$sensorhub_db->exec("insert into sensordata(sensor_id, utime, value) select sensor_id, utime, value from sensordata_im where (sensor_id,utime) not in (select sensor_id, utime from sensordata)"); 

print "inMemory Tabellen &uuml;bertragen";

?>
<?php
require_once("/sd_p2/web/php_inc/sensorhub.inc.php");

print "<center><table border=1><tr><th>Node_ID</th><th>Channel</th><th>Value</th><th>Startzeitpunkt</th></tr>";

foreach ($sensorhub_db->query("select node_id, channel, value, from_unixtime(utime) from jobbuffer ") as $row) {
	print "<tr><td>&nbsp;".$row[0]."&nbsp;</td><td>&nbsp;".$row[1]."&nbsp;</td><td>&nbsp;".$row[2]."&nbsp;</td><td>&nbsp;".$row[3]."&nbsp;</td></tr>";
}

echo "</tr></table>&nbsp;</center>"; 

?>

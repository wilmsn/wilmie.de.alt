<?php
$DB_FILENAME="/var/database/sensorhub_demo.db";
$db = new SQLite3($DB_FILENAME);
$results_node = $db->query(" select node_id, node_name, add_info from node where node_id in (select node_id from sensor) and node_id <> '00' ".
						   " order by substr(Node_id,length(node_id),1), substr(Node_id,length(node_id)-1,1), ".
						   " substr(Node_id,length(node_id)-2,1) ");
while ($row_node = $results_node->fetchArray() ) {
	print "<ul class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-inset='true' data-role='listview'>".
          "<li class='ui-li-divider ui-bar-inherit ui-first-child' data-role='list-divider' role='heading' ".
		  "style='background: #111111; color: white;'>".$row_node[1]."</li><li>";
	$results_sensor = $db->query("select Channel, Sensor_id, Sensor_name, strftime('%d.%m.%Y %H:%M:%S', utime, 'unixepoch', 'localtime'), Value ".
	                             "from sensor where node_id = '$row_node[0]' order by channel asc ");   
	while ($row_sensor = $results_sensor->fetchArray() ) {
		print "<a id='s".$row_sensor[1]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
		      " href='#' onclick='showsensor(".$row_sensor[1].");' ".
		      " data-rel='popup' style='background: #AAAAAA; color: white;' >".$row_sensor[2]."</a>";
	}	
	$results_actor = $db->query("select Channel, actor_id, actor_name, strftime('%d.%m.%Y %H:%M:%S', utime, 'unixepoch', 'localtime'), Value ".
	                            "from actor where node_id = '$row_node[0]' order by channel asc ");   
	while ($row_actor = $results_actor->fetchArray() ) {
		print "<a id='s".$row_actor[1]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
          	  " href='#' onclick='showactor(".$row_actor[1].");' ".
		      " style='background: #AAAAAA; color: white;' >".$row_actor[2]."</a>";			
	}
    print "<li class='ui-li-divider ui-bar-inherit ui-last-child' data-role='list-divider' role='heading'> </li></ul>";	
}	
?>

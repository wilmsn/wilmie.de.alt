<?php
require_once("/sd_p2/web/php_inc/sensorhubdemo.inc.php");

function node_details($db,$node) {
	print "<div ID=dn".$node." style='background: #AAAAAA; color: black; display: none;'>";
	$mynode='"'.$node.'"';
	foreach ($db->query(" select node_id, node_name, add_info, sleeptime1, sleeptime2, sleeptime3, sleeptime4, radiomode, voltagedivider, battery_id, u_batt  ".
						       " from node where node_id = '".$node."' ") as $row) { 
		print "<center><table>".
			  "<tr><td width=200>Nodename:</td><td width=300><input width=200 height=175 id='in_nn_".$node."' value='".$row[1]."'></td></tr>".
			  "<tr><td width=200>Nodeinfo:</td><td width=300><textarea id='in_ni_".$node."' height=175>".$row[2]."</textarea></td></tr>".
			  "<tr><td width=200>Sleeptime1:</td><td width=300><input width=200 height=175 id='in_st1_".$node."' value='".$row[3]."'></td></tr>".
			  "<tr><td width=200>Sleeptime2:</td><td width=300><input width=200 height=175 id='in_st2_".$node."' value='".$row[4]."'></td></tr>".
			  "<tr><td width=200>Sleeptime3:</td><td width=300><input width=200 height=175 id='in_st3_".$node."' value='".$row[5]."'></td></tr>".
			  "<tr><td width=200>Sleeptime4:</td><td width=300><input width=200 height=175 id='in_st4_".$node."' value='".$row[6]."'></td></tr>".
			  "<tr><td width=200>Radiomode:</td><td width=300><select id='in_rm_".$node."'>";
			if ( $row[7] == 0 ) {
				print "<option value=0 selected>Radio sleeps</option><option value=1>Radio on</option>";
			} else {
				print "<option value=0>Radio sleeps</option><option value=1 selected>Radio on</option>";
			}				  
		print "</select></td></tr>".	  
			  "<tr><td width=200>Voltagedivider:</td><td width=300><input width=200 height=175 id='in_vd_".$node."' value='".$row[8]."'></td></tr>".
			  "<tr><td width=200>Battery:</td><td width=300><select id='in_bid_".$node."'>";
		foreach ($db->query(" select battery_id, battery_sel_txt from battery where battery_id = '".$row[9]."' ") as $bat_row) { 
				print "<option value=".$bat_row[0]." selected>".$bat_row[1]."</option>";
			} 				  
		foreach ($db->query(" select battery_id, battery_sel_txt from battery where battery_id != '".$row[9]."' ") as $bat_row) { 
				print "<option value=".$bat_row[0].">".$bat_row[1]."</option>";
			} 				  
		print "</select></td></tr>";	  
	}
	print "</table><button class='ui-btn' onclick='savenode($mynode)'>Werte speichern</button></center></div>";
}

foreach ($sensorhub_db->query(" select node_id, node_name, add_info from node where node_id <> '00' ".
						   " order by substr(Node_id,length(node_id),1), substr(Node_id,length(node_id)-1,1), ".
						   " substr(Node_id,length(node_id)-2,1) ") as $row_node) { 
	$mynode="'".$row_node[0]."'";					   
	print "<ul class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-inset='true' data-role='listview'>".
          "<li class='ui-li-divider ui-bar-inherit ui-first-child' data-role='list-divider' role='heading' ".
		  "style='background: #111111; color: white;'></li>".
		  "<li><a id='s".$row_node[0]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
	      " href='#' onclick=editnode(".$mynode."); ".
	      " data-rel='popup' style='background: #666666; color: black; ' ><center>".$row_node[1]."(".$row_node[0].")</center></a>";	
	node_details($sensorhub_db,$row_node[0]);
	foreach ($sensorhub_db->query("select Sensor_id, Sensor_name ".
	                              " from sensor where node_id = '$row_node[0]' order by channel asc ") as $row_sensor) {   
		print "<a id='s".$row_sensor[0]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
		      " href='#' onclick='showsensor(".$row_sensor[0].");' ".
		      " data-rel='popup' style='background: #AAAAAA; color: white;' >".$row_sensor[1]."</a>";
	}	
    print "<li class='ui-li-divider ui-bar-inherit ui-last-child' data-role='list-divider' role='heading'> </li></ul>";	
}	
?>

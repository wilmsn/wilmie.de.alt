<?php
require_once("/sd_p2/web/php_inc/sensorhubdemo.inc.php");

function node_details($db,$node) {
	print "<div ID=dn".$node." style='background: #AAAAAA; color: black; display: none;'>";
	foreach ($db->query(" select node_id, node_name, add_info, sleeptime1, sleeptime2, sleeptime3, sleeptime4, radiomode, voltagedivider, battery_id, u_batt  ".
						       " from node where node_id = '".$node."' ") as $row) { 
		print "<center><table border=0>".
			  "<tr><td width=200>Nodename:</td><td width=300><input type='hidden' id='in_nid_".$node."' value='".$node."'><input size=23 id='in_nn_".$node."' value='".$row[1]."'></td></tr>".
			  "<tr><td width=200>Nodeinfo:</td><td width=300><textarea id='in_ni_".$node."' height=175>".$row[2]."</textarea></td></tr>".
			  "<tr><td width=200>Sleeptime1:</td><td width=300><input size=5 id='in_st1_".$node."' value='".$row[3]."'></td></tr>".
			  "<tr><td width=200>Sleeptime2:</td><td width=300><input size=5 id='in_st2_".$node."' value='".$row[4]."'></td></tr>".
			  "<tr><td width=200>Sleeptime3:</td><td width=300><input size=5 id='in_st3_".$node."' value='".$row[5]."'></td></tr>".
			  "<tr><td width=200>Sleeptime4:</td><td width=300><input size=5 id='in_st4_".$node."' value='".$row[6]."'></td></tr>".
			  "<tr><td width=200>Radiomode:</td><td width=300><select id='in_rm_".$node."'>";
			if ( $row[7] == 0 ) {
				print "<option value=0 selected>Radio sleeps</option><option value=1>Radio on</option>";
			} else {
				print "<option value=0>Radio sleeps</option><option value=1 selected>Radio on</option>";
			}				  
		print "</select></td></tr>".	  
			  "<tr><td width=200>Voltagedivider:</td><td width=300><input size=5 id='in_vd_".$node."' value='".$row[8]."'></td></tr>".
			  "<tr><td width=200>Battery:</td><td width=300><select id='in_bid_".$node."'>";
		foreach ($db->query(" select battery_id, battery_sel_txt from battery where battery_id = '".$row[9]."' ") as $bat_row) { 
				print "<option value=".$bat_row[0]." selected>".$bat_row[1]."</option>";
			} 				  
		foreach ($db->query(" select battery_id, battery_sel_txt from battery where battery_id != '".$row[9]."' ") as $bat_row) { 
				print "<option value=".$bat_row[0].">".$bat_row[1]."</option>";
			} 				  
		print "</select></td></tr>";	  
	}
	print "</table><button class='ui-btn' onclick=\"savenode('$node')\">Werte speichern</button></center></div>";
}
#######################
#
# Nodes auflisten
#
#######################
foreach ($sensorhub_db->query(" select node_id, node_name, add_info from node where node_id <> '00' ".
						   " order by substr(Node_id,length(node_id),1), substr(Node_id,length(node_id)-1,1), ".
						   " substr(Node_id,length(node_id)-2,1) ") as $row_node) { 
	$mynode="'".$row_node[0]."'";					   
	print "<ul class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-inset='true' data-role='listview'>".
          "<li class='ui-li-divider ui-bar-inherit ui-first-child' data-role='list-divider' role='heading' ".
		  "style='background: #111111; color: white;'></li>".
		  "<li><a id='n".$row_node[0]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
	      " href='#' onclick=editnode(".$mynode."); ".
	      " data-rel='popup' style='background: #666666; color: black; ' ><center>".$row_node[1]."(".$row_node[0].")</center></a>";	
	node_details($sensorhub_db,$row_node[0]);
	foreach ($sensorhub_db->query("select Sensor_id, Sensor_name ".
	                              " from sensor where node_id = '$row_node[0]' order by channel asc ") as $row_sensor) {   
		print "<a id='ss".$row_sensor[0]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
		      " href='#' onclick='showsensor(".$row_sensor[0].");' ".
		      " data-rel='popup' style='background: #AAAAAA; color: white;' >".$row_sensor[1]."</a>";
	}	  
    print "<li class='ui-li-divider ui-bar-inherit ui-last-child' data-role='list-divider' role='heading'></li></ul>";	
}
#######################
#
# Neuen Node anlegen
#
#######################
print "<ul class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-inset='true' data-role='listview'>".
      "<li class='ui-li-divider ui-bar-inherit ui-first-child' data-role='list-divider' role='heading' ".
      "style='background: #111111; color: white;'></li>".
	  "<li><a id='n0' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
	  " href='#' onclick=editnode(0); ".
	  " data-rel='popup' style='background: #666666; color: black; ' ><center>Neuen Node anlegen</center></a>".
	  "<div ID='dn0' style='background: #AAAAAA; color: black; display: none;'>".
	  "<center><table>".
	  "<tr><td width=200>NodeID:</td><td width=300><input size=6 id='in_nid_0' ></td></tr>".
	  "<tr><td width=200>Nodename:</td><td width=300><input size=23 id='in_nn_0' ></td></tr>".
	  "<tr><td width=200>Nodeinfo:</td><td width=300><textarea id='in_ni_0' height=175></textarea></td></tr>".
	  "<tr><td width=200>Sleeptime1:</td><td width=300><input size=5 id='in_st1_0' ></td></tr>".
	  "<tr><td width=200>Sleeptime2:</td><td width=300><input size=5 id='in_st2_0' ></td></tr>".
	  "<tr><td width=200>Sleeptime3:</td><td width=300><input size=5 id='in_st3_0' ></td></tr>".
	  "<tr><td width=200>Sleeptime4:</td><td width=300><input size=5 id='in_st4_0' ></td></tr>".
	  "<tr><td width=200>Radiomode:</td><td width=300><select id='in_rm_0'>".
	  "<option value=0>Radio sleeps</option><option value=1>Radio on</option>".
	  "</select></td></tr>".	  
	  "<tr><td width=200>Voltagedivider:</td><td width=300><input size=5 id='in_vd_0' ></td></tr>".
	  "<tr><td width=200>Battery:</td><td width=300><select id='in_bid_0'>";
	foreach ($sensorhub_db->query(" select battery_id, battery_sel_txt from battery ") as $bat_row) { 
		print "<option value=".$bat_row[0]." selected>".$bat_row[1]."</option>";
	} 				  
print "</select></td></tr>".	  
	  "</table><button class='ui-btn' onclick=\"savenode('0')\">Werte speichern</button></center></div>".
      "<li class='ui-li-divider ui-bar-inherit ui-last-child' data-role='list-divider' role='heading'></li></ul>";	

#######################
#
# Sensoren editieren
#
#######################
print "<ul class='ui-listview ui-listview-inset ui-corner-all ui-shadow' data-inset='true' data-role='listview'>".
      "<li class='ui-li-divider ui-bar-inherit ui-first-child' data-role='list-divider' role='heading' ".
	  "style='background: #111111; color: white;'></li>".
	  "<li><a id='senshead' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
	  " href='#' onclick=\"enablesensor();\" ".
	  " data-rel='popup' style='background: #666666; color: black; '><center>Sensoren editieren</center></a><div id='sensoren' style='display:none;'>";			  
foreach ($sensorhub_db->query("select Sensor_id, Sensor_name, add_info, node_id, channel from sensor order by sensor_id") as $row_sensor) {   
	print "<a id='sa".$row_sensor[0]."' class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
	      " href='#' onclick=\"editsensor('".$row_sensor[0]."');\" ".
	      " data-rel='popup' style='background: #AAAAAA; color: white;'>".$row_sensor[1]." (".$row_sensor[0].") </a>".
		  "<div id='se".$row_sensor[0]."' style='display:none;'><center><table>".
		  "<tr><td width=200>Sensornummer:</td><td width=300><input type=hidden id='is_sid_".$row_sensor[0]."'>".$row_sensor[0]."</td></tr>".
		  "<tr><td width=200>Sensorname:</td><td width=300><input size=25 id='is_sn_".$row_sensor[0]."' value='".$row_sensor[1]."'></td></tr>".
		  "<tr><td width=200>Sensorinfo:</td><td width=300><textarea id='is_si_".$row_sensor[0]."' height=175>".$row_sensor[2]."</textarea></td></tr>".		  
		  "<tr><td width=200>Node (ID):</td><td width=300><select id='is_nid_".$row_sensor[0]."'>";
	foreach ($sensorhub_db->query("select node_id, node_name from node where node_id = '".$row_sensor[3]."' ") as $rn) {
        print "<option value='".$rn[0]."' selected>".$rn[1]." (".$rn[0].")</option>";
	}		
	foreach ($sensorhub_db->query("select node_id, node_name from node where node_id != '".$row_sensor[3]."' ") as $rn) {
        print "<option value='".$rn[0]."'>".$rn[1]." (".$rn[0].")</option>";
	}		
    print "</select></td></tr>".
	      "<tr><td width=200>Channel:</td><td width=300><input size=6 id='is_ch_".$row_sensor[0]."' value='".$row_sensor[4]."'></td></tr>".
		  "</table><button class='ui-btn' onclick='savesensor(".$row_sensor[0].")'>Werte speichern</button></center></div>";
}	
print "<a class='ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow' data-theme='a' ".
      " href='#' onclick=\"$('#sen').toggle();\" ".
      " data-rel='popup' style='background: #AAAAAA; color: white;'>Neuer Sensor</a>".
	  "<div id='sen' style='display:none;'><center><table>".
	  "<tr><td width=200>Sensornummer:</td><td width=300><input size=6 id='is_sid_0'></td></tr>".
	  "<tr><td width=200>Sensorname:</td><td width=300><input size=25 id='is_sn_0'></td></tr>".
	  "<tr><td width=200>Sensorinfo:</td><td width=300><textarea id='is_si_0'></textarea></td></tr>".
	  "<tr><td width=200>Node_ID:</td><td width=300><select id='is_nid_0'>";
foreach ($sensorhub_db->query("select node_id, node_name from node ") as $rn) {
    print "<option value='".$rn[0]."'>".$rn[1]." (".$rn[0].")</option>";
}		
print "</select></td></tr>".
	  "<tr><td width=200>Channel:</td><td width=300><input size=6 id='is_ch_0'></td></tr>".
	  "</table><button class='ui-btn' onclick='savesensor(0)'>Werte speichern</button></center></div>".
	  "</div><li class='ui-li-divider ui-bar-inherit ui-last-child' data-role='list-divider' role='heading'></li></ul>";	
	
?>

<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
header("Content-type: image/png");
include "/sd_p2/web/var_db_sensorhub_norbert.php";
$data_y1 = array();
$data_x = array();
$db = new mysqli($db_server, $db_user, $db_pass, $db_db);

if (isset($_GET["sensor1"])) {
    $sensor1 = $_GET["sensor1"];
} else {
    $sensor1 = 1;
}
if (isset($_GET["sensor1color"])) {
    $sensor1color = "#".$_GET["sensor1color"];
} else {
    $sensor1color = "#ff0000";
}
if (isset($_GET["sensor1legend"])) {
    $sensor1legend = $_GET["sensor1legend"];
} else {
    $sensor1legend = "unbekannt";
}
switch ($sensor1legend) {
   case "Temperatur":
	$einheit="Grad C ->";
	break;
   case "Luftdruck":
	$einheit="hPa ->";
	break;
   case "Luftfeuchte":
	$einheit="% ->";
	break;
   case "Batterie":
	$einheit="V ->";
	break;
   default:
    $einheit= " ";
}	
	
if (isset($_GET["sizex"])) {
	$sizex = $_GET["sizex"];
} else {
    $sizex=650;
}	
if ($sizex > 1000) { $sizex = 1000; }
if (isset($_GET["sizey"])) {
	$sizey = $_GET["sizey"];
} else {
    $sizey=370;
}	
if (isset($_GET["range"])) {
	$range = $_GET["range"];
	$by_range = True;
	switch ($range) {
		case 365:
			$label_1 = 'der letzten 365 Tage'; 
			$label_2 = ' Kalendermonat ->';
			$utime_back = "3600 * 24 *365";
			$table = " sensordata_d ";
			$date_field = " DATE_FORMAT(from_unixtime(utime),'%m') ";
			$xinterval=60;		 
		break;
		case 30:
			$label_1 = 'der letzten 30 Tage'; 
			$label_2 = ' Kalendertag ->';
			$utime_back = "3600 * 24 *30";
			$table = " sensordata_d ";
			$date_field = " DATE_FORMAT(from_unixtime(utime),'%d') ";
			$xinterval=5;		 
		break;
		default:
			$label_1 = "Verlauf der letzten 24 Stunden"; 
			$label_2 = " Uhrzeit ->"; 
			$utime_back = " 3600 * 24 ";
			$table = " sensordata ";
			$date_field = " DATE_FORMAT(from_unixtime(utime),'%H') ";
			$xinterval=6;		
	}
	$stmt = " select value as val, ".$date_field." as ts, utime ". 
		    " from ".$table.
		    " where sensor_id = ".$sensor1. 
		    " and utime > (select max(utime) from ".$table." ) - ".$utime_back.
		    " order by utime asc";
    $stmt_min =	 "select min(value) as min_val". 
			" from ".$table. 
			" where sensor_id = ".$sensor1. 
			" and utime > (select max(utime) from ".$table." ) - ".$utime_back;	
    $stmt_max =	 " select max(value) as max_val ". 
			" from ".$table. 
			" where sensor_id = ".$sensor1. 
			" and utime > (select max(utime) from ".$table." ) - ".$utime_back;	
} else {
	$by_range = false;
	if ( isset($_GET['datum1'])) {
		$datum1 = $_GET['datum1'];
		$timestamp1 = strtotime($datum1);
	}
	if ( isset($_GET['datum2'])) {
		$datum2 = $_GET['datum2'];
		$timestamp2 = strtotime($datum2)+86400;
	}
}	
$results = $db->query($stmt);
while ($row = $results->fetch_assoc()) {
	$data_y1[]=$row['val'];
	$data_x[]=$row['ts'];
}		
$results = $db->query($stmt_min);
$row = $results->fetch_assoc();
$data_y1_min=$row['min_val'];
$results = $db->query($stmt_max);
$row = $results->fetch_assoc();
$data_y1_max=$row['max_val'];

if ($data_y1_max-$data_y1_min > 2 ) { 
	if ($data_y1_min > 0) {
		$scale_y1_min=floor($data_y1_min/10)*10;
	} else {
		$scale_y1_min=floor($data_y1_min/10)*10;
	}	
	if ($data_y1_max > 0) {
		$scale_y1_max=ceil($data_y1_max/10)*10;
	} else {
		$scale_y1_max=ceil($data_y1_max/10)*10;
	}	
} else {
	if ($data_y1_min > 0) {
		$scale_y1_min=floor($data_y1_min);
	} else {
		$scale_y1_min=floor($data_y1_min)-1;
	}	
	if ($data_y1_max > 0) {
		$scale_y1_max=floor($data_y1_max)+1;
	} else {
		$scale_y1_max=floor($data_y1_max);
	}	
}	

// Create the new graph
$graph = new Graph( $sizex,$sizey );
$graph->SetMargin(70,20,0,0);
$graph->SetScale('textlin', $scale_y1_min, $scale_y1_max);
$graph->SetMarginColor('#dddddd');
$graph->SetFrame(true,'#dddddd', 0);
$graph->title->Set($label_1);
$line = new LinePlot($data_y1);
$graph->Add($line);
if ( abs($scale_y1_max) > 10 or abs($scale_y1_min) > 10 or $scale_y1_min < -9 ) {
	$graph->yaxis->SetLabelFormat('%4.0f');
} else {
	$graph->yaxis->SetLabelFormat('%3.1f');
}	
$line->SetColor($sensor1color); 
$line->SetLegend($sensor1legend);
$graph->yaxis->title->Set($einheit);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->SetTitleMargin(50);
$graph->xaxis->SetTickLabels($data_x);
$graph->xaxis->SetTextLabelInterval($xinterval);
$graph->xaxis->title->Set($label_2); 
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetTitleMargin(10);
$graph->legend->SetAbsPos(10,30,'right','top');
$graph->legend->SetFrameWeight(2);
$graph->legend->SetShadow();
$graph->legend->SetColor('darkgreen');
$graph->legend->SetFillColor('lightyellow');
$graph->xaxis->SetPos('min');
# Achtung: Folgende Zeile verhindert Abstand unter Grafik !!!
$graph->graph_theme=null;
$graph->Stroke();
?> 
 







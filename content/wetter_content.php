<?php
include "/sd_p2/web/php_inc/check_mobile.php";
include "/sd_p2/web/var_db_sensorhub_norbert.php";
$db = new mysqli($db_server, $db_user, $db_pass, $db_db);
$mobile_browser = is_mobile_browser(); 
?>
<html>
  <head>
    <meta charset="utf-8">
    <style>

<?php
if($mobile_browser) { 
  echo "
  #zeit { 
  height: 70px;
  width: 100%;
  font-weight: bold;
  text-align: center;
  border: 1px solid #000; 
  background: #ddd; 
  position: absolute;
  padding: 10px;   
  }
  #wetter1, #wetter2, #wetter3 {
  height: 40px;
  width: 33%;	  
  background: #ddd; 
  position: absolute;
  text-align: center;
  border: 1px solid #000; 
  padding: 10px;   
  }	  
  #wetter1 { 
  left: 0%;
  top: 90px;
  }
  #wetter2 { 
  left: 33%;
  top: 90px;
  }
  #wetter3 { 
  left: 66%;
  top: 90px;
  }
  #wetter4 { 
  border: 1px solid #000; 
  background: #ddd; 
  position: absolute;
  width: 100%;	  
  left: 0px;
  top: 150px;
  }
  #wetter_s1, #wetter_s2, #wetter_s3 {
  height: 50px;
  width: 33%;	  
  background: #dddddd; 
  position: absolute;
  text-align: center;
  border: 1px solid #000; 
  padding: 3px;   
  top: 525px;
  }	  
  #wetter_s1 {
  left: 0%;
  }
  #wetter_s2 {
  left: 33%;
  }
  #wetter_s3 {
  left: 67%;
  }
  
  \n";
} else { 
  echo "
  #zeit { 
  left: 10px;
  top: 30px;
  height: 80px;
  width: 300px;
  font-weight: bold;
  text-align: center;
  border: 1px solid #000; 
  position: absolute;
  padding: 10px;   
  }
  #wetter1, #wetter2, #wetter3 {
  height: 50px;
  width: 130px;	  
  background: #ddd; 
  position: absolute;
  text-align: center;
  border: 1px solid #000; 
  padding: 10px;   
  }	  
  #wetter1 { 
  left: 10px;
  top: 150px;
  }
  #wetter2 { 
  left: 180px;
  top: 150px;
  }
  #wetter3 { 
  left: 10px;
  top: 350px;
  }
  #wetter4 { 
  border: 1px solid #000; 
  background: #ddd; 
  position: absolute;
  left: 350px;
  top: 30px;
  }
  #wetter_s1, #wetter_s2, #wetter_s3 {
  height: 50px;
  width: 100px;	  
  background: #dddddd; 
  position: absolute;
  text-align: center;
  border: 1px solid #000; 
  padding: 3px;   
  top: 430px;
  }	  
  #wetter_s1 {
  left: 350px;
  }
  #wetter_s2 {
  left: 470px;
  }
  #wetter_s3 {
  left: 590px;
  }
  \n";

}

?>
</style>
<script>
  var d = new Date();
  var n = d.getTime();
  var mycolor = '#FF0000';
  var but_color2 = '#DDDDDD';
  var but_color1 = '#AAAAAA';

function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

$(window).resize(function() {
    set_divs();
//	alert('Width: '+screen.width+'\n'+'Height:'+screen.height);
});

function set_divs() {
//    alert($('#wetter_t1').html());
	var d = new Date();
	var n = d.getTime();
	var w = screen.width;
	if ( w > 850 ) { w = 850; } else { if ( w > 500 ) { w = w-50; } }
    switch($('#wetter_t1').html()) {
    case "30":
		$('#wetter_s1').css('backgroundColor', but_color1);
		$('#wetter_s2').css('backgroundColor', but_color2);
		$('#wetter_s3').css('backgroundColor', but_color1);
        break;
    case "365":
		$('#wetter_s1').css('backgroundColor', but_color1);
		$('#wetter_s2').css('backgroundColor', but_color1);
		$('#wetter_s3').css('backgroundColor', but_color2);
        break;
    default:
		$('#wetter_s1').css('backgroundColor', but_color2);
		$('#wetter_s2').css('backgroundColor', but_color1);
		$('#wetter_s3').css('backgroundColor', but_color1);
	} 
    switch($('#wetter_t2').html()) {
    case "2":
		$('#wetter1').css('backgroundColor', but_color1);
		$('#wetter2').css('backgroundColor', but_color2);
		$('#wetter3').css('backgroundColor', but_color1);
		mycolor='0000FF';
		mylegend='Luftdruck';
        break;
    case "3":
		$('#wetter1').css('backgroundColor', but_color1);
		$('#wetter2').css('backgroundColor', but_color1);
		$('#wetter3').css('backgroundColor', but_color2);
		mycolor='00FF00';
		mylegend='Batterie';
        break;
    default:
		$('#wetter1').css('backgroundColor', but_color2);
		$('#wetter2').css('backgroundColor', but_color1);
		$('#wetter3').css('backgroundColor', but_color1);
		mycolor='FF0000';
		mylegend='Temperatur';
	} 
//	alert(mycolor);
	$('#wetter_dia').attr('src', '/content/wetter_diagramm.php?sensor1='+$('#wetter_t2').html()+'&sensor1color='+mycolor+'&sensor1legend='+mylegend+'&sizex='+w+'&sizey=370&range='+$('#wetter_t1').html()+'&t='+n)
} 
$('#zeit').css('backgroundColor', but_color1);
$('#wetter_t1').hide().html('1');  
$('#wetter_t2').hide().html('1');  
set_divs();
$("#wetter_s1").click(function(){
  $('#wetter_t1').html('1')
  set_divs();
});  
$("#wetter_s2").click(function(){
  $('#wetter_t1').html('30')
  set_divs();
});  
$("#wetter_s3").click(function(){
  $('#wetter_t1').html('365')
  set_divs();
});  
$("#wetter1").click(function(){
  $('#wetter_t2').html('1')
  set_divs();
});  
$("#wetter2").click(function(){
  $('#wetter_t2').html('2')
  set_divs();
});  
$("#wetter3").click(function(){
  $('#wetter_t2').html('3')
  set_divs();
});  

</script>	
<meta http-equiv="expires" content="0">
</head>
<div id="seitenbereich">
<div id='zeit'>
Die aktuellen Werte aus Nottuln: <br>
<!--
Kostenlose, frei konfigurierbare Homepage-Uhr von www.schnelle-online.info/Homepage/Tools.html. Ohne Gew�hr, ohne Haftung.
Nutzungbedingung: Dieser Kommentar und der Link unten d�rfen nicht entfernt oder (nofollow) modifiziert werden.
-->
<a style="text-decoration:none;border-style:none;color:black;" target="_blank" href="http://www.schnelle-online.info/Atomuhr-Uhrzeit.html" id="soitime121693632552">Uhrzeit</a><br/>
<a style="text-decoration:none;border-style:none;color:black;" target="_blank" href="http://www.schnelle-online.info/Kalender.html" id="soidate121693632552">Kalender</a>
<script type="text/javascript">
SOI = (typeof(SOI) != 'undefined') ? SOI : {};
(SOI.ac21fs = SOI.ac21fs || []).push(function() {
(new SOI.DateTimeService("121693632552", "DE")).appendTime(" Uhr").setWeekdayMode(1).setMonthMode(1).start();});
(function() {
  if (typeof(SOI.scrAc21) == "undefined") {
    SOI.scrAc21=document.createElement('script');
    SOI.scrAc21.type='text/javascript';
    SOI.scrAc21.async=true;
    SOI.scrAc21.src=((document.location.protocol == 'https:') ? 'https://' : 'http://') + 'homepage-tools.schnelle-online.info/Homepage/atomicclock2_1.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(SOI.scrAc21, s);
  }
})();
</script>
</div>
<div id='wetter1'<center>Temperatur:<br><b>
<?php
  $results = $db->query("SELECT value FROM sensor where sensor_id = 1 LIMIT 1");
  $row = $results->fetch_assoc();
  echo number_format($row['value'],1, ",", ".");
?>
 C</b></center></div>
<div id='wetter2'><center>Luftdruck:<br><b>
<?php
  $results = $db->query("SELECT value FROM sensor where sensor_id = 2 LIMIT 1");
  $row = $results->fetch_assoc();
  echo number_format($row['value'],0, ",", ".");
?>
 hPa</b></center></div>
<div id='wetter3'><center>Batterie:<br><b>
<?php
  $results = $db->query("SELECT value FROM sensor where sensor_id = 3 LIMIT 1");
  $row = $results->fetch_assoc();
  echo number_format($row['value'],2, ",", ".");
?>
 V</b></center></div>
<div id='wetter4'> 
<img id='wetter_dia' />
</div>
<div id='wetter_s1'>Diagramm<br>24 Stunden
</div>
<div id='wetter_s2'>Diagramm<br>30 Tage
</div>
<div id='wetter_s3'>Diagramm<br>365 Tage
</div>
<div id='wetter_t1'>
</div>
<div id='wetter_t2'>
</div>

</center>
</div>
<?php
$db->close(); 
?>


<?php
session_start();
require_once("/sd_p2/web/php_inc/config.inc.php");
require_once("/sd_p2/web/php_inc/functions.inc.php");
?>

<?php if(is_checked_in()): ?>	

<script> var basedir="/admin/"; </script>

<script src="/js/sensorhub.js"></script> 

<script type="text/javascript">

$(document).ready(function(){
  header_init("Haussteuerung");
  $.get(basedir+'getfhem.php',{geraet: "aussentemperatur", eigenschaft: "state" }, function(data) {
	header_addLine(1, "Aussentemperatur", parseInt(data*10)/10 +" &deg;C");
  });
// dev_init(dev#, dev Typ, dev Label, FHEM Wertequelle Objekt; FHEM Wertequelle Reading, FHEM Regler);  
  dev_init(1,"sw", "Steckdose Balkon",  "Balkon_Steckdose",     "state",       "HS_Balkon_Steckdose");
  dev_init(2,"sw", "Steckdose Terasse", "Terasse_Steckdose",    "state",       "HS_Terasse_Steckdose");
  dev_init(3,"sw", "Steckdose Flur", 	"Flur_Steckdose", 	    "state",       "HS_Flur_Steckdose");
  dev_init(4,"sw", "Wlan Steckdose 1", 	"Steckdose1",   		"Relay",       "HS_Steckdose1");
  dev_init(5,"sw", "Wlan Steckdose 2", 	"Steckdose2",   		"Relay",       "HS_Steckdose2");
  dev_init(6,"ht", "Wohnzimmer",        "Wohnzimmer_Temp",       "state", "HT_Wohnzimmer1");
  dev_init(7,"ht", "K&uuml;che",        "Kueche_Temp",          "state",       "HT_Kueche1");
  dev_init(8,"ht", "Bastelzimmer",      "Bastelzimmer_Temp",      "state", "HT_Bastelzimmer");
  dev_init(9,"di","Schlafzimmer",  "Schlafzimmer_Temp", "state","cccc");
});
</script>
 
<link rel="stylesheet" href="/css/sensorhub.css" /> 
   
<div id="haus" class="haus">
</div>  

<?php else: ?>

<h1>Nicht angemeldet!</h1>

<?php endif; ?>		

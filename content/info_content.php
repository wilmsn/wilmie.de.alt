<script>
function sysinfo(){
   alert("HTTP_USER_AGENT:\n<?php echo $_SERVER['HTTP_USER_AGENT']; ?>\n"+
         "SCREEN-WIDTH: "+screen.width+"\n"+
		 "SCREEN-HIGHT: "+screen.height);	
}	
</script>
<?php
include "/sd_p2/web/php_inc/check_mobile.php";
$mobile_browser = is_mobile_browser(); 
if($mobile_browser) { 
  echo "<small><small>";
} else { 
  echo "<div id='info'><img src=/img/kontakt.png></div>\n";
}
?>
<center>
<h1>Willkommen auf der Internetseite von </h1>
<h1>Norbert Wilms.</h1>
<h2>Auf dieser Seite finden Sie nur private Inhalte.</h2>
<h2>F&uuml;r eingebundene Links auf andere Webseiten &uuml;bernehme ich keine Verantwortung.</h2> 
<br>
<br>
<table border=0><tr><td><div id="sysinfo">
<a href='#' onclick='sysinfo();'><img src="/img/info.png" width="40" height="40" alt="Info"></a></div>
</td><td>
Diese Webseite läuft auf einem Raspberry PI<br>
und wurde für den Firefox Browser optimiert.
</td></tr></table>
</center>
<?php
if($mobile_browser) { 
  echo "<br><hr><div><img src=/img/kontakt.png></div>";
  echo "</small></small>";
}
?>



<?php

if (isset($_GET["geraet"])) {  $geraet=$_GET["geraet"]; }
if (isset($_GET["eigenschaft"])) {  $eigenschaft=$_GET["eigenschaft"]; }

	If ( $geraet == "HT_Wohnzimmer1") {
		if ( $eigenschaft =="desiredTemperature") {
			print 21;
		}
		if ( $eigenschaft == "mode") {
			print "auto";
		}
	}
	If ( $geraet == "HT_Schlafzimmer") {
		if ( $eigenschaft =="desiredTemperature") {
			print 14;
		}
		if ( $eigenschaft == "mode") {
			print "auto";
		}
	}
	If (  $geraet == "HT_Kueche") {
		if (  $eigenschaft == "desiredTemperature") {
			print 19;
		}
		if (  $eigenschaft == "mode") {
			print "auto";
		}
	}
	If (  $geraet == "HT_Bastelzimmer") {
		if (  $eigenschaft == "desiredTemperature") {
			print 16;
		}
		if (  $eigenschaft == "mode") {
			print "manual";
		}
	}
	If (  $geraet == "aussentemperatur") {
		if (  $eigenschaft == "state") {
			print -6.7;
		}
	}
	If (  $geraet == "Bastelzimmer_Temp") {
		if (  $eigenschaft == "state") {
			print 14.2;
		}
	}
	If (  $geraet == "Kueche_Temp") {
		if (  $eigenschaft == "state") {
			print 19.8;
		}
	}
	If (  $geraet == "HT_Wohnzimmer1") {
		if (  $eigenschaft == "temperature") {
			print 20.7;
		}
	}
	If (  $geraet == "HT_Schlafzimmer") {
		if (  $eigenschaft == "temperature") {
			print 16.3;
		}
	}
	If (  $geraet == "Balkon_Steckdose") {
		if (  $eigenschaft == "state") {
			print on;
		}
	}
	If (  $geraet == "HS_Balkon_Steckdose") {
		if (  $eigenschaft == "state") {
			print Auto;
		}
	}
	If (  $geraet == "Terasse_Steckdose") {
		if (  $eigenschaft == "state") {
			print off;
		}
	}
	If (  $geraet == "HS_Terasse_Steckdose") {
		if (  $eigenschaft == "state") {
			print Aus;
		}
	}
	If (  $geraet == "Flur_Steckdose") {
		if (  $eigenschaft == "Relay") {
			print off;
		}
	}
	If (  $geraet == "HS_Flur_Steckdose") {
		if (  $eigenschaft == "state") {
			print Auto;
		}
	}
?>

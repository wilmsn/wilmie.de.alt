function header_init(titel) {
// Parameter:
// titel = Die Ueberschrift in der ersten Zeile (zentriert)
  $("#haus").append("<div class='content_header' id='content_header'>");
  $("#content_header").append("<div class='content_header_head' id='content_header_head'>"+titel+"</div>");
}

function header_addLine(line_no, text_l, text_r) {
// Parameter: 
// line_no = Zeilennummer (nur fuer ID verwendet) muss unique sein!
// text_l = linksbuendiger Text
// text_r = rechtsbuendiger Text
  $("#content_header").append("<div class='content_header_line' id='content_header_line"+line_no+"'></div>");
  $("#content_header_line"+line_no).append("<div class='content_header_line_l' id='content_header_line_l"+line_no+"'>"+text_l+"</div>");
  $("#content_header_line"+line_no).append("<div class='content_header_line_r' id='content_header_line_r"+line_no+"'>"+text_r+"</div>");
}

function get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name) {
	$.get(basedir+'getfhem.php',{geraet: dev_fhem_name, eigenschaft: "state" }, function(data) {
		$("#dev"+dev_no+"lr").html("("+data+")  ");
//	alert(dev_fhem_name + ": "+data);
    });
	$.get(basedir+'getfhem.php',{geraet: dev_disp_name, eigenschaft: dev_disp_read }, function(data) {
//	alert(dev_disp_read + ": " + data);
	    switch(data) {
			case "1.000000":
				$("#dev"+dev_no+"lr").append("Ein");
				$("#dev"+dev_no+"b0g").css("background-color", "yellow").css("color","white");
			break;	
			case "0.000000":
				$("#dev"+dev_no+"lr").append("Aus");
				$("#dev"+dev_no+"b0g").css("background-color", "black").css("color","white");
			break;	
			case "on":
				$("#dev"+dev_no+"lr").append("Ein");
				$("#dev"+dev_no+"b0g").css("background-color", "yellow").css("color","black");
			break;	
			case "off":
				$("#dev"+dev_no+"lr").append("Aus");
				$("#dev"+dev_no+"b0g").css("background-color", "black").css("color","white");
			break;	
			default:
				$("#dev"+dev_no+"lr").append("-"+data);					
		}
	});
//	alert("Test");
}

function dev_init(dev_no, dev_typ, dev_label, dev_disp_name, dev_disp_read, dev_fhem_name) {
// Parameter:
// dev_no = Devicenummer (nur fuer die ID verwendet) muss unique sein!
// dev_typ = Devicetyp ("sw" => Schalter; "ht" => Heizkoerperthermostat)
// dev_label = Label fuer dieses Device auf der Webseite
// dev_disp_name = Angezeigter Devicename
// dev_disp_read = Name der Device in FHEM
// dev_fhem_name = Reading der Device in FHEM
    $("#haus").append("<div class='device' id='dev"+dev_no+"'>");
    $("#dev"+dev_no).append("<div class='device_label' id='dev"+dev_no+"l'></div>");
	$("#dev"+dev_no+"l").append("<div class='device_label_l' id='dev"+dev_no+"ll'>"+dev_label+"</div>");
	$("#dev"+dev_no+"l").append("<div class='device_label_r' id='dev"+dev_no+"lr'></div>");
    $("#dev"+dev_no).append("<div class='device_open' id='dev"+dev_no+"p'></div>");
  	$("#dev"+dev_no+"p").append("<img id='dev"+dev_no+"i' src='/img/arrow_down.gif' width='48' height='40' />");
    switch (dev_typ) {
		case "sw":
			get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
			$("#dev"+dev_no).append("<div class='device_sw' id='dev"+dev_no+"d'></div>");
		    $("#dev"+dev_no+"d")
			.append("<div class='device_sw_box0' id='dev"+dev_no+"b0'></div>")
			.append("<div class='device_sw_box1' id='dev"+dev_no+"b1'></div>")
			.append("<div class='device_sw_box2' id='dev"+dev_no+"b2'></div>")
			.append("<div class='device_sw_box3' id='dev"+dev_no+"b3'></div>");
			$("#dev"+dev_no+"b0").append("<button type='button' id='dev"+dev_no+"b0g' class='stateicon'>X</button>");			  
			$("#dev"+dev_no+"b1").append("<button type='button' id='dev"+dev_no+"b1g' class='button_akt'>Aus</button>");			  
			$("#dev"+dev_no+"b2").append("<button type='button' id='dev"+dev_no+"b2g' class='button_akt'>Auto</button>");			  
			$("#dev"+dev_no+"b3").append("<button type='button' id='dev"+dev_no+"b3g' class='button_akt'>Ein</button>");			  
			$.get(basedir+'getfhem.php',{geraet: dev_fhem_name, eigenschaft: "state" }, function(data) {
		//	    alert(data);
			    switch (data) {
					case "aus":
						$("#dev"+dev_no+"b1g").css("background-color", "#a80329");
						$("#dev"+dev_no+"b2g").css("background-color", "grey");
						$("#dev"+dev_no+"b3g").css("background-color", "grey");
					break;
					case "auto":
						$("#dev"+dev_no+"b1g").css("background-color", "grey");
						$("#dev"+dev_no+"b2g").css("background-color", "#a80329");
						$("#dev"+dev_no+"b3g").css("background-color", "grey");
					break;
					case "ein":
						$("#dev"+dev_no+"b1g").css("background-color", "grey");
						$("#dev"+dev_no+"b2g").css("background-color", "grey");
						$("#dev"+dev_no+"b3g").css("background-color", "#a80329");
					break;
				}	
			});			
			$("#dev"+dev_no+"b1g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").css("background-color", "#a80329");
				$("#dev"+dev_no+"b2g").css("background-color", "grey");
				$("#dev"+dev_no+"b3g").css("background-color", "grey");
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "aus" }, function(data) {
					setTimeout(function() {
						//alert(dev_no + " " + dev_disp_name + " " + dev_disp_read + " " + dev_fhem_name);
						get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
					}, 5000);
				    //alert(data);
					//get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
				});
			}); 
			$("#dev"+dev_no+"b2g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").css("background-color", "grey");
				$("#dev"+dev_no+"b2g").css("background-color", "#a80329");
				$("#dev"+dev_no+"b3g").css("background-color", "grey");
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "auto" }, function(data) {
					setTimeout(function() {
						//alert(dev_no + " " + dev_disp_name + " " + dev_disp_read + " " + dev_fhem_name);
						get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
					}, 5000);
//					alert(data);
//					get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
				});
			}); 
			$("#dev"+dev_no+"b3g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").css("background-color", "grey");
				$("#dev"+dev_no+"b2g").css("background-color", "grey");
				$("#dev"+dev_no+"b3g").css("background-color", "#a80329");
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "ein" }, function(data) {
					setTimeout(function() {
						//alert(dev_no + " " + dev_disp_name + " " + dev_disp_read + " " + dev_fhem_name);
						get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
					}, 5000);
//					alert(data);
//					get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
				});
			}); 
                        this['img_up_'+dev_no]='/img/arrow_up.gif';
                        this['img_dn_'+dev_no]='/img/arrow_down.gif';
		break;
		case "ht":
			$.get(basedir+'getfhem.php',{geraet: dev_disp_name, eigenschaft: dev_disp_read }, function(data) {
				$("#dev"+dev_no+"lr").append("Temp: "+parseInt(data*10)/10+" &deg;C");
			});
			$("#dev"+dev_no).append("<div class='device_ht' id='dev"+dev_no+"d'></div>");
			$("#dev"+dev_no+"d").append("<div class='device_ht_temp' id='dev"+dev_no+"d1'></div>");
            $("#dev"+dev_no+"d1").append("<input id='dev"+dev_no+"s1' min='5' max='22' step='0.5' data-highlight='true' data-role='slider' />");   
			$("#dev"+dev_no+"s1").slider();
			$("#dev"+dev_no+"d").append("<div class='device_ht_am' id='dev"+dev_no+"d2'></div>");
			$("#dev"+dev_no+"d2").append("<select name='dev"+dev_no+"s2' id='dev"+dev_no+"s2' data-role='slider'><option value='auto'>Auto</option><option value='manual'>Man.</option></select>");
			$("#dev"+dev_no+"s2").slider();
			$("#dev"+dev_no+"d").append("<div class='device_ht_ok' id='dev"+dev_no+"d3'></div>");
			$("#dev"+dev_no+"d3").append("<input type='button' id='dev"+dev_no+"s3' value='Wert setzen' />");
			$("#dev"+dev_no+"s3").buttonMarkup({ theme: "a" });
			$.get(basedir+'getfhem.php',{geraet: dev_fhem_name, eigenschaft: "desiredTemperature" }, function(data) {
				$("#dev"+dev_no+"s1").val(data).slider("refresh");
			});
			$.get(basedir+'getfhem.php',{geraet: dev_fhem_name, eigenschaft: "mode" }, function(data) {
				$("#dev"+dev_no+"s2").val(data).slider("refresh");	
			});
			$("#dev"+dev_no+"s3").click(function(){
			    mytemp=$("#dev"+dev_no+"s1").val();
				mymode=$("#dev"+dev_no+"s2").val();
				if ( mymode == "auto" ) { 
					$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: "desiredTemperature", wert: mymode, wert1: mytemp }, function(data) {
						alert(data);
					});	
				} else {
					$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: "desiredTemperature", wert: mytemp }, function(data) {
						alert(data);
					});
				}	
			}); 
                        this['img_up_'+dev_no]='/img/arrow_up.gif';
                        this['img_dn_'+dev_no]='/img/arrow_down.gif';
		break;
		case "di":
			$.get(basedir+'getfhem.php',{geraet: dev_disp_name, eigenschaft: dev_disp_read }, function(data) {
				$("#dev"+dev_no+"lr").append("Temp: "+parseInt(data*10)/10+" &deg;C");
			});
                        this['img_up_'+dev_no]='/img/arrow_down_e.gif';
                        this['img_dn_'+dev_no]='/img/arrow_down_e.gif';
 		break;
	} 
//        alert(this['img_dn_'+dev_no]+'  '+this['img_up_'+dev_no]);		
	$("#dev"+dev_no+"p").click(function(){
		if ( $("#dev"+dev_no+"d").is(':hidden') ) {
			$("#dev"+dev_no+"d").show();
			$("#dev"+dev_no+"i").attr('src', eval('img_dn_'+dev_no) );
		} else {	
			$("#dev"+dev_no+"d").hide();
			$("#dev"+dev_no+"i").attr('src', eval('img_up_'+dev_no) );
		} 
	});  
	$("#dev"+dev_no+"d").hide();
	$("#dev"+dev_no+"i").attr('src', eval('img_up_'+dev_no) );
}

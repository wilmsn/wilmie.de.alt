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
//	alert("Neu: "+data);
    });
	$.get(basedir+'getfhem.php',{geraet: dev_disp_name, eigenschaft: dev_disp_read }, function(data) {
	    switch(data) {
			case "1.000000":
				$("#dev"+dev_no+"lr").append("Ein");
			break;	
			case "0.000000":
				$("#dev"+dev_no+"lr").append("Aus");
			break;	
			case "on":
				$("#dev"+dev_no+"lr").append("Ein");
			break;	
			case "off":
				$("#dev"+dev_no+"lr").append("Aus");
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
			$("#dev"+dev_no).append("<div class='device_sw' id='dev"+dev_no+"d'>sw</div>");
		    $("#dev"+dev_no+"d")
			.append("<div class='device_sw_box1' id='dev"+dev_no+"b1'></div>")
			.append("<div class='device_sw_box2' id='dev"+dev_no+"b2'></div>")
			.append("<div class='device_sw_box3' id='dev"+dev_no+"b3'></div>");
			$("#dev"+dev_no+"b1").append("<img id='dev"+dev_no+"b1g' src='/img/but_gr_aus.png' width='100' height='50' />");			  
			$("#dev"+dev_no+"b2").append("<img id='dev"+dev_no+"b2g' src='/img/but_gr_auto.png' width='100' height='50' />");			  
			$("#dev"+dev_no+"b3").append("<img id='dev"+dev_no+"b3g' src='/img/but_gr_ein.png' width='100' height='50' />");	
			$.get(basedir+'getfhem.php',{geraet: dev_fhem_name, eigenschaft: "state" }, function(data) {
		//	    alert(data);
			    switch (data) {
					case "auto":
						$("#dev"+dev_no+"b1g").attr('src', '/img/but_gr_aus.png');
						$("#dev"+dev_no+"b2g").attr('src', '/img/but_rt_auto.png');
						$("#dev"+dev_no+"b3g").attr('src', '/img/but_gr_ein.png');
					break;
					case "aus":
						$("#dev"+dev_no+"b1g").attr('src', '/img/but_rt_aus.png');
						$("#dev"+dev_no+"b2g").attr('src', '/img/but_gr_auto.png');
						$("#dev"+dev_no+"b3g").attr('src', '/img/but_gr_ein.png');
					break;
					case "ein":
						$("#dev"+dev_no+"b1g").attr('src', '/img/but_gr_aus.png');
						$("#dev"+dev_no+"b2g").attr('src', '/img/but_gr_auto.png');
						$("#dev"+dev_no+"b3g").attr('src', '/img/but_rt_ein.png');
					break;
				}	
			});			
			$("#dev"+dev_no+"b1g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").attr('src', '/img/but_rt_aus.png');
				$("#dev"+dev_no+"b2g").attr('src', '/img/but_gr_auto.png');
				$("#dev"+dev_no+"b3g").attr('src', '/img/but_gr_ein.png');				
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "aus" }, function(data) {
					alert(data);
					get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
				});
			}); 
			$("#dev"+dev_no+"b2g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").attr('src', '/img/but_gr_aus.png');
				$("#dev"+dev_no+"b2g").attr('src', '/img/but_rt_auto.png');
				$("#dev"+dev_no+"b3g").attr('src', '/img/but_gr_ein.png');				
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "auto" }, function(data) {
					alert(data);
					get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
				});
			}); 
			$("#dev"+dev_no+"b3g").click(function(){
				//setfhemdata(myroom, mydevice);
				$("#dev"+dev_no+"b1g").attr('src', '/img/but_gr_aus.png');
				$("#dev"+dev_no+"b2g").attr('src', '/img/but_gr_auto.png');
				$("#dev"+dev_no+"b3g").attr('src', '/img/but_rt_ein.png');				
				$.get(basedir+'setfhem.php',{geraet: dev_fhem_name, eigenschaft: " ", wert: "ein" }, function(data) {
					alert(data);
					get_sw_data(dev_no, dev_disp_name, dev_disp_read, dev_fhem_name);
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

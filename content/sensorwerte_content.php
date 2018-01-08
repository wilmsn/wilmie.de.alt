<script>

var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var mydir = '/admin';

function shownodes() {
	$.get(mydir+'/sensoren_list.php', function(data) { 
		$('#liste').hide();
		$('#liste').html(data); 
		$('#liste').show();
	});
}

function showsensor(mysensor) {
    // alert(width);
	if (width < 450) { mynum_col=1; } else { 
		if (width < 650) { mynum_col=2; } else {
			if (width < 900) { mynum_col=3;} else { 
				if (width < 1150) { mynum_col=4;} else { mynum_col=5; }
	}	}   } 
	$.get(mydir+'/sensoren_pages.php',{sensor: mysensor, actor: 0, num_col: mynum_col }, function(data) { 
		$('#mypages').val(data);
		$("#myslider1").attr("max", data).attr("min", 0).val(0).slider('refresh');
	});
    $('#mysensor').val(mysensor);
	$('#myactor').val(0);
	$('#mynum_col').val(mynum_col);
	showresult(mysensor,0,0);
	$('#liste').hide();	
    $('#details_ctl').show();
}

function showresult(mysensor, myactor, mypage) {
	$("#myslider1").val(mypage).slider();
	mynum_col=$('#mynum_col').val();
	htmllinks1="<table class=noborder><tr><td class=noborder>";
	if (mypage == 0) { 
		htmllinks2="<img src='/img/arrow_left_e.gif'  height='100' width='40'>";
    } else {
	    prevpage = (mypage*1)-1;
		htmllinks2="<a href='#' onclick='showresult("+mysensor+","+myactor+","+prevpage+");'><img src='/img/arrow_left.gif' height='100' width='40'></a>";
	}	
	htmllinks3="</td><td>";
	htmlrechts1="</td><td class=noborder>";
    if (mypage >= $('#mypages').val() ) {
		htmlrechts2="<img src='/img/arrow_right_e.gif' height='100' width='40'>";
	} else {
		nextpage = (mypage*1)+1;
		htmlrechts2="<a href='#' onclick='showresult("+mysensor+","+myactor+","+nextpage+");'><img src='/img/arrow_right.gif' height='100' width='40'></a>";
	}	
	htmlrechts3="</td></tr></table>";
	$.get(mydir+'/sensoren_detail.php',{sensor: mysensor, actor: myactor, page: mypage, num_col: mynum_col }, function(data) { 
		$('#details').hide();
		$('#details').html(htmllinks1+htmllinks2+htmllinks3+data+htmlrechts1+htmlrechts2+htmlrechts3); 
		$('#details').show();
	});
}

$(document).ready(function(){
    $('#hideme').hide();
    $('#details_ctl').hide();
	shownodes();
	$('#zeigliste').click(function(){
		$('#liste').show();
		$('#details').hide();
		$('#details_ctl').hide();
	});
	$('#myslider1').on('slidestop',function(){
		showresult($('#mysensor').val(),$('#myactor').val(),$("#myslider1").val());
	});	
	if (width < 400) {
		$('#details').css('width', '290');
	} else {
		if (width < 650) {
			$('#details').css('width', '480');
		} else {
			if (width < 900) {
				$('#details').css('width', '670');
			} else {
				if (width < 1150) {
					$('#details').css('width', '880');
				} else {	
					$('#details').css('width', '1100');
				}
			}
		}
	}
//alert(width);
  $('#myslider1').slider();
});

</script>
<style type=text/css>
    div.ui-slider{
		width:85%;
		left: -30px;
	}
    input.ui-slider-input {
		width: 0;
		display: none;
    }
</style>

	<div data-role="main" class="ui-content">
		<p id="erg"></p>
		<div id="liste">
		</div>
        <div id="details" style="margin : 0 auto;">
		</div>
        <div id="details_ctl">
			<input type='range' id='myslider1' data-popup-enabled='true' value=0 min=0 max=10 step=1/>
			<button id="zeigliste" class="ui-btn">Sensorliste zeigen</button>
		</div>
		<div id="hideme">	
			<input id='mysensor'/>
			<input id='myactor'/>
			<input id='mynum_col'/>
			<input id='mypages' value='9'/>
		</div>	
	</div>


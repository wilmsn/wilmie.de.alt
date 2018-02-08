<script>

var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
var mydir = '/demo';

function shownodes() {
	$.get(mydir+'/sensoren_list.php', function(data) { 
		$('#liste').hide();
		$('#liste').html(data); 
		$('#liste').show();
	});
}

function editnode(mynode){
	$('#dn'+mynode).toggle();
	if ($('#dn'+mynode).is(":visible")) {
		$('#s'+mynode).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-d ui-shadow');
	} else {
		$('#s'+mynode).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow');
	}
}

function savenode(mynodeid){
	mynn=$('#in_nn_'+mynodeid).val();
	myni=$('#in_ni_'+mynodeid).val();
	myst1=$('#in_st1_'+mynodeid).val();
	myst2=$('#in_st2_'+mynodeid).val();
	myst3=$('#in_st3_'+mynodeid).val();
	myst4=$('#in_st4_'+mynodeid).val();
	myrm=$('#in_rm_'+mynodeid).val();
	mybid=$('#in_bid_'+mynodeid).val();
	myvd=$('#in_vd_'+mynodeid).val();
	$.get(mydir+'/savenode.php',{nodeid: mynodeid, nodename: mynn, ni: myni, st1: myst1, st2: myst2, st3: myst3, st4: myst4, vd: myvd, rm: myrm, bid: mybid }, function(data) { 
		alert(data);
	});
}

function showsensor(mysensor) {
    // alert(width);
	if (width < 450) { mynum_col=1; } else { 
		if (width < 650) { mynum_col=2; } else {
			if (width < 900) { mynum_col=3;} else { 
				if (width < 1150) { mynum_col=4;} else { mynum_col=5; }
	}	}   } 
	$.get(mydir+'/sensoren_pages.php',{sensor: mysensor, num_col: mynum_col }, function(data) { 
		$('#mypages').val(data);
		$("#myslider1").attr("max", data).attr("min", 0).val(0).slider('refresh');
	});
    $('#mysensor').val(mysensor);
	$('#mynum_col').val(mynum_col);
	showresult(mysensor, 0);
	$('#liste').hide();	
    $('#details_ctl').show();
}

function showresult(mysensor, mypage) {
	$("#myslider1").val(mypage).slider();
	mynum_col=$('#mynum_col').val();
	htmllinks1="<table class=noborder><tr><td class=noborder>";
	if (mypage == 0) { 
		htmllinks2="<img src='/img/arrow_left_e.gif'  height='100' width='40'>";
    } else {
	    prevpage = (mypage*1)-1;
		htmllinks2="<a href='#' onclick='showresult("+mysensor+","+prevpage+");'><img src='/img/arrow_left.gif' height='100' width='40'></a>";
	}	
	htmllinks3="</td><td>";
	htmlrechts1="</td><td class=noborder>";
    if (mypage >= $('#mypages').val() ) {
		htmlrechts2="<img src='/img/arrow_right_e.gif' height='100' width='40'>";
	} else {
		nextpage = (mypage*1)+1;
		htmlrechts2="<a href='#' onclick='showresult("+mysensor+","+nextpage+");'><img src='/img/arrow_right.gif' height='100' width='40'></a>";
	}	
	htmlrechts3="</td></tr></table>";
	$.get(mydir+'/sensoren_detail.php',{sensor: mysensor, page: mypage, num_col: mynum_col }, function(data) { 
		$('#details').hide();
		$('#details').html(htmllinks1+htmllinks2+htmllinks3+data+htmlrechts1+htmlrechts2+htmlrechts3); 
		$('#details').show();
	});
}


$(document).ready(function(){
    $('#hideme').hide();
	$('#node').hide();
    $('#details_ctl').hide();
	shownodes();
	$('#save_02').click(function(){
		$('#save_02').hide();
		alert('cc');
	});
	
	$('#zeigliste').click(function(){
		$('#liste').show();
		$('#node').hide();
		$('#details').hide();
		$('#details_ctl').hide();
	});
	$('#zeigliste1').click(function(){
		$('#liste').show();
		$('#node').hide();
		$('#details').hide();
		$('#details_ctl').hide();
	});
	$('#myslider1').on('slidestop',function(){
		showresult($('#mysensor').val(),$("#myslider1").val());
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


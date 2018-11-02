<script>

var mydir = '/admin';
var screenWidthOld = 0;

$(window).resize(function() {
	if (screen.width != screenWidthOld ) {
		screenWidthOld = screen.width;
	    //alert(screen.width);
	    init_window();
	    $('#details').hide();
	    shownodes();
	}
});

function listjobs(){
	if ($('#jobs').is(":visible")) {
		$('#jobshead').attr('class','ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow');
		$('#jobs').hide();
	} else {
		$('#jobshead').attr('class','ui-btn ui-btn-icon-right ui-icon-carat-d ui-shadow');
		$.get(mydir+'/rf24hubadm_jobs.php', function(data) { 
			$('#jobs').html(data); 
			$('#jobs').show();
		});
	}
}

function shownodes() {
	$.get(mydir+'/rf24hubadm_list.php', function(data) { 
		$('#liste').hide();
		$('#liste').html(data); 
		$('#liste').show();
	});
}

function editnode(mynode){
	$('#dn'+mynode).toggle();
	if ($('#dn'+mynode).is(":visible")) {
		$('#n'+mynode).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-d ui-shadow');
	} else {
		$('#n'+mynode).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow');
	}
}

function savenode(mynodeid){
	mynid=$('#in_nid_'+mynodeid).val();
	mynn=$('#in_nn_'+mynodeid).val();
	myni=$('#in_ni_'+mynodeid).val();
	myst1=$('#in_st1_'+mynodeid).val();
	myst2=$('#in_st2_'+mynodeid).val();
	myst3=$('#in_st3_'+mynodeid).val();
	myst4=$('#in_st4_'+mynodeid).val();
	myrm=$('#in_rm_'+mynodeid).val();
	mybid=$('#in_bid_'+mynodeid).val();
	myvd=$('#in_vd_'+mynodeid).val();
	$.get(mydir+'/savenode.php',{nid: mynid, onid: mynodeid, nn: mynn, ni: myni, st1: myst1, st2: myst2, st3: myst3, st4: myst4, vd: myvd, rm: myrm, bid: mybid }, function(data) { 
		alert(data);
	});
}

function enablesensor(){
	$('#sensoren').toggle();
	if ($('#sensoren').is(":visible")) {
		$('#senshead').attr('class','ui-btn ui-btn-icon-right ui-icon-carat-d ui-shadow');
	} else {
		$('#senshead').attr('class','ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow');
	}
}

function editsensor(sensor){
	$('#se'+sensor).toggle();
	if ($('#se'+sensor).is(":visible")) {
		$('#sa'+sensor).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-d ui-shadow');
	} else {
		$('#sa'+sensor).attr('class','ui-btn ui-btn-icon-right ui-icon-carat-r ui-shadow');
	}
}

function savesensor(mysensorid){
	mysid=$('#is_sid_'+mysensorid).val();
	mysn=$('#is_sn_'+mysensorid).val();
	mysi=$('#is_si_'+mysensorid).val();
	mynid=$('#is_nid_'+mysensorid).val();
	mych=$('#is_ch_'+mysensorid).val();
	myty=$('#is_ty_'+mysensorid).val();
	myfh=$('#is_fh_'+mysensorid).val();
	mysd=$('#is_sd_'+mysensorid).val();
	$.get(mydir+'/savesensor.php',{osid: mysensorid, sid: mysid, sn: mysn, si: mysi, nid: mynid, ch: mych, ty: myty, sd: mysd, fh: myfh }, function(data) { 
		alert(data);
	});
}

function showsensor(mysensor) {
	$.get(mydir+'/rf24hubadm_pages.php',{sensor: mysensor, num_col: mynum_col }, function(data) { 
		$('#mypages').val(data);
		$("#myslider1").attr("max", data).attr("min", 0).val(0).slider('refresh');
	});
    $('#mysensor').val(mysensor);
	showresult(mysensor, 0);
	$('#liste').hide();	
    $('#details_ctl').show();
}

function showresult(mysensor, mypage) {
	$("#myslider1").val(mypage);
	$("#myslider1").slider('refresh');
	mynum_col=$('#mynum_col').val();
	htmllinks1="<center><table class=noborder><tr><td class=noborder>";
	if (mypage == 0) { 
		htmllinks2="<img src='/img/arrow_left_e.gif'  height='100' width='40'>";
    } else {
	    prevpage = (mypage*1)-1;
		htmllinks2="<a href='#' onclick='showresult("+mysensor+","+prevpage+");'><img src='/img/arrow_left.gif' height='100' width='40'></a>";
	}	
	htmllinks3="</td><td class=noborder>";
	htmlrechts1="</td><td class=noborder>";
    if ((mypage*1) >= ($('#mypages').val()*1) ) {
		htmlrechts2="<img src='/img/arrow_right_e.gif' height='100' width='40'>";
	} else {
		nextpage = (mypage*1)+1;
		htmlrechts2="<a href='#' onclick='showresult("+mysensor+","+nextpage+");'><img src='/img/arrow_right.gif' height='100' width='40'></a>";
	}	
	htmlrechts3="</td></tr></table></center>";
	$.get(mydir+'/rf24hubadm_detail.php',{sensor: mysensor, page: mypage, num_col: mynum_col }, function(data) { 
		$('#details').hide();
		$('#details').html(htmllinks1+htmllinks2+htmllinks3+data+htmlrechts1+htmlrechts2+htmlrechts3); 
		$('#details').show();
	});
}

function init_window() {
	var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    $('#hideme').hide();
	$('#node').hide();
    $('#details_ctl').hide();
	shownodes();
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
	if (width < 450) {
		$('#details').css('width', '90%');
		mynum_col=1;
	} else {
		if (width < 650) {
			$('#details').css('width', '90%');
			mynum_col=2;
		} else {
			if (width < 900) {
				$('#details').css('width', '90%');
				mynum_col=3;
			} else {
				if (width < 1100) {
					$('#details').css('width', '90%');
					mynum_col=4;
				} else {	
					if (width < 1200) {
						$('#details').css('width', '90%');
						mynum_col=5;
					} else {	
						$('#details').css('width', '1200');
						mynum_col=6;
					}
				}
			}
		}
	}
	$('#mynum_col').val(mynum_col);	
    $('#myslider1').slider();
}

$(document).ready(function(){
	init_window();
});

</script>
<style type=text/css>
    div.ui-slider{
		width:97%;
		left: -55px;
	}
    input.ui-slider-input {
		width: 0;
		display: none;
    }
	table td{
		border:1px solid black; 
		vertical-align:center;
		overflow:hidden; 
	}
	table th{
		border:1px solid black; 
		vertical-align:center;
		overflow:hidden; 
	}
	table.noborder td.noborder {
		border:0px solid black; 
	}
	noborder {
		border:0px solid black; 
	}
</style>

	<div data-role="main" class="ui-content">
		<div id="liste">
		</div>
        <div id="details" style="margin : 0 auto;">
		</div>
        <div id="details_ctl">
			<input type='range' id='myslider1' data-popup-enabled='true' value=0 min=0 max=10 step=1/>
			<button id="zeigliste" class="ui-btn">Zurück zur Übersicht</button>
		</div>
		<div id="hideme">	
			<input id='mysensor'/>
			<input id='myactor'/>
			<input id='mynum_col'/>
			<input id='mypages' value='9'/>
		</div>	
	</div>


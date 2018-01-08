<?php
###################################################################################
#
# Change this part to your individual configuration
#
# this is the document root of your webserver
$basedir="/sd_p2/web/www";   # No slash "/" at the back !!!!!
# the dir of the galleries as seen from the werbserver
$htmlprefix="/bilder";                    # No slash "/" at the back !!!!!
# $mytext contains the headline from the file "text.txt"
$textfile="text.txt";
#
# Config labels here
$label_help_box="Hilfe zum Fotoalbum";
#
# Config icons here
#
$icon_menu="/img/menu.png";
$icon_next_picture="/img/next.png";
$icon_prev_picture="/img/prev.png";
$icon_first_picture="/img/first.png";
$icon_last_picture="/img/last.png";
$icon_fullscreen="/img/fullscreen.png";
$icon_normalscreen="/img/normalscreen.png";
$height_offset_mobile=80;
$height_offset_desktop=250;
# 
# exclude all the files that are no pictures !!!!!
$exclude_list = array(".", "..", "text.txt");
# parameter "dir" will contain the gallery
$mygallery=$_GET["dir"];
#
# No configuration below
#
###################################################################################
include "/sd_p2/web/php_inc/check_mobile.php";
$mobile_browser=is_mobile_browser();
$mytext = file_get_contents($basedir.$htmlprefix."/".$mygallery."/".$textfile);

echo "<script type=\"text/javascript\">\n",
         "bilder = new Array(\n";

$myfiles = array_diff(scandir($basedir.$htmlprefix."/".$mygallery), $exclude_list);
$i=0;
foreach($myfiles as $thisfile) {
   if ( $i > 0) { echo ","; }
   echo "'".$htmlprefix."/".$mygallery."/".$thisfile."' \n";
   $i++;
}
echo ");\n",
     "var headline='<center>".$mytext."</center>'; \n",
     "var icon_menu='".$icon_menu."'; \n",
     "var icon_next_picture='".$icon_next_picture."'; \n",
     "var icon_prev_picture='".$icon_prev_picture."'; \n",
     "var icon_first_picture='".$icon_first_picture."'; \n",
     "var icon_last_picture='".$icon_last_picture."'; \n",
     "var icon_fullscreen='".$icon_fullscreen."'; \n",
     "var icon_normalscreen='".$icon_normalscreen."'; \n";
?>
var pic_no_act = 0;
var img_params=" no-repeat center ";
var pic_height;
var pic_width;
var ph_width;
var bg_size;
var navi_l_left;
var navi_top;
var navi_r_left;
var navi_radius;
var preview_top;
var preview_left;
var preview_height;
var preview_width;
var bs_pic_width;
var bs_pic_height;
var bs_bg_size;

function do_init() { 

<?php
if($mobile_browser) { 
	echo "
    pic_height = screen.width/3*2;
    pic_width = screen.width;
	bg_size = 'auto '+pic_height+'px';
	navi_l_left = 0;
	navi_top = pic_height / 2 - 25;
	navi_r_left = 10;
	navi_radius = 20;
	preview_top = navi_top + 250;
	preview_left = 5;
	if ( screen.width > screen.height/3*4 ) {
      bs_pic_height = screen.height;
      bs_pic_width = bs_pic_height/3*4;
	} else {
      bs_pic_width = screen.width;
      bs_pic_height = bs_pic_width/4*3;
    }	
	ph_l_width = (screen.width - bs_pic_width)/2;
	ph_r_width = screen.width - bs_pic_width - ph_l_width;
	preview_width = ph_l_width - 12; 
	preview_height = preview_width / 4 * 3;
	bs_bg_size = 'auto '+bs_pic_height+'px';
    $('#gallery_placeholder_l').hide();
    $('#gallery_placeholder_r').hide();
    $('#gallery_bs_preview_l').hide();
    $('#gallery_bs_dir_l').hide();
    $('#gallery_bs_preview_r').hide();
    $('#gallery_bs_dir_r').hide();
//    $('#gallery_bs_placeholder_r').hide();
    $('#gallery_bs_placeholder_l').css({'background-color': 'black','position': 'relative', 'float': 'left', 'width': ph_l_width, 'height': bs_pic_height});
    $('#gallery_bs_placeholder_r').css({'background-color': 'black','position': 'relative', 'float': 'left', 'width': ph_r_width, 'height': bs_pic_height});
	";
} else {
	echo "
    pic_height = 600;
    pic_width = 800;
	ph_l_width = 112;
	ph_r_width = 112;
	bg_size = 'auto '+pic_height+'px';
	navi_l_left = 0;
	navi_top = pic_height / 2 - 25;
	navi_r_left = 10;
	navi_radius = 50;
	preview_top = navi_top + 250;
	preview_left = 5;
	preview_width = ph_l_width - 12; 
	preview_height = preview_width / 4 * 3;
    bs_pic_width = screen.width - 224;
    bs_pic_height = bs_pic_width /4*3;
	bs_bg_size = 'auto '+bs_pic_height+'px';
    $('#gallery_bs_placeholder_l').css({'cursor': 'pointer', 'background-color': 'grey','position': 'relative', 'float': 'left', 'width': ph_l_width, 'height': bs_pic_height});
    $('#gallery_bs_placeholder_r').css({'cursor': 'pointer', 'background-color': 'grey','position': 'relative', 'float': 'left', 'width': ph_r_width, 'height': bs_pic_height});
	";
}	
?>
  $('#gallery_menu_icon').html('<img src=' + icon_menu + '>');
  $('#gallery_menu_menu').html('<img src=' + icon_menu + '>');
  $('#gallery_menu_nextpic').html('<img src=' + icon_next_picture + '>');
  $('#gallery_menu_prevpic').html('<img src=' + icon_prev_picture + '>');
  $('#gallery_menu_lastpic').html('<img src=' + icon_last_picture + '>');
  $('#gallery_menu_firstpic').html('<img src=' + icon_first_picture + '>');
  $('#gallery_menu_fullscreen').html('<img src=' + icon_fullscreen + '>');
  $('#gallery_menu_toolbar').hide();	
  $('#gallery_placeholder_l').css({'position': 'relative', 'float': 'left', 'width': ph_l_width, 'height': pic_height});
  $('#gallery_placeholder_r').css({'position': 'relative', 'float': 'left', 'width': ph_r_width, 'height': pic_height});
  $('#gallery_pic_wrapper').css({'position': 'relative', 'float': 'left', 'width': pic_width, 'height': pic_height});
  $('#gallery_dir_l').css({'background-color': '#bbb', 'position': 'absolute', 'width': 2*navi_radius , 'height': 2*navi_radius, 'top': navi_top, 
       'left': navi_l_left, 'border': '1px solid black', 'text-align': 'center', 'border-radius': navi_radius,
       'background': "url('"+icon_prev_picture+"') "+img_params	   });
  $('#gallery_dir_r').css({'background-color': '#bbb', 'position': 'absolute', 'width': 2*navi_radius, 'height': 2*navi_radius, 'top': navi_top, 
       'left': navi_r_left, 'border': '1px solid black', 'text-align': 'center', 'border-radius': navi_radius,
       'background': "url('"+icon_next_picture+"') "+img_params	   });
  $('#gallery_preview_l').css({'position': 'absolute', 'width': preview_width, 'height': preview_height,
       'top': preview_top, 'left': preview_left, 'border': '1px solid black' });
  $('#gallery_preview_r').css({'position': 'absolute', 'width': preview_width, 'height': preview_height,
       'top': preview_top, 'left': preview_left, 'border': '1px solid black' });
  $('#gallery_pic0').css({'width': 0, 'height': pic_height, 'position': 'relative', 'float': 'left' });
  $('#gallery_pic1').css({'width': pic_width, 'height': pic_height, 'position': 'relative', 'float': 'left' });
  $('#gallery_pic2').css({'width': 0, 'height': pic_height, 'position': 'relative', 'float': 'left'  });
  $('#gallery_bs_menu_icon').html('<img src=' + icon_menu + '>');
  $('#gallery_bs_menu_menu').html('<img src=' + icon_menu + '>');
  $('#gallery_bs_menu_nextpic').html('<img src=' + icon_next_picture + '>');
  $('#gallery_bs_menu_prevpic').html('<img src=' + icon_prev_picture + '>');
  $('#gallery_bs_menu_lastpic').html('<img src=' + icon_last_picture + '>');
  $('#gallery_bs_menu_firstpic').html('<img src=' + icon_first_picture + '>');
  $('#gallery_bs_menu_fullscreen').html('<img src=' + icon_normalscreen + '>');
  $('#gallery_bs_menu_toolbar').hide();	
  $('#gallery_bs_pic_wrapper').css({'position': 'relative', 'float': 'left', 'width': bs_pic_width, 'height': bs_pic_height});
  $('#gallery_bs_dir_l').css({'position': 'absolute', 'width': 2*navi_radius , 'height': 2*navi_radius, 'top': navi_top, 
       'left': navi_l_left, 'border': '1px solid black', 'text-align': 'center', 'border-radius': navi_radius,
       'background': "url('"+icon_prev_picture+"') "+img_params	   });
  $('#gallery_bs_dir_r').css({'position': 'absolute', 'width': 2*navi_radius, 'height': 2*navi_radius, 'top': navi_top, 
       'left': navi_r_left, 'border': '1px solid black', 'text-align': 'center', 'border-radius': navi_radius,
       'background': "url('"+icon_next_picture+"') "+img_params	   });
  $('#gallery_bs_preview_l').css({'position': 'absolute', 'width': preview_width, 'height': preview_height,
       'top': preview_top, 'left': preview_left, 'border': '1px solid black' });
  $('#gallery_bs_preview_r').css({'position': 'absolute', 'width': preview_width, 'height': preview_height,
       'top': preview_top, 'left': preview_left, 'border': '1px solid black' });
  $('#gallery_bs_pic0').css({'width': 0, 'height': bs_pic_height, 'position': 'relative', 'float': 'left' });
  $('#gallery_bs_pic1').css({'width': bs_pic_width, 'height': bs_pic_height, 'position': 'relative', 'float': 'left' });
  $('#gallery_bs_pic2').css({'width': 0, 'height': bs_pic_height, 'position': 'relative', 'float': 'left'  });
}

function show_pic(pic_no, pic_dir) {
   var prev_pic = pic_no -1;
  $('#gallery_pic0').css({'width': 0});
  $('#gallery_pic1').css({'width': pic_width});
  $('#gallery_pic2').css({'width': 0});
  $('#gallery_bs_pic0').css({'width': 0});
  $('#gallery_bs_pic1').css({'width': bs_pic_width});
  $('#gallery_bs_pic2').css({'width': 0});
  if ( prev_pic < 0 ) { prev_pic = bilder.length -1; }
  var next_pic = pic_no +1;
  if ( next_pic > bilder.length -1) { next_pic = 0; }
  $('#gallery_pic1').css({'background': "url('"+bilder[pic_no]+"') "+img_params, 'background-size': bg_size });
  $('#gallery_bs_pic1').css({'background': "url('"+bilder[pic_no]+"') "+img_params, 'background-size': bs_bg_size });
  if (pic_dir == -1 ) {
    $('#gallery_pic0').css({'background': "url('"+bilder[prev_pic]+"') "+img_params, 'background-size': bg_size });
    $('#gallery_pic1').animate({'width': 0});
    $('#gallery_pic0').animate({'width': pic_width});
    $('#gallery_bs_pic0').css({'background': "url('"+bilder[prev_pic]+"') "+img_params, 'background-size': bs_bg_size });
    $('#gallery_bs_pic1').animate({'width': 0});
    $('#gallery_bs_pic0').animate({'width': bs_pic_width});
    pic_no_act = prev_pic;
  }  
  if (pic_dir == 1 ) {
    $('#gallery_pic2').css({'background': "url('"+bilder[next_pic]+"') "+img_params, 'background-size': bg_size });
    $('#gallery_pic1').animate({'width': 0});
    $('#gallery_pic2').animate({'width': pic_width});
    $('#gallery_bs_pic2').css({'background': "url('"+bilder[next_pic]+"') "+img_params, 'background-size': bs_bg_size });
    $('#gallery_bs_pic1').animate({'width': 0});
    $('#gallery_bs_pic2').animate({'width': bs_pic_width});
    pic_no_act = next_pic;
  }
  next_pic = pic_no_act+1;
  if ( next_pic > bilder.length -1) { next_pic = 0; }
  prev_pic = pic_no_act-1;
  if ( prev_pic < 0) { prev_pic = bilder.length -1; }
  $('#gallery_preview_l').html("<img src='"+bilder[prev_pic]+"' width='100%' height='100%'>");
  $('#gallery_preview_r').html("<img src='"+bilder[next_pic]+"' width='100%' height='100%'>");
  $('#gallery_bs_preview_l').html("<img src='"+bilder[prev_pic]+"' width='100%' height='100%'>");
  $('#gallery_bs_preview_r').html("<img src='"+bilder[next_pic]+"' width='100%' height='100%'>");
}

function swipeleftHandler( event ) {
    show_pic(pic_no_act,1);
}
function swiperightHandler( event ) {
    show_pic(pic_no_act,-1);
}

$(document).ready(function() {
  do_init();
  show_pic(pic_no_act, 0);
  $('#gallery_bs_wrapper').hide();
  $('#gallery_menu_toolbar').hide();	
  $('#gallery_menu_icon').click(function(){
     $("#gallery_menu_icon").hide();
     $("#gallery_menu_toolbar").show();
  }); 
  $('#gallery_menu_menu').click(function(){
     $("#gallery_menu_toolbar").hide();
     $("#gallery_menu_icon").show();
  }); 
  $('#gallery_menu_firstpic').click(function(){
	pic_no_act = 0;
    show_pic(pic_no_act, 0);
  });
  $('#gallery_menu_nextpic').click(function(){
    show_pic(pic_no_act, 1);
  });
  $('#gallery_menu_prevpic').click(function(){
    show_pic(pic_no_act, -1);
  });
  $('#gallery_menu_lastpic').click(function(){
	pic_no_act = bilder.length -1;
    show_pic(pic_no_act, 0);
  });
  $('#gallery_menu_fullscreen').click(function () {
     $("#gallery_menu_toolbar").hide();
     $("#gallery_menu_icon").show();
     $('#gallery_bs_wrapper').show();
     screenfull.request($('#gallery_bs_wrapper')[0]);
  });
  $(window).resize(function() {
    do_init();
    show_pic(pic_no_act, 0);
  });
  $('#gallery_placeholder_l').click(function(){
    show_pic(pic_no_act,-1);
  });
  $('#gallery_placeholder_r').click(function(){
    show_pic(pic_no_act,1);
  });
  $( "#gallery_pic_wrapper" ).on( "swipeleft", swipeleftHandler );
  $( "#gallery_pic_wrapper" ).on( "swiperight", swiperightHandler );

  $('#gallery_bs_menu_icon').click(function(){
     $("#gallery_bs_menu_icon").hide();
     $("#gallery_bs_menu_toolbar").show();
  }); 
  $('#gallery_bs_menu_menu').click(function(){
     $("#gallery_bs_menu_toolbar").hide();
     $("#gallery_bs_menu_icon").show();
  }); 
  $('#gallery_bs_menu_firstpic').click(function(){
	pic_no_act = 0;
    show_pic(pic_no_act, 0);
  });
  $('#gallery_bs_menu_nextpic').click(function(){
    show_pic(pic_no_act, 1);
  });
  $('#gallery_bs_menu_prevpic').click(function(){
    show_pic(pic_no_act, -1);
  });
  $('#gallery_bs_menu_lastpic').click(function(){
	pic_no_act = bilder.length -1;
    show_pic(pic_no_act, 0);
  });
  $('#gallery_bs_menu_fullscreen').click(function () {
     $("#gallery_bs_menu_toolbar").hide();
     $("#gallery_bs_menu_icon").show();
     screenfull.exit();
     $('#gallery_bs_wrapper').hide();
  });
  $('#gallery_bs_placeholder_r').click(function(){
    show_pic(pic_no_act, 1);
  });
  $('#gallery_bs_placeholder_l').click(function(){
    show_pic(pic_no_act, -1);
  });
  $( "#gallery_bs_pic_wrapper" ).on( "swipeleft", swipeleftHandler );
  $( "#gallery_bs_pic_wrapper" ).on( "swiperight", swiperightHandler );
});

</script>
<style>
#gallery_menu_icon {
position : absolute;
width : 30px;
height : 30px;
left : 0px;
z-index : 40;
background-color: #bbb;
opacity: 1;
}
#gallery_menu_toolbar {
position : absolute;
height : 30px;
left : 0px;
width : 100%;
z-index : 40;
background-color: white;
opacity: 0.5;
}
#gallery_bs_menu_icon {
position : absolute;
width : 30px;
height : 30px;
left : 0px;
z-index : 40;
background-color: white;
opacity: 1;
}
#gallery_bs_menu_toolbar {
position : absolute;
height : 30px;
left : 0px;
width : 100%;
z-index : 40;
background-color: white;
opacity: 0.5;
}
.gallery_menuitem {
float : left;
position : relative;
width : 30px;
height : 30px;
left : 0px;
cursor : pointer;
z-index : 40;
}
.gallery_menuitem img {
width : 30px;
height : 30px;
}
.gallery_menuspace {
float : left;
position : relative;
width : 20px;
height : 30px;
left : 10px;
z-index : 40;
}
</style>
<div id='gallery_wrapper'>
  <div id='gallery_menu_icon' class='gallery_menuitem'></div>
  <div id='gallery_menu_toolbar' >
     <div id='gallery_menu_menu' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_menu_fullscreen' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_menu_firstpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_menu_prevpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_menu_nextpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_menu_lastpic' class='gallery_menuitem'></div>
  </div>
  <div id='gallery_placeholder_l'>
     <div id='gallery_dir_l'></div>
     <div id='gallery_preview_l'></div>
  </div>
  <div id='gallery_pic_wrapper'>
    <div id="gallery_pic0"></div>
    <div id="gallery_pic1"></div>
    <div id="gallery_pic2"></div>
  </div>	
  <div id='gallery_placeholder_r'>
     <div id='gallery_dir_r'></div>
     <div id='gallery_preview_r'></div>
  </div>
</div>
<div id='gallery_bs_wrapper'>
  <div id='gallery_bs_menu_icon' class='gallery_menuitem'></div>
  <div id='gallery_bs_menu_toolbar' >
     <div id='gallery_bs_menu_menu' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_bs_menu_fullscreen' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_bs_menu_firstpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_bs_menu_prevpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_bs_menu_nextpic' class='gallery_menuitem'></div>
     <div class='gallery_menuspace'></div>
     <div id='gallery_bs_menu_lastpic' class='gallery_menuitem'></div>
  </div>
  <div id='gallery_bs_placeholder_l'>
     <div id='gallery_bs_dir_l'></div>
     <div id='gallery_bs_preview_l'></div>
  </div>
  <div id='gallery_bs_pic_wrapper'>
    <div id="gallery_bs_pic0"></div>
    <div id="gallery_bs_pic1"></div>
    <div id="gallery_bs_pic2"></div>
  </div>	
  <div id='gallery_bs_placeholder_r'>
     <div id='gallery_bs_dir_r'></div>
     <div id='gallery_bs_preview_r'></div>
  </div>
</div>

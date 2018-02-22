<!DOCTYPE html>
<html>
 
<head>
<?php
require_once("/sd_p2/web/php_inc/config.inc.php");
require_once("/sd_p2/web/php_inc/functions.inc.php");
require_once("/sd_p2/web/php_inc/check_mobile.php");
$vorname="";
$nachname="";
$userid="";
$logout=false;
$login=false;
$is_loged_in=false;
$session_started=false;
$login_msg="";
$cookie_msg="";
$cookie_ok=false; 
$email="";
$passwd="";
$sql_show = "role in ('+', '-')";

$login_msg = "";
$reload_needed = "";

$is_mobile_browser=is_mobile_browser();

if ( isset($_COOKIE["EMAIL"]) ) {
    $email=$_COOKIE["EMAIL"];
}
if ( isset($_COOKIE["PASSWD"]) ) {
    $passwd=$_COOKIE["PASSWD"];
}
if ($email != "" && $passwd != "") {
	session_start();
    $session_started=true;
    $statement = $www_db->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwd, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
//    !!!!! Muss überarbeitet werden !!!!!!
//        die('Login erfolgreich. Weiter zu <a href="/">internen Bereich</a>');
//		if(isset($_POST['angemeldet_bleiben'])) {
//			$identifier = random_string();
//			$securitytoken = random_string();				
//			$insert = $www_db->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
//			$insert->execute(array('user_id' => $user['id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
//			setcookie("identifier",$identifier,time()+(3600*24*365)); //Valid for 1 year
//			setcookie("securitytoken",$securitytoken,time()+(3600*24*365)); //Valid for 1 year
//		}
		$login=true;
		$sql_show = "role in ('+', 'a')";
    } else {
        $login_msg=$login_msg."E-Mail oder Passwort war ungültig";
    }
}

if ( isset($_COOKIE["PHPSESSID"]) ) {
    if ( $_COOKIE["PHPSESSID"] != "" ) { $cookie_ok = true; }
	$cookie_msg="Cookie gesetzt: ".$_COOKIE["PHPSESSID"]."<hr>";
}
if ( ($cookie_ok && ! $logout) || $login ) { 
	if ( ! $session_started ) session_start();
	$vorname="";
	$nachname="";
	$userid="";
	if(is_checked_in()) {
		$user = check_user();
		$vorname = htmlentities($user['vorname']);
		$nachname = htmlentities($user['nachname']);
		$userid = htmlentities($user['id']);
		$is_loged_in=true;
	}
}

$urlPart = explode("/", $_SERVER['REQUEST_URI']);
if ( $urlPart[1] == "") { $urlPart[1]="-"; } 

if( $is_mobile_browser ) { 
  echo "<title>wilmie.de mobile</title>\n";
} else { 
  echo "<title>wilmie.de</title>\n";
}
?>

<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<link rel='stylesheet' type='text/css' href='/css/styles.css' />
<link rel="stylesheet" type='text/css' href="/css/themes/wilmie.min.css" />
<script src="/js/jquery-2.1.3.js" ></script>
<script src="/js/screenfull.min.js"></script> 
<link rel='stylesheet' href='/css/jquery.mobile.icons-1.4.5.min.css' />
<link rel='stylesheet' href='/css/jquery.mobile.structure-1.4.5.min.css' />
<script src='/js/jquery.mobile-1.4.5.js'></script>

<?php if(is_mobile_browser()): ?>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<?php endif; ?>	  

<script> 
var myurl="";

if (top!=self) top.location.href=self.location.href;
 var vorname='<?php echo $vorname; ?>'; 
 var nachname='<?php echo $nachname; ?>'; 
 var userid='<?php echo $userid; ?>'; 
 var login_msg='<?php echo $login_msg; ?>'; 
 
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
 
function login() {
		createCookie('EMAIL',$('#email').val(),1);
		createCookie('PASSWD',$('#passwd').val(),1);
	    refreshPage();
}
function logout() {
		eraseCookie('EMAIL');
		eraseCookie('PASSWD');
		eraseCookie('PHPSESSID');
	    refreshPage();
}
 
function refreshPage() {
	$("#loadPage").html(" ");
	$.mobile.changePage("#loadPage");
	$("#homePage").html(" ");
	$.mobile.changePage("#homePage");  
	$.mobile.changePage(
		window.location.href, {
			allowSamePageTransition : true,
			transition              : 'none',
			showLoadMsg             : false,
			reloadPage              : true
		}
	);
	getcontent('/content/info_content.php','info');
	top.location.href=location.protocol + '//' + location.host + '/' +  'index.php';
}
 
 
<?php if( $is_mobile_browser ): ?>
 var info='info'; 
 var infourl='/main.php'; 
 var wetter='wetter'; 
 var wetterurl='/wetter.php'; 
 var gal='swipe'; 
 var galurl='/gallery.php?dir=herbst03'; 
 var gal1='swipe1'; 
 var gal1url='/gallery.php?dir=thailand'; 
 var gal2='swipe2'; 
 var gal2url='/gallery.php?dir=wien'; 
$(document).one('pagebeforecreate', function () {
$('#home').append("<div data-role='panel' id='menu_panel' data-theme='a' data-display='overlay' data-position='left'>"
				  +"</div>"
				  +"<div id='header' data-role='header' data-theme='c'>"
				  +"<a id='bars-button' data-icon='bars' class='ui-btn-left' style='margin-top:1px;' href='#menu_panel'>Menu</a>"
				  +"<h1 id='myheadline'></h1><a id='bmme_mo' onclick='bookmarkurl();' class='ui-btn-right' style='font-size:55%;' href='#'>URL 4<br>Bookmark</a>"
				  +"</div>"
				  +"<div id='contentwrapper' style='margin:0px auto; position: relative; align: center;' ><div id='content'> ... </div></div>");
<?php    
# Build Menu:
# Step 1: Add Entries on Main Menu and additional Menu Panels
	$sql="select menu1_id, menu2_id, menu3_id, class_mo, label, has_sub, url, bookmark, content, menu3_id from menu "
	    ."where show_mo = 1 and ".$sql_show." order by menu1_id, menu2_id, menu3_id asc";	
	$stmt = $www_db->prepare($sql);
	$stmt->execute();
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ) {
		if ($row['menu2_id'] == 1 && $row['menu3_id'] == 1) {
			if ( $row['has_sub'] == 1) {
				echo "$('#menu_panel').append(\"<a href='#panel".$row['menu1_id']."' data-role='button' data-theme='".$row['class_mo']."' >".$row['label']."</a>\");\n";
				echo "$('#home').append(\"<div data-role='panel' id='panel".$row['menu1_id']."' data-theme='".$row['class_mo']."' data-display='overlay' data-position='left'>".$row['label']."</div>\");\n";
			} else {
				if ( $row['url'] == "#" ) {
					echo "$('#menu_panel').append(\"<a href='#' data-role='button' data-theme='".$row['class_mo']."' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a>\");\n";
				} else {
					echo "$('#menu_panel').append(\"<a href='".$row['url']."' data-role='button' data-theme='".$row['class_mo']."' target='_blank' >".$row['label']."</a>\");\n";
				}	
			}			
		} else {
			if ( $row['has_sub'] == 0) {
				if ( $row['url'] == "#" ) {
					echo "$('#panel".$row['menu1_id']."').append(\"<a href='#' data-role='button' data-theme='".$row['class_mo']."' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a>\");\n";
				} else {
					echo "$('#panel".$row['menu1_id']."').append(\"<a href='".$row['url']."' data-role='button' data-theme='".$row['class_mo']."' target='_blank' >".$row['label']."</a>\");\n";
				}			
			}	
		}		
	}	
?>				  
<?php if( $is_loged_in ) : ?>
	$('#menu_panel').append("<a href='#' onclick='logout();' data-role='button' data-theme='a' >abmelden</a>");
	$('#myheadline').html("wilmie.de  ("+vorname+" "+nachname+")");
	eraseCookie("EMAIL");
	eraseCookie("PASSWD");
<?php else: ?>
	$('#menu_panel').append("<a href='#panel_am' data-role='button' data-theme='a' >anmelden</a>");
	$('#home').append("<div data-role='panel' id='panel_am' data-theme='a' data-display='overlay' data-position='left'>Anmelden</div>");
	$('#panel_am').append("<br><fieldset>"+
						  "E-Mail:<br><input id='email' type='email' size='31' maxlength='250' name='email'><br>"+
						  "Passwort:<br><input id='passwd' type='password' size='31'  maxlength='250' name='passwort'><br>"+
						  "<a href='#' onclick='login();' data-role='button' data-theme='a' >anmelden</a></fieldset>");
	$('#myheadline').html("wilmie.de  "+login_msg+"");
<?php endif; ?>	



});

function close_menu() {
<?php
	$sql="select menu1_id from menu where menu2_id = 1 and menu3_id = 1   and has_sub = true";	
	$stmt = $www_db->prepare($sql);
	$stmt->execute();
	while ( $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT) ) {
		echo "  $('#panel".$row[0]."').panel( 'close' );\n";
	}	
?>
  $('#menu_panel').panel( 'close' );
}

$(document).ready(function(){

<?php 
// End mobile Browser
else: 
// Start Desktop Browser
?>

$(document).ready(function(){
	$('#home').append("<div id='wrapper'><div id='head'></div><div id='menu' class='menu'></div><div id='main'><div id='content'></div></div></div>");
	$('#head').append("<div id='head_info'></div>");
    $('#head').append("<img src=/img/wilmie.png border=0><img src=/img/headline_pics.png border=0>"); 
    $('#menu').append("<div id='cssmenu'><ul id='mymenu'></ul></div>");
<?php		
# Step 1: Add Entries on Main Menu (Level 1)
	$sql="select menu1_id, menu2_id, menu3_id, class_dt, label, has_sub, url, bookmark, content from menu "
	    ."where show_dt = 1 and ".$sql_show." order by menu1_id, menu2_id, menu3_id asc";	
	$stmt = $www_db->prepare($sql);
	$stmt->execute();
	while ( $row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ) {
		if ($row['menu2_id'] == 1) {
# Top Level Menu Entries					
			if ($row['menu3_id'] == 1) {
				if ($row['has_sub'] == 1) {
# First level Label			
					echo "$('#mymenu').append(\"<li class='".$row['class_dt']."'><a href='#'><span>".$row['label']."</span></a><ul id='ml_".$row['menu1_id']."'></ul>\");\n";
				} else {
# First Level Entries
					if ( $row['url'] == "#" ) {
						echo "$('#mymenu').append(\"<li class='".$row['class_dt']."'><a href='#' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a></li>\");\n";
					} else {
						echo "$('#mymenu').append(\"<li class='".$row['class_dt']."'><a href='".$row['url']."' target='_blank' >".$row['label']."</a></li>\");\n";
					}
				}					
			} else {   # menu3_id > 1 sind immer Entries !!!
# Second Level Entries
				if ( $row['url'] == "#" ) {
					echo "$('#ml_".$row['menu1_id']."').append(\"<li class='".$row['class_dt']."'><a href='#' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a></li>\");\n";
				} else {
					echo "$('#ml_".$row['menu1_id']."').append(\"<li class='".$row['class_dt']."'><a href='".$row['url']."' target='_blank' >".$row['label']."</a></li>\");\n";
				}
			}				
		} else {
			if ($row['menu3_id'] == 1) {
				if ($row['has_sub'] == 1) {
# Second level Label			
					echo "$('#ml_".$row['menu1_id']."').append(\"<li class='".$row['class_dt']."'><a href='#'><span>".$row['label']."</span></a><ul id='ml_".$row['menu1_id'].$row['menu2_id']."'></ul>\");\n";
				} else {
# Second Level Entries					
					if ( $row['url'] == "#" ) {
						echo "$('#ml_".$row['menu1_id']."').append(\"<li class='".$row['class_dt']."'><a href='#' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a></li>\");\n";
					} else {
						echo "$('#ml_".$row['menu1_id']."').append(\"<li class='".$row['class_dt']."'><a href='".$row['url']."' target='_blank' >".$row['label']."</a></li>\");\n";
					}
				}					
			} else {   # menu3_id > 1 sind immer Entries !!!
# Third Level Entries
				if ( $row['url'] == "#" ) {
					echo "$('#ml_".$row['menu1_id'].$row['menu2_id']."').append(\"<li class='".$row['class_dt']."'><a href='#' onclick='getcontent(\\\"".$row['content']."\\\" , \\\"".$row['bookmark']."\\\");' >".$row['label']."</a></li>\");\n";
				} else {
					echo "$('#ml_".$row['menu1_id'].$row['menu2_id']."').append(\"<li class='".$row['class_dt']."'><a href='".$row['url']."' target='_blank' >".$row['label']."</a></li>\");\n";
				}
			}				
			
		}			
	}	
?>	
<?php if( $is_loged_in ) : ?>
	$('#mymenu').append("<li class='has_sub'><a href='#'><span>Logout</span></a><ul><li><button id='logoutbut' class='ui-btn ui-shadow ui-corner-all' onclick='logout();'> Abmelden</button></li></ul></li>");
<?php else: ?>
	$('#mymenu').append("<li class='has_sub'><a href='#'><span>Login</span></a><ul id='loginbox'><li>"+
						"E-Mail:<br><input id='email' type='email' size='31' maxlength='250' name='email'><br>"+
						"Passwort:<br><input id='passwd' type='password' size='31'  maxlength='250' name='passwort'><br>"+
						"<button id='loginbut' class=' ui-btn ui-shadow ui-corner-all' onclick='login();'> Anmelden</button></li></ul></li>");
<?php endif; ?>	
   $('#email').click(function() {
	   $('#loginbox').css('display', 'block');
   });
   $('#passwd').click(function() {
	   $('#loginbox').css('display', 'block');
   });

$('#mymenu').append("<li class='hidden' id='bmme'><a href='#'>&nbsp;</a></li>");

<?php endif; ?>		

switch ( window.location.pathname ) { 
<?php	
   	$sql="select bookmark, content from menu where length(bookmark) > 2 and length(content) > 2 ";
	$stmt = $www_db->prepare($sql);
	$stmt->execute();
	while ( $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT) ) {
		echo " case \"/".$row[0]."\" : \n"
		    ." getcontent(\"".$row[1]."\",\"".$row[0]."\"); \n"
			." break; \n";
	}
?>	
	default:
		getcontent('/content/info_content.php', 'info'); 
} 
<?php if(! is_mobile_browser()): ?>
  $('#bmme').removeClass('active');
  $('#bmme').addClass('hidden');
<?php endif; ?>			 
});	
 
function getcontent(mypage,myurlx) {
  myurl = myurlx;
  $.get(mypage, function(data) { 
    $('#content').hide();
    $('#content').html(data); 
    $('#content').show();
<?php if(is_mobile_browser()): ?>
	close_menu();
<?php endif; ?>			 
  });
  $('#bmme').removeClass('hidden');
  $('#bmme').html("<a href='#' onclick='bookmarkurl();'><span><small>URL 4 Bookmark</small></span>");
  $('#bmme').addClass('active');
}

function bookmarkurl() {
       top.location.href=location.protocol + '//' + location.host + '/' +  myurl;
}

</script>
</head>
<?php
if(is_mobile_browser()) { 
	echo "<div data-role='page' id='home' data-theme='a'>\n";
} else { 
	echo "<div id='home'></div>\n";
}
?>
</html>

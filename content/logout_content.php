<?php
session_start();
require_once("/sd_p2/web/php_inc/config.inc.php");
require_once("/sd_p2/web/php_inc/functions.inc.php");
$user = check_user();
?>
<form method='post'>

<center>
Nutzer:<br><?php echo htmlentities($user['vorname'])." ".htmlentities($user['nachname']); ?>
<br>(ID:<?php echo htmlentities($user['id']) ?>) abmelden?"
<br>	
<input type='hidden' name='abmelden' value='ja'>	
<button type='submit' style='width: 220px; height: 40px; color: #ffffff; background: #a80329;'>Logout</button>
</center>
		
</form>		
		

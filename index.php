<?php

/**
 * include the configs / constants for the database connection
 */
require_once("config/db.php");

// class autoloader function, this includes all the classes that are needed by the script
// you can remove this stuff if you want to include your files manually
function autoload($class)
{
    require('classes/' . $class . '.class.php');
}

// automatically loads all needed classes, when they are needed
spl_autoload_register("autoload");


//create a database connection
$db    = new Database();

// start this baby and give it the database connection
$login = new Login($db);

// base structure
?>
<?php
    // are we logged in ?
    if ($login->isUserLoggedIn()) {
        include("views/login/logged_in.php");
        // further stuff here
?>
</div>
<div style="position:fixed; top:10px; left:25%; z-index:100;">
	<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
	<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="auto" height="auto">
		<param name="movie" value="views/img/mainHeader.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="opaque" />
		<param name="swfversion" value="6.0.65.0" />
		<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
		<param name="expressinstall" value="Scripts/expressInstall.swf" />
		<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="views/img/mainHeader.swf" width="778" height="153">
			<!--<![endif]-->
			<param name="quality" value="high" />
			<param name="wmode" value="opaque" />
			<param name="swfversion" value="6.0.65.0" />
			<param name="expressinstall" value="Scripts/expressInstall.swf" />
			<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
			<div>
				<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			</div>
			<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
	<script type="text/javascript">
	<!--
	swfobject.registerObject("FlashID");
	//-->
	</script>
</div>
<div style="clear:both; position:relative; top:10px;">
<?php
		include("views/content/content.php");
    } else {
        // not logged in, showing the login form
        include("views/login/not_logged_in.php");
    }
?>
</div>
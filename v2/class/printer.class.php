<?php
    /**
     * @author Marcello Visigalli < marcello.visigalli@gmail.com >
     */

class printer
{
	
	function alert($message) { print "<script language=\"javascript\">alert(\"$message\")</script>"; }
	function alertgo($message, $location) { print"<script language=\"javascript\">alert(\"$message\");document.location=\"$location\"</script>"; }
	function alertback($message) { print"<script language=\"javascript\">alert(\"$message\");history.go(-1)</script>"; }
	function alertclose($message) { print"<script language=\"javascript\">alert(\"$message\");close()</script>"; }
	function opento($url){	print"<script language=\"Javascript\">window.open('".$url."');</script>";}
	function _goto($url) {
	         echo "<script language=\"javascript\">document.location='$url'</script>Se il tuo browser non supporta javascript clicca <a href=\"$url\">qui</a>"; }
	
	
	
}

?>
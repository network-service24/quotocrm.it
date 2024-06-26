<?
unset($_SESSION['utente']);
unset($_SESSION);
$content .='
<form  action="'.BASE_URL_SITO.'login.php" method="POST" name="form_phpmv" id="form_phpmv" target="_self">
	<input type="hidden" name="username" id="username"  value="'.$_REQUEST['azione'].'"/>
	<input type="hidden" name="password" id="password"  value="'.$_REQUEST['param'].'"/>
</form>'."\r\n";

$content .='<script src="'.BASE_URL_SITO.'js/jquery-3.5.1.js"></script>';
$content .='<script>
				$(document).ready(function(){
					$("#form_phpmv").submit();
				});
    		</script>'."\r\n";
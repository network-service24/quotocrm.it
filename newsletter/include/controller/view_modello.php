 <?php

		$select = "SELECT * FROM mailing_newsletter_template WHERE idsito = ".IDSITO." AND id = '".$_REQUEST['azione']."' ";
		$res = $dbMysqli->query($select);
		$dati = $res[0];


?> 
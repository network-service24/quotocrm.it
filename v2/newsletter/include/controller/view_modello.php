 <?php

		$select = "SELECT * FROM mailing_newsletter_template WHERE idsito = ".IDSITO." AND id = '".$_REQUEST['azione']."' ";
		$res = $db->query($select);
		$dati = $db->row($res);


?> 
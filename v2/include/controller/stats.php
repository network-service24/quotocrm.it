<?php
if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '') {
	$Id        = $_REQUEST['param'];
	$select    = $db->query("SELECT DataInvio FROM hospitality_guest WHERE Id = ".$Id);
	$rec       = $db->row($select);
	if($rec['DataInvio'] != ''){

        $db_suiteweb->query('SELECT * FROM siti WHERE idsito = "'.$_SESSION['IDSITO'].'"');
        $rows =  $db_suiteweb->row();
        $sito_tmp    = str_replace("http://","",$rows['web']);
        $sito_tmp    = str_replace("www.","",$sito_tmp);
        $directory_sito = str_replace(".it","",$sito_tmp);
        $directory_sito = str_replace(".com","",$directory_sito);
        $directory_sito = str_replace(".net","",$directory_sito);
        $directory_sito = str_replace(".biz","",$directory_sito);
        $directory_sito = str_replace(".eu","",$directory_sito);
        $directory_sito = str_replace(".de","",$directory_sito);
        $directory_sito = str_replace(".es","",$directory_sito);
        $directory_sito = str_replace(".fr","",$directory_sito);

		$url          = $googl->shorten($_SESSION['URL_LANDING'].$directory_sito.'/'.base64_encode($Id.'_'.$_SESSION['IDSITO'].'_p').'/count/');
		$destinazione = $url.'.info';
		header('Location:'.$destinazione);
	}else{

		echo "<script language=\"javascript\"> alert('Non sono presenti Statistiche per questa richiesta!');close();</script>";

	}

}
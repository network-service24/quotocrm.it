<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');

function clean($stringa){

	$clean_title = str_replace( "&#39;",   "'", $stringa );
	$clean_title = str_replace( "&agrave;", "à", $clean_title );
	$clean_title = str_replace( "&egrave;", "è", $clean_title );
	$clean_title = str_replace( "&igrave;", "ì", $clean_title );
	$clean_title = str_replace( "&ograve;", "ò", $clean_title );
	$clean_title = str_replace( "&ugrave;", "ù", $clean_title );
	$clean_title = str_replace( "&nbsp;",  " ", $clean_title );

	return($clean_title);
}

	$idmotivazione                 = $_REQUEST['idmotivazione'];
    $idsito                        = $_REQUEST['idsito'];
    $lingua                        = $_REQUEST['lingua'];

    $cliente                       = urldecode($_REQUEST['cliente']);
    $acconto                       = urldecode($_REQUEST['acconto']);
    
    $data_valid                    = $_REQUEST['data_valid'];

    $hotel                         = urldecode($_REQUEST['hotel']);
    $email_hotel                   = urldecode($_REQUEST['email_hotel']);
    $avatar                        = urldecode($_REQUEST['avatar']);

    $idpreno                       = $_REQUEST['idpreno'];
    $NumeroPrenotazione            = $_REQUEST['NumeroPrenotazione'];

    $dir_sito                      = urldecode($_REQUEST['dir_sito']);

    $linkvoucher        = '<a href="'.BASE_URL_LANDING.$dir_sito.'/'.base64_encode($idpreno.'_'.$idsito.'_c').'/voucher_rec/">VOUCHER</a>';

    $qr  = "SELECT 
                hospitality_tipo_voucher_cancellazione_lingua.*
            FROM 
                hospitality_tipo_voucher_cancellazione 
            INNER JOIN
                hospitality_tipo_voucher_cancellazione_lingua
            ON
                hospitality_tipo_voucher_cancellazione_lingua.motivazione_id = hospitality_tipo_voucher_cancellazione.Id
            WHERE 
                hospitality_tipo_voucher_cancellazione.idsito = ".$idsito." 
            AND 
                hospitality_tipo_voucher_cancellazione.Id = ".$idmotivazione ."
            AND 
                hospitality_tipo_voucher_cancellazione.Abilitato = 1
            AND
                hospitality_tipo_voucher_cancellazione_lingua.lingue = '".$lingua."'
            AND 
                hospitality_tipo_voucher_cancellazione_lingua.idsito = ".$idsito." ";

    $risult = $dbMysqli->query($qr);
    $tot    = sizeof($risult);

    if($tot > 0){

        $valore = $risult[0];

        $contenuto_mail = str_replace("[cliente]",$cliente, $valore['Descrizione']);
        $contenuto_mail = str_replace("[caparra]",$acconto,$contenuto_mail);
        $contenuto_mail = str_replace("[numeropreno]",$NumeroPrenotazione,$contenuto_mail);
        $contenuto_mail = str_replace("[validita]",$data_valid,$contenuto_mail);
        $contenuto_mail = str_replace("[emailhotel]",$email_hotel,$contenuto_mail);
        $contenuto_mail = str_replace("[linkvoucher]",$linkvoucher,$contenuto_mail);
        $contenuto_mail = str_replace("[struttura]",$hotel,$contenuto_mail);

        $oggetto_mail = str_replace("[cliente]",$cliente, $valore['Oggetto']);
        $oggetto_mail = str_replace("[numeropreno]",$NumeroPrenotazione, $oggetto_mail);


        echo   clean($oggetto_mail).'^<img src = "'.BASE_URL_SITO.'uploads/loghi_siti/'.$avatar.'" /><br>'.clean($contenuto_mail);
    }

?>
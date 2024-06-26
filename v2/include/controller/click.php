<?php
if($_REQUEST['azione'] != '' && $_REQUEST['param'] != '') {

    require_once INC_PATH_CLASS.'Googl.class.php';
    $googl = new GoogleUrlApi('AIzaSyCbcKWbZhHcU2fQ0JzRNyM_blXdL5i5sbc');
    
	$Id      = $_REQUEST['param'];

	if($_REQUEST['azione'] == 'prev'){
    	$url     = $googl->shorten($_SESSION['URL_LANDING'].$_SESSION['DIRECTORYSITO'].'/'.base64_encode($Id.'_'.$_SESSION['IDSITO'].'_p').'/count/');
	}else{
		$url     = $googl->shorten($_SESSION['URL_LANDING'].$_SESSION['DIRECTORYSITO'].'/'.base64_encode($Id.'_'.$_SESSION['IDSITO'].'_c').'/count/');
	}

    $qry_str = "?key=AIzaSyCbcKWbZhHcU2fQ0JzRNyM_blXdL5i5sbc&shortUrl=".$url."&projection=ANALYTICS_CLICKS";

    unset($googl);
    $url = '';
    
    $ch = curl_init();

    // Set query data here with the URL
    curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url' . $qry_str); 

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);

    $result = trim(curl_exec($ch));
    $dati  = json_decode($result);


    curl_close($ch);

    $click = $dati->analytics->allTime->shortUrlClicks;
    $aperture = ($_REQUEST['azione'] == 'prev'?'Il preventivo  è stato aperto':'La conferma  è stata aperta').': N° <b style="font-size:16px;'.($click==0?'color:red;':'color:green;').'">'.$click.'</b>';




}

     ?>
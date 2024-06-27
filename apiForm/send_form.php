<?php

/**
 * * controllo per l'esecuzione del codice che avviene solo se
 * * la variabile action è valorizzata a 'send'
*/
if ($_REQUEST['action'] == 'send') {

  /**
   * ? foreach di tutti i campi form_fields per
   * ? estrarre tutti i valori
  */
  foreach ($_REQUEST as $key => $value) {
    $campi[$key] = $value;
  }
  /**
   * ! foreach per la composizione della stringa dati
   * ! concatenando tutti i valori
  */
  $dati = '';
  foreach ($campi as $k => $v) {
    $dati .= $k . '=' . urlencode($v) . '&';
  }
  rtrim($dati, '&');
  /**
   * * valorizzazione della user e pass per accedere al file (api_form_2023.php) protetto
  */
  $user = 'quoto';
  $pass = 'lHxAbMHGU';
  /**
   * ? invio dei dati tramite codice php cUrl()
  */
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.quotocrm.it/ApiFormQuoto/api_form_2023.php');
  curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass);
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $dati);
  curl_exec($ch);
  curl_close($ch);

} else {
  /**
   * ! in caso di accesso malevolo al file senza variabile action impostata ritorna questo output!
  */
  echo 'STAI TENTANDO UN ACCESSO NON AUTORIZZATO OPPURE C\'E\' UN PROBLEMA CONTATTA L\'AMMINISTRATORE DEL TUO SITO!';
}

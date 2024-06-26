<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli <a marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    $action    =      $_REQUEST['action'];
    
    if($action=='update'){
      
        $idutente               =      $_REQUEST['idutente'];
        $logo                   =      $_REQUEST['logo'];
        $username               =      $dbMysqli->escape($_REQUEST['username']);
        $password               =      base64_encode($_REQUEST['password']);
        $blocco_accesso         =      $_REQUEST['blocco_accesso'];
        $data_creazione         =      $_REQUEST['data_creazione'].' 00:00:00';
        $ut_email               =      $_REQUEST['utente_email'];
        $ut_nome                =      $dbMysqli->escape($_REQUEST['utente_nome']);
        $ut_cognome             =      $dbMysqli->escape($_REQUEST['utente_cognome']);

    

        $updateUT    = "UPDATE utenti_admin SET 
                                    ".($_REQUEST['logo']!=''?'logo ="'.$logo.'",':'')."
                                    username               ='".$username."',
                                    password               ='".$password."',
                                    blocco_accesso         ='".$blocco_accesso."',
                                    data_creazione         ='".$data_creazione."',
                                    utente_nome                ='".$ut_nome."',
                                    utente_cognome             ='".$ut_cognome."',
                                    utente_email               ='".$ut_email."'
                                WHERE idutente = ".$idutente;
        $dbMysqli->query($updateUT);


    }
#######################################################################################################################

echo 'ok';

#######################################################################################################################

?>

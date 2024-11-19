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
      
        $lista_id_tipo_utente   =      explode(",", $_REQUEST['id_tipo_utente']);
        $idutente               =      $_REQUEST['idutente'];
        $idsito                 =      $_REQUEST['idsito'];
        $idanagra               =      $_REQUEST['idanagra'];
        $logo                   =      $_REQUEST['logo'];
        $username               =      $dbMysqli->escape($_REQUEST['username']);
        $password               =      base64_encode($_REQUEST['password']);
        $blocco_accesso         =      $_REQUEST['blocco_accesso'];
        $is_admin               =      $_REQUEST['is_admin'];
        $matricola              =      $_REQUEST['matricola'];
        $data_creazione         =      $_REQUEST['data_creazione'].' 00:00:00';
        $data_modifica          =      $_REQUEST['data_modifica'].' 00:00:00';
        $ut_email               =      $_REQUEST['ut_email'];
        $ut_nome                =      $dbMysqli->escape($_REQUEST['ut_nome']);
        $ut_cognome             =      $dbMysqli->escape($_REQUEST['ut_cognome']);
        $ut_color               =      $_REQUEST['ut_color'];
        $flag_dashboard_view    =      $_REQUEST['flag_dashboard_view'];
        $flag_utente_view       =      $_REQUEST['flag_utente_view'];
        $ut_note                =      $dbMysqli->escape($_REQUEST['ut_note']);
    

        $updateUT    = "UPDATE utenti SET idanagra             ='".$idanagra."',
                                        idsito                 ='".$idsito."',
                                        ".($_REQUEST['logo']!=''?'logo ="'.$logo.'",':'')."
                                        username               ='".$username."',
                                        password               ='".$password."',
                                        blocco_accesso         ='".$blocco_accesso."',
                                        is_admin               ='".$is_admin."',
                                        matricola              ='".$matricola."',
                                        data_creazione         ='".$data_creazione."',
                                        data_modifica          ='".$data_modifica."',
                                        ut_nome                ='".$ut_nome."',
                                        ut_cognome             ='".$ut_cognome."',
                                        ut_color               ='".$ut_color."',
                                        ut_email               ='".$ut_email."',
                                        ut_note                ='".$ut_note."',
                                        flag_dashboard_view    ='".$flag_dashboard_view."',
                                        flag_utente_view       ='".$flag_utente_view."'
                                    WHERE idutente = ".$idutente;
        $dbMysqli->query($updateUT);

        $deleteUT = "DELETE FROM utente_tipo_utente WHERE idutente = ".$idutente;
        $dbMysqli->query($deleteUT);



        foreach ($lista_id_tipo_utente as $key => $value) {
            $insertUT = "INSERT INTO utente_tipo_utente(idutente,id_tipo_utente) VALUES('".$idutente."', '".$value."')";
            $dbMysqli->query($insertUT);
        }

    }
#######################################################################################################################

echo 'ok';

#######################################################################################################################

?>

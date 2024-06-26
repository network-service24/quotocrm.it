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
/*         foreach ($q as $key => $value) {

            if($_REQUEST[$value['Field']]==true){
                    $campi_tabella[$value['Field']] = $_REQUEST[$value['Field']];
            }
    
        }
        $dbMysqli->where($param,$id);
        $dbMysqli->update('siti',$campi_tabella); */
      

            $idsito                                 =      $_REQUEST['idsito'];
            $tiposito                               =      $_REQUEST['tiposito'];
            $classe                                 =      $_REQUEST['classe'];
            $https                                  =      $_REQUEST['https'];
            $web                                    =      $dbMysqli->escape($_REQUEST['web']);
            $nome                                   =      $dbMysqli->escape($_REQUEST['nome']);
            $id_stato                               =      $_REQUEST['id_stato'];
            $codice_regione                         =      $_REQUEST['codice_regione'];
            $codice_provincia                       =      $_REQUEST['codice_provincia'];
            $codice_comune                          =      $_REQUEST['codice_comune'];
            $indirizzo                              =      $dbMysqli->escape($_REQUEST['indirizzo']);
            $cap                                    =      $_REQUEST['cap'];
            $link_gmap                              =      $dbMysqli->escape($_REQUEST['link_gmap']);
            $link_percorso_gmap                     =      $dbMysqli->escape($_REQUEST['link_percorso_gmap']);
            $iframe_gmap                            =      $dbMysqli->escape($_REQUEST['iframe_gmap']);
            $chiave_sito_recaptcha                  =      $_REQUEST['chiave_sito_recaptcha'];
            $chiave_segreta_recaptcha               =      $_REQUEST['chiave_segreta_recaptcha'];
            $TagManager                             =      $_REQUEST['TagManager'];

            $IdAccountAnalytics                     =      $_REQUEST['IdAccountAnalytics'];
            $IdPropertyAnalytics                    =      $_REQUEST['IdPropertyAnalytics'];
            $ViewIdAnalytics                        =      $_REQUEST['ViewIdAnalytics'];

            $tel                                    =      $_REQUEST['tel'];
            $fax                                    =      $_REQUEST['fax'];
            $cell                                   =      $_REQUEST['cell'];
            $whatsapp                               =      $_REQUEST['whatsapp'];
            $email                                  =      $_REQUEST['email'];
            $smtp                                   =      $_REQUEST['smtp'];
            $note                                   =      $dbMysqli->escape($_REQUEST['note']);
            $data_creazione                         =      $_REQUEST['data_creazione'];
            $data_modifica                          =      $_REQUEST['data_modifica'];
            $data_scadenza                          =      $_REQUEST['data_scadenza'];
            $website                                =      $_REQUEST['website'];
            $italiaabc                              =      $_REQUEST['italiaabc'];
            $usa_privacy_policy                     =      $_REQUEST['usa_privacy_policy'];
            $sito_migrato                           =      $_REQUEST['sito_migrato'];
            $id_status                              =      $_REQUEST['id_status'];
            if($id_status == 2 || $id_status == 5 || $id_status == 7){
                $website                            =      0;
            }
            $servizi_attivi                         =      $_REQUEST['servizi_attivi'];
            $id_tipo_contratto                      =      $_REQUEST['id_tipo_contratto'];
            $vip                                    =      $_REQUEST['vip'];
            $hospitality                            =      $_REQUEST['hospitality'];
            $API_hospitality                        =      $_REQUEST['API_hospitality'];
            $checkin_online_hospitality             =      $_REQUEST['checkin_online_hospitality'];
            $no_rinnovo_hospitality                 =      $_REQUEST['no_rinnovo_hospitality'];
            $data_start_hospitality                 =      $_REQUEST['data_start_hospitality'];
            $data_end_hospitality                   =      $_REQUEST['data_end_hospitality'];

            $facebook                               =      $dbMysqli->escape($_REQUEST['facebook']);
            $twitter                                =      $dbMysqli->escape($_REQUEST['twitter']);
            $instagram                              =      $dbMysqli->escape($_REQUEST['instagram']);
            $tripadvisor                            =      $dbMysqli->escape($_REQUEST['tripadvisor']);




        $updateUT    = "UPDATE siti SET tiposito              ='".$tiposito."',
                                        classe                ='".$classe."',
                                        https                 ='".$https."',
                                        web                   ='".$web."',
                                        nome                  ='".$nome."',
                                        indirizzo             ='".$indirizzo."',
                                        codice_comune         ='".$codice_comune."',
                                        codice_provincia      ='".$codice_provincia."',
                                        codice_regione        ='".$codice_regione."',
                                        id_stato              ='".$id_stato."',
                                        cap                   ='".$cap."',
                                        link_gmap             ='".$link_gmap."',
                                        link_percorso_gmap    ='".$link_percorso_gmap."',
                                        iframe_gmap           ='".$iframe_gmap."',
                                        chiave_sito_recaptcha ='".$chiave_sito_recaptcha."',
                                        chiave_segreta_recaptcha ='".$chiave_segreta_recaptcha."',

                                        TagManager ='".$TagManager."',
                                        IdAccountAnalytics ='".$IdAccountAnalytics."',
                                        IdPropertyAnalytics ='".$IdPropertyAnalytics."',
                                        ViewIdAnalytics ='".$ViewIdAnalytics."',
                                        cell ='".$cell."',
                                        whatsapp ='".$whatsapp."',
                                        email ='".$email."',
                                        smtp ='".$smtp."',
                                        note ='".$chiave_snoteegreta_recaptcha."',
                                        data_creazione ='".$data_creazione."',
                                        data_modifica ='".$data_modifica."',

                                        data_scadenza ='".$data_scadenza."',
                                        website ='".$website."',
                                        italiaabc ='".$italiaabc."',
                                        usa_privacy_policy ='".$usa_privacy_policy."',
                                        sito_migrato ='".$sito_migrato."',


                                        tripadvisor           ='".$tripadvisor."'
                         WHERE idsito = ".$idsito;
        $dbMysqli->query($updateUT);

      /*  $deleteUT = "DELETE FROM utente_tipo_utente WHERE idutente = ".$idutente;
        $dbMysqli->query($deleteUT);



        foreach ($lista_id_tipo_utente as $key => $value) {
            $insertUT = "INSERT utente_tipo_utente SET idutente = ".$idutente.", id_tipo_utente = ".$value;
            $dbMysqli->query($insertUT);
        } */

    }
#######################################################################################################################

echo 'ok';

#######################################################################################################################

?>

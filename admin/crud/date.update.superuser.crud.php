<?php
/**
 * CRM and CMS
 * @author Marcello Visigalli < marcello.visigalli@gmail.com >
 * @version 3.0
 * @name SuiteWeb
 * CRUD for insert, update, delete query in ajax
 */

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$tabella   = $_REQUEST['tabella'];



                   
            $id                      = $_REQUEST['id'];
            $param_where             = $_REQUEST['parametro'];
        
            # QUERY PER COMPILARE IL DATATABLE
            $s  = " SELECT *  FROM ".$tabella." WHERE ".$param_where." = ".$id."";
        
            $rec = $dbMysqli->query($s);
        
            $row = $rec[0];
           
         
            $idutente               = $row['idutente'];
            $logo                   = $row['logo'];
            $username               = ($row['username']);
            $password               = base64_decode($row['password']);
            $blocco_accesso         = $row['blocco_accesso'];
            $is_admin               = $row['is_admin'];
            $data_creazione_x       = explode("-",$row['data_creazione']);
            $data_creazione_tmp     = explode(" ",$data_creazione_x[2]);
            $data_creazione_        = $data_creazione_x[0].'-'.$data_creazione_x[1].'-'.$data_creazione_tmp[0];
            $data_creazione         = $row['data_creazione'];
            $ut_email               = $row['utente_email'];
            $ut_nome                = ($row['utente_nome']);
            $ut_cognome             = ($row['utente_cognome']);

                  // 
            $output = '<script type="text/javascript">
                            $(document).ready(function() {
                                $("#id_update").val(\''.$idutente.'\');
                                $("#idutente_update").val(\''.$idutente.'\');
                                $("#id_tipo_utente_update_").html(\''.$lTUtenti.'\');
                                '.($logo!=""?'
                                    $("#logo_view").html(\'<a href="'.BASE_URL_SITO.'uploads/loghi_superuser/'.$logo.'" class="img-link" data-lightbox="'.$idsito.'"><img src="'.BASE_URL_SITO.'class/resize.class.php?src='.BASE_PATH_SITO.'uploads/loghi_superuser/'.$logo.'&w=140&h=140&a=c&q=100" class="img-fluid img-thumbnail"></a>\');
                                ':
                                    '$("#logo_view").html(\'<i class="fa fa-image fa-fw fa-3x"></i>\');
                                ').'
                                $("#logo").val(\''.$logo.'\');
                                $("#username_update").val(\''.$username.'\');
                                $("#password_update").val(\''.$password.'\');
                                $("#blocco_accesso_update").val(\''.$blocco_accesso.'\');
                                '.($blocco_accesso==1?'$("#blocco_accesso_update").attr("checked",true);':'').'
                                $("#is_admin_update").val(\''.$is_admin.'\');
                                '.($is_admin==1?'$("#is_admin_update").attr("checked",true);':'').'
                                $("#data_creazione_update_").val(\''.$data_creazione_.'\');
                                $("#data_creazione_update").val(\''.$data_creazione.'\');
                                $("#utente_email_update").val(\''.$ut_email.'\');
                                $("#utente_nome_update").val(\''.$ut_nome.'\');
                                $("#utente_cognome_update").val(\''.$ut_cognome.'\');
                            });
                    </script>';	

        echo $output;
?>

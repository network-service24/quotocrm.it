<?php

include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/v2/include/function.inc.php");


 	if($_POST['password']!=''){
						
            $select       = "SELECT
                                    *
                                FROM
                                    utenti_password
                                WHERE
                                    utenti_password.password = '".addslashes($_POST['password'])."'
                                AND
                                    utenti_password.idutente = '".$_POST['idutente'] ."'";

            $risult        = $dbMysqli_suiteweb->query($select);
            $check_pass    = sizeof($risult);

            if($check_pass > 0){

                echo '<div class="alert alert-danger text-center">La password scelta <b>'.$risult[0]['password'].'</b> è già stata usata!</div>';
            }
    }

?>
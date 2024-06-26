<?php

include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");


 	if($_POST['password']!=''){
						
            $select       = "SELECT
                                    *
                                FROM
                                    utenti_password
                                WHERE
                                    utenti_password.password = '".base64_encode($_POST['password'])."'
                                AND
                                    utenti_password.idutente = '".$_POST['idutente'] ."'";

            $risult        = $dbMysqli->query($select);
            $check_pass    = sizeof($risult);

            if($check_pass > 0){

                echo '<div class="alert alert-danger text-center">La password scelta <b>'.base64_decode($risult[0]['password']).'</b> è già stata usata!</div>';
            }
    }

?>
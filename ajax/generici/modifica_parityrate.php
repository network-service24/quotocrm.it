<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_pr'){

            $Id                = $_REQUEST['id'];
            $idsito            = $_REQUEST['idsito'];
            $Abilitato         = $_REQUEST['Abilitato'];
            $HotelId            = $_REQUEST['HotelId'];
            $UserParity         = $_REQUEST['UserParity'];
            $PasswordParity     = $_REQUEST['PasswordParity'];
            $UrlApi             = $_REQUEST['UrlApi'];
            $ApiKey             = $_REQUEST['ApiKey'];

            $update ="UPDATE hospitality_parityrate SET HotelId = '".$HotelId."',UserParity = '".$UserParity."',PasswordParity  = '".$PasswordParity."',UrlApi   = '".$UrlApi."',ApiKey   = '".$ApiKey."', Abilitato = '".$Abilitato."' WHERE Id =  ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>
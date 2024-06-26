<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_pr'){

            $idsito             = $_REQUEST['idsito'];
            $Abilitato          = $_REQUEST['Abilitato'];
            $HotelId            = $_REQUEST['HotelId'];
            $UserParity         = $_REQUEST['UserParity'];
            $PasswordParity     = $_REQUEST['PasswordParity'];
            $UrlApi             = $_REQUEST['UrlApi'];
            $ApiKey             = $_REQUEST['ApiKey'];

            $insert ="INSERT INTO hospitality_parityrate(idsito,HotelId,UserParity,PasswordParity,UrlApi,ApiKey,Abilitato)  VALUES ('".$idsito."','".$HotelId."','".$UserParity."','".$PasswordParity."','".$UrlApi."','".$ApiKey."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>
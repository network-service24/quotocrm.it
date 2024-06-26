<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_im'){

            $idsito                      = $_REQUEST['idsito'];
            $Abilitato                   = $_REQUEST['Abilitato'];
            $Portale                     = $_REQUEST['Portale'];
            $ServerEmail                 = $_REQUEST['ServerEmail'];
            $UserEmail                   = $_REQUEST['UserEmail'];
            $PasswordEmail               = $_REQUEST['PasswordEmail'];
            $HotelID                     = $_REQUEST['HotelID'];
            $Type                        = $_REQUEST['Type'];
            $UrlApi                      = $_REQUEST['UrlApi'];

            $insert ="INSERT INTO hospitality_imap_email(idsito,Portale,ServerEmail,UserEmail,PasswordEmail,HotelID,Type,UrlApi,Abilitato)  VALUES ('".$idsito."','".$Portale."','".$ServerEmail."','".$UserEmail."','".$PasswordEmail."','".$HotelID."','".$Type."','".$UrlApi."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>
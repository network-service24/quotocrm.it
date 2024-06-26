<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_im'){

        $Id                          = $_REQUEST['id'];
        $idsito                      = $_REQUEST['idsito'];
        $Abilitato                   = $_REQUEST['Abilitato'];
        $Portale                     = $_REQUEST['Portale'];
        $ServerEmail                 = $_REQUEST['ServerEmail'];
        $UserEmail                   = $_REQUEST['UserEmail'];
        $PasswordEmail               = $_REQUEST['PasswordEmail'];
        $HotelID                     = $_REQUEST['HotelID'];
        $Type                        = $_REQUEST['Type'];
        $UrlApi                      = $_REQUEST['UrlApi'];

        $update           ="UPDATE hospitality_imap_email SET   Portale          = '".$Portale."',
                                                                ServerEmail       =        '".$ServerEmail."',
                                                                UserEmail         =        '".$UserEmail."',
                                                                PasswordEmail     =        '".$PasswordEmail."',
                                                                HotelID           =        '".$HotelID."',
                                                                Type              =        '".$Type."',
                                                                UrlApi            =        '".$UrlApi."',
                                                                Abilitato         =        '".$Abilitato."'
                                                    WHERE          Id =  ".$Id." AND idsito = ".$idsito;
                                                    $dbMysqli->query($update);

	}

?>
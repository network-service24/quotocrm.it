<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_sb'){

            $Id                = $_REQUEST['id'];
            $idsito            = $_REQUEST['idsito'];
            $Abilitato         = $_REQUEST['Abilitato'];
            $IdHotel           = $_REQUEST['IdHotel'];
            $UserHotel         = $_REQUEST['UserHotel'];
            $PasswordHotel     = $_REQUEST['PasswordHotel'];
            $UserProvider         = $_REQUEST['UserProvider'];
            $PasswordProvider    = $_REQUEST['PasswordProvider'];

            $update ="UPDATE hospitality_simplebooking SET IdHotel = '".$IdHotel."',UserHotel = '".$UserHotel."',PasswordHotel  = '".$PasswordHotel."',UserProvider   = '".$UserProvider."',PasswordProvider   = '".$PasswordProvider."', Abilitato = '".$Abilitato."' WHERE Id =  ".$Id." AND idsito = ".$idsito;
            $dbMysqli->query($update);

	}

?>
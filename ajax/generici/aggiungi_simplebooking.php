<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_sb'){

            $idsito            = $_REQUEST['idsito'];
            $Abilitato         = $_REQUEST['Abilitato'];
            $IdHotel           = $_REQUEST['IdHotel'];
            $UserHotel         = $_REQUEST['UserHotel'];
            $PasswordHotel     = $_REQUEST['PasswordHotel'];
            $UserProvider         = $_REQUEST['UserProvider'];
            $PasswordProvider    = $_REQUEST['PasswordProvider'];

            $insert ="INSERT INTO hospitality_simplebooking(idsito,IdHotel,UserHotel,PasswordHotel,UserProvider,PasswordProvider,Abilitato)  VALUES ('".$idsito."','".$IdHotel."','".$UserHotel."','".$PasswordHotel."','".$UserProvider."','".$PasswordProvider."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>
<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_sm'){

            $idsito                   = $_REQUEST['idsito'];
            $Abilitato                = $_REQUEST['Abilitato'];
            $SMTPAuth                 = $_REQUEST['SMTPAuth'];
            $SMTPHost                 = $_REQUEST['SMTPHost'];
            $SMTPPort                 = $_REQUEST['SMTPPort'];
            $SMTPSecure               = $_REQUEST['SMTPSecure'];
            $SMTPUsername             = $_REQUEST['SMTPUsername'];
            $SMTPPassword             = $_REQUEST['SMTPPassword'];
            $NumberSend               = $_REQUEST['NumberSend'];

            $insert ="INSERT INTO hospitality_smtp(idsito,SMTPAuth,SMTPHost,SMTPPort,SMTPSecure,SMTPUsername,SMTPPassword,NumberSend,Abilitato)  VALUES ('".$idsito."','".$SMTPAuth."','".$SMTPHost."','".$SMTPPort."','".$SMTPSecure."','".$SMTPUsername."','".$SMTPPassword."','".$NumberSend."','".$Abilitato."')";
            $dbMysqli->query($insert);

	}

?>
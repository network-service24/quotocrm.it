<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='mod_sm'){

            $Id                       = $_REQUEST['id'];
            $idsito                   = $_REQUEST['idsito'];
            $Abilitato                = $_REQUEST['Abilitato'];
            $SMTPAuth                 = $_REQUEST['SMTPAuth'];
            $SMTPHost                 = $_REQUEST['SMTPHost'];
            $SMTPPort                 = $_REQUEST['SMTPPort'];
            $SMTPSecure               = $_REQUEST['SMTPSecure'];
            $SMTPUsername             = $_REQUEST['SMTPUsername'];
            $SMTPPassword             = $_REQUEST['SMTPPassword'];
            $NumberSend               = $_REQUEST['NumberSend'];

            $update ="UPDATE hospitality_smtp SET   SMTPAuth       = '".$SMTPAuth."',
                                                    SMTPHost       =  '".$SMTPHost."',
                                                    SMTPPort       =  '".$SMTPPort."',
                                                    SMTPSecure     =  '".$SMTPSecure."',
                                                    SMTPUsername   =  '".$SMTPUsername."',
                                                    SMTPPassword   =  '".$SMTPPassword."',
                                                    NumberSend     =  '".$NumberSend."',
                                                    Abilitato      =  '".$Abilitato."'
                                                    WHERE          Id =  ".$Id." AND idsito = ".$idsito;
                                                    $dbMysqli->query($update);

	}

?>
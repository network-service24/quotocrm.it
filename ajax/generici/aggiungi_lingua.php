<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='add_lg'){

				$insert ="INSERT INTO hospitality_lingue_form(idsito,codlingua) VALUES ('".$_REQUEST['idsito']."','".$_REQUEST['codlingua']."')";
				$dbMysqli->query($insert);
	}

?>
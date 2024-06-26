<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='breadcrumb'){


            $idsito            = $_REQUEST['idsito'];
            $valore_breadcrumb = $_REQUEST['valore_breadcrumb'];

            $select ="SELECT * FROM hospitality_paginazione WHERE  idsito = ".$idsito;
            $res = $dbMysqli->query($select);
            if(sizeof($res)>0){
                $row = $res[0];
                $id  = $row['Id'];
                $update ="UPDATE hospitality_paginazione SET numero   = '".$valore_breadcrumb."' WHERE Id =  ".$id." AND idsito = ".$idsito;
                $dbMysqli->query($update);
            }else{
                $insert ="INSERT INTO hospitality_paginazione (idsito,numero) VALUES (".$idsito.",".$valore_breadcrumb.")";
                $dbMysqli->query($insert);
            }

	}

?>
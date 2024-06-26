<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


 	if($_REQUEST['action']=='associa'){

            $id_template = $_REQUEST['id_template'];
            $idsito      = $_REQUEST['idsito'];
            $id_infobox  = $_REQUEST['id_infobox'];

            $select ="SELECT hospitality_rel_infobox_template.Id FROM hospitality_rel_infobox_template WHERE idsito =  ".$idsito." AND id_template = ".$id_template." AND id_infobox = ".$id_infobox;
            $res = $dbMysqli->query($select);

            if(sizeof($res)>0){

                $IdRelazione = $res[0]['Id'];

                $delete ="DELETE FROM hospitality_rel_infobox_template WHERE Id = ".$IdRelazione;
                $dbMysqli->query($delete);

            }else{

                $insert ="INSERT INTO hospitality_rel_infobox_template (idsito,id_template,id_infobox) VALUES('".$idsito."','".$id_template."','".$id_infobox."')";
                $dbMysqli->query($insert);
            }


	}

?>
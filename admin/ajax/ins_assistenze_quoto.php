<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
            
    $idsito           = $_REQUEST['idsito'];
    $comunicazioni    = addslashes($_REQUEST['comunicazioni']);
    $data_inserimento = date('Y-m-d H:i:s');
        
    $select = "SELECT * FROM assistenze_quoto WHERE idsito = ".$idsito;
    $res = $dbMysqli->query($select);
    $tot = sizeof($res);
    if($tot>0){
        $update ="UPDATE assistenze_quoto SET comunicazioni = '".$comunicazioni."', data_inserimento = '".$data_inserimento."' WHERE idsito = ".$idsito;
        $dbMysqli->query($update);
    }else{
        $insert ="INSERT INTO assistenze_quoto(idsito,comunicazioni,data_inserimento) VALUES('".$idsito."','".$comunicazioni."','".$data_inserimento."')";
        $dbMysqli->query($insert);
    }


?>
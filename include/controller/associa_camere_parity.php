<?php
if($_REQUEST['azione'] != '' && $_REQUEST['param'] != ''){

    $update = "UPDATE hospitality_tipo_camere SET RoomParityId = ".($_REQUEST['azione']==0?'NULL':$_REQUEST['azione'])." WHERE Id = ".$_REQUEST['param']." AND idsito = ".IDSITO;
    $dbMysqli->query($update);


    header('Location:'.BASE_URL_SITO.'disponibilita-camere/');
}

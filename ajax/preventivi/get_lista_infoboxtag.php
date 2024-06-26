<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

$id_template = $_REQUEST['id_template'];
$idsito      = $_REQUEST['idsito'];


$select ="SELECT 
                hospitality_info_box.*
            FROM 
                hospitality_rel_infobox_template
            INNER JOIN
                hospitality_info_box ON hospitality_info_box.Id = hospitality_rel_infobox_template.id_infobox
            WHERE 
                hospitality_rel_infobox_template.idsito = ".$idsito."
            AND
                hospitality_info_box.idsito = ".$idsito."
            AND 
                hospitality_rel_infobox_template.id_template = ".$id_template."
            AND 
                hospitality_info_box.Abilitato = 1";
$res = $dbMysqli->query($select);
if(sizeof($res)>0){
    foreach($res as $key => $value){
        $infoBox .='<option value="'.$value['Id'].'" selected="selected">'.$value['Titolo'].'</option>';
    }
    

}else{
    $listaInfoBox = $fun->lista_infoBox($idsito);
    foreach($listaInfoBox as $key => $value){
        $infoBox .='<option value="'.$value['Id'].'">'.$value['Titolo'].'</option>';
    } 
}
echo $infoBox ;
?>
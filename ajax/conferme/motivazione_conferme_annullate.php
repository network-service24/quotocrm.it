<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$id = $_REQUEST['id'];
$idsito      = $_REQUEST['idsito'];

$query = 'SELECT hospitality_motivi_disdetta.* FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.IdRichiesta = ' . $id . ' AND hospitality_motivi_disdetta.idsito = ' . $idsito . ' ORDER BY hospitality_motivi_disdetta.id DESC';
$result = $dbMysqli->query($query);
$record = $result[0];

$valore = '<small>' . $record['Motivo'] . '<br>
                    ' . (strlen($record['MotivoCustom']) <= 30 ?
    $record['MotivoCustom'] :
    substr($record['MotivoCustom'], 0, 30) . '... <i class="fa fa-angle-down" id="more' . $id . '" style="position:absolute;margin-top:10px;cursor:pointer;"></i>
                        <div id="textmore' . $id . '" style="display:none">' . substr($record['MotivoCustom'], 30, 500) . '</div>
                    ') . '
                </small>';
$valore .= '<script>
                    $(document).ready(function(){
                        $("#more' . $id . '").on("click",function(){
                            $("#textmore' . $id . '").slideToggle("slow");
                        });
                    });
                </script>';
echo $valore;

?>

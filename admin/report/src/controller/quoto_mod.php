<?


    if ($_REQUEST['action'] == 'save') {

        $idsito                        = $_REQUEST['idsito'];
        $data_report                   = $_REQUEST['data_report'];
        $titolo_quoto                  = addslashes($_REQUEST['titolo_quoto']);
        $periodo_riferimento           = addslashes($_REQUEST['periodo_riferimento']);
        $preventivi_inviati            = addslashes($_REQUEST['preventivi_inviati']);
        $prenotazioni_chiuse           = addslashes($_REQUEST['prenotazioni_chiuse']);
        $tasso_conversione             = addslashes($_REQUEST['tasso_conversione']);
        $fatturato                     = addslashes($_REQUEST['fatturato']);
        $etichetta_fatturato_fonti     = addslashes(implode("#", $_REQUEST['etichetta_fatturato_fonti']));
        $valore_fatturato_fonti        = addslashes(implode("#", $_REQUEST['valore_fatturato_fonti']));
        $totale_fatturato_fonti        = addslashes($_REQUEST['totale_fatturato_fonti']);
        $etichetta_fatturato_sito      = addslashes(implode("#", $_REQUEST['etichetta_fatturato_sito']));
        $valore_fatturato_sito         = addslashes(implode("#", $_REQUEST['valore_fatturato_sito']));
        $totale_fatturato_sito         = addslashes($_REQUEST['totale_fatturato_sito']);
        $etichetta_fatturato_target    = addslashes(implode("#", $_REQUEST['etichetta_fatturato_target']));
        $valore_fatturato_target       = addslashes(implode("#", $_REQUEST['valore_fatturato_target']));
        $totale_fatturato_target       = addslashes($_REQUEST['totale_fatturato_target']);
        $etichetta_fatturato_operatori = addslashes(implode("#", $_REQUEST['etichetta_fatturato_operatori']));
        $valore_fatturato_operatori    = addslashes(implode("#", $_REQUEST['valore_fatturato_operatori']));
        $totale_fatturato_operatori    = addslashes($_REQUEST['totale_fatturato_operatori']);
        $dal                           = $_REQUEST['dal'];
        $al                            = $_REQUEST['al'];
        $testo_report_quoto            = addslashes($_REQUEST['testo_report_quoto']);

        $query_check = "SELECT * FROM report_clienti WHERE idsito = '".$idsito."' AND data_report = '".$data_report."'  AND quoto != 0 ";
        $res_check = $dbMysqli->query($query_check);
        $rec_check = $res_check[0];
        if(is_array($rec_check)) {
          if($rec_check > count($rec_check)) 
              $check = count($rec_check); 
        }else{
            $check = 0;
        }
  
        if($check == 0){


            $insert = "INSERT INTO report_quoto_dati (idsito,
                                                    data_report,
                                                    titolo_quoto,
                                                    periodo_riferimento,
                                                    dal,
                                                    al,
                                                    preventivi_inviati,
                                                    prenotazioni_chiuse,
                                                    tasso_conversione,
                                                    fatturato,
                                                    etichetta_fatturato_fonti,
                                                    valore_fatturato_fonti,
                                                    totale_fatturato_fonti,
                                                    etichetta_fatturato_sito,
                                                    valore_fatturato_sito,
                                                    totale_fatturato_sito,
                                                    etichetta_fatturato_target,
                                                    valore_fatturato_target,
                                                    totale_fatturato_target,
                                                    etichetta_fatturato_operatori,
                                                    valore_fatturato_operatori,
                                                    totale_fatturato_operatori,
                                                    testo_report_quoto
                                                    )
                                            VALUES('" . $idsito . "',
                                                '" . $data_report . "',
                                                '" . $titolo_quoto . "',
                                                '" . $periodo_riferimento . "',
                                                '" . $dal . "',
                                                '" . $al . "',
                                                '" . $preventivi_inviati. "',
                                                '" . $prenotazioni_chiuse. "',
                                                '" . $tasso_conversione. "',
                                                '" . $fatturato. "',
                                                '" . $etichetta_fatturato_fonti. "',
                                                '" . $valore_fatturato_fonti. "',
                                                '" . $totale_fatturato_fonti. "',
                                                '" . $etichetta_fatturato_sito. "',
                                                '" . $valore_fatturato_sito. "',
                                                '" . $totale_fatturato_sito. "',
                                                '" . $etichetta_fatturato_target. "',
                                                '" . $valore_fatturato_target. "',
                                                '" . $totale_fatturato_target. "',
                                                '" . $etichetta_fatturato_operatori. "',
                                                '" . $valore_fatturato_operatori. "',
                                                '" . $totale_fatturato_operatori. "',
                                                '" . $testo_report_quoto . "')";
        $insert_q = $dbMysqli->query($insert);

        $idreport = $dbMysqli->getInsertId($insert_q);

        $query_chk = "SELECT * FROM report_clienti WHERE idsito = '".$idsito."' AND data_report = '".$data_report."'";
        $res_chk   = $dbMysqli->query($query_chk);
        $rec_chk   = $res_chk[0];
        if(is_array($rec_chk)) {
          if($rec_chk > count($rec_chk)) 
              $chk = count($rec_chk); 
        }else{
            $chk = 0;
        }
        if($chk == 0){
          $insert2 = "INSERT INTO report_clienti(idsito,data_report,quoto) VALUES('".$idsito."','".$data_report."','".$idreport."')";
          $dbMysqli->query($insert2);
        }else{
          $update2 = "UPDATE report_clienti SET quoto = '".$idreport."' WHERE Id = ".$rec_chk['Id'];
          $dbMysqli->query($update2);
        }


    }else{

      $idreport = $rec_check['quoto'];


      $update = " UPDATE 
                    report_quoto_dati 
                  SET
                    titolo_quoto                  = '" . $titolo_quoto . "',
                    periodo_riferimento           = '" . $periodo_riferimento . "',
                    dal                           = '" . $dal . "',
                    al                            = '" . $al . "',
                    preventivi_inviati            = '" . $preventivi_inviati. "',
                    prenotazioni_chiuse           = '" . $prenotazioni_chiuse. "',
                    tasso_conversione             = '" . $tasso_conversione. "',
                    fatturato                     = '" . $fatturato. "',
                    etichetta_fatturato_fonti     = '" . $etichetta_fatturato_fonti. "',
                    valore_fatturato_fonti        = '" . $valore_fatturato_fonti. "',
                    totale_fatturato_fonti        = '" . $totale_fatturato_fonti. "',
                    etichetta_fatturato_sito      = '" . $etichetta_fatturato_sito. "',
                    valore_fatturato_sito         = '" . $valore_fatturato_sito. "',
                    totale_fatturato_sito         = '" . $totale_fatturato_sito. "',
                    etichetta_fatturato_target    = '" . $etichetta_fatturato_target. "',
                    valore_fatturato_target       = '" . $valore_fatturato_target. "',
                    totale_fatturato_target       = '" . $totale_fatturato_target. "',
                    etichetta_fatturato_operatori = '" . $etichetta_fatturato_operatori. "',
                    valore_fatturato_operatori    = '" . $valore_fatturato_operatori. "',
                    totale_fatturato_operatori    = '" . $totale_fatturato_operatori. "',
                    testo_report_quoto            = '" . $testo_report_quoto . "'
                  WHERE 
                    Id = '" .$idreport. "'
                  AND 
                    idsito = '" . $idsito . "'
                  AND 
                    data_report =  '" . $data_report . "'";
        
        $dbMysqli->query($update);


    }

        if (!file_exists(BASE_PATH_ADMIN."report/images/".$idsito."/")) { 
            mkdir(BASE_PATH_ADMIN."report/images/".$idsito."/",0755);
        }

        header('location:' . BASE_URL_ADMIN . 'report/quoto_mod/' . $_REQUEST['azione'] . '/' . $idsito . '/'.$idreport.'/');
}





    $select = "SELECT * FROM report_quoto_dati WHERE Id = ".$_REQUEST['valore'];
    $result = $dbMysqli->query($select);
    $row    = $result[0];

    $Id                  = $row['Id'];
    $idsito              = $row['idsito'];
    $Dal                 = $row['dal'];
    $Al                  = $row['al'];
    $data_report         = $row['data_report'];

    $periodo_riferimento = $row['periodo_riferimento'];
    $titolo_quoto        = $row['titolo_quoto'];
    $testo_report_quoto  = $row['testo_report_quoto'];

        $preventivi_inviati            = $row['preventivi_inviati'];
        $prenotazioni_chiuse           = $row['prenotazioni_chiuse'];
        $tasso_conversione             = $row['tasso_conversione'];
        $fatturato                     = $row['fatturato'];
        $etichetta_fatturato_fonti     = explode("#",$row['etichetta_fatturato_fonti']);
        $valore_fatturato_fonti        = explode("#",$row['valore_fatturato_fonti']);
        $totale_fatturato_fonti        = $row['totale_fatturato_fonti'];
        $etichetta_fatturato_sito      = explode("#",$row['etichetta_fatturato_sito']);
        $valore_fatturato_sito         = explode("#",$row['valore_fatturato_sito']);
        $totale_fatturato_sito         = $row['totale_fatturato_sito'];
        $etichetta_fatturato_target    = explode("#",$row['etichetta_fatturato_target']);
        $valore_fatturato_target       = explode("#",$row['valore_fatturato_target']);
        $totale_fatturato_target       = $row['totale_fatturato_target'];
        $etichetta_fatturato_operatori = explode("#",$row['etichetta_fatturato_operatori']);
        $valore_fatturato_operatori    = explode("#",$row['valore_fatturato_operatori']);
        $totale_fatturato_operatori    = $row['totale_fatturato_operatori'];

        if(!is_null($etichetta_fatturato_fonti) && !empty($etichetta_fatturato_fonti) && $etichetta_fatturato_fonti[0] != ''){

            foreach ($etichetta_fatturato_fonti as $key => $value) {
                            $td_fonti .= '<tr id="riga_fonti'.$key.'">
                                              <td class="col-md-6">
                                                  <input type="text" name="etichetta_fatturato_fonti[]"  class=" form-control no_border_input font20Bold text-center" value="'.$value.'" />
                                              </td>
                                              <td class="col-md-6">
                                                  <input type="text" name="valore_fatturato_fonti[]"  class=" form-control no_border_input font20Bold text-center" value="'.$valore_fatturato_fonti[$key].'" />
                                              </td>
                                              <td class="text-right">
                                                  <a href="javascript:;" id="del_fonti'.$key.'" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a>
                                              </td>
                                            </tr>';
                            $td_fonti .='<script>
                                            $(document).ready(function() {
                                                $("#del_fonti'.$key.'").click(function(){
                                                    $("#riga_fonti'.$key.'").remove();
                                                });
                                            });
                                            </script> '. "\r\n";

            }

            $td_fonti .= '<tr id="riga_tot_fonti"><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_fonti"  class=" form-control no_border_input font20Bold text-center" value="'.$totale_fatturato_fonti.'" /></td><td class="text-right"><a href="javascript:;" id="del_tot_fonti" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a></td></tr>';
            $td_fonti .='<script>
                            $(document).ready(function() {
                                $("#del_tot_fonti").click(function(){
                                    $("#riga_tot_fonti").remove();
                                });
                            });
                            </script> '. "\r\n";
        }

        if(!is_null($etichetta_fatturato_sito) && !empty($etichetta_fatturato_sito) && $etichetta_fatturato_sito[0] != ''){

            foreach ($etichetta_fatturato_sito as $key => $value) {
                            $td_provenienza .= '<tr id="riga_prov'.$key.'">
                                              <td class="col-md-6">
                                                  <input type="text" name="etichetta_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="'.$value.'" />
                                              </td>
                                              <td class="col-md-6">
                                                  <input type="text" name="valore_fatturato_sito[]"  class=" form-control no_border_input font20Bold text-center" value="'.$valore_fatturato_sito[$key].'" />
                                              </td>
                                              <td class="text-right">
                                                  <a href="javascript:;" id="del_prov'.$key.'" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a>
                                              </td>
                                            </tr>';
                            $td_provenienza .='<script>
                                            $(document).ready(function() {
                                                $("#del_prov'.$key.'").click(function(){
                                                    $("#riga_prov'.$key.'").remove();
                                                });
                                            });
                                            </script> '. "\r\n";
            }

            $td_provenienza .= '<tr id="riga_tot_prov"><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_sito"  class=" form-control no_border_input font20Bold text-center" value="'.$totale_fatturato_sito.'" /></td><td class="text-right"><a href="javascript:;" id="del_tot_prov" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a></td></tr>';
            $td_provenienza .='<script>
                            $(document).ready(function() {
                                $("#del_tot_prov").click(function(){
                                    $("#riga_tot_prov").remove();
                                });
                            });
                            </script> '. "\r\n";
        }

        if(!is_null($etichetta_fatturato_target) && !empty($etichetta_fatturato_target) && $etichetta_fatturato_target[0] != ''){

            foreach ($etichetta_fatturato_target as $key => $value) {
                            $td_target .= '<tr id="riga_targ'.$key.'">
                                              <td class="col-md-6">
                                                  <input type="text" name="etichetta_fatturato_target[]"  class=" form-control no_border_input font20Bold text-center" value="'.$value.'" />
                                              </td>
                                              <td class="col-md-6">
                                                  <input type="text" name="valore_fatturato_target[]"  class=" form-control no_border_input font20Bold text-center" value="'.$valore_fatturato_target[$key].'" />
                                              </td>
                                              <td class="text-right">
                                                  <a href="javascript:;" id="del_targ'.$key.'" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a>
                                              </td>
                                            </tr>';
                            $td_target .='<script>
                                            $(document).ready(function() {
                                                $("#del_targ'.$key.'").click(function(){
                                                    $("#riga_targ'.$key.'").remove();
                                                });
                                            });
                                            </script> '. "\r\n";
            }

            $td_target .= '<tr id="riga_tot_targ"><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_target"  class=" form-control no_border_input font20Bold text-center" value="'.$totale_fatturato_target.'" /></td><td class="text-right"><a href="javascript:;" id="del_tot_targ" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a></td></tr>';
            $td_target .='<script>
                            $(document).ready(function() {
                                $("#del_tot_targ").click(function(){
                                    $("#riga_tot_targ").remove();
                                });
                            });
                            </script> '. "\r\n";
        }

        if(!is_null($etichetta_fatturato_operatori) && !empty($etichetta_fatturato_operatori) && $etichetta_fatturato_operatori[0] != ''){

            foreach ($etichetta_fatturato_operatori as $key => $value) {
                            $td_operatori .= '<tr id="riga_op'.$key.'">
                                              <td class="col-md-6">
                                                  <input type="text" name="etichetta_fatturato_operatori[]"  class=" form-control no_border_input font20Bold text-center" value="'.$value.'" />
                                              </td>
                                              <td class="col-md-6">
                                                  <input type="text" name="valore_fatturato_operatori[]"  class=" form-control no_border_input font20Bold text-center" value="'.$valore_fatturato_operatori[$key].'" />
                                              </td>
                                              <td class="text-right">
                                                  <a href="javascript:;" id="del_op'.$key.'" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a>
                                              </td>
                                            </tr>';
                            $td_operatori .='<script>
                                            $(document).ready(function() {
                                                $("#del_op'.$key.'").click(function(){
                                                    $("#riga_op'.$key.'").remove();
                                                });
                                            });
                                            </script> '. "\r\n";
            }

            $td_operatori .= '<tr id="riga_tot_op"><td class="col-md-6 font20Bold text-center"><b>TOTALE</b></td><td class="col-md-6"><input type="text" name="totale_fatturato_operatori"  class=" form-control no_border_input font20Bold text-center" value="'.$totale_fatturato_operatori.'" /></td><td class="text-right"><a href="javascript:;" id="del_tot_op" title="Elimina questa riga" data-tooltip="tooltip"><i  class="fa fa-remove text-red"></i></a></td></tr>';
            $td_operatori .='<script>
                            $(document).ready(function() {
                                $("#del_tot_op").click(function(){
                                    $("#riga_tot_op").remove();
                                });
                            });
                            </script> '. "\r\n";
        }
        $script_legenda = ' <script>
                                    $(function() {
                                        $.notify({ 
                                            title:    \'LEGENDA\', 
                                            body:     \'I caratteri speciali: esempio <b>&euro;</b> oppure <b>%</b>, vengono introdotti nella stampa PDF, NON tentare di inserirli in questo step!\', 
                                            icon:     \'fa fa-exclamation-triangle\', 
                                            position: \'top-center\', 
                                            timeout: 3000,
                                            showTime: 100,
                                            forever: false
                                        }); 
                                    });
                                    $(document).ready(function(){
                                    scroll_to(\'posizione\', 10, 1000);
                                    });
                            </script>'."\r\n";


 if ($_REQUEST['action'] == 'modif') {


        $Id                            = $_REQUEST['Id'];
        $idsito                        = $_REQUEST['idsito'];
        $data_report                   = $_REQUEST['data_report'];
        $titolo_quoto                  = addslashes($_REQUEST['titolo_quoto']);
        $periodo_riferimento           = addslashes($_REQUEST['periodo_riferimento']);
        $dal                           = $_REQUEST['dal'];
        $al                            = $_REQUEST['al'];
        $testo_report_quoto            = addslashes($_REQUEST['testo_report_quoto']);

        $preventivi_inviati            = addslashes($_REQUEST['preventivi_inviati']);
        $prenotazioni_chiuse           = addslashes($_REQUEST['prenotazioni_chiuse']);
        $tasso_conversione             = addslashes($_REQUEST['tasso_conversione']);
        $fatturato                     = addslashes($_REQUEST['fatturato']);
        $etichetta_fatturato_fonti     = addslashes(implode("#", $_REQUEST['etichetta_fatturato_fonti']));
        $valore_fatturato_fonti        = addslashes(implode("#", $_REQUEST['valore_fatturato_fonti']));
        $totale_fatturato_fonti        = addslashes($_REQUEST['totale_fatturato_fonti']);
        $etichetta_fatturato_sito      = addslashes(implode("#", $_REQUEST['etichetta_fatturato_sito']));
        $valore_fatturato_sito         = addslashes(implode("#", $_REQUEST['valore_fatturato_sito']));
        $totale_fatturato_sito         = addslashes($_REQUEST['totale_fatturato_sito']);
        $etichetta_fatturato_target    = addslashes(implode("#", $_REQUEST['etichetta_fatturato_target']));
        $valore_fatturato_target       = addslashes(implode("#", $_REQUEST['valore_fatturato_target']));
        $totale_fatturato_target       = addslashes($_REQUEST['totale_fatturato_target']);
        $etichetta_fatturato_operatori = addslashes(implode("#", $_REQUEST['etichetta_fatturato_operatori']));
        $valore_fatturato_operatori    = addslashes(implode("#", $_REQUEST['valore_fatturato_operatori']));
        $totale_fatturato_operatori    = addslashes($_REQUEST['totale_fatturato_operatori']);

        $update = "UPDATE report_quoto_dati SET
                                  titolo_quoto                  = '" . $titolo_quoto . "',
                                  periodo_riferimento           = '" . $periodo_riferimento . "',
                                  dal                           = '" . $dal . "',
                                  al                            = '" . $al . "',
                                  preventivi_inviati            = '" . $preventivi_inviati. "',
                                  prenotazioni_chiuse           = '" . $prenotazioni_chiuse. "',
                                  tasso_conversione             = '" . $tasso_conversione. "',
                                  fatturato                     = '" . $fatturato. "',
                                  etichetta_fatturato_fonti     = '" . $etichetta_fatturato_fonti. "',
                                  valore_fatturato_fonti        = '" . $valore_fatturato_fonti. "',
                                  totale_fatturato_fonti        = '" . $totale_fatturato_fonti. "',
                                  etichetta_fatturato_sito      = '" . $etichetta_fatturato_sito. "',
                                  valore_fatturato_sito         = '" . $valore_fatturato_sito. "',
                                  totale_fatturato_sito         = '" . $totale_fatturato_sito. "',
                                  etichetta_fatturato_target    = '" . $etichetta_fatturato_target. "',
                                  valore_fatturato_target       = '" . $valore_fatturato_target. "',
                                  totale_fatturato_target       = '" . $totale_fatturato_target. "',
                                  etichetta_fatturato_operatori = '" . $etichetta_fatturato_operatori. "',
                                  valore_fatturato_operatori    = '" . $valore_fatturato_operatori. "',
                                  totale_fatturato_operatori    = '" . $totale_fatturato_operatori. "',
                                  testo_report_quoto            = '" . $testo_report_quoto . "'
                                WHERE Id = ".$Id;
        $dbMysqli->query($update);

        header('Location:' . BASE_URL_ADMIN . 'report/quoto_print/'.$_REQUEST['azione']. '/' . $idsito . '/'.$Id.'/');
    }


<?
    $select = "SELECT * FROM report_quoto_dati WHERE Id = " . $_REQUEST['valore'];
    $result = $dbMysqli->query($select);
    $row    = $result[0];


       $Id             = $row['Id'];
       $idsito         = $row['idsito'];
       $DataReport_    = explode("-", $row['data_report']);
       $DataReport     = $DataReport_[2]. '-' . $DataReport_[1] . '-' . $DataReport_[0];
       $Dal_           = explode("-", $row['dal']);
       $Dal            = $Dal_[2]. '/'.$Dal_[1]. '/' .$Dal_[0];
       $Al_            = explode("-", $row['al']);
       $Al             = $Al_[2]. '/' .$Al_[1]. '/' .$Al_[0];
       
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
                            $td_fonti .= '<tr>
                                            <td class="borderBottom height30 col50 font20 text-center">
                                                '.$value.'
                                            </td>
                                            <td class="borderBottom height30 col50 font20Bold text-center">
                                                &euro; '.$valore_fatturato_fonti[$key].'
                                            </td>
                                            </tr>';               
            }

            $td_fonti .= '<tr><td class="borderBottom height30 col50 font20Bold text-center"><b>TOTALE</b></td><td class="borderBottom height30 col50 font20Bold text-center">&euro; '.$totale_fatturato_fonti.'</td></tr>';

        }

        if(!is_null($etichetta_fatturato_sito) && !empty($etichetta_fatturato_sito) && $etichetta_fatturato_sito[0] != ''){
            
            foreach ($etichetta_fatturato_sito as $key => $value) {
                            $td_provenienza .= '<tr>
                                            <td class="borderBottom height30 col50 font20 text-center">
                                                '.$value.'
                                            </td>
                                            <td class="borderBottom height30 col50 font20Bold text-center">
                                                &euro; '.$valore_fatturato_sito[$key].'
                                            </td>
                                            </tr>';               
            }

            $td_provenienza .= '<tr><td class="borderBottom height30 col50 font20Bold text-center"><b>TOTALE</b></td><td class="borderBottom height30 col50 font20Bold text-center">&euro; '.$totale_fatturato_sito.'</td></tr>';

        }  
        
        if(!is_null($etichetta_fatturato_target) && !empty($etichetta_fatturato_target) && $etichetta_fatturato_target[0] != ''){
            
            foreach ($etichetta_fatturato_target as $key => $value) {
                            $td_target .= '<tr>
                                            <td class="borderBottom height30 col50 font20 text-center">
                                                '.$value.'
                                            </td>
                                            <td class="borderBottom height30 col50 font20Bold text-center">
                                               &euro; '.$valore_fatturato_target[$key].'
                                            </td>
                                            </tr>';               
            }

            $td_target .= '<tr><td class="borderBottom height30 col50 font20Bold text-center"><b>TOTALE</b></td><td class="borderBottom height30 col50 font20Bold text-center">&euro; '.$totale_fatturato_target.'</td></tr>';

        } 

        if(!is_null($etichetta_fatturato_operatori) && !empty($etichetta_fatturato_operatori) && $etichetta_fatturato_operatori[0] != ''){
            
            foreach ($etichetta_fatturato_operatori as $key => $value) {
                            $td_operatori .= '<tr>
                                            <td class="borderBottom height30 col50 font20 text-center">
                                                '.$value.'
                                            </td>
                                            <td class="borderBottom height30 col50 font20Bold text-center">
                                              &euro; '.$valore_fatturato_operatori[$key].'
                                            </td>
                                            </tr>';               
            }

            $td_operatori .= '<tr><td class="borderBottom height30 col50 font20Bold text-center"><b>TOTALE</b></td><td class="borderBottom height30 col50 font20Bold text-center">&euro; '.$totale_fatturato_operatori.'</td></tr>';

        }



ob_start();
$content .= '<style type="text/css">
            <!--
                table.page_header {width: 100%; border: none; background-color: #FFFFFF; padding: 0mm;}
                table.page_footer {width: 100%; border: none; background-color: #FFFFFF; padding: 0mm;}
                .font16{font-size:16px;}
                .font16Bold{font-size:16px;font-weight: bold}
                .font12{font-size:12px;}
                .blu{background-color: #073c6d;color:#FFFFFF;}
                .blu_top{background-color: #073c6d;color:#FFFFFF;}
                .font24Bold{font-size:20px;font-weight: bold;}
                .font22{ font-size:22px;}
                .font50{ font-size:50px;}
                .font20{ font-size:18px;}
                .font20Bold{font-size:18px;font-weight: bold;}
                .borderLeftTop{border-left:1px solid #2E74B5;border-top:1px solid #2E74B5;}
                .borderRightTopLeft{border-right:1px solid #2E74B5;border-left:1px solid #2E74B5;border-top:1px solid #2E74B5;}
                .borderBottomLeftRight{border-right: 1px  solid #2E74B5;border-left: 1px  solid #2E74B5;border-bottom: 1px  solid #2E74B5;}
                .borderBottom{border-bottom: 1px  solid #2E74B5;}
                .borderAll{border-top: 1px  solid #2E74B5;border-right: 1px  solid #2E74B5;border-left: 1px  solid #2E74B5;border-bottom: 1px  solid #2E74B5;}
                .NoborderAll{border: 0px;}
                .text-center{text-align:center;}
                .text-left{text-align:left;}
                .text-right{text-align:right;}
                .float-right{float:right;}
                .float-left{float:left;}
                .clear{clear:both;}
                .clear10{clear:both;height:10px;}
                .clear20{clear:both;height:20px;}
                .clear50{clear:both;height:50px;}
                .table100{width:100%;}
                .table92{width:92%;}
                .table90{width:90%;}
                .tableauto{width:auto;}
                .table101{width:101%;}
                .col33{width:33%;}
                .col32{width:32%;}
                .col35{width:35%;}
                .col22{width:21.5%;}
                .col16{width:16%;}
                .col12{width:12%;}
                .col4{width:4%;}
                .col25{width:25%;}
                .col50{width:50%;}
                .col65{width:65%;}
                .col60{width:60%;}
                .col40{width:40%;}
                .col70{width:70%;}
                .col75{width:75%;}
                .col100{width:100%;}
                .verticalAlignTop{vertical-align:top;}
                .verticalAlignMiddle{vertical-align:middle;}
                .text-white{color:#FFFFFF;}
                .text-black{color:#363636;}
                .text-green{color:#008000;}
                .text-red{color:#FF0000;}
                .text-orange{color:#ff851b;}
                .height30{height:30px;}
                .height40{height:40px;}
                .height60{height:60px;}
                .height200{height:200px;}
                .noWrap{white-space: nowrap;}
                .colorHR{border-top:4px solid; border-bottom:0px;color:#2E74B5;}
            -->
            </style>'."\r\n";
$content .='<page backtop="18mm" backbottom="15mm" backleft="0mm" backright="0mm" pagegroup="new">';
$content .='<page_header> 
             <table class="page_header">
                <tr>
                    <td class="text-left verticalAlignTop col33">
                         <img src="'.BASE_URL_ADMIN.'report/images/quoto.jpg" style="width:80%"/>
                    </td>                
                    <td class="text-right float-right verticalAlignTop"  style="width:65%">
                        <img src="'.BASE_URL_ADMIN.'report/images/logo_network_service_new.jpg" style="width:50%" />
                    </td>
                </tr>
            </table>
        </page_header> 
        <page_footer> 
        <table class="page_footer">
            <tr>
                <td class="text-left col100">
                    <!--<div align="center">Pagina  [[page_cu]] di [[page_nb]]</div>-->
                      <div class="col100 text-center">
                        <img src="'.BASE_URL_ADMIN.'report/images/linea_logo_network.jpg" style="width:750px;height:8px" />
                      </div> 
                      <br />
                        <div style="line-height:14px;font-size:11px"><b>Network Service srl</b> - Via L. e A. Valentini, 11 - 47922 Rimini (RN) - Tel. 0541.790062 / 793053 - Fax 0541.778656<br>
                        Reg.Impr.RN - P.I.: 04297510408 - REA 334661 - Cap.Soc.10.000,00<br>www.network-service.it - info@network-service.it</div>
                </td>
            </tr>
        </table>
        </page_footer>'."\r\n";                 
$content .='<table class="table101" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td class="blu_top height40 col100 text-white text-center">
                          <h1>'.$titolo_quoto.'</h1>
                        </td>
                      </tr>
                  </table>
                  <div class="clear20"></div>
                  <table class="table100" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="col100 text-left">
                      '.$periodo_riferimento.'
                         <div class="clear20"></div>
                          <span class=" font20Bold">'.$Dal.' - '.$Al.'</span>
                      </td>
                    </tr>                
                  </table>'."\r\n";
if(!is_null($preventivi_inviati) && !empty($preventivi_inviati) && $preventivi_inviati != ''){
    $content .=' <div class="clear20"></div>
                    <table class="table100 borderRightTopLeft" align="center" cellpadding="0" cellspacing="0">                                     
                        <tr>
                          <td class="blu height40 col25 font16Bold text-white text-center noWrap"><b>Preventivi Inviati</b></td>
                          <td class="blu height40 col25 font16Bold text-white text-center noWrap"><b>Prenotazioni Chiuse</b></td>
                          <td class="blu height40 col25 font16Bold text-white text-center noWrap"><b>Tasso di Conversione</b></td>
                          <td class="blu height40 col25 font16Bold text-white text-center noWrap"><b>Fatturato su Prenotazioni Chiuse</b></td>
                        </tr>
                        <tr>
                          <td class="borderBottom height30 col25 font20Bold text-center">'.$preventivi_inviati.'</td>
                          <td class="borderBottom height30 col25 font20Bold text-center">'.$prenotazioni_chiuse.'</td>
                          <td class="borderBottom height30 col25 font20Bold text-center">'.$tasso_conversione.'</td>
                          <td class="borderBottom height30 col25 font20Bold text-center">&euro; '.$fatturato.'</td>
                        </tr>                                          
                    </table>'."\r\n"; 
}
if(!is_null($etichetta_fatturato_fonti) && !empty($etichetta_fatturato_fonti) && $etichetta_fatturato_fonti[0] != ''){
     $content .=' <div class="clear20"></div>
                      <table class="table100" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="blu height40 col100 text-white font20Bold text-center">
                            Fatturato per Fonti di Prenotazione
                          </td>
                        </tr>
                    </table> 
                      <table class="table100 borderRightTopLeft" align="center" cellpadding="0" cellspacing="0">                                     
                          '.$td_fonti.'                                       
                      </table>'."\r\n";
}
if(!is_null($etichetta_fatturato_sito) && !empty($etichetta_fatturato_sito) && $etichetta_fatturato_sito[0] != ''){                  
     $content .=' <div class="clear20"></div>
                       <table class="table100" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="blu height40 col100 font20Bold text-white text-center">
                        Dettaglio del Fatturato per Fonte di Prenotazione Sito Web
                      </td>
                    </tr>
                </table>  
                <table class="table100 borderRightTopLeft" align="center" cellpadding="0" cellspacing="0">                                     
                    '.$td_provenienza.'                                       
                </table>'."\r\n";
}  
if(!is_null($etichetta_fatturato_target) && !empty($etichetta_fatturato_target) && $etichetta_fatturato_target[0] != ''){
       $content .='  <div class="clear20"></div> 
                      <table class="table100" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="blu height40 col100 font20Bold text-white text-center">
                            Fatturato per Target Clienti
                          </td>
                        </tr>
                    </table> 
                    <table class="table100 borderRightTopLeft" align="center" cellpadding="0" cellspacing="0">                                     
                        '.$td_target.'                                        
                    </table>'."\r\n"; 
}
if(!is_null($etichetta_fatturato_operatori) && !empty($etichetta_fatturato_operatori) && $etichetta_fatturato_operatori[0] != ''){
      $content .='  <div class="clear20"></div>
                      <table class="table100" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td class="blu height40 col100 font20Bold text-white text-center">
                              Fatturato per Operatori
                            </td>
                          </tr>
                      </table>  
                      <table class="table100 borderRightTopLeft" align="center" cellpadding="0" cellspacing="0">                                     
                          '.$td_operatori.'                                        
                      </table> '."\r\n";
}
$content .=' <div class="clear20"></div> 
                  <table class="table100">
                      <tr>
                        <td class="text-left">
                          '.$testo_report_quoto.'
                        </td>
                      </tr>
                  </table>'."\r\n";
$content .='</page>'."\r\n";

  // creazione della directory dedicata al cliente per deposito file
  if (!file_exists(BASE_PATH_ADMIN."report/document/".$_REQUEST['param']."/")) { 
    mkdir(BASE_PATH_ADMIN."report/document/".$_REQUEST['param']."/");
    chmod(BASE_PATH_ADMIN."report/document/".$_REQUEST['param']."/",0755);
  }

  $content .= ob_get_clean();
  $pagina = $_REQUEST['azione'].'_qto_'.$DataReport;

  require_once(BASE_PATH_SITO.'html2pdf-master/vendor/autoload.php');
  
  use Spipu\Html2Pdf\Html2Pdf;
  use Spipu\Html2Pdf\Exception\Html2PdfException;
  use Spipu\Html2Pdf\Exception\ExceptionFormatter;
  
  $html2pdf = new Html2Pdf('P', 'A4', 'it');

  $html2pdf->writeHTML(utf8_decode($content));
  $html2pdf->output(BASE_PATH_ADMIN.'report/document/'.$_REQUEST['param'].'/'.$pagina.'.pdf','F');
  
 $url = BASE_URL_ADMIN.'report/archivio/'.$_REQUEST['param'].'/'.$row['data_report'].'/';
 echo "<script language=\"javascript\">document.location='$url'</script>Se il tuo browser non supporta javascript clicca <a href=\"$url\">qui</a>";
//header('Location:'.BASE_URL_ADMIN.'report/archivio/'.$_REQUEST['param'].'/'.$row['data_report'].'/');
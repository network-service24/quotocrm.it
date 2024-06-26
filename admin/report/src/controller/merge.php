<?php


    $idsito       = $_REQUEST['param'];
    $data_report  = $_REQUEST['valore'];
    $nomesito     = $_REQUEST['azione'];

    $select = "SELECT nome FROM siti WHERE idsito = " . $idsito;
    $result = $dbMysqli->query($select);
    $record = $result[0];

    $nomecliente = $record['nome'];

    ob_start();
    $content .= '<style type="text/css">
                <!--
                    table.page_header {width: 100%; border: none; background-color: #FFFFFF; padding: 0mm;}
                    table.page_footer {width: 100%; border: none; background-color: #FFFFFF; padding: 0mm;}
                    .font16{font-size:16px;}
                    .blu{background-color: #073c6d;color:#FFFFFF;}
                    .font24Bold{font-size:20px;font-weight: bold;}
                    .font22{ font-size:22px;}
                    .font50{ font-size:50px;}
                    .font20{ font-size:18px;}
                    .font20Bold{font-size:18px;font-weight: bold;}
                    .borderLeftTop{border-left:1px solid #555555;border-top:1px solid #555555;}
                    .borderRightTopLeft{border-right:1px solid #555555;border-left:1px solid #555555;border-top:1px solid #555555;}
                    .borderBottomLeftRight{border-right: 1px  solid #555555;border-left: 1px  solid #555555;border-bottom: 1px  solid #555555;}
                    .borderBottom{border-bottom: 1px  solid #555555;}
                    .borderAll{border-top: 1px  solid #555555;border-right: 1px  solid #555555;border-left: 1px  solid #555555;border-bottom: 1px  solid #555555;}
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
                    .table101{width:101%;}
                    .col33{width:33%;}
                    .col32{width:32%;}
                    .col22{width:21.5%;}
                    .col4{width:4%;}
                    .col25{width:25%;}
                    .col50{width:50%;}
                    .col100{width:100%;}
                    .verticalAlignTop{vertical-align:top;}
                    .text-white{color:#FFFFFF;}
                    .text-black{color:#363636;}
                    .height30{height:30px;}
                    .height40{height:40px;}
                    .height60{height:60px;}
                    .height200{height:200px;}
                    .noWrap{white-space: nowrap;}
                    .colorHR{border-top:4px solid; border-bottom:0px;color:#2E74B5;}
                -->
                </style>' . "\r\n";
    $content .= '<page backtop="18mm" backbottom="15mm" backleft="0mm" backright="0mm" pagegroup="new">';
    
    $content .= '<page_header>
                 <table class="page_header">
                    <tr>
                        <td class="text-left verticalAlignTop col33">
                        </td>
                        <td class="text-right float-right verticalAlignTop"  style="width:65%">
                            <img src="' . BASE_URL_ADMIN . 'report/images/logo_network_service_new.jpg" style="width:50%" />
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
            </page_footer>' . "\r\n";
    
    $content .= '<div class="height200"></div>
                    <table class="table101" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td class="blu col100 text-white text-center">
                              <h1 class="font50">' . $nomecliente. '<br>' . $nomesito. '</h1>
                            </td>
                          </tr>
                      </table>
                      <div class="height40"></div>
                      <table class="table100" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td class="col100 font22 text-center">
                              Report - ' . $data_report . '
                            </td>
                          </tr>
                      </table>';
    $content .= '</page>' . "\r\n";

    $content .= ob_get_clean();

    $pagina = $nomesito.'_copertina_'.$data_report;
  

    require_once(BASE_PATH_ADMIN.'plugin/html2pdf-master/vendor/autoload.php');
  
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;
    
    $html2pdf = new Html2Pdf('P', 'A4', 'it');
    // $html2pdf->setDefaultFont('Tahoma');
    $html2pdf->writeHTML(utf8_decode($content));
    $html2pdf->output(BASE_PATH_ADMIN.'report/document/'.$idsito.'/'.$pagina.'.pdf','F');
    



    include BASE_PATH_ADMIN . 'report/PDFMerger/PDFMerger.php';

    $pdf = new PDFMerger;

    if (file_exists(BASE_PATH_ADMIN . "report/document/" . $idsito . "/" . $nomesito. '_copertina_' . $data_report . '.pdf')) {
        $pdf->addPDF(BASE_PATH_ADMIN . 'report/document/'.$idsito.'/'.$nomesito.'_copertina_'.$data_report.'.pdf', 'all');
    }
    
    if (file_exists(BASE_PATH_ADMIN . "report/document/" .$idsito . "/" . $nomesito. '_qto_' . $data_report . '.pdf')) {
        $pdf->addPDF(BASE_PATH_ADMIN . 'report/document/'.$idsito.'/'.$nomesito.'_qto_'.$data_report.'.pdf', 'all');
    } 

    if (file_exists(BASE_PATH_ADMIN . "report/document/" .$idsito . "/" . $nomesito. '_chiusura_' . $data_report . '.pdf')) {
        $pdf->addPDF(BASE_PATH_ADMIN . 'report/document/'.$idsito.'/'.$nomesito.'_chiusura_'.$data_report.'.pdf', 'all');
    } 

    $pdf->merge('file', BASE_PATH_ADMIN . 'report/document/'.$idsito.'/merge_'.$nomesito.'_'.$data_report.'.pdf');

    header('Location:' . BASE_URL_ADMIN . 'report/document/'.$idsito.'/merge_'.$nomesito.'_'.$data_report.'.pdf');


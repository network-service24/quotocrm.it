<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT'].'/include/function.inc.php');


$idsito      = $_REQUEST['idsito'];
$idPreno     = $_REQUEST['id_preno'];
$avatar      = $fun->logoSito($idsito);
$dati_hotel  = $fun->datiHotel($idsito);
$nome_hotel  = $dati_hotel['nome'];
$email_hotel = $dati_hotel['email'];
$dir_sito_   = $fun->nomeSito($idsito);
$sito_tmp    = str_replace("http://","",$dir_sito_);
$sito_tmp    = str_replace("www.","",$sito_tmp);
if($rows['https']==1){
    $http = 'https://';
}else{
    $http = 'http://';
}
$SitoWeb   = $http.'www.'.$sito_tmp;  
$dir_sito = str_replace(".it","",$sito_tmp);
$dir_sito = str_replace(".com","",$dir_sito);
$dir_sito = str_replace(".net","",$dir_sito);
$dir_sito = str_replace(".biz","",$dir_sito);
$dir_sito = str_replace(".eu","",$dir_sito);
$dir_sito = str_replace(".de","",$dir_sito);
$dir_sito = str_replace(".es","",$dir_sito);
$dir_sito = str_replace(".fr","",$dir_sito);

$qry  = "SELECT 
            hospitality_guest.* 
        FROM 
            hospitality_guest 
        INNER JOIN 
            hospitality_proposte 
        ON 
            hospitality_proposte.id_richiesta = hospitality_guest.Id
        WHERE 
            hospitality_guest.idsito = ".$idsito." 
        AND 
            hospitality_guest.Id = ".$idPreno." ";

$risultato = $dbMysqli->query($qry);
$value = $risultato[0];

$Id                 = $value['Id'];
$AccontoRichiesta   = $value['AccontoRichiesta'];
$AccontoLibero      = $value['AccontoLibero'];
$Operatore          = $value['ChiPrenota'];
$Nome               = stripslashes(ucfirst($value['Nome']));
$Cognome            = stripslashes(ucfirst($value['Cognome']));
$Email              = $value['Email'];
$Cellulare          = $value['Cellulare'];
$Lingua             = $value['Lingua'];
if($Lingua =='')      $Lingua = 'it';

$DataPreno_tmp      = explode("-",$value['DataChiuso']);
$DataPrenoCheck     = $value['DataChiuso'];
$DataPreno          = $DataPreno_tmp[2].'/'.$DataPreno_tmp[1].'/'.$DataPreno_tmp[0];   

$NumeroPrenotazione = $value['NumeroPrenotazione'];
$NumeroAdulti       = $value['NumeroAdulti'];
$NumeroBambini      = $value['NumeroBambini'];

$DataA_tmp          = explode("-",$rows['DataArrivo']);
$DataArrivo         = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
$DataP_tmp          = explode("-",$rows['DataPartenza']);
$DataPartenza       = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];


$start              = mktime(24,0,0,$DataA_tmp[1],$DataA_tmp[2],$DataA_tmp[0]);
$end                = mktime(01,0,0,$DataP_tmp[1],$DataP_tmp[2],$DataP_tmp[0]);
$formato="%a";
$Notti = dateDiff($rows['DataArrivo'],$rows['DataPartenza'],$formato);


$query = "SELECT 
            hospitality_proposte.Id                 as IdProposta,
            hospitality_proposte.Arrivo             as Arrivo,
            hospitality_proposte.Partenza           as Partenza,
            hospitality_proposte.NomeProposta       as NomeProposta,
            hospitality_proposte.TestoProposta      as TestoProposta,
            hospitality_proposte.CheckProposta      as CheckProposta,
            hospitality_proposte.PrezzoL            as PrezzoL,
            hospitality_proposte.PrezzoP            as PrezzoP,
            hospitality_proposte.AccontoPercentuale as AccontoPercentuale,
            hospitality_proposte.AccontoImporto     as AccontoImporto,
            hospitality_proposte.AccontoTariffa     as AccontoTariffa,
            hospitality_proposte.AccontoTesto       as AccontoTesto
        FROM 
            hospitality_proposte
        WHERE 
            hospitality_proposte.id_richiesta = ".$Id."
        GROUP BY 
            hospitality_proposte.Id";

    $ris = $dbMysqli->query($query);
    foreach($ris as $key => $record){

        $CheckProposta      = $record['CheckProposta'];                 
        $PrezzoL            = number_format($record['PrezzoL'],2,',','.');
        $PrezzoP            = number_format($record['PrezzoP'],2,',','.'); 
        $PrezzoPC           = $record['PrezzoP']; 
        $IdProposta         = $record['IdProposta'];  
        $NomeProposta       = stripslashes($record['NomeProposta']); 
        $TestoProposta      = stripslashes($record['TestoProposta']); 
        $AccontoPercentuale = $record['AccontoPercentuale'];
        $AccontoImporto     = $record['AccontoImporto'];
        $AccontoTariffa     = stripslashes($record['AccontoTariffa']); 
        $AccontoTesto       = stripslashes($record['AccontoTesto']); 
        $A_tmp              = explode("-",$record['Arrivo']);
        $A                  = $record['Arrivo'];
        $Arrivo             = $A_tmp[2].'/'.$A_tmp[1].'/'.$A_tmp[0];
        $P_tmp              = explode("-",$record['Partenza']);
        $P                  = $record['Partenza'];
        $Partenza           = $P_tmp[2].'/'.$P_tmp[1].'/'.$P_tmp[0];
        $Astart             = mktime(24,0,0,$A_tmp[1],$A_tmp[2],$A_tmp[0]);
        $Aend               = mktime(01,0,0,$P_tmp[1],$P_tmp[2],$P_tmp[0]);
        $formato="%a";
        $ANotti = dateDiff($record['Arrivo'],$record['Partenza'],$formato);

        if($PrezzoL!='0,00'){
            $percentuale_sconto =  str_replace(",00", "",number_format((100-(100*$record['PrezzoP'])/$record['PrezzoL']),2,',','.'));             
        }  

        if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
            $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
        }
        if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
            $saldo   = ($PrezzoPC-$AccontoLibero);
            $acconto = number_format($AccontoLibero,2,',','.');
        }

        if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
            $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
            $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
        }
        if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
            if($AccontoImporto >= 1) {
                $etichetta_caparra  = '';
            }else{
                $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
            }
            $saldo   = ($PrezzoPC-$AccontoImporto);
            $acconto = number_format($AccontoImporto,2,',','.');
        }
        if($PrezzoPC==$saldo){
            $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
        }else{
            $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
        }

    }

$select = " SELECT 
                hospitality_carte_credito.*
            FROM 
                hospitality_carte_credito
            WHERE 
                hospitality_carte_credito.id_richiesta = ".$idPreno." 
            AND 
                hospitality_carte_credito.idsito = ".$idsito." ";

$result       = $dbMysqli->query($select);
$check_cc     = sizeof($result);

if($check_cc > 0){
    $GiaPagatoCC = true;
}else{
    $GiaPagatoCC = false;
}

$select2 = " SELECT 
                hospitality_altri_pagamenti.*
            FROM 
                hospitality_altri_pagamenti
            WHERE 
                hospitality_altri_pagamenti.id_richiesta = ".$idPreno." 
            AND 
                hospitality_altri_pagamenti.idsito = ".$idsito." ";

$result2       = $dbMysqli->query($select2);
$check_pay     = sizeof($result2);

if($check_pay > 0){
    $GiaPagatoPAY = true;
}else{
    $GiaPagatoPAY = false;
}


$q  = " SELECT 
            hospitality_tipo_voucher_cancellazione.*
        FROM 
            hospitality_tipo_voucher_cancellazione 
        WHERE 
            hospitality_tipo_voucher_cancellazione.idsito = ".$idsito." 
        AND 
            hospitality_tipo_voucher_cancellazione.Abilitato = 1 ";

        $ris = $dbMysqli->query($q);

    foreach($ris as $key => $val){	
        $motiv .= '<option value="'.$val['Id'].'" data-id="'.$val['Id'].'">'.$val['Motivazione'].'</option>';
    }

    $qr  = "SELECT 
                hospitality_tipo_voucher_cancellazione.DataValidita,hospitality_tipo_voucher_cancellazione_lingua.*
            FROM 
                hospitality_tipo_voucher_cancellazione 
            INNER JOIN
                hospitality_tipo_voucher_cancellazione_lingua
            ON
                hospitality_tipo_voucher_cancellazione_lingua.motivazione_id = hospitality_tipo_voucher_cancellazione.Id
            WHERE 
                hospitality_tipo_voucher_cancellazione.idsito = ".$idsito." 
            AND 
                hospitality_tipo_voucher_cancellazione.Abilitato = 1
            AND
                hospitality_tipo_voucher_cancellazione_lingua.lingue = '".$Lingua."'
            AND 
                hospitality_tipo_voucher_cancellazione_lingua.idsito = ".$idsito." ";

    $risult = $dbMysqli->query($qr);
    $valore = $risult[0];


    echo'<style>
            #toolbar [data-wysihtml5-action] {
                float: right;
            }
            
            #toolbar{
                width: 920px;
                padding: 5px;
                -webkit-box-sizing: border-box;
                -ms-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
     
            .wysihtml5-command-active, .wysihtml5-action-active {
                font-weight: bold;
            }
            
            [data-wysihtml5-dialog] {
                margin: 5px 0 0;
                padding: 5px;
                border: 1px solid #666;
            }
            
            
            .wysihtml5-editor, .wysihtml5-editor table td {
                outline: 1px dotted #abc;
                
            }
            
            
            .toolbar {
                display: block;
                border-radius: 3px;
                border: 1px solid #fff;
                margin-bottom: 9px;
                line-height: 1em;
            }
            .toolbar a {
                display: inline-block;
                height: 1.5em;
                border-radius: 3px;
                font-size: 9px;
                line-height: 1.5em;
                text-decoration: none;
                background: #e1e1e1;
                border: 1px solid #ddd;
                padding: 0 0.2em;
                margin: 1px 0;
            }
            .toolbar a.wysihtml5-command-active, .toolbar .wysihtml5-action-active {
                background: #222;
                color: white;
            }
            .toolbar .block { 
                padding: 1px 1px;
                display: inline-block;
                background: #eee;
                border-radius: 3px;
                margin: 0px 1px 1px 0;
            }

            .editor-container-tag {
                padding: 5px 10px;
                position: absolute;
                color: white;
                background: rgba(0,0,0,0.8);
                width: 100px;
                margin-left: -50px;
                -webkit-transition: 0.1s left, 0.1s top;
            }

        </style>
        <script src="'.BASE_URL_SITO.'plugin/wysihtml-0.5.5/parser_rules/advanced_and_extended.js"></script>
        <script src="'.BASE_URL_SITO.'plugin/wysihtml-0.5.5/dist/wysihtml-toolbar.min.js"></script>
        <script type="text/javascript">

            function htmlarea(){
                var editors = [];

                $(\'.ewrapper\').each(function(idx, wrapper) {
                    var e = new wysihtml5.Editor($(wrapper).find(\'.editable\').get(0), {
                        toolbar:        $(wrapper).find(\'.toolbar\').get(0),
                        parserRules:    wysihtml5ParserRules,
                    });
                    editors.push(e);
                });
  
            }

            $(document).ready(function(){
                    $(\'[data-toogle="tooltip"]\').tooltip();
                    $(\'[data-tooltip="tooltip"]\').tooltip();
            });
            $(function() {

                $("#op_voucher'.$idPreno.'").modal("show");    
    
                $(\'#tag_voucher'.$idPreno.'\').on("change",function() {   

                    $("#send_email_voucher_rec'.$idPreno.'").remove();

                    var idmotivazione          =  $(\'#tag_voucher'.$idPreno.' option:selected\').data(\'id\');
                    var idsito                 = '.$idsito.';
                    var lingua                 = "'.$Lingua.'";
                    var hotel                  = "'.$nome_hotel.'";
                    var acconto                = "'.$acconto.'";
                    var data_valid             = "'.gira_data($valore['DataValidita']).'";
                    var cliente                = "'.$Nome.' '.$Cognome.'";
                    var avatar                 = "'.$avatar.'";
                    var idpreno                = '.$idPreno.';
                    var NumeroPrenotazione     = '.$NumeroPrenotazione.';
                    var dir_sito               = "'.$dir_sito.'";
                    var email_hotel            = "'.$email_hotel.'";



                    if(idmotivazione != 0){

                        $.ajax({        
                            type: "POST",         
                            url: "'.BASE_URL_SITO.'ajax/sendmail/descr_voucher_recupero.php",        
                            data: "idmotivazione=" + idmotivazione + "&idsito=" + idsito + "&lingua=" + lingua + "&hotel=" + hotel + "&acconto=" + acconto + "&data_valid=" + data_valid + "&cliente=" + cliente + "&idpreno=" + idpreno + "&avatar=" + avatar + "&dir_sito=" + dir_sito + "&email_hotel=" + email_hotel + "&NumeroPrenotazione=" + NumeroPrenotazione,
                            dataType: "html",
                            success: function(data){

                             
                                $("#re_send_email_voucher_rec'.$idPreno.'").html(\'<textarea id="send_email_voucher_rec'.$idPreno.'" class="editable" name="testo_voucher_rec"  style="width:100%!important;height:450px!important;"></textarea>\');
                                
                                var contenuto_ = data.split("^");
                                var oggetto    = contenuto_[0];
                                var contenuto  = contenuto_[1];

                                setTimeout(function(){ 
                                    htmlarea();
                                }, 1000)

                                $("#oggetto'.$idPreno.'").val(oggetto);
                                $("#send_email_voucher_rec'.$idPreno.'").val(contenuto);
                              

                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare..."); 
                            }
                        });

                    }

                }); 


            });
        </script> 
        <!-- modale per invio email per voucher di recupero -->
        <div class="modal fade" id="op_voucher'.$idPreno.'"  role="dialog" aria-labelledby="myop_voucher">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myemail_upselling">Invia email per variazione date soggiorno e motiva l\'emissione di un buono voucher!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">


                            <form id="form_voucher_rec'.$idPreno.'" name="form_voucher_rec" method="post" class="ewrapper">
                            <p>Sceglie tra la <b>lista dei Tag</b> di motivazione per caricare automaticamente il testo pre-compilato!</p>
                                <div class="form-group">
                                    <label>Lista dei TAG di motivazione <small class="text-maroon">(pre-compilati)</small></label>
                                        <select id="tag_voucher'.$idPreno.'" name="tag_voucher" class="form-control no_border_top_dx bold" required>
                                            <option value="" data-id="0">--</option>
                                            '.$motiv.' 
                                        </select>
                                </div>  
                                <div class="control-group">
                                <label>Data scadenza del buono voucher <i class="fa fa-info-circle text-info" data-toggle="tooltip" title="La data di scadenza sarà visibile solo dopo l\'invio e non nell\'anteprima"></i></label>
                                        <div class="input-group">
                                            <label for="DataValiditaVoucher" class="input-group-addon btn">
                                                <span class="fa fa-calendar"></span>
                                            </label>
                                            <input id="DataValiditaVoucher'.$idPreno.'" name="DataValiditaVoucher"  type="date" class="form-control" autocomplete="off" required>
                                        </div>                                    
                                    </div>
                               <br>                        
                                <div class="form-group">
                                    <label>Oggetto E-mail   &nbsp;&nbsp;&nbsp;&nbsp;<small class="text-maroon">se non si utilizza l\'oggetto pre-compilato è possibile usare questi short_tag: [cliente] e [numeropreno]</small></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"  data-toogle="tooltip" title="Inserire un oggetto"><i class="fa fa-fw fa-pencil"></i></span>
                                        <input type="text" id="oggetto'.$idPreno.'" name="oggetto" placeholder="Oggetto: [cliente], [numeroPreno]" class="form-control no_border_top_dx bold"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">	
                                        <div class="col-md-9 text-right">&nbsp;</div>
                                        <div class="col-md-3 text-center">
                                            <small>Anteprima Voucher <i class="fa fa-info-circle text-info" data-toggle="tooltip" title="La data di scadenza sarà visibile solo dopo l\'invio e non nell\'anteprima"></i></small>
                                            <br>
                                                <a href="'.BASE_URL_LANDING.$dir_sito.'/'.base64_encode($idPreno.'_'.$idsito.'_c').'/voucher_rec/" target="_blank" class="btn btn-default btn-xs"  title="Anteprima Voucher" data-toogle="tooltip"><i class="fa fa-eye"></i></a>
                                        </div>     
                                    </div>
                                    <label>Contenuto E-mail</label>	
                                    <div class="alert alert-profila alert-default-profila alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <small class="text-maroon">Se non si utilizza un testo pre-compilato si possono utilizzare alcuni short_tag!</small>
                                        <br>
                                        <small class="text-maroon">ESEMPIO: [cliente], [caparra], [numeropreno], [emailhotel], [linkvoucher] e [struttura]</small>

                                        </div>	
                                    <div class="toolbar" style="display: none;">
                                        <a data-wysihtml5-command="bold" title="CTRL+B">Bold</a> |
                                        <a data-wysihtml5-command="italic" title="CTRL+I">Italic</a> |
                                        <a data-wysihtml5-command="createLink">Link</a> |
                                        <a data-wysihtml5-command="removeLink"><s>Link</s></a> |
  
                                        <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">h1</a> |
                                        <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2">h2</a> |

                                        <a data-wysihtml5-command="insertUnorderedList">Lista default</a> |
                                        <a data-wysihtml5-command="insertOrderedList">Lista numerata</a> |

                                        <a data-wysihtml5-command="undo">Undo</a> |
                                        <a data-wysihtml5-command="redo">Redo</a> |

                                        <a data-wysihtml5-action="change_view">switch to html</a>
                                        
                                        <div data-wysihtml5-dialog="createLink" style="display: none;">
                                        <label>
                                            Link:
                                            <input data-wysihtml5-dialog-field="href" value="http://">
                                        </label>
                                        <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                        </div>
                                        
                                        
                                    </div>
                                    <div id="re_send_email_voucher_rec'.$idPreno.'"></div>						
                                    <textarea id="send_email_voucher_rec'.$idPreno.'" name="testo_voucher_rec" class="editable" style="width:100%!important;height:300px!important;"></textarea>
                                  
                                        <input type="hidden" name="id_prenotazione" value="'.$idPreno.'">
                                        <input type="hidden" name="NumeroPrenotazione" value="'.$NumeroPrenotazione.'">
                                        <input type="hidden" name="action" value="send_email_voucher_rec">
                                </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 text-center"></div>
                                            <div class="col-md-4 text-center"><button type="button" id="button_send'.$idPreno.'" class="btn btn-primary">Invia email e link voucher</button></div>
                                            <div class="col-md-4 text-right"></div>
                                        </div>
                                    </div>
                            </form>  
                            <script>
                                $(document).ready(function(){
                                    $("#button_send'.$idPreno.'").on("click",function(){

                                        var idsito                 = '.$idsito.';
                                        var tag_voucher            = $(\'#tag_voucher'.$idPreno.' option:selected\').data(\'id\');;
                                        var DataValiditaVoucher    = $("#DataValiditaVoucher'.$idPreno.'").val();
                                        var id_prenotazione        = '.$idPreno.';
                                        var NumeroPrenotazione     = '.$NumeroPrenotazione.';
                                        var oggetto                = $("#oggetto'.$idPreno.'").val();
                                        var testo_voucher_rec      = $("#send_email_voucher_rec'.$idPreno.'").val();
                                        $.ajax({        
                                            type: "POST",         
                                            url: "'.BASE_URL_SITO.'ajax/sendmail/esec_mail_voucher_rec.php",        
                                            data: "action=send_email_voucher_rec&idsito=" + idsito + "&tag_voucher=" + tag_voucher + "&DataValiditaVoucher=" + DataValiditaVoucher + "&id_prenotazione=" + id_prenotazione + "&oggetto=" + oggetto + "&testo_voucher_rec=" + testo_voucher_rec + "",
                                            dataType: "html",
                                            success: function(data){
                                                $("#op_voucher'.$idPreno.'").modal("hide"); 
                                                document.location="'.BASE_URL_SITO.'buoni_voucher/";
                                            }
                                        });
                                    });

                                });
                            </script>                                                                                                   
                        </div>
                    </div>
                </div>
            </div>
        </div>';

?>
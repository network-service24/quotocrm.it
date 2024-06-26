<?php
include($_SERVER['DOCUMENT_ROOT']."/v2/include/settings.inc.php");
include(BASE_PATH_SITO.'include/function.inc.php');
 //error_reporting(0); 
$username   = DB_USER;
$password   = DB_PASSWORD;
$host       = HOST;
$dbname     = DATABASE;

$conn = mysqli_connect($host, $username, $password, $dbname) or die ("Error connecting to database");
mysqli_set_charset($conn, 'utf8');

$idsito      = $_REQUEST['idsito'];
$idPreno     = $_REQUEST['id_preno'];
$avatar      = $_REQUEST['avatar'];
$nome_hotel  = urldecode($_REQUEST['nome_hotel']);
$email_hotel = urldecode($_REQUEST['email_hotel']);
$dir_sito    = urldecode($_REQUEST['dir_sito']);

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

$risultato = mysqli_query($conn,$qry);
$value = mysqli_fetch_assoc($risultato);

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

    $ris = mysqli_query($conn,$query);
    while($record = mysqli_fetch_assoc($ris)){

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

$result       = mysqli_query($conn,$select);
$check_cc     = mysqli_num_rows($result);

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

$result2       = mysqli_query($conn,$select2);
$check_pay     = mysqli_num_rows($result2);

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

        $ris = mysqli_query($conn,$q);

    while($val = mysqli_fetch_assoc($ris)){	
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

    $risult = mysqli_query($conn,$qr);
    $valore = mysqli_fetch_assoc($risult);


    echo'<script type="text/javascript">
            $(document).ready(function(){
                    $(\'[data-toogle="tooltip"]\').tooltip();
                    $(\'[data-tooltip="tooltip"]\').tooltip();
            });
            $(function() {

                $("#op_voucher'.$idPreno.'").modal("show");    
    
                $(\'#tag_voucher'.$idPreno.'\').on("change",function() {   

                    var idmotivazione          =  $(\'#tag_voucher'.$idPreno.' option:selected\').data(\'id\');
                    var idsito                 = '.$idsito.';
                    var lingua                 = "'.$Lingua.'";
                    var hotel                  = "'.urlencode($nome_hotel).'";
                    var acconto                = "'.urlencode($acconto).'";
                    var data_valid             = "'.gira_data($valore['DataValidita']).'";
                    var cliente                = "'.urlencode($Nome.' '.$Cognome).'";
                    var avatar                 = "'.urlencode($avatar).'";
                    var idpreno                = '.$idPreno.';
                    var NumeroPrenotazione     = '.$NumeroPrenotazione.';
                    var dir_sito               = "'.urlencode($dir_sito).'";
                    var email_hotel            = "'.urlencode($email_hotel).'";

                    if(idmotivazione != 0){

                        $.ajax({        
                            type: "POST",         
                            url: "'.BASE_URL_SITO.'ajax/descr_voucher_recupero.php",        
                            data: "idmotivazione=" + idmotivazione + "&idsito=" + idsito + "&lingua=" + lingua + "&hotel=" + hotel + "&acconto=" + acconto + "&data_valid=" + data_valid + "&cliente=" + cliente + "&idpreno=" + idpreno + "&avatar=" + avatar + "&dir_sito=" + dir_sito + "&email_hotel=" + email_hotel + "&NumeroPrenotazione=" + NumeroPrenotazione,
                            dataType: "html",
                            success: function(data){

                                var contenuto_ = data.split("^");
                                var oggetto    = contenuto_[0];
                                var contenuto  = contenuto_[1];

                                if($("#send_email_voucher_rec'.$idPreno.'").text() != \'\'){
                                    $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'.wysihtml5-toolbar\').remove();
                                    $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'iframe\').remove();
                                    $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'input[name*="wysihtml5"]\').remove();
                                    $("#send_email_voucher_rec'.$idPreno.'").parent().find(\'textarea\').remove();
                                    $("#re_send_email_voucher_rec'.$idPreno.'").html(\'<textarea id="send_email_voucher_rec'.$idPreno.'" name="testo_voucher_rec" class="form-control" style="width:100%!important;height:450px!important;"></textarea>\');
             
                                    $("#oggetto'.$idPreno.'").val(oggetto);
                                    $("#send_email_voucher_rec'.$idPreno.'").text(contenuto);
                                }else{
                                    $("#oggetto'.$idPreno.'").val(oggetto);
                                    $("#send_email_voucher_rec'.$idPreno.'").text(contenuto);
                                }

                                setTimeout(function(){ 
                                    $("#send_email_voucher_rec'.$idPreno.'").wysihtml5();
                                }, 1000)
                            },
                            error: function(){
                                alert("Chiamata fallita, si prega di riprovare..."); 
                            }
                        });

                    }else{
                        $("#oggetto'.$idPreno.'").val(\'\');
                        $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'.wysihtml5-toolbar\').remove();
                        $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'iframe\').remove();
                        $(\'#send_email_voucher_rec'.$idPreno.'\').parent().find(\'input[name*="wysihtml5"]\').remove();
                        $("#send_email_voucher_rec'.$idPreno.'").parent().find(\'textarea\').remove();
                        $("#re_send_email_voucher_rec'.$idPreno.'").html(\'<textarea id="send_email_voucher_rec'.$idPreno.'" name="testo_voucher_rec" class="form-control" style="width:100%!important;height:450px!important;"></textarea>\');
                    }

                }); 

                $("#html").prop("disabled",true);  
                $("#html2").prop("disabled",false);                                                                                                                                                    
             
            
                    $( "#html" ).click(function() { 
                        $(this).prop("disabled",true);  
                        $("#html2").prop("disabled",false);                                                                                                                                                    
                        $("#send_email_voucher_rec'.$idPreno.'").wysihtml5();                                                                                
                    });
                            
                    $( "#html2" ).click(function() {
                        $(this).prop("disabled",true);
                        $("#html").prop("disabled",false);
                            var content = $(\'#send_email_voucher_rec'.$idPreno.'\');
                            var contentPar = content.parent();
                            contentPar.find(\'.wysihtml5-toolbar\').remove();
                            contentPar.find(\'iframe\').remove();
                            contentPar.find(\'input[name*="wysihtml5"]\').remove();
                            content.show();                                                                                                                                
                    });

            });
        </script> 
        <!-- modale per invio email per voucher di recupero -->
        <div class="modal fade" id="op_voucher'.$idPreno.'"  role="dialog" aria-labelledby="myop_voucher">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myemail_upselling">Invia email per variazione date soggiorno e motiva l\'emissione di un buono voucher!</h4>
                    </div>
                    <div class="modal-body">

                        <link rel="stylesheet" href="'.BASE_URL_SITO.'plugins/datepicker/datepicker3.css">
                        <script src="'.BASE_URL_SITO.'plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
                        <script src="'.BASE_URL_SITO.'plugins/datepicker/locales/bootstrap-datepicker.it.js" type="text/javascript"></script>

                            <form id="form_voucher_rec'.$idPreno.'" name="form_voucher_rec" method="post"  action="'.BASE_URL_SITO.'esec_mail_voucher_rec/">
                            <p>Sceglie tra la <b>lista dei Tag</b> di motivazione per caricare automaticamente il testo pre-compilato!</p>
                                <div class="form-group">
                                    <label>Lista dei TAG di motivazione <small class="text-maroon">(pre-compilati)</small></label>
                                        <select id="tag_voucher'.$idPreno.'" name="tag_voucher" class="form-control no_border_top_dx bold" required>
                                            <option value="" data-id="0">--</option>
                                            '.$motiv.' 
                                        </select>
                                </div>  
                                <div class="control-group">
                                <label>Data scadenza del buono voucher</label>
                                        <div class="input-group">
                                            <label for="DataValiditaVoucher" class="input-group-addon btn">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </label>
                                            <input id="DataValiditaVoucher'.$idPreno.'" name="DataValiditaVoucher"  type="text" class="form-control hasDatepicker" autocomplete="off" required>
                                        </div>                                    
                                    </div>
                                    <style>.ui-datepicker{z-index:99999!important;}</style>
                                    <script>
                                        $(function() {
                                            $( "#DataValiditaVoucher'.$idPreno.'" ).datepicker({
                                                    numberOfMonths: 1,
                                                    language:\'it\',
                                                    showButtonPanel: true
                                                });
                                            });
                                    </script>
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
                                   <div class="col-md-1 text-center"><small>VOUCHER</small><br><a href="'.BASE_URL_SITO.'anteprima_voucher_rec/'.$idPreno.'" class="btn btn-default btn-xs"  title="Anteprima Voucher" data-toogle="tooltip"><i class="fa fa-bed"></i></a></div>
                                        <div class="col-md-1 text-center">
                                            <small>HTML</small><br>
                                            <button type="button" class="btn btn-default btn-xs" id="html" title="Abilita HtmlArea" data-toogle="tooltip"><i class="fa fa-html5"></i></button>
                                        </div>
                                        <div class="col-md-1 text-center">
                                            <small>CODE</small><br>
                                            <button type="button" class="btn btn-default btn-xs" id="html2" title="Disabilita HtmlArea" data-toogle="tooltip"><i class="fa fa-code"></i></button>
                                        </div>
                                    </div>
                                    <label>Contenuto E-mail</label>	
                                    <div class="alert alert-profila alert-default-profila alert-dismissable text-center">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <small class="text-maroon">Se non si utilizza un testo pre-compilato si possono utilizzare alcuni short_tag!</small>
                                        <br>
                                        <small class="text-maroon">ESEMPIO: [cliente], [caparra], [numeropreno], [emailhotel], [linkvoucher] e [struttura]</small>

                                        </div>
                                    <div id="re_send_email_voucher_rec'.$idPreno.'"></div>									
                                    <textarea id="send_email_voucher_rec'.$idPreno.'" name="testo_voucher_rec" class="form-control" style="width:100%!important;height:300px!important;"></textarea>

                                        <input type="hidden" name="idsito" value="'.$idsito.'">
                                        <input type="hidden" name="id_prenotazione" value="'.$idPreno.'">
                                        <input type="hidden" name="NumeroPrenotazione" value="'.$NumeroPrenotazione.'">
                                        <input type="hidden" name="action" value="send_email_voucher_rec">
                                </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4 text-center"></div>
                                            <div class="col-md-4 text-center"><button type="submit" id="button_send" class="btn btn-primary">Invia email e link voucher</button></div>
                                            <div class="col-md-4 text-right"><div class="clearfix"></div><button type="button" class="btn btn-xs bg-black" data-dismiss="modal">Chiudi</button></div>
                                        </div>
                                    </div>
                            </form>                                                                                                           
                        </div>
                    </div>
                </div>
            </div>
        </div>';

?>
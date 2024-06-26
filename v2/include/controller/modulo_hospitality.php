<?php
$js_Check_email ='
<script>
/* check sul campo email in tempo reale, se email esiste CNAME */
    $( document ).ready(function() {
        $("#bottone_salva").attr("disabled","true");
        if($(\'#Email\').val() != \'\'){
            var EmailCliente = $(\'#Email\').val().trim();
            var EmailOperatore = \''.$EmailOperatoreDefault.'\';
            if(EmailCliente.length>=2){
                $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",
                    success: function(data){
                        var classe = \'\';
                        if(data == \'valid\'){
                            $("#check_email").html(\'<small class="text-green">dominio email valido ed esistente</small>\');
                            $("#bottone_salva").removeAttr("disabled");
                        }else{
                            $("#check_email").html(\'<small class="text-red">dominio email non valido ed inesistente</small>\');
                            $("#bottone_salva").attr("disabled","true");
                        }

                    },
                    error: function(){
                        alert("Chiamata fallita, si prega di riprovare...");
                    }
                });
            }else{
                $("#bottone_salva").removeAttr("disabled");
            }
        }

            $("#Email").bind("keyup focusout mouseenter", function () {
                var EmailCliente = $("#Email").val().trim();
                var EmailOperatore = "'.$EmailOperatoreDefault.'";
                if(EmailCliente.length>=2){
                    $.ajax({
                    type: "POST",
                    url: "'.BASE_URL_SITO.'ajax/check_valid_email.php",
                    data: "EmailCliente=" + EmailCliente + "&EmailOperatore=" + EmailOperatore,
                    dataType: "html",
                        success: function(data){
                            var classe = "";
                            if(data == "valid"){
                                $("#check_email").html(\'<small class="text-green">dominio email valido ed esistente</small>\');
                                $("#bottone_salva").removeAttr("disabled");
                            }else{
                                $("#check_email").html(\'<small class="text-red">dominio email non valido ed inesistente</small>\');
                                $("#bottone_salva").attr("disabled","true");
                            }

                        },
                        error: function(){
                            alert("Chiamata fallita, si prega di riprovare...");
                        }
                    });
                }else{
                    $("#bottone_salva").removeAttr("disabled");
                }
            });

    });
</script>'."\r\n";

$js_target_template ='
<script>
    $( document ).ready(function() {
        $("#TipoVacanza").on("change",function(){
            var tipovacanza = $("#TipoVacanza").val().toLowerCase();   
            $("#id_template option").each(function(){
                if(tipovacanza == $(this).text()){
                    $(this).attr("selected",true);
                }else{
                    $(this).attr("selected",false);
                }
            });
            $("div.thumbnail").each(function(){
                var text_div = $(this).text();
                var text = text_div.split(" ");
                var divtext = text[1].toLowerCase();
                if(tipovacanza == divtext){
                    $(this).addClass("selected");
                }else{
                    $(this).removeClass("selected");
                }
            });
        });
    });
</script>'."\r\n";

    $select_nomi = "SELECT Nome,Cognome,Email,Cellulare FROM hospitality_guest WHERE hospitality_guest.idsito = ".IDSITO." AND (hospitality_guest.Nome LIKE '%" . addslashes($_REQUEST['Nome']) . "%' OR hospitality_guest.Cognome LIKE '%" . addslashes($_REQUEST['Cognome']) . "%')";
    $risultato   = $db->query($select_nomi);
    $record      = $db->result($risultato);

    foreach ($record as $key => $row) {
        if($row['Nome']!='' || $row['Cognome']!=''){
            $lista_nomi[] = "'".addslashes(trim($row['Nome'])).($row['Cognome']!=""?" ".addslashes(trim($row['Cognome'])):"").($row['Email']!=""?", ".trim($row['Email']):"").($row['Cellulare']!=""?", ".addslashes(trim($row['Cellulare'])):"")."'";
        }
    }

    if (is_array($lista_nomi)) {
        $lista_nomi = implode(',', $lista_nomi);
    }


    $Lingua = $_REQUEST['Lingua'];
    if($Lingua=='')$Lingua = 'it';
    else{$Lingua =$_REQUEST['Lingua']; }

    //Check Simplebooking
    if(check_simplebooking(IDSITO)==1){
      $simplebooking = true;
      $required = '';
    }else{
      $simplebooking = false;
      $required = 'required';
    }

    // Query e ciclo per estrapolare le lingue
    $db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
    $row = $db->result();
    foreach($row as $chiave => $valore){
        $ListaLingua .='<option value="'.$valore['Sigla'].'" '.($Lingua==$valore['Sigla']?'selected="selected"':'').'>'.$valore['Lingua'].'</option>';
    }
    // Query e ciclo per estrapolare le lingue
    $db->query("SELECT * FROM prefissi ORDER BY nazione ASC");
    $rows = $db->result();
    foreach($rows as $ch => $val){
        switch($Lingua){
            case "it":
                $lingua_estesa = 'ITALY';
            break;
            case "en":
                $lingua_estesa = 'UNITED KINGDOM';
            break;
            case "fr":
                $lingua_estesa = 'FRANCE';
            break;
            case "de":
                $lingua_estesa = 'GERMANY';
            break;
            default :
                $lingua_estesa = 'ITALY';
            break;
        }
        $ListaPrefissi .='<option value="'.$val['prefisso'].'" '.($lingua_estesa==trim($val['nazione'])?'selected="selected"':'').'>'.ucwords(strtolower($val['nazione'])).' +'.$val['prefisso'].' </option>';
    }


                        
                        
    // Query e ciclo per estrapolare gli operatori
    $permessi_user = check_permessi();
    $db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ".($permessi_user['UNIQUE']==1?" AND NomeOperatore = '".NOMEUTENTEACCESSI."'":"")." ORDER BY Id ASC");
    $row = $db->result();
    $EmailOperatoreDefault = trim($row[0]['EmailSegretaria']);
    //$EmailOperatoreDefault = trim(MAIL_CHECK);
     $NomiOperatori .='<option value="">scegli</option>';
    foreach($row as $chiave => $valore){
        $NomiOperatori .='<option value="'.$valore['NomeOperatore'].'" >'.$valore['NomeOperatore'].'</option>';
    }

    $db->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id ASC");
    $row = $db->result();
    $Target .='<option value="">--</option>';
    foreach($row as $chiave => $valore){
        $Target .='<option value="'.$valore['Target'].'" >'.$valore['Target'].'</option>';
    }

    function get_servizi_aggiuntivi($n){
        global $db;

            $box_open = check_configurazioni(IDSITO,'check_open_servizi');
          // Query per servizi aggiuntivi
            $query  = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi
                            WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                            AND hospitality_tipo_servizi.Lingua = 'it'
                            AND hospitality_tipo_servizi.Abilitato = 1
                            ORDER BY hospitality_tipo_servizi.TipoServizio ASC";
            $risultato_query = $db->query($query);
            $record          = $db->result($risultato_query);
            if(sizeof($record)>0){
                $lista_servizi_aggiuntivi .='<tr><td colspan="6"></td></tr>
                                            <tr>
                                                <td colspan="6" class="nopadding no-border-top">
                                                    <div class="box box-default radius6 '.($box_open==0?'collapsed-box':'').'">
                                                    <div  class="box-header">
                                                        <i class="fa  fa-coffee" aria-hidden="true"></i> Aggiungi Servizio
                                                        <i class="fa fa-long-arrow-right pdL20" aria-hidden="true"></i> <small class="pdL20">(senza inserire le date principali od alternative, il calcolo dei servizi aggiuntivi non viene attivato!)</small>
                                                        <div class="clearfix"></div>
                                                        <div style="float:right;"><a href="javascript:;" id="attiva_legenda_servizi'.$n.'" data-toogle="tooltip" title="" data-original-title="Clicca per leggere!">Help <i class="fa fa-life-ring text-info" aria-hidden="true"></i></a></div>
                                                        <div class="clearfix"></div>
                                                        <div id="legenda_servizi'.$n.'" style="display:none">
                                                            <i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small class="pdL20">Il <b>numero massimo di Servizi Aggiunti è <span class="text-red" style="font-size:18px!important">'.NUMERO_SERVIZI.'</span></b>, se si <b>pareggia</b> questo numero, automaticamente i checkbox (in creazione e/o modifica preventivo) per rendere i servizi visibili o non visibili in ogni proposta, <b>verranno rimossi automaticamente</b>!</small>
                                                            <div class="clearfix"></div>
                                                            <i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i><small class="pdL20"><b>ATTENZIONE:</b> selezionare tutte le caselle corrispondenti ai servizi da rendere visibili al cliente nel preventivo, anche per quelli inclusi e attivati con il cursore azzurro a destra.</small>
                                                            <div class="clearfix"></div>
                                                            <i class="fa fa-question text-info" aria-hidden="true"></i> <small class="pdL20">Se il <b>servizio viene eliminato</b>, (dopo essere stato calcolato), <b>passare con il cursore del mouse</b> sul campo <b>"Prezzo Soggiorno"</b></small>
                                                            </div>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("#attiva_legenda_servizi'.$n.'").on("click",function(){
                                                                    $("#legenda_servizi'.$n.'").slideToggle("slow");
                                                                })
                                                            })
                                                        </script> 
                                                        <div class="clearfix"></div>
                                                        <div class="pull-right box-tools">
                                                            <button data-original-title="Collapse"  class="btn btn-default btn-xs transparent no-border" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="box-body">
                                                        <table class="table table-responsive nopadding transparent ">
                                                        '.(DISABLED_CHECKBOX==1?'':
                                                            '<tr>
                                                                <td class="td5pdl0pdr10 no-border-top padding2"></td>
                                                                <td class="td20pdl0pdr10 no-border-top padding2"></td>
                                                                <td class="td20pdl0pdr10 no-border-top padding2 text-right" colspan="2">
                                                                <div  id="selectAll'.$n.'" style="cursor:pointer"><small><i class="fa fa-square-o"></i> Deselezione tutti</small> <i class="fa fa-exclamation-circle text-info" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i></div>
                                                                    <script>
                                                                        $( document ).ready(function() {
                                                                            $("#selectAll'.$n.'").on("click", function () {
                                                                                if($(".select_servizi'.$n.'").prop("checked")==false) {
                                                                                        $(".select_servizi'.$n.'").prop("checked", true);
                                                                                        $("#selectAll'.$n.'").html(\'<small><i class="fa fa-square-o"></i> Deselezione tutti</small> <i class="fa fa-exclamation-circle text-info" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i>\');
                                                                                }else{
                                                                                        $(".select_servizi'.$n.'").prop("checked", false);
                                                                                        $("#selectAll'.$n.'").html(\'<small><i class="fa fa-check-square-o"></i> Seleziona tutti</small> <i class="fa fa-exclamation-circle text-info" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i>\');
                                                                                }
                
                                                                            });
                                                                        });
                                                                    </script>
                                                                </td>
                                                        </tr> ')."\r\n";
                                                        
                foreach($record as $chiave => $campo){




                    $q  = "SELECT hospitality_tipo_servizi_lingua.Descrizione FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = 'it'";
                    $r = $db->query($q);
                    $rec  = $db->row($r);
        

                                    $lista_servizi_aggiuntivi .='<tr class="contenitore_servizio'.$n.'">
                                                                    <td class="td5pdl0pdr10 no-border-top padding2">'.($campo['Icona']!=''?'<div class="content_icona"><img src="'.BASE_URL_ROOT.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></div>':'<div class="content_icona_empty"></div>').'</td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2"><b>'.$campo['TipoServizio'].'</b></td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2"><small>'.(strlen($rec['Descrizione'])<=80?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,80).'...').'</small></td>
                                                                    <td class="td10pdl0pdr10 no-border-top padding2">'.(DISABLED_CHECKBOX==1?'':'<input type="checkbox" class="select_servizi'.$n.'" data-toogle="tooltip" title="Rendi visibile o nascondi il servizio" id="VisibileServizio'.$n.'_'.$campo['Id'].'" name="VisibileServizio'.$n.'['.$campo['Id'].']" value="1" checked="checked" />').'</td>';
                               
                                if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                                    $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top text-maroon padding2">'.$campo['CalcoloPrezzo'].'</td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2"><i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format($campo['PercentualeServizio'],2).'</td>';
                                }else{
                                    $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top '.($campo['CalcoloPrezzo']=='Una tantum'?'text-green':'text-orange').' padding2">'.($campo['CalcoloPrezzo']=='A persona'?$campo['CalcoloPrezzo'].' <i class="fa fa-info-circle text-teal" data-toggle="tooltip" data-html="true" title="Per <b>modificare</b> un valore già inserito disabilita e riabilita il servizio, riapparirà il pulsante <b>Calcola</b>"></i>':$campo['CalcoloPrezzo']).'</td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2">'.($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-info">Gratis</small>').'</td>';
                                }

                                    $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top padding2"><div id="valori_serv_'.$n.'_'.$campo['Id'].'"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'"></div><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'"></div>'.($campo['Obbligatorio']==1?'<small>(Incluso)</small>':'').'</td>
                                                                    <td class="td5pdl0pdr0 no-border-top text-center padding2">';
                               
                                if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                                    $lista_servizi_aggiuntivi .='   <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'checked="checked"':'').' onChange="calcola_totale'.$n.'();">';
                                }else{
                                    if($campo['CalcoloPrezzo'] == 'A persona'){ 
                                        $lista_servizi_aggiuntivi .='   <div style="display:inline;width:100%" class="nowrap"><span  style="position:absolute;right:100px"><small><a href="javascript:;" data-toogle="tooltip" title="Clicca sul HELP"><i class="fa fa-question"></i></a></small></span> <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'checked="checked"':'').'></div>';
                                    }else{
                                        $lista_servizi_aggiuntivi .='   <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'checked="checked"':'').' onChange="calcola_totale'.$n.'();"> ';
                                    }
                                }
  
                                    $lista_servizi_aggiuntivi .='   <script>
                                                                            $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").change(function(){
                                                                                if(this.checked == true){
                                                                                    if($("#DataArrivo_'.$n.'").val()!="" && $("#DataPartenza_'.$n.'").val()!=""){
                                                                                        var s_tmp     = $("#DataArrivo_'.$n.'").val();
                                                                                        var e_tmp     = $("#DataPartenza_'.$n.'").val();
                                                                                        var start_tmp = s_tmp.split("/");
                                                                                        var end_tmp   = e_tmp.split("/");
                                                                                        var dal       = s_tmp;
                                                                                        var al        = e_tmp;
                                                                                        var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],1,0,0).getTime()/1000;
                                                                                        var end       = new Date(end_tmp[2],(end_tmp[1]-1),end_tmp[0],1,0,0).getTime()/1000;
                                                                                        var notti     = Math.ceil(Math.abs(end - start) / 86400);
                                                                                    }
                                                                                    var idsito        = '.IDSITO.';
                                                                                    var n_proposta    = '.$n.';
                                                                                    var id_servizio   = '.$campo['Id'].';
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv.php",
                                                                                        data: "notti=" + notti + "&dal=" + dal + "&al=" + al + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
                                                                                        dataType: "html",
                                                                                        success: function(data){
                                                                                            $("#valori_serv").html(data);
                                                                                            $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").show();
                                                                                        },
                                                                                        error: function(){
                                                                                            alert("Chiamata fallita, si prega di riprovare...");
                                                                                        }
                                                                                    });
                                                                                }

                                                                            });
                                                                        </script>';
                                

                                    $lista_servizi_aggiuntivi .= '<div class="modal fade" id="modal_persone_'.$n.'_'.$campo['Id'].'"  role="dialog" aria-labelledby="myModalLabel">
                                                                                <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel">Inserisci i dati utili per il calcolo del prezzo servizio</h4>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                    <label for="prezzo'.$n.'_'.$campo['Id'].'">Prezzo Servizio</label>
                                                                                                    <input type="text" id="prezzo'.$n.'_'.$campo['Id'].'" name="prezzo'.$n.'_'.$campo['Id'].'" class="form-control" value="'.$campo['PrezzoServizio'].'" readonly />
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                        <label for="Nnotti'.$n.'_'.$campo['Id'].'">Numero Giorni</label>
                                                                                                            <select id="Nnotti'.$n.'_'.$campo['Id'].'" name="Nnotti'.$n.'_'.$campo['Id'].'"  class="form-control" >
                                                                                                                <option value="1">1</option>
                                                                                                                <option value="2">2</option>
                                                                                                                <option value="3">3</option>
                                                                                                                <option value="4">4</option>
                                                                                                                <option value="5">5</option>
                                                                                                                <option value="6">6</option>
                                                                                                                <option value="7">7</option>
                                                                                                                <option value="8">8</option>
                                                                                                                <option value="9">9</option>
                                                                                                                <option value="10">10</option>
                                                                                                                <option value="11">11</option>
                                                                                                                <option value="12">12</option>
                                                                                                                <option value="13">13</option>
                                                                                                                <option value="14">14</option>
                                                                                                                <option value="15">15</option>
                                                                                                                <option value="16">16</option>
                                                                                                                <option value="17">17</option>
                                                                                                                <option value="18">18</option>
                                                                                                                <option value="19">19</option>
                                                                                                                <option value="20">20</option>
                                                                                                                <option value="21">21</option>
                                                                                                                <option value="22">22</option>
                                                                                                                <option value="23">23</option>
                                                                                                                <option value="24">24</option>
                                                                                                                <option value="25">25</option>
                                                                                                                <option value="26">26</option>
                                                                                                                <option value="27">27</option>
                                                                                                                <option value="28">28</option>
                                                                                                                <option value="29">29</option>
                                                                                                                <option value="30">30</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                        <label for="NPersone'.$n.'_'.$campo['Id'].'">Numero Persone</label>
                                                                                                        <select id="NPersone'.$n.'_'.$campo['Id'].'" name="NPersone'.$n.'_'.$campo['Id'].'" class="form-control" >
                                                                                                            <option value="" selected="selected">--</option>
                                                                                                            <option value="1">1</option>
                                                                                                            <option value="2">2</option>
                                                                                                            <option value="3">3</option>
                                                                                                            <option value="4">4</option>
                                                                                                            <option value="5">5</option>
                                                                                                            <option value="6">6</option>
                                                                                                            <option value="7">7</option>
                                                                                                            <option value="8">8</option>
                                                                                                            <option value="9">9</option>
                                                                                                            <option value="10">10</option>
                                                                                                            <option value="11">11</option>
                                                                                                            <option value="12">12</option>
                                                                                                            <option value="13">13</option>
                                                                                                            <option value="14">14</option>
                                                                                                            <option value="15">15</option>
                                                                                                            <option value="16">16</option>
                                                                                                            <option value="17">17</option>
                                                                                                            <option value="18">18</option>
                                                                                                            <option value="19">19</option>
                                                                                                            <option value="20">20</option>
                                                                                                            <option value="21">21</option>
                                                                                                            <option value="22">22</option>
                                                                                                            <option value="23">23</option>
                                                                                                            <option value="24">24</option>
                                                                                                            <option value="25">25</option>
                                                                                                            <option value="26">26</option>
                                                                                                            <option value="27">27</option>
                                                                                                            <option value="28">28</option>
                                                                                                            <option value="29">29</option>
                                                                                                            <option value="30">30</option>
                                                                                                            <option value="31">31</option>
                                                                                                            <option value="32">32</option>
                                                                                                            <option value="33">33</option>
                                                                                                            <option value="34">34</option>
                                                                                                            <option value="35">35</option>
                                                                                                            <option value="36">36</option>
                                                                                                            <option value="37">37</option>
                                                                                                            <option value="38">38</option>
                                                                                                            <option value="39">39</option>
                                                                                                            <option value="40">40</option>
                                                                                                            <option value="41">41</option>
                                                                                                            <option value="42">42</option>
                                                                                                            <option value="43">43</option>
                                                                                                            <option value="44">44</option>
                                                                                                            <option value="45">45</option>
                                                                                                            <option value="46">46</option>
                                                                                                            <option value="47">47</option>
                                                                                                            <option value="48">48</option>
                                                                                                            <option value="48">49</option>
                                                                                                            <option value="50">50</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 text-center">
                                                                                                <input type="hidden" id="id_servizio'.$n.'_'.$campo['Id'].'" name="id_servizio'.$n.'_'.$campo['Id'].'" value="'.$campo['Id'].'">
                                                                                                <button type="button" class="btn btn-success" id="send_re_calc'.$n.'_'.$campo['Id'].'" data-dismiss="modal" aria-label="Close">Calcola prezzo servizio</button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                    $("#modal_persone_'.$n.'_'.$campo['Id'].'").on("show.bs.modal", function (event) {
                                                                                                        var button = $(event.relatedTarget);
                                                                                                        var xnotti = button.data("notti");
                                                                                                        var prezzo = button.data("prezzo");
                                                                                                        var id_servizio = button.data("id_servizio");
                                                                                                        var modal = $(this);
                                                                                                        modal.find(".modal-body select#Nnotti'.$n.'_'.$campo['Id'].'").val(xnotti);
                                                                                                        modal.find(".modal-body input#prezzo'.$n.'_'.$campo['Id'].'").val(prezzo);
                                                                                                        modal.find(".modal-body input#id_servizio'.$n.'_'.$campo['Id'].'").val(id_servizio);

                                                                                                    });
                                                                                                    $("#send_re_calc'.$n.'_'.$campo['Id'].'").on("click",function(){
                                                                                                        var idsito        = '.IDSITO.';
                                                                                                        var n_proposta    = '.$n.';
                                                                                                        var id_servizio   = $("#id_servizio'.$n.'_'.$campo['Id'].'").val();
                                                                                                        var notti         = $("#Nnotti'.$n.'_'.$campo['Id'].'").val();
                                                                                                        var prezzo        = $("#prezzo'.$n.'_'.$campo['Id'].'").val();
                                                                                                        var NPersone      = $("#NPersone'.$n.'_'.$campo['Id'].'").val();
                                                                                                        $.ajax({
                                                                                                            type: "POST",
                                                                                                            url: "'.BASE_URL_SITO.'ajax/calc_prezzo_serv_a_persona.php",
                                                                                                            data: "action=re_calc&notti=" + notti + "&prezzo=" + prezzo + "&NPersone=" + NPersone + "&n_proposta=" + n_proposta + "&id_servizio=" + id_servizio + "&idsito=" + idsito,
                                                                                                            dataType: "html",
                                                                                                            success: function(data){
                                                                                                                $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                                                $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").hide();
                                                                                                                 calcola_totale'.$n.'();
                                                                                                            },
                                                                                                            error: function(){
                                                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                                                            }
                                                                                                        });

                                                                                                });

                                                                                            });
                                                                                        </script>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>';
                    $lista_servizi_aggiuntivi .='
                                                                    </td>
                                                                </tr>';

                }
                $lista_servizi_aggiuntivi .='               </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> ';
            }

            return $lista_servizi_aggiuntivi;
    }



    $db->query("SELECT hospitality_tipo_pacchetto_lingua.* FROM hospitality_tipo_pacchetto_lingua
                INNER JOIN hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
                WHERE hospitality_tipo_pacchetto_lingua.lingue = '".$Lingua."'
                AND hospitality_tipo_pacchetto.Abilitato = 1
                AND hospitality_tipo_pacchetto_lingua.idsito = ".IDSITO."
                ORDER BY hospitality_tipo_pacchetto_lingua.Pacchetto ASC");
    $row = $db->result();
    $ListaPacchetti .='<option value="">scegli</option>';
    foreach($row as $chiave => $valore){
        $ListaPacchetti .='<option value="'.$valore['Pacchetto'].'" data-id="'.$valore['Id'].'" >'.$valore['Pacchetto'].'</option>';
    }
    $db->query("SELECT hospitality_condizioni_tariffe_lingua.* FROM hospitality_condizioni_tariffe_lingua
                            INNER JOIN hospitality_condizioni_tariffe ON hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe
                            WHERE hospitality_condizioni_tariffe_lingua.Lingua = '".$Lingua."'
                            AND hospitality_condizioni_tariffe.idsito = ".IDSITO."
                            ORDER BY hospitality_condizioni_tariffe_lingua.tariffa ASC");
    $row = $db->result();
    $ListaTariffe .='<option value="">scegli</option>';
    foreach($row as $chiave => $valore){
        $ListaTariffe .='<option value="'.$valore['tariffa'].'" data-id="'.$valore['id'].'" >'.$valore['tariffa'].'</option>';
    }
    // Query e ciclo per estrapolare i dati di tipologia soggiorno
    $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoSoggiorno ASC");
    $row = $db->result();
    foreach($row as $chiave => $valore){
        $ListaSoggiorno .='<option value="'.$valore['Id'].'">'.mini_clean($valore['TipoSoggiorno']).'</option>';
    }
    // configuratore select tipo camere
    $stile_chosen = check_configurazioni(IDSITO,'select_tipo_camere');

    // Query e ciclo per estrapolare i dati di tipologia camere
    $db->query("SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Ordine ASC");
    $rw = $db->result();
    foreach($rw as $key => $val){
        $ListaCamere .='<option value="'.$val['Id'].'">'.$val['TipoCamere'].'</option>';
    }

    $select_tipo_camere1 .= '  <select name="TipoCamere1[]" id="TipoCamere_1_1" class="'.$stile_chosen.' form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(1,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere2 .= '  <select name="TipoCamere2[]" id="TipoCamere_2_1" class="'.$stile_chosen.' form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(2,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere3 .= '  <select name="TipoCamere3[]" id="TipoCamere_3_1" class="'.$stile_chosen.' form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(3,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere4 .= '  <select name="TipoCamere4[]" id="TipoCamere_4_1" class="'.$stile_chosen.' form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(4,1);"':'').'>
                              <option value="" selected="selected">Camere</option>
                                  '.$ListaCamere.'
                          </select>';

    $select_tipo_camere5 .= '  <select name="TipoCamere5[]" id="TipoCamere_5_1" class="'.$stile_chosen.' form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(5,1);"':'').'>
                          <option value="" selected="selected">Camere</option>
                              '.$ListaCamere.'
                      </select>';
    // Query e ciclo per estrapolare i dati delle fonti di prenotazione
    $db->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");
    $rws = $db->result();
    foreach($rws as $key => $v){
        $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($v['FontePrenotazione']=='Sito Web'?'disabled="disabled"':'').'>'.($v['FontePrenotazione']=='Sito Web'?$v['FontePrenotazione'].' / Landing':$v['FontePrenotazione']).'</option>';
    }
    // Query lista template
    $db->query("SELECT hospitality_template_background.TemplateName,hospitality_template_background.Thumb,hospitality_template_background.Id as idTempBk FROM hospitality_template_background
                    WHERE hospitality_template_background.idsito = ".IDSITO." 
                    AND (hospitality_template_background.TemplateType = 'custom1'
                    OR hospitality_template_background.TemplateType = 'custom2'
                    OR hospitality_template_background.TemplateType = 'custom3'
                    OR hospitality_template_background.TemplateName = 'smart'
                    OR hospitality_template_background.TemplateName = 'default')
                     ORDER BY hospitality_template_background.Id ASC");
    $rwt = $db->result();
    $ListaTemplate = '';
    foreach($rwt as $kt => $vt){
        $db->query("SELECT * FROM hospitality_template_landing WHERE idsito = ".IDSITO." LIMIT 1");
        $rt = $db->row();

        $ListaTemplate .='<option data-img-src="'.BASE_URL_SITO.'img/'.$vt['Thumb'].'" data-img-label="Template '.$vt['TemplateName'].'" value="'.$vt['idTempBk'].'" '.(($id_template==$vt['idTempBk']) || ($rt['Template']==$vt['TemplateName'])?'selected="selected"':'').'>'.$vt['TemplateName'].'</option>';
    }

    // Query e ciclo per ricavare il numero di prenotazione
    $select2             = "SELECT NumeroPrenotazione FROM hospitality_guest WHERE idsito = ".IDSITO." ORDER BY NumeroPrenotazione DESC";
    $res2                = $db->query($select2);
    $rws                 = $db->row($res2);
    $numero_prenotazione =  (intval($rws['NumeroPrenotazione'])+1);
    // Ciclo per il select numerico
    $i = 1;
    for($i==1; $i<=20; $i++){
       $Numeri .='<option value="'.$i.'">'.$i.'</option>';
    }
    $Numeri .='<option value="25">25</option>';
    $Numeri .='<option value="30">30</option>';
    $Numeri .='<option value="35">35</option>';
    $Numeri .='<option value="40">40</option>';
    $Numeri .='<option value="45">45</option>';
    $Numeri .='<option value="50">50</option>';
    $Numeri .='<option value="60">60</option>';
    $Numeri .='<option value="70">70</option>';

    $x = 1;
    for($x==1; $x<=10; $x++){
       $NumeriBimbi .='<option value="'.$x.'">'.$x.'</option>';
    }
    $e = 1;
    $etaBimbi .='<option value="< 1">< 1</option>';
    for($e==1; $e<=18; $e++){
       $etaBimbi .='<option value="'.$e.'">'.$e.'</option>';
    }
    $e1 = 1;
    $etaBimbi1 .='<option value="< 1" '.($EtaBambini1=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e1==1; $e1<=18; $e1++){
       $etaBimbi1 .='<option value="'.$e1.'" '.($EtaBambini1==$e1?'selected="selected"':'').'>'.$e1.'</option>';
    }
    $e2 = 1;
    $etaBimbi2 .='<option value="< 1" '.($EtaBambini2=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e2==1; $e2<=18; $e2++){
       $etaBimbi2 .='<option value="'.$e2.'" '.($EtaBambini2==$e2?'selected="selected"':'').'>'.$e2.'</option>';
    }
    $e3 = 1;
    $etaBimbi3 .='<option value="< 1" '.($EtaBambini3=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e3==1; $e3<=18; $e3++){
       $etaBimbi3 .='<option value="'.$e3.'" '.($EtaBambini3==$e3?'selected="selected"':'').'>'.$e3.'</option>';
    }
    $e4 = 1;
    $etaBimbi4 .='<option value="< 1" '.($EtaBambini4=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e4==1; $e4<=18; $e4++){
       $etaBimbi4 .='<option value="'.$e4.'" '.($EtaBambini4==$e4?'selected="selected"':'').'>'.$e4.'</option>';
    }
    $e5 = 1;
    $etaBimbi5 .='<option value="< 1" '.($EtaBambini5=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e5==1; $e5<=18; $e5++){
       $etaBimbi5 .='<option value="'.$e5.'" '.($EtaBambini5==$e5?'selected="selected"':'').'>'.$e5.'</option>';
    }
    $e6 = 1;
    $etaBimbi6 .='<option value="< 1" '.($EtaBambini6=='< 1'?'selected="selected"':'').'>< 1</option>';
    for($e6==1; $e6<=18; $e6++){
       $etaBimbi6 .='<option value="'.$e6.'" '.($EtaBambini6==$e6?'selected="selected"':'').'>'.$e6.'</option>';
    }
    //ciclo per percentuli sconto
    $num_sconto = 1;
    for($num_sconto==1; $num_sconto<=25; $num_sconto++){
       $percentuali_sconto .='<option value="'.$num_sconto.'">'.$num_sconto.'%</option>';
    }
    $percentuali_sconto .='<option value="30">30%</option>';
    $percentuali_sconto .='<option value="35">35%</option>';
    $percentuali_sconto .='<option value="40">40%</option>';
    $percentuali_sconto .='<option value="45">45%</option>';
    $percentuali_sconto .='<option value="50">50%</option>';

    // query per estrarre dati sbooking online
    $db->query("SELECT BookingOnline FROM hospitality_social WHERE idsito = '".IDSITO."'");
    $rw =  $db->row();

    if($rw['BookingOnline']!=''){
       $BookingOnline   = '<div class="row">
                              <div class="col-md-2"></div>
                              <div class="col-md-8 text-center">
                                <a href="javascript:;" onclick="window.open(\''.$rw['BookingOnline'].'\', \'pop\', \'top=500,left=500,width=1024,height=768\');" class="btn btn-success">
                                  <i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;Aiuto per il calcolo del preventivo con la maschera del tuo Booking Online
                                </a>
                              </div>
                              <div class="col-md-2"></div>
                        </div>';
    }


    // Query e ciclo per estrapolare
    $db->query("SELECT * FROM hospitality_politiche WHERE idsito = ".IDSITO." AND tipo = 0 ORDER BY Id ASC");
    $rec = $db->result();
    foreach($rec as $ch => $vl){
        $ListaPolitiche .='<option value="'.$vl['id'].'">'.$vl['etichetta'].'</option>';
    }

    $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = ".IDSITO;
    $res    = $db->query($select);
    $rw     = $db->row($res);
    $Acc    = $rw['Acconto'];
    $AccontoRichiesta .='<option value="" '.($Acc==''?'selected="selected"':'').'>--</option>'."\r\n";
    $AccontoRichiesta .='<option value="importo" '.($Acc=='importo'?'selected="selected"':'').'>importo</option>'."\r\n";
    $AccontoRichiesta .='<option value="10" '.($Acc=='10'?'selected="selected"':'').'>10%</option>'."\r\n";
    $AccontoRichiesta .='<option value="15" '.($Acc=='15'?'selected="selected"':'').'>15%</option>'."\r\n";
    $AccontoRichiesta .='<option value="20" '.($Acc=='20'?'selected="selected"':'').'>20%</option>'."\r\n";
    $AccontoRichiesta .='<option value="25" '.($Acc=='25'?'selected="selected"':'').'>25%</option>'."\r\n";
    $AccontoRichiesta .='<option value="30" '.($Acc=='30'?'selected="selected"':'').'>30%</option>'."\r\n";
    $AccontoRichiesta .='<option value="40" '.($Acc=='40'?'selected="selected"':'').'>40%</option>'."\r\n";
    $AccontoRichiesta .='<option value="50" '.($Acc=='50'?'selected="selected"':'').'>50%</option>'."\r\n";
    $AccontoRichiesta .='<option value="60" '.($Acc=='60'?'selected="selected"':'').'>60%</option>'."\r\n";
    $AccontoRichiesta .='<option value="70" '.($Acc=='70'?'selected="selected"':'').'>70%</option>'."\r\n";
    $AccontoRichiesta .='<option value="80" '.($Acc=='80'?'selected="selected"':'').'>80%</option>'."\r\n";
    $AccontoRichiesta .='<option value="90" '.($Acc=='90'?'selected="selected"':'').'>90%</option>'."\r\n";
    $AccontoRichiesta .='<option value="100" '.($Acc=='100'?'selected="selected"':'').'>100%</option>'."\r\n";

    // Query e ciclo per estrapolare i tipi di pagamento
    $sel = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Ordine ASC";
    $ris = $db->query($sel);
    $rec = $db->result($ris);
    if(sizeof($rec)>0){

        $TipiPagamento .='<table class="table table-responsive"><tr>';

        foreach($rec as $ch => $vl){
            $TipiPagamento .='
                            '.($vl['TipoPagamento']=='Carta di Credito'?'<td class="text-center no_border_top no_padding nowrap"><b>Carta di Credito</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Carta di Credito'?'checked="checked"':'').' name="CC"></td>':'').'
                            '.($vl['TipoPagamento']=='Bonifico Bancario'?'<td class="text-center no_border_top no_padding nowrap"><b>Bonifico Bancario</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Bonifico Bancario'?'checked="checked"':'').' name="BB"></td>':'').'
                            '.($vl['TipoPagamento']=='Vaglia Postale'?'<td class="text-center no_border_top no_padding nowrap"><b>Vaglia Postale</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Vaglia Postale'?'checked="checked"':'').' name="VP"></td>':'').'
                            '.($vl['TipoPagamento']=='PayPal'?'<td class="text-center no_border_top no_padding nowrap"><b>PayPal</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='PayPal'?'checked="checked"':'').' name="PP"></td>':'').'
                            '.($vl['TipoPagamento']=='Gateway Bancario'?'<td class="text-center no_border_top no_padding nowrap"><b>Gateway Bancario</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Gateway Bancario'?'checked="checked"':'').' name="GB"></td>':'').'
                            '.($vl['TipoPagamento']=='Gateway Bancario Virtual Pay'?'<td class="text-center no_border_top no_padding nowrap"><b>Virtual Pay</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Gateway Bancario Virtual Pay'?'checked="checked"':'').' name="GBVP"></td>':'').'
                            '.($vl['TipoPagamento']=='Stripe'?'<td class="text-center no_border_top no_padding nowrap"><b>Stripe</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Stripe'?'checked="checked"':'').' name="GBS" id="GBS"><br><input style="display:none" class="form-control" placeholder="Copia ed incolla il link creato da STRIPE" type="text" name="linkStripe" id="linkStripe"></td>':'').'
                            '.($vl['TipoPagamento']=='Nexi'?'<td class="text-center no_border_top no_padding nowrap"><b>Nexi</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Nexi'?'checked="checked"':'').' name="GBNX"></td>':'').'
                            ';
        }
        $TipiPagamento .='</tr></table>';
        $TipiPagamento .='  <script>
                                $(document).ready(function(){
                                    if($("#GBS").is(":checked")==true){
                                        $("#linkStripe").show();
                                    }else{
                                        $("#linkStripe").hide();
                                    }
                                    $( "#GBS" ).on( "change", function() {
                                        $("#linkStripe").slideToggle();
                                    });

                                });
                            </script>';        
    }

    function getlastid($tabella){
       global $db;
        $db->query("SELECT MAX(id) as Id FROM $tabella");
        $dato = $db->row();
        $newid = $dato['Id'];
        return($newid);
   }
    function new_Npreno($tabella,$id_sito){
       global $db;
        $db->query("SELECT  NumeroPrenotazione FROM $tabella WHERE idsito =".$id_sito." ORDER BY NumeroPrenotazione DESC");
        $dato = $db->row();
        $newN = $dato['NumeroPrenotazione']+1;
        return($newN);
   }

    if($_REQUEST['action']=='create'){

        if($_REQUEST['PrezzoL1'] == $_REQUEST['PrezzoP1']) {
            $_REQUEST['PrezzoL1'] = 0;
        }
        if($_REQUEST['PrezzoL2'] == $_REQUEST['PrezzoP2']) {
            $_REQUEST['PrezzoL2'] = 0;
        }
        if($_REQUEST['PrezzoL3'] == $_REQUEST['PrezzoP3']) {
            $_REQUEST['PrezzoL3'] = 0;
        }
        if($_REQUEST['PrezzoL4'] == $_REQUEST['PrezzoP4']) {
            $_REQUEST['PrezzoL4'] = 0;
        }
        if($_REQUEST['PrezzoL5'] == $_REQUEST['PrezzoP5']) {
            $_REQUEST['PrezzoL5'] = 0;
        }
       // dati richiesta
       $DataRichiesta      = date('Y-m-d');
       $id_politiche       = $_REQUEST['id_politiche'];
       $id_template        = $_REQUEST['id_template'];
       $acconto_richiesta  = $_REQUEST['acconto_richiesta'];
       $AccontoLibero      = $_REQUEST['acconto_libero'];
       $Lingua             = $_REQUEST['Lingua'];
       $TipoRichiesta      = $_REQUEST['TipoRichiesta'];
       $TipoVacanza        = $_REQUEST['TipoVacanza'];
       $ChiPrenota         = addslashes($_REQUEST['ChiPrenota']);
       $EmailSegretaria    = $_REQUEST['EmailSegretaria'];
       $idsito             = $_REQUEST['idsito'];
       // dati cliente
       $Nome               = addslashes(ucfirst($_REQUEST['Nome']));
       $Cognome            = addslashes(ucfirst($_REQUEST['Cognome']));
       $Email              = $_REQUEST['Email'];
       
       $PrefissoInternazionale  = $_REQUEST['PrefissoInternazionale'];
       $Cellulare          = $_REQUEST['Cellulare'];
       $DataN_tmp          = explode("/",$_REQUEST['DataNascita']);
       $DataNascita        = $DataN_tmp[2].'-'.$DataN_tmp[1].'-'.$DataN_tmp[0];
       // dati prenotazione
       $DataA_tmp          = explode("/",$_REQUEST['DataArrivo']);
       $DataArrivo         = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
       $DataP_tmp          = explode("/",$_REQUEST['DataPartenza']);
       $DataPartenza       = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];
       //$NumeroPrenotazione = $_REQUEST['NumeroPrenotazione'];
       $NumeroPrenotazione = new_Npreno('hospitality_guest',IDSITO);

       $NumeroAdulti       = $_REQUEST['NumeroAdulti'];
       $NumeroBambini      = $_REQUEST['NumeroBambini'];
       $EtaBambini1        = ($_REQUEST['EtaBambini1']==''?NULL:$_REQUEST['EtaBambini1']);
       $EtaBambini2        = ($_REQUEST['EtaBambini2']==''?NULL:$_REQUEST['EtaBambini2']);
       $EtaBambini3        = ($_REQUEST['EtaBambini3']==''?NULL:$_REQUEST['EtaBambini3']);
       $EtaBambini4        = ($_REQUEST['EtaBambini4']==''?NULL:$_REQUEST['EtaBambini4']);
       $EtaBambini5        = ($_REQUEST['EtaBambini5']==''?NULL:$_REQUEST['EtaBambini5']);
       $EtaBambini6        = ($_REQUEST['EtaBambini6']==''?NULL:$_REQUEST['EtaBambini6']);
       // dati informativi
       $FontePrenotazione  = $_REQUEST['FontePrenotazione'];
       $TipoPagamento      = $_REQUEST['TipoPagamento'];
       $DataS_tmp          = explode("/",$_REQUEST['DataScadenza']);
       $DataScadenza       = $DataS_tmp[2].'-'.$DataS_tmp[1].'-'.$DataS_tmp[0];
       $Note               = $_REQUEST['Note'];
       // ABILITAZIONE A INVIO EMAIL
       $AbilitaInvio       = $_REQUEST['AbilitaInvio' ];
        // ABILITAZIONE TIPO DI PAGAMENTI
        $CC   = $_REQUEST['CC'];
        $BB   = $_REQUEST['BB'];
        $VP   = $_REQUEST['VP'];
        $PP   = $_REQUEST['PP'];
        $GB   = $_REQUEST['GB'];
        $GBVP = $_REQUEST['GBVP'];
        $GBS  = $_REQUEST['GBS'];
        $linkStripe  = $_REQUEST['linkStripe'];
        $GBNX = $_REQUEST['GBNX'];

        // query di inserimento
        $insert = "INSERT INTO hospitality_guest(id_politiche,
                                                id_template,
                                                AccontoRichiesta,
                                                AccontoLibero,
                                                DataRichiesta,
                                                TipoRichiesta,
                                                TipoVacanza,
                                                ChiPrenota,
                                                EmailSegretaria,
                                                idsito,
                                                Nome,
                                                Cognome,
                                                Email,
                                                PrefissoInternazionale,
                                                Cellulare,
                                                DataNascita,
                                                Lingua,
                                                DataArrivo,
                                                DataPartenza,
                                                NumeroPrenotazione,
                                                NumeroAdulti,
                                                NumeroBambini,
                                                EtaBambini1,
                                                EtaBambini2,
                                                EtaBambini3,
                                                EtaBambini4,
                                                EtaBambini5,
                                                EtaBambini6,
                                                FontePrenotazione,
                                                TipoPagamento,
                                                DataScadenza,
                                                Note,
                                                AbilitaInvio
                                                ) VALUES (
                                                '".$id_politiche."',
                                                '".$id_template."',
                                                '".$acconto_richiesta."',
                                                '".$AccontoLibero."',
                                                '".$DataRichiesta."',
                                                '".$TipoRichiesta."',
                                                '".$TipoVacanza."',
                                                '".$ChiPrenota."',
                                                '".$EmailSegretaria."',
                                                '".$idsito."',
                                                '".addslashes($Nome)."',
                                                '".addslashes($Cognome)."',
                                                '".$Email."',
                                                '".$PrefissoInternazionale."',
                                                '".$Cellulare."',
                                                '".$DataNascita."',
                                                '".$Lingua."',
                                                '".$DataArrivo."',
                                                '".$DataPartenza."',
                                                '".$NumeroPrenotazione."',
                                                '".$NumeroAdulti."',
                                                '".$NumeroBambini."',
                                                '".$EtaBambini1."',
                                                '".$EtaBambini2."',
                                                '".$EtaBambini3."',
                                                '".$EtaBambini4."',
                                                '".$EtaBambini5."',
                                                '".$EtaBambini6."',
                                                '".$FontePrenotazione."',
                                                '".$TipoPagamento."',
                                                '".$DataScadenza."',
                                                '".addslashes($Note)."',
                                                '".$AbilitaInvio."')";
      $db->query($insert);

      $IdRichiesta = getlastid('hospitality_guest');

      $record_template = check_nome_template_by_id($id_template,$idsito);
      $nome_template_scelto = ucfirst($record_template['TemplateName']);
      $tipo_template_scelto = strtoupper($record_template['TemplateType']);

            if(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Preventivo'){
                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                            INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                            WHERE hospitality_dizionario.idsito = ".$idsito." 
                            AND hospitality_dizionario.etichetta = 'PREVENTIVO_".$tipo_template_scelto."'
                            AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                            AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                $re = $db->query($sele);
                $v  = $db->row($re);
                $TestoAlternativoFP = stripslashes($v['testo']);

                $in ="INSERT INTO hospitality_contenuti_web_lingua(
                            idsito,
                            IdRichiesta,
                            Lingua,
                            Testo)
                        VALUES (
                            '".$idsito."',
                            '".$IdRichiesta."',
                            '".$Lingua."',
                            '".addslashes($TestoAlternativoFP)."')";
                $db->query($in);   

            }elseif(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Conferma'){

                // query per testo default landing page
                $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                            INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                            WHERE hospitality_dizionario.idsito = ".$idsito." 
                            AND hospitality_dizionario.etichetta = 'CONFERMA_".$tipo_template_scelto."'
                            AND hospitality_dizionario_lingua.idsito =  ".$idsito." 
                            AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                $re = $db->query($sele);
                $v = $db->row($re);
                $TestoAlternativoFC = stripslashes($v['testo']);

                $in ="INSERT INTO hospitality_contenuti_web_lingua(
                            idsito,
                            IdRichiesta,
                            Lingua,
                            Testo)
                        VALUES (
                            '".$idsito."',
                            '".$IdRichiesta."',
                            '".$Lingua."',
                            '".addslashes($TestoAlternativoFC)."')";
                $db->query($in); 

            
            }



      $ins_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$IdRichiesta."','".$id_template."','".$idsito."')";
      $db->query($ins_template);
    /**
     * * inserire le scelate dei tipi di pagamento
     */
    $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,linkStripe,GBNX) VALUES ('".$idsito."','".$IdRichiesta."','".$CC."','".$BB."','".$VP."','".$PP."','".$GB."','".$GBVP."','".$GBS."','".$linkStripe."','".$GBNX."')";
    $db->query($ins_pag);

      // se la prima proposta è compilata
      if($_REQUEST['PrezzoP1']!=''){

        $DataA_tmp1          = explode("/",$_REQUEST['DataArrivo1']);
        $DataArrivo1         = $DataA_tmp1[2].'-'.$DataA_tmp1[1].'-'.$DataA_tmp1[0];
        $DataP_tmp1          = explode("/",$_REQUEST['DataPartenza1']);
        $DataPartenza1       = $DataP_tmp1[2].'-'.$DataP_tmp1[1].'-'.$DataP_tmp1[0];

                 $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                      Arrivo,
                                                      Partenza,
                                                      NomeProposta,
                                                      TestoProposta,
                                                      CheckProposta,
                                                      PrezzoL,
                                                      PrezzoP,
                                                      AccontoPercentuale,
                                                      AccontoImporto,
                                                      AccontoTariffa,
                                                      AccontoTesto
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$DataArrivo1."',
                                                      '".$DataPartenza1."',
                                                      '".addslashes($_REQUEST['NomeProposta1'])."',
                                                      '".addslashes($_REQUEST['TestoProposta1'])."',
                                                      '".$_REQUEST['CheckProposta1']."',
                                                      '".$_REQUEST['PrezzoL1']."',
                                                      '".$_REQUEST['PrezzoP1']."',
                                                      '".$_REQUEST['AccontoPercentuale1']."',
                                                      '".$_REQUEST['AccontoImporto1']."',
                                                      '".addslashes($_REQUEST['EtichettaTariffa1'])."',
                                                      '".addslashes($_REQUEST['AccontoTesto1'])."')");

            $IdProposta = getlastid('hospitality_proposte');
             $n_camere = count($_REQUEST['TipoCamere1']);
             for($i=0; $i<=($n_camere-1); $i++){
                 $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                      id_proposta,
                                                      TipoSoggiorno,
                                                      NumeroCamere,
                                                      TipoCamere,
                                                      NumAdulti,
                                                      NumBambini,
                                                      EtaB,
                                                      Prezzo
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta."',
                                                      '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                      '".$_REQUEST['NumeroCamere1'][$i]."',
                                                      '".$_REQUEST['TipoCamere1'][$i]."',
                                                      '".$_REQUEST['NumAdulti1'][$i]."',
                                                      '".$_REQUEST['NumBambini1'][$i]."',
                                                      '".$_REQUEST['EtaB1'][$i]."',
                                                      '".$_REQUEST['Prezzo1'][$i]."')");
             }
             if($_REQUEST['PrezzoServizio1'] != '') {
                foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                    $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                }
            }
            if($_REQUEST['VisibileServizio1'] != '') {
                foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                    $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$key."','".$value."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$_REQUEST['SC1']."')");
      }
      // se la seconda proposta è compilata
      if($_REQUEST['PrezzoP2']!=''){

        $DataA_tmp2          = explode("/",$_REQUEST['DataArrivo2']);
        $DataArrivo2         = $DataA_tmp2[2].'-'.$DataA_tmp2[1].'-'.$DataA_tmp2[0];
        $DataP_tmp2          = explode("/",$_REQUEST['DataPartenza2']);
        $DataPartenza2       = $DataP_tmp2[2].'-'.$DataP_tmp2[1].'-'.$DataP_tmp2[0];

                 $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                      Arrivo,
                                                      Partenza,
                                                      NomeProposta,
                                                      TestoProposta,
                                                      CheckProposta,
                                                      PrezzoL,
                                                      PrezzoP,
                                                      AccontoPercentuale,
                                                      AccontoImporto,
                                                      AccontoTariffa,
                                                      AccontoTesto
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$DataArrivo2."',
                                                      '".$DataPartenza2."',
                                                      '".addslashes($_REQUEST['NomeProposta2'])."',
                                                      '".addslashes($_REQUEST['TestoProposta2'])."',
                                                      '".$_REQUEST['CheckProposta2']."',
                                                      '".$_REQUEST['PrezzoL2']."',
                                                      '".$_REQUEST['PrezzoP2']."',
                                                      '".$_REQUEST['AccontoPercentuale2']."',
                                                      '".$_REQUEST['AccontoImporto2']."',
                                                      '".addslashes($_REQUEST['EtichettaTariffa2'])."',
                                                      '".addslashes($_REQUEST['AccontoTesto2'])."')");

            $IdProposta2 = getlastid('hospitality_proposte');
             $n_camere2 = count($_REQUEST['TipoCamere2']);
             for($i=0; $i<=($n_camere2-1); $i++){
                 $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                      id_proposta,
                                                      TipoSoggiorno,
                                                      NumeroCamere,
                                                      TipoCamere,
                                                      NumAdulti,
                                                      NumBambini,
                                                      EtaB,
                                                      Prezzo
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta2."',
                                                      '".$_REQUEST['TipoSoggiorno2'][$i]."',
                                                      '".$_REQUEST['NumeroCamere2'][$i]."',
                                                      '".$_REQUEST['TipoCamere2'][$i]."',
                                                      '".$_REQUEST['NumAdulti2'][$i]."',
                                                      '".$_REQUEST['NumBambini2'][$i]."',
                                                      '".$_REQUEST['EtaB2'][$i]."',
                                                      '".$_REQUEST['Prezzo2'][$i]."')");
             }

             if($_REQUEST['PrezzoServizio2'] != '') {
                foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                    $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                }
            }
            if($_REQUEST['VisibileServizio2'] != '') {
                foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                    $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$key2."','".$value2."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta2."','".$_REQUEST['SC2']."')");
      }
      // se la terza proposta è compilata
      if($_REQUEST['PrezzoP3']!=''){

        $DataA_tmp3          = explode("/",$_REQUEST['DataArrivo3']);
        $DataArrivo3         = $DataA_tmp3[2].'-'.$DataA_tmp3[1].'-'.$DataA_tmp3[0];
        $DataP_tmp3          = explode("/",$_REQUEST['DataPartenza3']);
        $DataPartenza3       = $DataP_tmp3[2].'-'.$DataP_tmp3[1].'-'.$DataP_tmp3[0];

                 $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                      Arrivo,
                                                      Partenza,
                                                      NomeProposta,
                                                      TestoProposta,
                                                      CheckProposta,
                                                      PrezzoL,
                                                      PrezzoP,
                                                      AccontoPercentuale,
                                                      AccontoImporto,
                                                      AccontoTariffa,
                                                      AccontoTesto
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$DataArrivo3."',
                                                      '".$DataPartenza3."',
                                                      '".addslashes($_REQUEST['NomeProposta3'])."',
                                                      '".addslashes($_REQUEST['TestoProposta3'])."',
                                                      '".$_REQUEST['CheckProposta3']."',
                                                      '".$_REQUEST['PrezzoL3']."',
                                                      '".$_REQUEST['PrezzoP3']."',
                                                      '".$_REQUEST['AccontoPercentuale3']."',
                                                      '".$_REQUEST['AccontoImporto3']."',
                                                      '".addslashes($_REQUEST['EtichettaTariffa3'])."',
                                                      '".addslashes($_REQUEST['AccontoTesto3'])."')");

             $IdProposta3 = getlastid('hospitality_proposte');
             $n_camere3 = count($_REQUEST['TipoCamere3']);
             for($i=0; $i<=($n_camere3-1); $i++){
                 $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                      id_proposta,
                                                      TipoSoggiorno,
                                                      NumeroCamere,
                                                      TipoCamere,
                                                      NumAdulti,
                                                      NumBambini,
                                                      EtaB,
                                                      Prezzo
                                                      ) VALUES (
                                                      '".$IdRichiesta."',
                                                      '".$IdProposta3."',
                                                      '".$_REQUEST['TipoSoggiorno3'][$i]."',
                                                      '".$_REQUEST['NumeroCamere3'][$i]."',
                                                      '".$_REQUEST['TipoCamere3'][$i]."',
                                                      '".$_REQUEST['NumAdulti3'][$i]."',
                                                      '".$_REQUEST['NumBambini3'][$i]."',
                                                      '".$_REQUEST['EtaB3'][$i]."',
                                                      '".$_REQUEST['Prezzo3'][$i]."')");
             }

             if($_REQUEST['PrezzoServizio3'] != '') {
                foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                    $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                }
            }
            if($_REQUEST['VisibileServizio3'] != '') {
                foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                    $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$key3."','".$value3."')");
                }
            }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta3."','".$_REQUEST['SC3']."')");
      }

        // se la quarta proposta è compilata
        if($_REQUEST['PrezzoP4']!=''){

            $DataA_tmp4          = explode("/",$_REQUEST['DataArrivo4']);
            $DataArrivo4         = $DataA_tmp4[2].'-'.$DataA_tmp4[1].'-'.$DataA_tmp4[0];
            $DataP_tmp4          = explode("/",$_REQUEST['DataPartenza4']);
            $DataPartenza4       = $DataP_tmp4[2].'-'.$DataP_tmp4[1].'-'.$DataP_tmp4[0];

                    $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                        Arrivo,
                                                        Partenza,
                                                        NomeProposta,
                                                        TestoProposta,
                                                        CheckProposta,
                                                        PrezzoL,
                                                        PrezzoP,
                                                        AccontoPercentuale,
                                                        AccontoImporto,
                                                        AccontoTariffa,
                                                        AccontoTesto
                                                        ) VALUES (
                                                        '".$IdRichiesta."',
                                                        '".$DataArrivo4."',
                                                        '".$DataPartenza4."',
                                                        '".addslashes($_REQUEST['NomeProposta4'])."',
                                                        '".addslashes($_REQUEST['TestoProposta4'])."',
                                                        '".$_REQUEST['CheckProposta4']."',
                                                        '".$_REQUEST['PrezzoL4']."',
                                                        '".$_REQUEST['PrezzoP4']."',
                                                        '".$_REQUEST['AccontoPercentuale4']."',
                                                        '".$_REQUEST['AccontoImporto4']."',
                                                        '".addslashes($_REQUEST['EtichettaTariffa4'])."',
                                                        '".addslashes($_REQUEST['AccontoTesto4'])."')");

                $IdProposta4 = getlastid('hospitality_proposte');
                $n_camere4 = count($_REQUEST['TipoCamere4']);
                for($i=0; $i<=($n_camere4-1); $i++){
                    $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                        id_proposta,
                                                        TipoSoggiorno,
                                                        NumeroCamere,
                                                        TipoCamere,
                                                        NumAdulti,
                                                        NumBambini,
                                                        EtaB,
                                                        Prezzo
                                                        ) VALUES (
                                                        '".$IdRichiesta."',
                                                        '".$IdProposta4."',
                                                        '".$_REQUEST['TipoSoggiorno4'][$i]."',
                                                        '".$_REQUEST['NumeroCamere4'][$i]."',
                                                        '".$_REQUEST['TipoCamere4'][$i]."',
                                                        '".$_REQUEST['NumAdulti4'][$i]."',
                                                        '".$_REQUEST['NumBambini4'][$i]."',
                                                        '".$_REQUEST['EtaB4'][$i]."',
                                                        '".$_REQUEST['Prezzo4'][$i]."')");
                }

                if($_REQUEST['PrezzoServizio4'] != '') {
                    foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                        $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                    }
                }
                if($_REQUEST['VisibileServizio4'] != '') {
                    foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                        $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                }
            ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
            $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta4."','".$_REQUEST['SC4']."')");
        }

        // se la quinta proposta è compilata
        if($_REQUEST['PrezzoP5']!=''){

            $DataA_tmp5          = explode("/",$_REQUEST['DataArrivo5']);
            $DataArrivo5         = $DataA_tmp5[2].'-'.$DataA_tmp5[1].'-'.$DataA_tmp5[0];
            $DataP_tmp5          = explode("/",$_REQUEST['DataPartenza5']);
            $DataPartenza5       = $DataP_tmp5[2].'-'.$DataP_tmp5[1].'-'.$DataP_tmp5[0];

                    $db->query("INSERT INTO hospitality_proposte(id_richiesta,
                                                        Arrivo,
                                                        Partenza,
                                                        NomeProposta,
                                                        TestoProposta,
                                                        CheckProposta,
                                                        PrezzoL,
                                                        PrezzoP,
                                                        AccontoPercentuale,
                                                        AccontoImporto,
                                                        AccontoTariffa,
                                                        AccontoTesto
                                                        ) VALUES (
                                                        '".$IdRichiesta."',
                                                        '".$DataArrivo5."',
                                                        '".$DataPartenza5."',
                                                        '".addslashes($_REQUEST['NomeProposta5'])."',
                                                        '".addslashes($_REQUEST['TestoProposta5'])."',
                                                        '".$_REQUEST['CheckProposta5']."',
                                                        '".$_REQUEST['PrezzoL5']."',
                                                        '".$_REQUEST['PrezzoP5']."',
                                                        '".$_REQUEST['AccontoPercentuale5']."',
                                                        '".$_REQUEST['AccontoImporto5']."',
                                                        '".addslashes($_REQUEST['EtichettaTariffa5'])."',
                                                        '".addslashes($_REQUEST['AccontoTesto5'])."')");

                $IdProposta5 = getlastid('hospitality_proposte');
                $n_camere5 = count($_REQUEST['TipoCamere5']);
                for($i=0; $i<=($n_camere5-1); $i++){
                    $db->query("INSERT INTO hospitality_richiesta(id_richiesta,
                                                        id_proposta,
                                                        TipoSoggiorno,
                                                        NumeroCamere,
                                                        TipoCamere,
                                                        NumAdulti,
                                                        NumBambini,
                                                        EtaB,
                                                        Prezzo
                                                        ) VALUES (
                                                        '".$IdRichiesta."',
                                                        '".$IdProposta5."',
                                                        '".$_REQUEST['TipoSoggiorno5'][$i]."',
                                                        '".$_REQUEST['NumeroCamere5'][$i]."',
                                                        '".$_REQUEST['TipoCamere5'][$i]."',
                                                        '".$_REQUEST['NumAdulti5'][$i]."',
                                                        '".$_REQUEST['NumBambini5'][$i]."',
                                                        '".$_REQUEST['EtaB5'][$i]."',
                                                        '".$_REQUEST['Prezzo5'][$i]."')");
                }

                if($_REQUEST['PrezzoServizio5'] != '') {
                    foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                        $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                    }
                }
                if($_REQUEST['VisibileServizio5'] != '') {
                    foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                        $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                }
                ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta5."','".$_REQUEST['SC5']."')");    
        }



            include($_SERVER['DOCUMENT_ROOT'].'/v2/include/template/moduli/logs.inc.php');

            if($TipoRichiesta=='Conferma'){
                 header('Location:'.BASE_URL_SITO.'conferme/');
            }
            if($TipoRichiesta=='Preventivo'){
                header('Location:'.BASE_URL_SITO.'preventivi/');
            }

    }

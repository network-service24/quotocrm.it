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



    $select_nomi = "SELECT Nome,Cognome,Email,Cellulare FROM hospitality_guest WHERE hospitality_guest.idsito = ".IDSITO." AND (hospitality_guest.Nome LIKE '%" . addslashes($_REQUEST['Nome']) . "%' OR hospitality_guest.Cognome LIKE '%" . addslashes($_REQUEST['Cognome']) . "%') GROUP BY hospitality_guest.Cognome";
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
    
    // configuratore select tipo camere
    $stile_chosen = check_configurazioni(IDSITO,'select_tipo_camere');

    // Query e ciclo per estrapolare i dati di tipologia camere
    $db->query("SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoCamere ASC");
    $rw = $db->result();
    foreach($rw as $key => $val){
        $ListaCamere .='<option value="'.$val['Id'].'">'.$val['TipoCamere'].'</option>';
    }

    $select_tipo_camere1 .= '  <select name="TipoCamere1[]" id="TipoCamere_1_1" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino(1,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere2 .= '  <select name="TipoCamere2[]" id="TipoCamere_2_1" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino(2,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere3 .= '  <select name="TipoCamere3[]" id="TipoCamere_3_1" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino(3,1);"':'').'>
                                  <option value="" selected="selected">Camere</option>
                                      '.$ListaCamere.'
                              </select>';

    $select_tipo_camere4 .= '  <select name="TipoCamere4[]" id="TipoCamere_4_1" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino(4,1);"':'').'>
                              <option value="" selected="selected">Camere</option>
                                  '.$ListaCamere.'
                          </select>';

    $select_tipo_camere5 .= '  <select name="TipoCamere5[]" id="TipoCamere_5_1" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino(5,1);"':'').'>
                          <option value="" selected="selected">Camere</option>
                              '.$ListaCamere.'
                      </select>';

    $z = 1;
    for($z==1; $z<=10; $z++){
        $NumeriC .='<option value="'.$z.'">'.$z.'</option>';
    }
    $a = 1;
    for($a==1; $a<=20; $a++){
        $NumeriAD .='<option value="'.$a.'">'.$a.'</option>';
    }

    $x = 1;
    for($x==1; $x<=6; $x++){
        $NumeriBimbi .='<option value="'.$x.'">'.$x.'</option>';
    }

    //ciclo per percentuli sconto
    $num_sconto = 1;
    for($num_sconto==1; $num_sconto<=25; $num_sconto++){
       $percentuali_sconto .='<option value="'.$num_sconto.'">'.$num_sconto.'%</option>';
    }
    $percentuali_sconto .='<option value="30">30</option>';
    $percentuali_sconto .='<option value="35">35</option>';
    $percentuali_sconto .='<option value="40">40</option>';
    $percentuali_sconto .='<option value="45">45</option>';
    $percentuali_sconto .='<option value="50">50</option>';

    function getlastid($tabella){
       global $db;
        $db->query("SELECT MAX(id) as Id FROM $tabella");
        $dato = $db->row();
        $newid = $dato['Id'];
        return($newid);
   }

    $Lingua = $_REQUEST['Lingua'];
    if($Lingua==''){
        $Lingua = 'it';
    }else{
        $Lingua =$_REQUEST['Lingua'];
    }


    if($_GET['azione'] == 'edit' && $_GET['param'] != '') {

        if($_REQUEST['azione_lingua'] == 'update_lingua') {
            $db->query("UPDATE hospitality_guest SET Lingua = '".$_REQUEST['Lingua']."' WHERE Id = ".$_GET['param']);
            //header
        }
        // query per estrarre dati booking online
        $db->query("SELECT BookingOnline FROM hospitality_social WHERE idsito = '".IDSITO."'");
        $rw =  $db->row();

        if($rw['BookingOnline']!=''){
           $BookingOnline   = '<div class="row">
                                  <div class="col-md-2"></div>
                                  <div class="col-md-8 text-center">
                                    <a href="javascript:;" onclick="window.open(\''.$rw['BookingOnline'].'\', \'\', \'top=500,left=500,width=1024,height=768\');" class="btn btn-success">
                                      <i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;Aiuto per il calcolo del preventivo con la maschera del tuo Booking Online
                                    </a>
                                  </div>
                                  <div class="col-md-2"></div>
                            </div>';
        }
        function get_servizi_aggiuntivi($n){
            global $db;

              $box_open = check_configurazioni(IDSITO,'check_open_servizi');
                        // Query per servizi aggiuntivi
                $query  = "SELECT hospitality_tipo_servizi.*FROM hospitality_tipo_servizi
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
                                                            <i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small class="pdL20">Il <b>numero massimo di Servizi Aggiunti è <span class="text-red" style="font-size:18px!important">'.NUMERO_SERVIZI.'</span></b>, se si <b>pareggia</b> questo numero, automaticamente i checkbox (in creazione e/o modifica preventivo) per rendere i servizi visibili o non visibili in ogni proposta, <b>verranno rimossi automaticamente</b>!</small>
                                                            <div class="clearfix"></div>
                                                            <i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <small class="pdL20"><b>ATTENZIONE:</b> selezionare tutte le caselle corrispondenti ai servizi da rendere visibili al cliente nel preventivo, anche per quelli inclusi e attivati con il cursore azzurro a destra.</small>
                                                            <div class="clearfix"></div>
                                                            <div class="pull-right box-tools">
                                                                <button data-original-title="Collapse"  class="btn btn-default btn-xs transparent no-border" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                        <i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <small class="pdL20">Per modificare i servizi aggiuntivi  abilitati durante la creazione del preventivo o dopo la duplicazione di un preventivo, cliccate sulla <b class="text-orange">X</b> corrispondete! (Ricordatevi di aggiornare il prezzo totale del soggiorno, semplicemente cliccando sul campo)</small><br><br>
                                                            <table class="table table-responsive nopadding transparent ">
                           
                                                            '.(DISABLED_CHECKBOX==1?'':'
                                                                <tr>
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
                                                            </tr>')."\r\n";
                   
                    foreach($record as $chiave => $campo){



                        $q  = "SELECT hospitality_tipo_servizi_lingua.Descrizione FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = 'it'";
                        $r = $db->query($q);
                        $rec  = $db->row($r);


                                        $lista_servizi_aggiuntivi .='<tr class="contenitore_servizio'.$n.'">
                                                                        <td class="td5pdl0pdr10 no-border-top padding2">'.($campo['Icona']!=''?'<div class="content_icona"><img src="'.BASE_URL_SITO.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></div>':'<div class="content_icona_empty"></div>').'</td>
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
    
                                        $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top padding2"><div id="valori_serv_'.$n.'_'.$campo['Id'].'"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'"></div><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'"></div></td>
                                                                        <td class="td5pdl0pdr0 no-border-top text-center padding2">';
                                    
                                    if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                                        $lista_servizi_aggiuntivi .='   <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'checked="checked"':'').'>';
                                    }else{
                                        $lista_servizi_aggiuntivi .='   <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($campo['Obbligatorio']==1?'checked="checked"':'').'>';
                                    } 
                                                                        
             
                                    $lista_servizi_aggiuntivi .='   <script>
                                                                            $(document).ready(function(){
                                                                                $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").change(function(){
                                                                                    if(this.checked == true){
                                                                                        if($("#DataArrivo_'.$n.'").val()!="" && $("#DataPartenza_'.$n.'").val()!=""){
                                                                                            var s_tmp     = $("#DataArrivo_'.$n.'").val();
                                                                                            var e_tmp     = $("#DataPartenza_'.$n.'").val();
                                                                                            var start_tmp = s_tmp.split("/");
                                                                                            var end_tmp   = e_tmp.split("/");
                                                                                            var dal       = s_tmp;
                                                                                            var al        = e_tmp;
                                                                                            var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],24,0,0).getTime()/1000;
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
                                                                                                $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                                $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").show();
                                                                                            },
                                                                                            error: function(){
                                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                        </script>
                                                                        <div class="modal fade" id="modal_persone_'.$n.'_'.$campo['Id'].'"  role="dialog" aria-labelledby="myModalLabel">
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
                                                                                                    $("#num_persone_'.$n.'_'.$campo['Id'].'").on("show.bs.modal", function (event) {
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

                                                                                                            },
                                                                                                            error: function(){
                                                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                                                            }
                                                                                                        });

                                                                                                });

                                                                                            });
                                                                                        </script>

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
        function get_modifica_servizi_aggiuntivi($n,$id_richiesta,$id_proposta){
            global $db,$Notti;

            $box_open = check_configurazioni(IDSITO,'check_open_servizi');

                $q = "SELECT * FROM hospitality_relazione_servizi_proposte WHERE id_richiesta = ".$id_richiesta." AND id_proposta = ".$id_proposta;
                $r = $db->query($q);
                $r = $db->result($r);
                $IdServizio = array();
                foreach($r as $k => $v){
                    $IdServizio[$v['servizio_id']]=1;
                }



                        // Query per servizi aggiuntivi
                $query  = "SELECT hospitality_tipo_servizi.* FROM hospitality_tipo_servizi
                                WHERE hospitality_tipo_servizi.idsito = ".IDSITO."
                                AND hospitality_tipo_servizi.Lingua  = 'it'
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
                                                            <i class="fa fa-exclamation-circle text-info" aria-hidden="true"></i> <small class="pdL20">Il <b>numero massimo di Servizi Aggiunti è <span class="text-red" style="font-size:18px!important">'.NUMERO_SERVIZI.'</span></b>, se si <b>pareggia</b> questo numero, automaticamente i checkbox (in creazione e/o modifica preventivo) per rendere i servizi visibili o non visibili in ogni proposta, <b>verranno rimossi automaticamente</b>!</small>
                                                            <div class="clearfix"></div>
                                                            <i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <small class="pdL20"><b>ATTENZIONE:</b> selezionare tutte le caselle corrispondenti ai servizi da rendere visibili al cliente nel preventivo, anche per quelli inclusi e attivati con il cursore azzurro a destra.</small>
                                                            <div class="clearfix"></div>
                                                            <div class="pull-right box-tools">
                                                                <button data-original-title="Collapse"  class="btn btn-default btn-xs transparent no-border" data-widget="collapse" data-toggle="tooltip"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                        <i class="fa fa-exclamation-triangle text-orange" aria-hidden="true"></i> <small class="pdL20">Per modificare i servizi aggiuntivi  abilitati durante la creazione del preventivo o dopo la duplicazione di un preventivo, cliccate sulla <b class="text-orange">X</b> corrispondete! (Ricordatevi di aggiornare il prezzo totale del soggiorno, semplicemente cliccando sul campo)</small><br><br>
                                                            <table class="table table-responsive nopadding transparent ">
                                                            '.(DISABLED_CHECKBOX==1?'':
                                                                '<tr>
                                                                    <td class="td5pdl0pdr10 no-border-top padding2"></td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2"></td>
                                                                    <td class="td20pdl0pdr10 no-border-top padding2 text-right" colspan="2">
                                                                        <div  id="selectAll'.$n.'" style="cursor:pointer"><small><i class="fa fa-check-square-o"></i> Selezione tutti</small> <i class="fa fa-exclamation-circle text-info" aria-hidden="true" data-toggle="tooltip" data-html="true" title="<b>ATTENZIONE:</b> solo i servizi selezionati saranno visibili lato utente finale!"></i></div>
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
                                                            </tr>')."\r\n";

                    foreach($record as $chiave => $campo){



                        $q  = "SELECT hospitality_tipo_servizi_lingua.Descrizione FROM hospitality_tipo_servizi_lingua  WHERE hospitality_tipo_servizi_lingua.servizio_id = ".$campo['Id']." AND hospitality_tipo_servizi_lingua.idsito = ".IDSITO." AND hospitality_tipo_servizi_lingua.lingue = 'it'";
                        $r = $db->query($q);
                        $rec  = $db->row($r);

                        $qrel   = "SELECT hospitality_relazione_servizi_proposte.id as id_relazionale,hospitality_relazione_servizi_proposte.num_persone,hospitality_relazione_servizi_proposte.num_notti FROM hospitality_relazione_servizi_proposte WHERE hospitality_relazione_servizi_proposte.id_richiesta = ".$id_richiesta." AND hospitality_relazione_servizi_proposte.id_proposta = ".$id_proposta." AND hospitality_relazione_servizi_proposte.servizio_id = ".$campo['Id']." ";
                        $rel    = $db->query($qrel);
                        $recrel = $db->row($rel);

                        $s  = "SELECT hospitality_relazione_visibili_servizi_proposte.visibile FROM hospitality_relazione_visibili_servizi_proposte  WHERE hospitality_relazione_visibili_servizi_proposte.id_richiesta = ".$id_richiesta." AND hospitality_relazione_visibili_servizi_proposte.id_proposta = ".$id_proposta." AND hospitality_relazione_visibili_servizi_proposte.servizio_id = ".$campo['Id']." AND hospitality_relazione_visibili_servizi_proposte.idsito = ".IDSITO."";
                        $ss = $db->query($s);
                        $rs  = $db->row($ss);

                                        $lista_servizi_aggiuntivi .='<tr class="contenitore_servizio'.$n.'">
                                                                        <td class="td5pdl0pdr10 no-border-top padding2">'.($campo['Icona']!=''?'<div class="content_icona"><img src="'.BASE_URL_SITO.'uploads/'.IDSITO.'/'.$campo['Icona'].'" class="iconaDimension"></div>':'<div class="content_icona_empty"></div>').'</td>
                                                                        <td class="td20pdl0pdr10 no-border-top padding2"><b>'.$campo['TipoServizio'].'</b></td>
                                                                        <td class="td20pdl0pdr10 no-border-top padding2"><small>'.(strlen($rec['Descrizione'])<=80?stripslashes(strip_tags($rec['Descrizione'])):substr(stripslashes(strip_tags($rec['Descrizione'])),0,80).'...').'</small></td>
                                                                        <td class="td10pdl0pdr10 no-border-top padding2">'.(DISABLED_CHECKBOX==1?'':'<input type="checkbox" class="select_servizi'.$n.'" data-toogle="tooltip" title="Rendi visibile o nascondi il servizio" class="" id="VisibileServizio'.$n.'_'.$campo['Id'].'" name="VisibileServizio'.$n.'['.$campo['Id'].']" value="1" '.($rs['visibile']==1?'checked="checked"':'').'>').'</td>';
                                   
                                    if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                                        $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top text-maroon padding2">'.$campo['CalcoloPrezzo'].'</td>
                                                                        <td class="td20pdl0pdr10 no-border-top padding2"><i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format($campo['PercentualeServizio'],2).'</td>';
                                    }else{
                                        $lista_servizi_aggiuntivi .='   <td class="td20pdl0pdr10 no-border-top '.($campo['CalcoloPrezzo']=='Una tantum'?'text-green':'text-orange').' padding2">'.($campo['CalcoloPrezzo']=='A persona'?$campo['CalcoloPrezzo'].' <i class="fa fa-info-circle text-teal" data-toggle="tooltip" data-html="true" title="Per <b>modificare</b> un valore già inserito disabilita e riabilita il servizio, riapparirà il pulsante <b>Calcola</b>"></i>':$campo['CalcoloPrezzo']).'</td>
                                                                        <td class="td20pdl0pdr10 no-border-top padding2">'.($campo['PrezzoServizio']!=0?'<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($campo['PrezzoServizio'],2,',','.'):'<small class="text-info">Gratis</small>').'</td>';
                                    }

                                    $lista_servizi_aggiuntivi .='       <td class="td20pdl0pdr10 no-border-top padding2">'.($recrel['num_notti']!= 0 || !is_null($recrel['num_notti']) || !empty($recrel['num_notti']) ? '<input type="hidden" name="notti'.$n.'_'.$campo['Id'].'" id="notti'.$n.'_'.$campo['Id'].'" data-tipo="notti'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_notti'].'">':'').($recrel['num_persone']!= 0 || !is_null($recrel['num_persone']) || !empty($recrel['num_persone']) ? '<input type="hidden" name="num_persone_'.$n.'_'.$campo['Id'].'" id="num_persone'.$n.'_'.$campo['Id'].'" data-tipo="persone'.$n.'_'.$campo['Id'].'" value="'.$recrel['num_persone'].'" />':'').'<div id="valori_serv_'.$n.'_'.$campo['Id'].'"></div><div id="pulsante_calcola_'.$n.'_'.$campo['Id'].'"></div><div id="spiegazione_prezzo_servizio_'.$n.'_'.$campo['Id'].'"></div><div id="Prezzo_Servizio_'.$n.'_'.$campo['Id'].'"></div></div>'.($campo['Obbligatorio']==1?'<small>(Incluso)</small>':'').'</td>
                                                                        <td class="td5pdl0pdr0 no-border-top text-center padding2">';

                                if($campo['CalcoloPrezzo'] == 'A percentuale' && $campo['PercentualeServizio'] != ''){ 
                                    $lista_servizi_aggiuntivi .='       <div id="contenitore_switchery'.$recrel['id_relazionale'].'">
                                                                        <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PercentualeServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').' '.($campo['Obbligatorio']==1?'checked="checked"':'').'>';
                                }else{
                                    $lista_servizi_aggiuntivi .='       <div id="contenitore_switchery'.$recrel['id_relazionale'].'">
                                                                        <input type="checkbox" class="js-switch PrezzoServizio'.$n.'" id="PrezzoServizio'.$n.'_'.$campo['Id'].'" name="PrezzoServizio'.$n.'['.$campo['Id'].']" value="'.$campo['PrezzoServizio'].'#'.$campo['CalcoloPrezzo'].'#'.$campo['Id'].'" '.($IdServizio[$campo['Id']]==1?'checked="checked"':'').' '.($campo['Obbligatorio']==1?'checked="checked"':'').'>';
                                }                 
                                    $lista_servizi_aggiuntivi .='       <script>
                                                                                $(document).ready(function(){
                                                                                    $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").change(function(){
                                                                                        if(this.checked == true){
                                                                                            if($("#DataArrivo_'.$n.'").val()!="" && $("#DataPartenza_'.$n.'").val()!=""){
                                                                                                var s_tmp     = $("#DataArrivo_'.$n.'").val();
                                                                                                var e_tmp     = $("#DataPartenza_'.$n.'").val();
                                                                                                var start_tmp = s_tmp.split("/");
                                                                                                var end_tmp   = e_tmp.split("/");
                                                                                                var dal       = s_tmp;
                                                                                                var al        = e_tmp;
                                                                                                var start     = new Date(start_tmp[2],(start_tmp[1]-1),start_tmp[0],24,0,0).getTime()/1000;
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
                                                                                                    $("#valori_serv_'.$n.'_'.$campo['Id'].'").html(data);
                                                                                                    $("#pulsante_calcola_'.$n.'_'.$campo['Id'].'").show();
                                                                                                },
                                                                                                error: function(){
                                                                                                    alert("Chiamata fallita, si prega di riprovare...");
                                                                                                }
                                                                                            });
                                                                                        }
                                                                                    });
                                                                                });
                                                                        </script>
                                                                        <div class="modal fade" id="modal_persone_'.$n.'_'.$campo['Id'].'"  role="dialog" aria-labelledby="myModalLabel">
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
                                                                                                    $("#num_persone_'.$n.'_'.$campo['Id'].'").on("show.bs.modal", function (event) {
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
                                                                                                                $("input[data-tipo=persone'.$n.'_'.$campo['Id'].']").remove();
                                                                                                                $("input[data-tipo=notti'.$n.'_'.$campo['Id'].']").remove();
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
                                                                        </div>
                                                                        </div>
                                                                        </td>
                                                                        <td class="no-border-top">
                                                                        '.($IdServizio[$campo['Id']]==1?'
                                                                            <i class="fa fa-remove text-orange" id="remove_service'.$recrel['id_relazionale'].'" style="cursor:pointer" data-toogle="tooltip" data-html="true" title="Se cliccate sulla <b class=\'text-orange\'>X</b> eliminate la scelta del servizio, per <b>riattivarla</b> dovete prima salvare la modifica e riaprire il preventivo per riattivare il servizio stesso!" ></i>
                                                                            <script>
                                                                            $(document).ready(function() {
                                                                                $("#contenitore_switchery'.$recrel['id_relazionale'].' .switchery").addClass("switchery-opacity");
                                                                                $("#remove_service'.$recrel['id_relazionale'].'").on("click",function(){
                                                                                    if (window.confirm("ATTENZIONE: Sicuro di voler eliminare questo servizio dal preventivo?")){
                                                                                        var idsito   = '.IDSITO.';
                                                                                        var n_prop   = '.$n.';
                                                                                        var id_serv  = '.$recrel['id_relazionale'].';
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "'.BASE_URL_SITO.'ajax/remove_serv.php",
                                                                                            data: "action=remove_serv&n_prop=" + n_prop + "&id_serv=" + id_serv + "&idsito=" + idsito,
                                                                                            dataType: "html",
                                                                                            success: function(data){

                                                                                                $("#PrezzoServizio'.$n.'_'.$campo['Id'].'").prop("checked",false);
                                                                                                $("#contenitore_switchery'.$recrel['id_relazionale'].' .switchery").removeClass("switchery-opacity");
                                                                                                $("#contenitore_switchery'.$recrel['id_relazionale'].' .switchery").addClass("switchery-off");
                                                                                                $("#contenitore_switchery'.$recrel['id_relazionale'].' .switchery small").addClass("small-switchery-off");
                                                                                            },
                                                                                            error: function(){
                                                                                                alert("Chiamata fallita, si prega di riprovare...");
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            </script>
                                                                        ':'').'
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

        $db->query("SELECT * FROM hospitality_guest WHERE Id = ".$_GET['param']);
        $dati = $db->result();
        foreach($dati as $c => $row){


                $Id                  = $row['Id'];
                $id_politiche        = $row['id_politiche'];
                $id_template         = $row['id_template'];
                $Acconto             = $row['AccontoRichiesta'];
                $AccontoLibero       = $row['AccontoLibero'];
                $DataRichiesta       = $row['DataRichiesta'];
                $TipoRichiesta       = $row['TipoRichiesta'];
                $TipoVacanza         = $row['TipoVacanza'];
                $Lingua              = $row['Lingua'];
                $ChiPrenota          = $row['ChiPrenota'];
                $EmailOperatore      = $row['EmailSegretaria'];
                $IdClienteGestionale = $row['IdClienteGestionale'];

                $MultiStruttura      = stripslashes($row['MultiStruttura']);
                $Nome                = stripslashes($row['Nome']);
                $Cognome             = stripslashes($row['Cognome']);
                $Email               = $row['Email'];
                $prefisso            = $row['PrefissoInternazionale'];
                $Cellulare           = $row['Cellulare'];
                $DataN_tmp           = explode("-",$row['DataNascita']);
                $DataNascita         = $DataN_tmp[2].'/'.$DataN_tmp[1].'/'.$DataN_tmp[0];

                $DataA_tmp           = explode("-",$row['DataArrivo']);
                $DataArrivo          = $DataA_tmp[2].'/'.$DataA_tmp[1].'/'.$DataA_tmp[0];
                $DataP_tmp           = explode("-",$row['DataPartenza']);
                $DataPartenza        = $DataP_tmp[2].'/'.$DataP_tmp[1].'/'.$DataP_tmp[0];
                $NumeroPrenotazione  = $row['NumeroPrenotazione'];

                $NumeroAdulti        = $row['NumeroAdulti'];
                $NumeroBambini       = $row['NumeroBambini'];
                $EtaBambini1         = $row['EtaBambini1'];
                $EtaBambini2         = $row['EtaBambini2'];
                $EtaBambini3         = $row['EtaBambini3'];
                $EtaBambini4         = $row['EtaBambini4'];
                $EtaBambini5         = $row['EtaBambini5'];
                $EtaBambini6         = $row['EtaBambini6'];

                $FontePrenotazione   = $row['FontePrenotazione'];
                $TipoPagamento       = $row['TipoPagamento'];
                $DataS_tmp           = explode("-",$row['DataScadenza']);
                $DataScadenza        = $DataS_tmp[2].'/'.$DataS_tmp[1].'/'.$DataS_tmp[0];
                $Note                = stripslashes($row['Note']);

                $AbilitaInvio        = $row['AbilitaInvio'];

                $Chiuso              = $row['Chiuso'];
                $DataChiuso          = $row['DataChiuso'];
                $IdMotivazione       = $row['IdMotivazione'];
                $DataVoucherRecSend  = $row['DataVoucherRecSend'];
                $DataValiditaVoucher = $row['DataValiditaVoucher'];
                $DataRi              = $row['DataRiconferma'];
        }

        $js_ajax_content ='
                            <script>
                            /* compilazione del testo richiesta*/
                                $( document ).ready(function() {
                                    $("#id_template").on("change",function(){
                                        var tiporichiesta = $("#TipoRichiesta").val();  
                                        var id_richiesta  = '.$Id.';   
                                        var idsito = '.IDSITO.';
                                        var lingua = "'.$Lingua.'";
                                        var target = $("#TipoVacanza").val();  
                                        var id_template = $("#id_template").val();
                                        var template = $("#id_template option:selected").text(); 
                                        $.ajax({        
                                            type: "POST",         
                                            url: "'.BASE_URL_SITO.'ajax/associa_contenuto_landing.php",        
                                            data: "tiporichiesta=" + tiporichiesta + "&idsito=" + idsito + "&lingua=" + lingua + "&target=" + target+ "&id_richiesta=" + id_richiesta+ "&id_template=" + id_template+ "&template=" + template,
                                            dataType: "html",        
                                            success: function(data){

                                               if(template != "default" || template != "smart" || template != ""){
                                                    var content = $(\'#Testo\');
                                                    var contentPar = content.parent();
                                                    contentPar.find(\'.wysihtml5-toolbar\').remove();
                                                    contentPar.find(\'iframe\').remove();
                                                    contentPar.find(\'input[name*="wysihtml5"]\').remove();
                                                    content.show();
                                                    $("#Testo").prop("disabled",true);
                                                    $("#Testo").hide();
                                                    $("#html").hide();
                                                    $("#html2").hide();
                                                    $("#etichetta_html").hide();
                                                    $("#etichetta_html2").hide();
                                                    $("#TestoAlternativo").show();  
                                                    $("#TestoAlternativo").prop("disabled",false); 
                                                    $("#TestoAlternativo").attr("style","height:150px!important"); 
                                                    $("#TestoAlternativo").html(\'\'+data+\'\');
                                                }else{
                                                    var content = $(\'#Testo\');
                                                    var contentPar = content.parent();
                                                    contentPar.find(\'.wysihtml5-toolbar\').remove();
                                                    contentPar.find(\'iframe\').remove();
                                                    contentPar.find(\'input[name*="wysihtml5"]\').remove();
                                                    content.show();
                                                    $("#html").show();
                                                    $("#html2").show();
                                                    $("#etichetta_html").show();
                                                    $("#etichetta_html2").show();
                                                    $("#Testo").show();
                                                    $("#Testo").prop("disabled",false);
                                                    $("#Testo").wysihtml5(); 
                                                    $("#TestoAlternativo").hide(); 
                                                    $("#TestoAlternativo").prop("disabled",true);  
                                                }
                                            },
                                            error: function(){
                                                alert("Chiamata fallita, si prega di riprovare..."); 
                                            }
                                        });  
                                    });
                                });
                            </script>'."\r\n";

        // controllo quante lingue sono impostate
        $db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
        $row = $db->result();
        foreach($row as $chiave => $valore){
            $ArrayLingua[] = $valore['Sigla'];
        }
        // se la lingua della richiesta non è presente allora di default carico EN
        if(!in_array($Lingua,$ArrayLingua)){
            $Lingua = 'en';
        }

        $select = "SELECT * FROM hospitality_acconto_pagamenti WHERE idsito = ".IDSITO;
        $res    = $db->query($select);
        $rw     = $db->row($res);
        $Acc    = $rw['Acconto'];
        if($Acconto==''){
            $Acconto = $Acc;
        }
        $AccontoRichiesta .='<option value="" '.($Acconto==''?'selected="selected"':'').'>--</option>'."\r\n";
        $AccontoRichiesta .='<option value="importo" '.($Acc=='importo'?'selected="selected"':'').'>importo</option>'."\r\n";
        $AccontoRichiesta .='<option value="10" '.($Acconto=='10'?'selected="selected"':'').'>10%</option>'."\r\n";
        $AccontoRichiesta .='<option value="15" '.($Acconto=='15'?'selected="selected"':'').'>15%</option>'."\r\n";
        $AccontoRichiesta .='<option value="20" '.($Acconto=='20'?'selected="selected"':'').'>20%</option>'."\r\n";
        $AccontoRichiesta .='<option value="25" '.($Acconto=='25'?'selected="selected"':'').'>25%</option>'."\r\n";
        $AccontoRichiesta .='<option value="30" '.($Acconto=='30'?'selected="selected"':'').'>30%</option>'."\r\n";
        $AccontoRichiesta .='<option value="40" '.($Acconto=='40'?'selected="selected"':'').'>40%</option>'."\r\n";
        $AccontoRichiesta .='<option value="50" '.($Acconto=='50'?'selected="selected"':'').'>50%</option>'."\r\n";
        $AccontoRichiesta .='<option value="60" '.($Acconto=='60'?'selected="selected"':'').'>60%</option>'."\r\n";
        $AccontoRichiesta .='<option value="70" '.($Acconto=='70'?'selected="selected"':'').'>70%</option>'."\r\n";
        $AccontoRichiesta .='<option value="80" '.($Acconto=='80'?'selected="selected"':'').'>80%</option>'."\r\n";
        $AccontoRichiesta .='<option value="90" '.($Acconto=='90'?'selected="selected"':'').'>90%</option>'."\r\n";
        $AccontoRichiesta .='<option value="100" '.($Acconto=='100'?'selected="selected"':'').'>100%</option>'."\r\n";


        // Query e ciclo per estrapolare
        $db->query("SELECT * FROM hospitality_politiche WHERE idsito = ".IDSITO." AND tipo = 0  ORDER BY Id ASC");
        $rec = $db->result();
        foreach($rec as $ch => $vl){
            $ListaPolitiche .='<option value="'.$vl['id'].'" '.($id_politiche==$vl['id']?'selected="selected"':'').'>'.$vl['etichetta'].'</option>';
        }

        $db->query("SELECT * FROM hospitality_lingue WHERE idsito = ".IDSITO." ORDER BY Id ASC");
        $row = $db->result();
        foreach($row as $chiave => $valore){
            $ListaLingua .='<option value="'.$valore['Sigla'].'" '.($Lingua==$valore['Sigla']?'selected="selected"':'').'>'.$valore['Lingua'].'</option>';
        }
        // Query e ciclo per estrapolare i prefissi telefonici internazionali
        $db->query("SELECT * FROM prefissi  ORDER BY nazione ASC");
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
            if($prefisso==''){
                if($lingua_estesa==trim($val['nazione'])){
                    $se = 'selected="selected"';
                }else{
                        $se = '';
                }  
            }else{     
                if(trim($val['prefisso'])==$prefisso){
                    $se = 'selected="selected"';
                }else{
                    $se = '';
                }
            }
            $ListaPrefissi .='<option value="'.$val['prefisso'].'" '.$se.'>'.ucwords(strtolower($val['nazione'])).' +'.$val['prefisso'].' </option>';
        }
        // Query e ciclo per estrapolare gli operatori

        $db->query("SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY Id ASC");
        $row = $db->result();
        $EmailOperatoreDefault = trim($row[0]['EmailSegretaria']);
        $NomiOperatori = '';
        $EmailSegretaria = '';
        foreach($row as $chiave => $valore){
           $NomiOperatori .='<option value="'.$valore['NomeOperatore'].'" '.($ChiPrenota==$valore['NomeOperatore']?'selected="selected"':'').'>'.$valore['NomeOperatore'].'</option>';
           $EmailSegretaria .='<option value="'.$valore['EmailSegretaria'].'" '.($EmailOperatore==$valore['EmailSegretaria']?'selected="selected"':'').'>'.$valore['EmailSegretaria'].'</option>';
        }

        $db->query("SELECT * FROM hospitality_target WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Id ASC");
        $row = $db->result();
        $Target .='<option value="">--</option>';
        foreach($row as $chiave => $valore){
            $Target .='<option value="'.$valore['Target'].'" '.($TipoVacanza==$valore['Target']?'selected="selected"':'').' >'.$valore['Target'].'</option>';
        }

        // Query e ciclo per estrapolare i dati delle fonti di prenotazione
        $db->query("SELECT * FROM hospitality_fonti_prenotazione WHERE Abilitato = 1 AND idsito = ".IDSITO." ORDER BY FontePrenotazione ASC");
        $rws = $db->result();
        foreach($rws as $key => $v){
            $ListaFonti .='<option value="'.$v['FontePrenotazione'].'" '.($v['FontePrenotazione']=='Sito Web'?'disabled="disabled"':'').' '.($FontePrenotazione==$v['FontePrenotazione']?'selected="selected"':'').'>'.($v['FontePrenotazione']=='Sito Web'?$v['FontePrenotazione'].' / Landing':$v['FontePrenotazione']).'</option>';
        }

        // query per testo alternativo landing page
        $select = "SELECT Testo,Id FROM hospitality_contenuti_web_lingua WHERE IdRichiesta = ".$Id." AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' ORDER BY Id DESC";
        $res = $db->query($select);
        $vl = $db->row($res);
        if(is_array($vl)) {
            if($vl > count($vl)) // se la pagina richiesta non esiste
                $tot = count($vl); // restituire la pagina con il numero più alto che esista
        }else{
            $tot = 0;
        }
        if($tot>0){
            $IdTestoAlternativo = $vl['Id'];
            $TestoAlternativo = $vl['Testo'];
        }else{

           

                if($id_template != ''){
                    $record_template      = check_nome_template_by_id($id_template,IDSITO);
                    $nome_template_scelto = ucfirst($record_template['TemplateName']);
                    $tipo_template_scelto = strtoupper($record_template['TemplateType']);
                }else{
                    $record_template      = check_nome_template_default(IDSITO);
                    $nome_template_scelto = ucfirst($record_template['Template']);
                }
               


                if(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Preventivo'){
                    // query per testo default landing page
                    $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                                INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                WHERE hospitality_dizionario.idsito = ".IDSITO." 
                                AND hospitality_dizionario.etichetta = 'PREVENTIVO_".$tipo_template_scelto."'
                                AND hospitality_dizionario_lingua.idsito =  ".IDSITO." 
                                AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                    $re = $db->query($sele);
                    $v  = $db->row($re);
                    $TestoAlternativo = stripslashes($v['testo']);
        
                }elseif(ucfirst($TipoVacanza) == $nome_template_scelto && $TipoRichiesta == 'Conferma'){
        
                    // query per testo default landing page
                    $sele = "SELECT hospitality_dizionario_lingua.testo FROM hospitality_dizionario 
                                INNER JOIN hospitality_dizionario_lingua ON hospitality_dizionario_lingua.id_dizionario = hospitality_dizionario.id
                                WHERE hospitality_dizionario.idsito = ".IDSITO." 
                                AND hospitality_dizionario.etichetta = 'CONFERMA_".$tipo_template_scelto."'
                                AND hospitality_dizionario_lingua.idsito =  ".IDSITO." 
                                AND hospitality_dizionario_lingua.Lingua = '".$Lingua."'";
                    $re = $db->query($sele);
                    $v = $db->row($re);
                    $TestoAlternativo = stripslashes($v['testo']);
                       

                }else{

            
                    // query per testo default landing page
                    $sele = "SELECT Testo FROM hospitality_contenuti_web WHERE TipoRichiesta = '".$TipoRichiesta."' AND idsito = ".IDSITO." AND Lingua = '".$Lingua."' AND Abilitato = 1";
                    $re = $db->query($sele);
                    $v = $db->row($re);
                    $TestoAlternativo = stripslashes($v['Testo']);

                }
            
        }
    
        // Query e ciclo per estrapolare i tipi di pagamento
        $sel2 = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = ".IDSITO." AND id_richiesta = ".$Id."";
        $ris2 = $db->query($sel2);
        $rec2 = $db->row($ris2);
        if(is_array($rec2)) {
            if($rec2 > count($rec2)) // se la pagina richiesta non esiste
                $tot2 = count($rec2); // restituire la pagina con il numero più alto che esista
        }else{
            $tot2 = 0;
        }
        $sel = "SELECT * FROM hospitality_tipo_pagamenti WHERE idsito = ".IDSITO." AND Abilitato = 1 ORDER BY Ordine ASC";
        $ris = $db->query($sel);
        $rec = $db->result($ris);

            if(sizeof($rec)>0){

                $TipiPagamento .='<table class="table table-responsive"><tr>';

                foreach($rec as $ch => $vl){

                  if($tot2==0){
                      $TipiPagamento .='
                                      '.($vl['TipoPagamento']=='Carta di Credito'?'<td class="text-center no_border_top no_padding"><b>Carta di Credito</b><br><input class="js-switch" type="checkbox" value="1" '.($vl['TipoPagamento']=='Carta di Credito'?'checked="checked"':'').' name="CC"></td>':'').'
                                      '.($vl['TipoPagamento']=='Bonifico Bancario'?'<td class="text-center no_border_top no_padding"><b>Bonifico Bancario</b><br><input class="js-switch" type="checkbox" value="1" '.($vl['TipoPagamento']=='Bonifico Bancario'?'checked="checked"':'').' name="BB"></td>':'').'
                                      '.($vl['TipoPagamento']=='Vaglia Postale'?'<td class="text-center no_border_top no_padding"><b>Vaglia Postale</b><br><input class="js-switch" type="checkbox" value="1" '.($vl['TipoPagamento']=='Vaglia Postale'?'checked="checked"':'').' name="VP"></td>':'').'
                                      '.($vl['TipoPagamento']=='PayPal'?'<td class="text-center no_border_top no_padding"><b>PayPal</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='PayPal'?'checked="checked"':'').' name="PP"></td>':'').'
                                      '.($vl['TipoPagamento']=='Gateway Bancario'?'<td class="text-center no_border_top no_padding"><b>PayWay</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Gateway Bancario'?'checked="checked"':'').' name="GB"></td>':'').'
                                      '.($vl['TipoPagamento']=='Gateway Bancario Virtual Pay'?'<td class="text-center no_border_top no_padding"><b>Virtual Pay</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Gateway Bancario Virtual Pay'?'checked="checked"':'').' name="GBVP"></td>':'').'
                                      '.($vl['TipoPagamento']=='Stripe'?'<td class="text-center no_border_top no_padding"><b>Stripe</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Stripe'?'checked="checked"':'').' name="GBS"></td>':'').'
                                      '.($vl['TipoPagamento']=='Nexi'?'<td class="text-center no_border_top no_padding"><b>Nexi</b><br><input type="checkbox" class="js-switch" value="1" '.($vl['TipoPagamento']=='Nexi'?'checked="checked"':'').' name="GBNX"></td>':'').'
                                      ';
                  }else{
                      $TipiPagamento .='
                                      '.($vl['TipoPagamento']=='Carta di Credito'?'<td class="text-center no_border_top no_padding"><b>Carta di Credito</b><br><input class="js-switch" type="checkbox" value="1" '.($rec2['CC']==1?'checked="checked"':'').' name="CC"></td>':'').'
                                      '.($vl['TipoPagamento']=='Bonifico Bancario'?'<td class="text-center no_border_top no_padding"><b>Bonifico Bancario</b><br><input class="js-switch" type="checkbox" value="1" '.($rec2['BB']==1?'checked="checked"':'').' name="BB"></td>':'').'
                                      '.($vl['TipoPagamento']=='Vaglia Postale'?'<td class="text-center no_border_top no_padding"><b>Vaglia Postale</b><br><input class="js-switch" type="checkbox" value="1" '.($rec2['VP']==1?'checked="checked"':'').' name="VP"></td>':'').'
                                      '.($vl['TipoPagamento']=='PayPal'?'<td class="text-center no_border_top no_padding"><b>PayPal</b><br><input type="checkbox" class="js-switch" value="1" '.($rec2['PP']==1?'checked="checked"':'').' name="PP"></td>':'').'
                                      '.($vl['TipoPagamento']=='Gateway Bancario'?'<td class="text-center no_border_top no_padding"><b>PayWay</b><br><input type="checkbox" class="js-switch" value="1" '.($rec2['GB']==1?'checked="checked"':'').' name="GB"></td>':'').'
                                      '.($vl['TipoPagamento']=='Gateway Bancario Virtual Pay'?'<td class="text-center no_border_top no_padding"><b>Virtual Pay</b><br><input type="checkbox" class="js-switch" value="1" '.($rec2['GBVP']==1?'checked="checked"':'').' name="GBVP"></td>':'').'
                                      '.($vl['TipoPagamento']=='Stripe'?'<td class="text-center no_border_top no_padding"><b>Stripe</b><br><input type="checkbox" class="js-switch" value="1" '.($rec2['GBS']==1?'checked="checked"':'').' name="GBS"></td>':'').'
                                      '.($vl['TipoPagamento']=='Nexi'?'<td class="text-center no_border_top no_padding"><b>Nexi</b><br><input type="checkbox" class="js-switch" value="1" '.($rec2['GBNX']==1?'checked="checked"':'').' name="GBNX"></td>':'').'
                                      ';
                      }
                }
                $TipiPagamento .='</tr></table>';
            }
        // configuratore per la select del tipo camere
        $stile_chosen = check_configurazioni(IDSITO,'select_tipo_camere');
        // Query lista template
        $db->query("SELECT hospitality_template_background.TemplateName,hospitality_template_background.Thumb,hospitality_template_background.Id as idTempBk FROM hospitality_template_background
                    WHERE hospitality_template_background.idsito = ".IDSITO." ORDER BY hospitality_template_background.Id ASC");
        $rwt = $db->result();

        foreach($rwt as $kt => $vt){
            $db->query("SELECT * FROM hospitality_template_landing WHERE idsito = ".IDSITO." LIMIT 1");
            $rt = $db->row();

            $ListaTemplate .='<option  data-img-src="'.BASE_URL_SITO.'img/'.$vt['Thumb'].'" data-img-label="Template '.$vt['TemplateName'].'" data-id="'.$vt['TemplateName'].'" value="'.$vt['idTempBk'].'" '.($id_template==$vt['idTempBk']?'selected="selected"':'').'>'.$vt['TemplateName'].'</option>';
        }
        // Ciclo per il select numerico
        $i = 1;
        for($i==1; $i<=20; $i++){
            $NumeriA .='<option value="'.$i.'" '.($NumeroAdulti==$i?'selected="selected"':'').'>'.$i.'</option>';

        }
        $NumeriA .='<option value="25" '.($NumeroAdulti==25?'selected="selected"':'').'>25</option>';
        $NumeriA .='<option value="30" '.($NumeroAdulti==30?'selected="selected"':'').'>30</option>';
        $NumeriA .='<option value="35" '.($NumeroAdulti==35?'selected="selected"':'').'>35</option>';
        $NumeriA .='<option value="40" '.($NumeroAdulti==40?'selected="selected"':'').'>40</option>';
        $NumeriA .='<option value="45" '.($NumeroAdulti==45?'selected="selected"':'').'>45</option>';
        $NumeriA .='<option value="50" '.($NumeroAdulti==50?'selected="selected"':'').'>50</option>';
        $NumeriA .='<option value="60" '.($NumeroAdulti==60?'selected="selected"':'').'>60</option>';
        $NumeriA .='<option value="70" '.($NumeroAdulti==70?'selected="selected"':'').'>70</option>';

        $x = 1;
        for($x==1; $x<=6; $x++){
            $NumeriB .='<option value="'.$x.'" '.($NumeroBambini==$x?'selected="selected"':'').'>'.$x.'</option>';
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

        $qry_conteggio_proposte = "SELECT * FROM hospitality_proposte WHERE id_richiesta = ".$_REQUEST['param']." ORDER BY Id ASC";
        $res_conteggio_proposte = $db->query($qry_conteggio_proposte);
        $record = $db->result($res_conteggio_proposte);
        $numero_proposte = sizeof($record);
        // azzero le variabili
        $i              = 1;
        $ListaPacchetti = '';
        $ListaTariffe   = '';
        $listaCamere    = '';
        $select_sconti  = '';
        $lista_sconti   = '';

        foreach($record as $k => $rows){

               $Id_riga            = $rows['Id'];
               $NomeProposta       = stripslashes($rows['NomeProposta']);
               $TestoProposta      = stripslashes($rows['TestoProposta']);
               $CheckProposta      = $rows['CheckProposta'];
               $PrezzoL            = $rows['PrezzoL'];
               $PrezzoP            = $rows['PrezzoP'];
               $AccontoPercentuale = $rows['AccontoPercentuale'];
               $AccontoImporto     = $rows['AccontoImporto'];
               $AccontoTariffa     = stripslashes($rows['AccontoTariffa']);
               $AccontoTesto       = stripslashes($rows['AccontoTesto']);
               $A_tmp              = explode("-",$rows['Arrivo']);
               $Arrivo             = $A_tmp[2].'/'.$A_tmp[1].'/'.$A_tmp[0];
               $P_tmp              = explode("-",$rows['Partenza']);
               $Partenza           = $P_tmp[2].'/'.$P_tmp[1].'/'.$P_tmp[0];
               $ListaPacchetti     = '';


               $select_sconti = "  SELECT 
                                        hospitality_relazione_sconto_proposte.* 
                                    FROM 
                                        hospitality_relazione_sconto_proposte
                                    WHERE 
                                        hospitality_relazione_sconto_proposte.idsito = ".IDSITO."
                                    AND 
                                        hospitality_relazione_sconto_proposte.id_richiesta = ".$_REQUEST['param']."
                                    AND 
                                        hospitality_relazione_sconto_proposte.id_proposta = ".$Id_riga."";
                $result_sconti = $db->query($select_sconti);
                $rec_sconti    = $db->row($result_sconti);

                $lista_sconti ='<option value="0" '.($rec_sconti['sconto']==0 || $rec_sconti['sconto']==''?'selected="selected"':'').'>Sconto</option>';
                //ciclo per percentuli sconto
                $num_sc = 1;
                for($num_sc==1; $num_sc<=25; $num_sc++){
                   $lista_sconti .='<option value="'.$num_sc.'" '.($rec_sconti['sconto']==$num_sc?'selected="selected"':'').'>'.$num_sc.'%</option>';
                }

                $lista_sconti .=' <option value="30" '.($rec_sconti['sconto']==30?'selected="selected"':'').'>30%</option>
                                        <option value="35" '.($rec_sconti['sconto']==35?'selected="selected"':'').'>35%</option>
                                        <option value="40" '.($rec_sconti['sconto']==40?'selected="selected"':'').'>40%</option>
                                        <option value="45" '.($rec_sconti['sconto']==45?'selected="selected"':'').'>45%</option>
                                        <option value="50" '.($rec_sconti['sconto']==50?'selected="selected"':'').'>50%</option>';

                // Query e ciclo per estrapolare i pacchetti
                $db->query("SELECT hospitality_tipo_pacchetto_lingua.* FROM hospitality_tipo_pacchetto_lingua
                        INNER JOIN hospitality_tipo_pacchetto ON hospitality_tipo_pacchetto.Id = hospitality_tipo_pacchetto_lingua.pacchetto_id
                        WHERE hospitality_tipo_pacchetto_lingua.lingue = '".$Lingua."'
                        AND hospitality_tipo_pacchetto.Abilitato = 1
                        AND hospitality_tipo_pacchetto_lingua.idsito = ".IDSITO."
                        ORDER BY hospitality_tipo_pacchetto_lingua.Pacchetto ASC");
                $row = $db->result();

                $ListaPacchetti .='<option value="" '.($valore['Pacchetto']==''?'selected="selected"':'').'>scegli</option>';
                foreach($row as $chiave => $valore){
                    $ListaPacchetti .='<option value="'.$valore['Pacchetto'].'" '.($NomeProposta==$valore['Pacchetto']?'selected="selected"':'').' data-id="'.$valore['Id'].'">'.$valore['Pacchetto'].'</option>';
                }

                $db->query("SELECT hospitality_condizioni_tariffe_lingua.* FROM hospitality_condizioni_tariffe_lingua
                            INNER JOIN hospitality_condizioni_tariffe ON hospitality_condizioni_tariffe.id = hospitality_condizioni_tariffe_lingua.id_tariffe
                            WHERE hospitality_condizioni_tariffe_lingua.Lingua = '".$Lingua."'
                            AND hospitality_condizioni_tariffe.idsito = ".IDSITO."
                            ORDER BY hospitality_condizioni_tariffe_lingua.tariffa ASC");
                $row = $db->result();
                $ListaTariffe .='<option value="">scegli</option>';
                foreach($row as $chiave => $valore){
                    $ListaTariffe .='<option value="'.$valore['tariffa'].'" '.($AccontoTariffa==$valore['tariffa']?'selected="selected"':'').' data-id="'.$valore['id'].'" >'.$valore['tariffa'].'</option>';
                }

               $proposte .='  <div class="panel box box-success">
                                                      <div class="box-header with-border">

                                                        <div class="row">
                                                        <div class="col-md-8">
                                                            <h4 class="box-title">
                                                                <a class="collapsed" aria-expanded="true" data-toggle="collapse" data-parent="#accordion" href="#collapseOne'.$i.'">
                                                                    <span class="text-black">'.$i.'° PROPOSTA</span>
                                                                </a>
                                                            </h4>
                                                          </div>
                                                          <div class="col-md-4 text-right">';
                            if($Id_riga!='' && $i>1){
                               $proposte .='                 <script>
                                                                       $( document ).ready(function() {

                                                                            $(\'[data-toogle="tooltip"]\').tooltip();

                                                                            $("#del_prop'.$Id_riga.'").click(function(){
                                                                                var idproposta = '.$Id_riga.';
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "'.BASE_URL_SITO.'ajax/del_proposta.php",
                                                                                    data: "idproposta=" + idproposta,
                                                                                    dataType: "html",
                                                                                    success: function(data){
                                                                                        $("div#ris_prop'.$i.'").html(\'<div class="alert alert-danger alert-dismissable">ATTENZIONE: la '.$i.'° proposta è stata svuotata attendere il reload della pagina!</div>\');
                                                                                            setTimeout(function(){
                                                                                                location.reload();
                                                                                            },3000);
                                                                                    },
                                                                                    error: function(){
                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                    }
                                                                                });
                                                                          });
                                                                        });
                                                                      </script>
                                                                    <a href="javascript:;" id="del_prop'.$Id_riga.'" title="Svuota questa Proposta" data-toogle="tooltip">Svuota proposta <i  class="fa fa-remove text-red"></i></a>';
                            }
                $proposte .='                                   </div>
                                                            </div>

                                                      </div>
                                                      <div  aria-expanded="true" id="collapseOne'.$i.'" class="panel-collapse collapse in">
                                                        <div class="box-body">';
                    if($TipoRichiesta=='Preventivo'){
                            if(check_simplebooking(IDSITO)==1){
                                 $proposte  .=    '<div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10 text-center">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#input_booking'.$i.'">Apri <img src="'.BASE_URL_SITO.'img/powered-sb-bc.png"></button>
                                                        <div id="wait'.$i.'"></div>
                                                    </div>
                                                    <div class="col-md-1"></div>
                                                </div>';
                            }
                    }
                                $proposte  .=    '      <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10">

                                                           <table class="table table-responsive">
                                                            <tr>
                                                                <td colspan="6">
                                                                <input type="hidden" value="'.$Id_riga .'" name="id_proposta'.$i.'">
                                                                    <div class="Check'.$i.'bis"><label for="CheckProposta"> '.$i.'° Proposta</label></div>
                                                                        <div class="Check'.$i.'" style="display:none">
                                                                            <label for="CheckProposta"> Seleziona Proposta</label>
                                                                        <div class="form-group">
                                                                            <input type="checkbox"  value="1" onclick="check(this);" class="controllo" name="CheckProposta'.$i.'" id="CheckProposta_'.$i.'" '.($CheckProposta ==1?'checked':'').'>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>';
                            if($DataRichiesta>DATA_QUOTO_V2){
                                $proposte  .=    '         <tr>
                                                            <td class="no-border-top 100-percento">
                                                                <div class="control-group">
                                                                    <label class="control-label">Data Arrivo Alternativa</label>
                                                                    <div class="controls">
                                                                        <div class="input-group">
                                                                            <label class="input-group-addon btn">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </label>
                                                                            <input id="DataArrivo_'.$i.'" name="DataArrivo'.$i.'" type="text" class="date-picker form-control"
                                                                                tabindex="10" autocomplete="off" value="'.$Arrivo.'"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="no-border-top 100-percento">
                                                                <div class="control-group">
                                                                    <label for="DataPartenza" class="control-label">Data Partenza Alternativa</label>
                                                                    <div class="controls">
                                                                        <div class="input-group">
                                                                            <label for="DataPartenza" class="input-group-addon btn">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </label>
                                                                            <input id="DataPartenza_'.$i.'" name="DataPartenza'.$i.'" type="text" class="date-picker form-control"
                                                                                tabindex="11" autocomplete="off" value="'.$Partenza.'" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>';
                            }

                                $proposte  .=    '      <tr>
                                                             <td colspan="6">
                                                                    <div class="form-group">
                                                                        <label for="NomeProposta">Nome Proposta o del Pacchetto <small style="font-weight: normal!important">(non obbligatorio)</small></label>
                                                                            <select  name="NomeProposta'.$i.'" id="NomeProposta_'.$i.'" class="form-control">
                                                                                  '.$ListaPacchetti.'
                                                                            </select>
                                                                    </div>
                                                             </td>
                                                            </tr>
                                                            <tr>
                                                             <td colspan="6">
                                                                    <div class="form-group">
                                                                        <label for="TestoProposta">Descrizione Proposta o del Pacchetto</label>
                                                                        <textarea rows="3" name="TestoProposta'.$i.'" id="TestoProposta_'.$i.'" class="form-control" placeholder="Non è obbligatoria la compilazione di questo campo, offre qualche informazione in più per la proposta">'.$TestoProposta.'</textarea>
                                                                    </div>
                                                             </td>
                                                            </tr>';
                                             if($TipoRichiesta=='Preventivo'){
                                                    if(check_simplebooking(IDSITO)==1){
                                                            $proposte  .='<tr>
                                                                            <td colspan="6" style="border:0px!important">
                                                                                <div id="simple'.$i.'"></div>
                                                                            </td>
                                                                        </tr>';
                                                    }
                                            }
                                            $proposte  .=    '<tr><td colspan="6" style="border:0px!important"><div id="risultato_del'.$i.'"></div><div id="ris_prop'.$i.'"></div></td></tr>';

                           $select2 = "SELECT hospitality_richiesta.Id as idRichiesta,
                                                hospitality_richiesta.TipoSoggiorno,
                                                hospitality_richiesta.NumAdulti,
                                                hospitality_richiesta.NumBambini,
                                                hospitality_richiesta.EtaB,
                                                hospitality_richiesta.NumeroCamere,
                                                hospitality_richiesta.Prezzo,
                                                hospitality_tipo_camere.Id as id_camere,
                                                hospitality_tipo_camere.TipoCamere
                                    FROM hospitality_richiesta
                                    INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                                    WHERE hospitality_richiesta.id_proposta = ".$Id_riga." AND  hospitality_richiesta.id_richiesta = ".$_REQUEST['param']." ORDER BY hospitality_richiesta.Id ASC "  ;
                                    $result2     = $db->query($select2);
                                    $res2        = $db->result($result2);
                                    $num_righe = 1;
                                    foreach ($res2 as $ky => $val) {

                                        if($DataRichiesta>DATA_QUOTO_V2){
                                            $proposte  .= '<tr>
                                                                <td colspan="6" class="nopadding no-border-top">

                                                                <input type="hidden" value="'.$val['idRichiesta'] .'" name="idrichiesta'.$i.'[]">
                                                                    <table class="table table-responsive">
                                                                    <tr>
                                                                        <td class="td25pdl10pdr10 no-border-top">
                                                                          <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_'.$i.'_'.$num_righe.'"></div>
                                                                                <div class="form-group">
                                                                                    <select name="TipoSoggiorno'.$i.'[]" id="TipoSoggiorno_'.$i.'_'.$num_righe.'"
                                                                                        class="form-control" tabindex="20">
                                                                                        <option value="" selected="selected">Tipo Soggiorno</option>';
                                                                                        // Query e ciclo per estrapolare i dati di tipologia soggiorno
                                                                                        $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoSoggiorno ASC");
                                                                                        $row = $db->result();
                                                                                        $ListaSoggiorno  = '';
                                                                                        foreach($row as $chiave => $valore){
                                                                                            $proposte .='<option value="'.$valore['Id'].'" '.($val['TipoSoggiorno']==$valore['Id']?'selected="selected"':'').'>'.mini_clean($valore['TipoSoggiorno']).'</option>';
                                                                                        }
                                            $proposte  .= '                        </select>
                                                                                </div>
                                                                        </td>
                                                                        <td class="td6pdl0pdr10 no-border-top">
                                                                            <div class="form-group">
                                                                                <select name="NumeroCamere'.$i.'[]" id="NumeroCamere_'.$i.'_'.$num_righe.'"
                                                                                    class="form-control" tabindex="21">
                                                                                    <option value="" selected="selected">Nr.</option>
                                                                                    <option value="1" '.(1==$val['NumeroCamere']?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.(2==$val['NumeroCamere']?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.(3==$val['NumeroCamere']?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.(4==$val['NumeroCamere']?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.(5==$val['NumeroCamere']?'selected="selected"':'').'>5</option>
                                                                                    <option value="6" '.(6==$val['NumeroCamere']?'selected="selected"':'').'>6</option>
                                                                                    <option value="7" '.(7==$val['NumeroCamere']?'selected="selected"':'').'>7</option>
                                                                                    <option value="8" '.(8==$val['NumeroCamere']?'selected="selected"':'').'>8</option>
                                                                                    <option value="9" '.(9==$val['NumeroCamere']?'selected="selected"':'').'>9</option>
                                                                                    <option value="10" '.(10==$val['NumeroCamere']?'selected="selected"':'').'>10</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td25pdl0pdr10 no-border-top">
                                                                            <div class="form-group">
                                                                                <select name="TipoCamere'.$i.'[]"  id="TipoCamere_'.$i.'_'.$num_righe.'" class="'.$stile_chosen.'form-control" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino('.$i.','.$num_righe.');"':'').'>';
                                                                                $db->query("SELECT * FROM hospitality_tipo_camere WHERE  Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoCamere ASC");
                                                                                $rw = $db->result();
                                                                                $ListaCamere = '';
                                                                                foreach($rw as $key => $v){
                                                                                    $proposte  .='<option value="'.$v['Id'].'" '.($v['Id']==$val['id_camere']?'selected="selected"':'').'>'.$v['TipoCamere'].'</option>';
                                                                                }

                                            $proposte  .='                    </select>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td9pdl0pdr10 no-border-top">
                                                                            <div class="form-group">
                                                                                <select name="NumAdulti'.$i.'[]" id="NumeroAdulti_'.$i.'_'.$num_righe.'"
                                                                                    class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onChange="get_listino('.$i.','.$num_righe.');"':'').'>
                                                                                    <option value="" selected="selected">Adulti</option>
                                                                                    <option value="1" '.(1==$val['NumAdulti']?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.(2==$val['NumAdulti']?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.(3==$val['NumAdulti']?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.(4==$val['NumAdulti']?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.(5==$val['NumAdulti']?'selected="selected"':'').'>5</option>
                                                                                    <option value="6" '.(6==$val['NumAdulti']?'selected="selected"':'').'>6</option>
                                                                                    <option value="7" '.(7==$val['NumAdulti']?'selected="selected"':'').'>7</option>
                                                                                    <option value="8" '.(8==$val['NumAdulti']?'selected="selected"':'').'>8</option>
                                                                                    <option value="9" '.(9==$val['NumAdulti']?'selected="selected"':'').'>9</option>
                                                                                    <option value="10" '.(10==$val['NumAdulti']?'selected="selected"':'').'>10</option>
                                                                                </select>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td9pdl0pdr10 no-border-top">
                                                                            <div class="form-group">
                                                                                <select name="NumBambini'.$i.'[]" id="NumeroBambini_'.$i.'_'.$num_righe.'"
                                                                                    class="NumeroBambini_'.$i.'_'.$num_righe.' form-control" tabindex="20" onchange="eta_bimbi(\''.$i.'_'.$num_righe.'\');">
                                                                                    <option value="" selected="selected">Bambini</option>
                                                                                    <option value="1" '.(1==$val['NumBambini']?'selected="selected"':'').'>1</option>
                                                                                    <option value="2" '.(2==$val['NumBambini']?'selected="selected"':'').'>2</option>
                                                                                    <option value="3" '.(3==$val['NumBambini']?'selected="selected"':'').'>3</option>
                                                                                    <option value="4" '.(4==$val['NumBambini']?'selected="selected"':'').'>4</option>
                                                                                    <option value="5" '.(5==$val['NumBambini']?'selected="selected"':'').'>5</option>
                                                                                    <option value="6" '.(6==$val['NumBambini']?'selected="selected"':'').'>6</option>
                                                                                </select>
                                                                                <div class="EtaBambini'.$i.'_'.$num_righe.'" style="'.($val['EtaB']!=''?'display:block':'display:none').'">
                                                                                    <input type="text"  name="EtaB'.$i.'[]" placeholder="Età: 1,2,3" value="'.$val['EtaB'].'" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="td25pdl0pdr0 no-border-top">
                                                                        <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_'.$i.'_'.$num_righe.'"></div>
                                                                            <div class="form-group">
                                                                                <div class="input-group" style="width:100%">
                                                                                    <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                                    <input type="text" name="Prezzo'.$i.'[]" id="Prezzo_'.$i.'_'.$num_righe.'"
                                                                                        class="prezzo'.$i.' form-control" value="'.$val['Prezzo'].'"
                                                                                        placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0)?'onfocus="get_listino('.$i.','.$num_righe.');"':'').'>';
                                                if($TipoRichiesta=='Preventivo'){
                                                    $proposte  .= '                             <span class="input-group-addon btn bg-green" onclick="room_fields('.$i.',\'righe_room'.($i==1?'':$i).'\');">
                                                                                                <i class="fa fa-plus"></i>
                                                                                                </span>';
                                                }
                                                $proposte  .= '                 </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>';

                                                if($TipoRichiesta=='Preventivo'){
                                                    $proposte  .= ' <tr>
                                                                        <td colspan="6" class="nopadding no-border-top">
                                                                            <table id="righe_room'.($i==1?'':$i).'" class="table table-responsive nopadding"></table>
                                                                        </td>
                                                                    </tr>';
                                                }

                                                $proposte  .= '
                                                                </table>
                                                                </td>
                                                                <td style="width:1%" class="no-border-top">';
                                                                if($Chiuso=='0'){
                                                                    $proposte  .='  <script>
                                                                                    $( document ).ready(function() {
                                                                                            $(\'[data-toogle="tooltip"]\').tooltip();

                                                                                            $("#del_riga'.$val['idRichiesta'] .'").click(function(){
                                                                                                if($(".contax'.$i.'").length===1){
                                                                                                    alert(\'ATTENZIONE non è possibile eliminare tutte le righe compilate\');
                                                                                                    return;
                                                                                                }
                                                                                                var idrichiesta = '.$val['idRichiesta'] .';
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "'.BASE_URL_SITO.'ajax/del_riga.php",
                                                                                                    data: "idrichiesta=" + idrichiesta,
                                                                                                    dataType: "html",
                                                                                                    success: function(data){
                                                                                                        $("div#risultato_del'.$i.'").html(\'<div class="alert alert-danger alert-dismissable">Eliminazione avvenuta! ATTENZIONE: attendere il reload della pagina ed AGGIORNARE il TOTALE del soggiorno!</div>\');
                                                                                                            setTimeout(function(){
                                                                                                                location.reload();
                                                                                                            },3000);
                                                                                                    },
                                                                                                    error: function(){
                                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                                    }
                                                                                                });
                                                                                        });
                                                                                        });
                                                                                    </script>
                                                                                    <i id="del_riga'.$val['idRichiesta'] .'" title="Elimina la riga e aggiorna il prezzo soggiorno" data-toogle="tooltip" class="fa fa-remove text-red contax'.$i.'" style="cursor:pointer"></i>';
                                                                }
                                            $proposte  .='     </td>
                                                            </tr>';

                                            $num_righe++;
                                        }else{
                                            //camere
                                            $proposte  .=    '<tr>

                                                                <td style="width:25%">
                                                                <input type="hidden" value="'.$val['idRichiesta'] .'" name="idrichiesta'.$i.'[]">
                                                                        <div class="form-group">
                                                                            <label for="TipoSoggiorno">Tipo Soggiorno</label>
                                                                            <select name="TipoSoggiorno'.$i.'[]"  class="form-control">';
                                                                                    // Query e ciclo per estrapolare i dati di tipologia soggiorno
                                                                                    $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoSoggiorno ASC");
                                                                                    $row = $db->result();
                                                                                    $ListaSoggiorno  = '';
                                                                                    foreach($row as $chiave => $valore){
                                                                                        $proposte .='<option value="'.$valore['Id'].'" '.($val['TipoSoggiorno']==$valore['Id']?'selected="selected"':'').'>'.mini_clean($valore['TipoSoggiorno']).'</option>';
                                                                                    }
                                                            $proposte  .='  </select>
                                                                        </div>
                                                                </td>
                                                                    <td style="width:25%">
                                                                        <div class="form-group">
                                                                            <label for="NumeroCamere">Nr Camere</label>
                                                                            <select name="NumeroCamere'.$i.'[]"  class="form-control">
                                                                                <option value="1" '.(1==$val['NumeroCamere']?'selected="selected"':'').'>1</option>
                                                                                <option value="2" '.(2==$val['NumeroCamere']?'selected="selected"':'').'>2</option>
                                                                                <option value="3" '.(3==$val['NumeroCamere']?'selected="selected"':'').'>3</option>
                                                                                <option value="4" '.(4==$val['NumeroCamere']?'selected="selected"':'').'>4</option>
                                                                                <option value="5" '.(5==$val['NumeroCamere']?'selected="selected"':'').'>5</option>
                                                                                <option value="6" '.(6==$val['NumeroCamere']?'selected="selected"':'').'>6</option>
                                                                                <option value="7" '.(7==$val['NumeroCamere']?'selected="selected"':'').'>7</option>
                                                                                <option value="8" '.(8==$val['NumeroCamere']?'selected="selected"':'').'>8</option>
                                                                                <option value="9" '.(9==$val['NumeroCamere']?'selected="selected"':'').'>9</option>
                                                                                <option value="10" '.(10==$val['NumeroCamere']?'selected="selected"':'').'>10</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                    <td style="width:25%">
                                                                        <div class="form-group">
                                                                            <label for="TipoCamere">Tipo Camere</label>
                                                                            <select name="TipoCamere'.$i.'[]"  class="'.$stile_chosen.'form-control">';
                                                                            $db->query("SELECT * FROM hospitality_tipo_camere WHERE  Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoCamere ASC");
                                                                            $rw = $db->result();
                                                                            foreach($rw as $key => $v){
                                                                                $proposte  .='<option value="'.$v['Id'].'" '.($v['Id']==$val['id_camere']?'selected="selected"':'').'>'.$v['TipoCamere'].'</option>';
                                                                            }
                                                        $proposte  .=' </select>
                                                                        </div>
                                                                    </td>
                                                                    <td style="width:23%">
                                                                        <label for="Prezzo">Prezzo</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                            <input type="text" name="Prezzo'.$i.'[]"  class="prezzo'.$i.' form-control" placeholder="0000.00"  value="'.$val['Prezzo'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td style="width:2%">';
                                                if($Chiuso=='0'){
                                                    $proposte  .='  <script>
                                                                    $( document ).ready(function() {
                                                                            $(\'[data-toogle="tooltip"]\').tooltip();

                                                                            $("#del_riga'.$val['idRichiesta'] .'").click(function(){
                                                                                if($(".contax'.$i.'").length===1){
                                                                                    alert(\'ATTENZIONE non è possibile eliminare tutte le righe compilate\');
                                                                                    return;
                                                                                }
                                                                                var idrichiesta = '.$val['idRichiesta'] .';
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "'.BASE_URL_SITO.'ajax/del_riga.php",
                                                                                    data: "idrichiesta=" + idrichiesta,
                                                                                    dataType: "html",
                                                                                    success: function(data){
                                                                                        $("div#risultato_del'.$i.'").html(\'<div class="alert alert-danger alert-dismissable">Eliminazione avvenuta! ATTENZIONE: attendere il reload della pagina ed AGGIORNARE il TOTALE del soggiorno!</div>\');
                                                                                            setTimeout(function(){
                                                                                                location.reload();
                                                                                            },3000);
                                                                                    },
                                                                                    error: function(){
                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                    }
                                                                                });
                                                                        });
                                                                        });
                                                                    </script>
                                                                    <i id="del_riga'.$val['idRichiesta'] .'" title="Elimina la riga e aggiorna il prezzo soggiorno" data-toogle="tooltip" class="fa fa-remove text-red contax'.$i.'" style="cursor:pointer"></i>';
                                                }
                                                $proposte  .='     </td>
                                                                </tr>';

                                        }
                                    }
                                    if($DataRichiesta<DATA_QUOTO_V2){
                                        if($TipoRichiesta=='Preventivo'){
                                          $n = ($i==1?'':$i);
                                          $proposte .='   <tr id="nc'.$n.'">
                                                            <td colspan="6">
                                                                <table id="add_c'.$n.'" class="table" ></table>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                              <td colspan="6" style="text-align:right">
                                                                   <a href="javascript:;" onclick="scroll_to(\'nc'.$n.'\', 50, 1000)" id="add_cam'.$n.'" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i></a>
                                                                   <a href="javascript:;" onclick="scroll_to(\'nc'.$n.'\', 50, 1000)" id="rem_cam'.$n.'" class="btn btn-warning btn-xs"><i class="fa fa-minus"></i></a>
                                                              </td>
                                                          </tr>';
                                                          // fine camere
                                        }
                                    }
                                    if($DataRichiesta>DATA_QUOTO_V2){
                                        $proposte  .=''.get_modifica_servizi_aggiuntivi($i,$_REQUEST['param'],$Id_riga).' ';
                                    }
                                        $proposte .='</table>';
                                        $proposte .='<table class="table table-responsive">
                                                            <tr>
                                                                <td class="col-md-2 text-right"><small style="font-weight:normal!important"><small>Se il prezzo di listino è uguale al prezzo del soggiorno, non sarà visibile sulla proposta!</small></small></td>
                                                                <td class="col-md-3">
                                                                    <label for="Prezzo">Prezzo Soggiorno <strike>Listino</strike></label>
                                                                    <div class="input-group" style="width:100%">
                                                                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                        <input type="text" onclick="calcola_totale'.$i.'();" name="PrezzoL'.$i.'" id="PrezzoL_'.$i.'" class="form-control" placeholder="0000.00"  value="'.$PrezzoL.'">
                                                                    </div>
                                                                    <span id="sconto_P'.$i.'"></span>
                                                                </td>
                                                                <td class="col-md-3">
                                                                    <label for="Prezzo">Prezzo Soggiorno Proposto</label>
                                                                    <div class="input-group" style="width:100%">
                                                                        <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                                                                        <input type="text" onclick="calcola_totale'.$i.'();" name="PrezzoP'.$i.'" id="PrezzoP_'.$i.'" class="form-control" placeholder="0000.00" value="'.$PrezzoP.'">
                                                                    </div>
                                                                </td>
                                                                <td class="col-md-2">
                                                                <label for="Sconto">Sconto</label>
                                                                        <select name="SC'.$i.'" id="SC_'.$i.'" class="form-control" >
                                                                            '.$lista_sconti.'
                                                                        </select>
                                                                        <input type="hidden" name="sconto_camere'.$i.'" id="sconto_camere_'.$i.'">
                                                                        <div id="Imponibile_'.$i.'"></div>
                                                                </td>';
                                    if($DataRichiesta>=DATA_UPGRADE_CAPARRE){
                                        $proposte .='           <td class="col-md-2">
                                                                    <div class="form-group"> ';
                                                                        if($AccontoImporto){
                                                                            $proposte .='<label for="acconto_richiesta">Caparra ad importo <i class="fa fa-exclamation-triangle text-orange" data-toggle="tooltip" title="Se come importo viene inserito un valore inferiore ad 1 euro (0.1, 0.01), automaticamente si abilita la modalità Carta di Credito a Garanzia. Attenzione: se utilizzate questa opzione ricordatevi di disabilitare le altre modalità di pagamento, dal menù delle configurazioni!"></i></label>
                                                                                            <input type="text" id="AccontoImporto_'.$i.'" name="AccontoImporto'.$i.'" value="'.$AccontoImporto.'" class="form-control" placeholder="000.00">';
                                                                        }else{
                                                                           $proposte .='<label for="acconto_richiesta">'.((($DataVoucherRecSend != '' && $DataValiditaVoucher != '' && $IdMotivazione != '') && $DataRi == ''  && $TipoRichiesta == 'Conferma')?'Caparra (attuale - precedente) <i class="fa fa-question-circle text-info" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Inserire nel campo la differenza tra la caparra attuale e la precedente, usare valore ad importo"></i>':'Caparra').'</label>
                                                                                        <select  name="AccontoPercentuale'.$i.'" id="AccontoPercentuale_'.$i.'" class="form-control">
                                                                                            <option value="" '.($AccontoPercentuale==''?'selected="selected"':'').'>--</option>
                                                                                            <option value="importo" '.($Acc=='importo'?'selected="selected"':'').'>importo</option>
                                                                                            <option value="10" '.($AccontoPercentuale=='10'?'selected="selected"':'').'>10%</option>
                                                                                            <option value="15" '.($AccontoPercentuale=='15'?'selected="selected"':'').'>15%</option>
                                                                                            <option value="20" '.($AccontoPercentuale=='20'?'selected="selected"':'').'>20%</option>
                                                                                            <option value="25" '.($AccontoPercentuale=='25'?'selected="selected"':'').'>25%</option>
                                                                                            <option value="30" '.($AccontoPercentuale=='30'?'selected="selected"':'').'>30%</option>
                                                                                            <option value="40" '.($AccontoPercentuale=='40'?'selected="selected"':'').'>40%</option>
                                                                                            <option value="50" '.($AccontoPercentuale=='50'?'selected="selected"':'').'>50%</option>
                                                                                            <option value="60" '.($AccontoPercentuale=='60'?'selected="selected"':'').'>60%</option>
                                                                                            <option value="70" '.($AccontoPercentuale=='70'?'selected="selected"':'').'>70%</option>
                                                                                            <option value="80" '.($AccontoPercentuale=='80'?'selected="selected"':'').'>80%</option>
                                                                                            <option value="90" '.($AccontoPercentuale=='90'?'selected="selected"':'').'>90%</option>
                                                                                            <option value="100" '.($AccontoPercentuale=='100'?'selected="selected"':'').'>100%</option>
                                                                                        </select>
                                                                                        <div id="acconto_l'.$i.'"></div>';
                                                                            if(($DataVoucherRecSend != '' && $DataValiditaVoucher != '' && $IdMotivazione != '') && $DataRi == '' && $TipoRichiesta == 'Conferma'){

                                                                                $proposte .=' <div style="clear:both;"></div>
                                                                                                <label for="precedente">Caparra precedente</label>
                                                                                                <input type="text" name="AccontoPrecedente" id="AccontoPrecedente_1" class="form-control" value="'.output_acconto($Id).'" >';
                                                                            }
                                                                        }

                                            $proposte .='           </div>
                                                                </td>';
                                        }
                                            $proposte .='   </tr>';
                                        if($DataRichiesta >= DATA_UPGRADE_CAPARRE){
                                            $proposte .='   <tr>
                                                                 <td class="col-md-4" colspan="2">
                                                                        <div class="form-group">
                                                                            <label for="NomeProposta">Tipologia Tariffa</label>
                                                                                <select id="EtichettaTariffa_'.$i.'" name="EtichettaTariffa'.$i.'" class="form-control">
                                                                                    '.$ListaTariffe.'
                                                                                </select>
                                                                        </div>

                                                                 </td>
                                                                 <td colspan="3" class="col-md-8">
                                                                        <div class="form-group">
                                                                            <label for="TestoProposta">Condizioni Tariffa</label>
                                                                                <textarea rows="3" name="AccontoTesto'.$i.'" id="AccontoTesto_'.$i.'" class="form-control" placeholder="Il campo si autocompila scegliendo la tariffa oppure manualmente!">'.$AccontoTesto.'</textarea>
                                                                                    <script type="text/javascript">
                                                                                    // descrizione pacchetto
                                                                                        $(document).ready(function() {
                                                                                            $(\'#EtichettaTariffa_'.$i.'\').change(function() {
                                                                                                    var tariffa =  $(\'#EtichettaTariffa_'.$i.' option:selected\').data(\'id\');
                                                                                                    var idsito = '.IDSITO.';
                                                                                                    var lingua = \''.$Lingua.'\';
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    url: "'.BASE_URL_SITO.'ajax/descr_tariffa.php",
                                                                                                    data: "tariffa=" + tariffa + "&idsito=" + idsito + "&lingua=" + lingua,
                                                                                                    dataType: "html",
                                                                                                    success: function(data){
                                                                                                        $("#AccontoTesto_'.$i.'").text(data);
                                                                                                    },
                                                                                                    error: function(){
                                                                                                        alert("Chiamata fallita, si prega di riprovare...");
                                                                                                    }
                                                                                                });
                                                                                            });
                                                                                        });
                                                                                    </script>

                                                                        </div>
                                                                 </td>
                                                                </tr>';
                                            $ListaTariffe   = '';
                                        }
                                        $proposte .='     </table>
                                                         </div>
                                                        <div class="col-md-1">';
                                            if($TipoRichiesta=='Preventivo'){
                                                    $proposte .='<button type="button" class="btn btn-default btn-xs"  data-toggle="modal" data-target="#calculator'.$i.'" title="Calcolatrice">
                                                                    <i class="fa fa-calculator text-blue" aria-hidden="true"></i>
                                                                </button>
                                                                <div class="modal fade modale_drag draggable" id="calculator'.$i.'">
                                                                  <div class="modal-dialog">
                                                                    <div class="modal-content" style="height:360px!important;width:250px!important">
                                                                      <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title">Calcolatrice &nbsp;&nbsp;<small><small>Drag & Drop <i class="fa fa-arrows" aria-hidden="true"></i></small></small></h4>
                                                                      </div>
                                                                        <div class="modal-body">
                                                                            <iframe width="100%" height="280" src="'.BASE_URL_SITO.'calculator/index.php" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div>';
                                            }
                                            $proposte .='</div>
                                                        </div>
                                                        </div>
                                                      </div>
                                                    </div>  ';

            $i++;

        }
        if($TipoRichiesta=='Conferma'){
            $proposte .='<!-- id utile alla compilazione della conferma automatica dei prezzi camere in ajax --><div id="valori"></div>';
        }

        $ListaPacchetti = '';
        $ListaTariffe   = '';
    }
        $ListaPacchetti = '';
        $ListaTariffe   = '';

        // Query e ciclo per estrapolare i dati di tipologia soggiorno
        $db->query("SELECT * FROM hospitality_tipo_soggiorno WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoSoggiorno ASC");
        $row = $db->result();
        foreach($row as $chiave => $valore){
            $ListaSoggiorno .='<option value="'.$valore['Id'].'">'.mini_clean($valore['TipoSoggiorno']).'</option>';
        }
        // Query e ciclo per estrapolare i dati di tipologia camere
        $db->query("SELECT * FROM hospitality_tipo_camere WHERE Lingua = 'it' AND Abilitato = 1 AND idsito = ".IDSITO." ORDER BY TipoCamere ASC");
        $rw = $db->result();
        foreach($rw as $key => $val){
            $ListaCamere .='<option value="'.$val['Id'].'">'.$val['TipoCamere'].'</option>';
        }
        // Ciclo per il select numerico
        $i = 1;
        for($i==1; $i<=10; $i++){
            $Numeri .='<option value="'.$i.'">'.$i.'</option>';

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



     if($_REQUEST['action']=='modif'){



        if($_REQUEST['id_testo_alternativo']==''){

                $in ="INSERT INTO hospitality_contenuti_web_lingua(
                                                                        idsito,
                                                                        IdRichiesta,
                                                                        Lingua,
                                                                        Testo)
                                                                    VALUES (
                                                                        '".$_REQUEST['idsito']."',
                                                                        '".$_REQUEST['Id']."',
                                                                        '".$_REQUEST['Lingua']."',
                                                                        '".addslashes($_REQUEST['Testo'])."')";

                $db->query($in);
        }else{

                $up ="UPDATE hospitality_contenuti_web_lingua SET Testo = '".addslashes($_REQUEST['Testo'])."' WHERE Id =  ".$_REQUEST['id_testo_alternativo'];

                $db->query($up);
        }



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

       $db->query("SELECT * FROM hospitality_guest WHERE Id = ".$_REQUEST['Id']);
        $d = $db->result();
        foreach($d as $c => $rw){

                $TipoRichiesta = $rw['TipoRichiesta'];

        }

       $DataA_tmp    = explode("/",$_REQUEST['DataArrivo']);
       $DataArrivo   = $DataA_tmp[2].'-'.$DataA_tmp[1].'-'.$DataA_tmp[0];
       $DataP_tmp    = explode("/",$_REQUEST['DataPartenza']);
       $DataPartenza = $DataP_tmp[2].'-'.$DataP_tmp[1].'-'.$DataP_tmp[0];
       $DataN_tmp    = explode("/",$_REQUEST['DataNascita']);
       $DataNascita  = $DataN_tmp[2].'-'.$DataN_tmp[1].'-'.$DataN_tmp[0];
       $DataS_tmp    = explode("/",$_REQUEST['DataScadenza']);
       $DataScadenza = $DataS_tmp[2].'-'.$DataS_tmp[1].'-'.$DataS_tmp[0];

       $CC   = $_REQUEST['CC'];
       $BB   = $_REQUEST['BB'];
       $VP   = $_REQUEST['VP'];
       $PP   = $_REQUEST['PP'];
       $GB   = $_REQUEST['GB'];
       $GBVP = $_REQUEST['GBVP'];
       $GBS  = $_REQUEST['GBS'];
       $GBNX = $_REQUEST['GBNX'];

       if($_REQUEST['TipoRichiesta']=='Conferma' && $TipoRichiesta == 'Preventivo'){

                $ins_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$IdRichiesta."','".$_REQUEST['id_template']."','".$_REQUEST['idsito']."')";
                $db->query($ins_template);

                if($_REQUEST['DataRiconferma']!=''){               
                    $datariconferma  = $_REQUEST['DataRiconferma'].',';
                    $camporiconferma = 'DataRiconferma,';
                }else{
                    $datariconferma  = "";
                    $camporiconferma = "";
                }

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
                                                        MultiStruttura,
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
                                                        ".$camporiconferma."
                                                        AbilitaInvio
                                                        ) VALUES (
                                                        '".$_REQUEST['id_politiche']."',
                                                        '".$_REQUEST['id_template']."',
                                                        '".$_REQUEST['acconto_richiesta']."',
                                                        '".$_REQUEST['acconto_libero']."',
                                                        '".$_REQUEST['DataRichiesta']."',
                                                        '".$_REQUEST['TipoRichiesta']."',
                                                        '".$_REQUEST['TipoVacanza']."',
                                                        '".addslashes($_REQUEST['ChiPrenota'])."',
                                                        '".$_REQUEST['EmailSegretaria']."',
                                                        '".$_REQUEST['idsito']."',
                                                        '".addslashes($_REQUEST['MultiStruttura'])."',
                                                        '".addslashes(ucfirst($_REQUEST['Nome']))."',
                                                        '".addslashes(ucfirst($_REQUEST['Cognome']))."',
                                                        '".$_REQUEST['Email']."',
                                                        '".$_REQUEST['PrefissoInternazionale']."',
                                                        '".$_REQUEST['Cellulare']."',
                                                        '".$DataNascita."',
                                                        '".$_REQUEST['Lingua']."',
                                                        '".$DataArrivo."',
                                                        '".$DataPartenza."',
                                                        '".$_REQUEST['NumeroPrenotazione']."',
                                                        '".$_REQUEST['NumeroAdulti']."',
                                                        '".$_REQUEST['NumeroBambini']."',
                                                        '".$_REQUEST['EtaBambini1']."',
                                                        '".$_REQUEST['EtaBambini2']."',
                                                        '".$_REQUEST['EtaBambini3']."',
                                                        '".$_REQUEST['EtaBambini4']."',
                                                        '".$_REQUEST['EtaBambini5']."',
                                                        '".$_REQUEST['EtaBambini6']."',
                                                        '".$_REQUEST['FontePrenotazione']."',
                                                        '".$_REQUEST['TipoPagamento']."',
                                                        '".$DataScadenza."',
                                                        '".addslashes($_REQUEST['Note'])."',
                                                        '".$datariconferma."'
                                                        '".$_REQUEST['AbilitaInvio']."')";
              $db->query($insert);

              $IdRichiesta = getlastid('hospitality_guest');

                /**
                 * * inserire le scelate dei tipi di pagamento
                 */
                $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,GBNX) VALUES ('".$_REQUEST['idsito']."','".$IdRichiesta."','".$CC."','".$BB."','".$VP."','".$PP."','".$GB."','".$GBVP."','".$GBS."','".$GBNX."')";
                $db->query($ins_pag);

              // se la prima proposta è compilata
              if($_REQUEST['CheckProposta1']!=''){

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

                    if($_REQUEST['PrezzoServizio1'] != '') {
                        //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$IdRichiesta." AND id_proposta = ".$IdProposta);
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
                    $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$IdRichiesta."','".$IdProposta."','".$_REQUEST['SC5']."')");                     
                        ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################

                            $query  = " SELECT 
                                            hospitality_tipo_servizi.*,
                                            hospitality_relazione_servizi_proposte.num_persone,
                                            hospitality_relazione_servizi_proposte.num_notti 
                                        FROM 
                                            hospitality_relazione_servizi_proposte
                                        INNER JOIN 
                                            hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                                        WHERE 
                                            hospitality_tipo_servizi.idsito = ".IDSITO."
                                        AND 
                                            hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta."'
                                        ORDER BY 
                                            hospitality_tipo_servizi.TipoServizio ASC";
                                $risultato_query = $db->query($query);
                                $record          = $db->result($risultato_query);
                                if(sizeof($record)>0){
                                    $array_serv     = array();
                                    $num_persone    = '';
                                    $num_notti      = '';                          
                                    $PrezzoServizio = ''; 
                                    foreach($record as $key => $campo){

                                        switch($campo['CalcoloPrezzo']){
                                            case "Al giorno":
                                                $num_persone = ''; 
                                                $num_notti = $campo['num_notti'];                            
                                                $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti),2):'Gratis');
                                            break;
                                            case "A percentuale":
                                            $num_persone = '';
                                            $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                                            break;
                                            case "Una tantum":
                                                $num_persone = '';
                                                $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format($campo['PrezzoServizio'],2):'Gratis');
                                            break;
                                            case "A persona":
                                            $num_persone = $campo['num_persone'];
                                            $num_notti = $campo['num_notti'];                          
                                            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2):'Gratis');
                                            break;
                                        }
                                        $serv .= str_replace("&"," ",$campo['TipoServizio']).' '.$campo['CalcoloPrezzo'].' '.$PrezzoServizio;
                                    }
                                }                                                        
      
                     ######################################### ARRAY UTILE AL CURL PER ANALITICS###################################
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

                  
                        ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################         
                            $sel3 = "SELECT Id as idCamera,TipoCamere as camera FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['TipoCamere1'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res3 = $db->query($sel3);
                            $rec3 = $db->row($res3);

                            $sel4 = "SELECT TipoSoggiorno as soggiorno FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['TipoSoggiorno1'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res4 = $db->query($sel4);
                            $rec4 = $db->row($res4);

                            
                            $proposta .= '&pr'.$n_camere.'id='.$rec3['idCamera'].'&pr'.$n_camere.'nm=QUOTO - '.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).' - dal '.$DataArrivo1.' al '.$DataPartenza1.'&pr'.$n_camere.'ca='.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).'&pr'.$n_camere.'qt='.$_REQUEST['NumeroCamere1'][$i].'&pr'.$n_camere.'pr='.$_REQUEST['Prezzo1'][$i].'$pr'.$n_camere.'va='.$serv;
    
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                 

                     }// fine cilo for delle camere

                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############
                            // Solo se la provenienza è da Sito Web
                            if($_REQUEST['FontePrenotazione']== 'Sito Web'){

                                $AccountAnalytics = get_account_analytics($_REQUEST['idsito']);
            
                                if($AccountAnalytics != ''){
            
                                $select = "SELECT CLIENT_ID FROM hospitality_client_id WHERE NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."' AND idsito = ".$_REQUEST['idsito'];
                                $result = $db->query($select);
                                $record = $db->row($result);
                                $CLIENT_ID = $record['CLIENT_ID'];
            
                                if($CLIENT_ID != ''){
            
                                    $stringaDati = 'v=1&tid=UA-'.$AccountAnalytics.'&cid='.$CLIENT_ID.'&t=event&ti='.$_REQUEST['NumeroPrenotazione'].'&tr='.str_replace(",",".",$_REQUEST['PrezzoP1']).'&pa=purchase&ec=Ecommerce&ea=purchase&el=QUOTO CRM'.$proposta;
            
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, 'https://www.google-analytics.com/collect');
                                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                                    curl_setopt($ch, CURLOPT_POST, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $stringaDati);
                                    curl_exec($ch);
                                    curl_close($ch); 
            
                                }// fine se account è inserito su suiteweb
            
                                }// fine se client id è presente
            
                            }// fine if solo se la provenienza è da Sito Web
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############


              }
              // se la seconda proposta è compilata
              if($_REQUEST['CheckProposta2']!=''){

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

                    if($_REQUEST['PrezzoServizio2'] != '') {
                        //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$IdRichiesta." AND id_proposta = ".$IdProposta2);
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
                    ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
 
                        $query  = " SELECT 
                                        hospitality_tipo_servizi.*,
                                        hospitality_relazione_servizi_proposte.num_persone,
                                        hospitality_relazione_servizi_proposte.num_notti 
                                    FROM 
                                        hospitality_relazione_servizi_proposte
                                    INNER JOIN 
                                        hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                                    WHERE 
                                        hospitality_tipo_servizi.idsito = ".IDSITO."
                                    AND 
                                        hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta2."'
                                    ORDER BY 
                                        hospitality_tipo_servizi.TipoServizio ASC";
                            $risultato_query = $db->query($query);
                            $record          = $db->result($risultato_query);
                            if(sizeof($record)>0){
                                $array_serv     = array();
                                $num_persone    = '';
                                $num_notti      = '';                          
                                $PrezzoServizio = ''; 
                                foreach($record as $key => $campo){

                                    switch($campo['CalcoloPrezzo']){
                                        case "Al giorno":
                                            $num_persone = ''; 
                                            $num_notti = $campo['num_notti'];                            
                                            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti),2):'Gratis');
                                        break;
                                        case "A percentuale":
                                        $num_persone = '';
                                        $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                                        break;
                                        case "Una tantum":
                                            $num_persone = '';
                                            $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format($campo['PrezzoServizio'],2):'Gratis');
                                        break;
                                        case "A persona":
                                        $num_persone = $campo['num_persone'];
                                        $num_notti = $campo['num_notti'];                          
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2):'Gratis');
                                        break;
                                    }
                                    $serv2 .= str_replace("&"," ",$campo['TipoServizio']).' '.$campo['CalcoloPrezzo'].' '.$PrezzoServizio;
                                }
                            }                                                        
                  
                    ######################################### ARRAY UTILE AL CURL PER ANALITICS###################################
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

                                          
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################         
                            $sel3 = "SELECT Id as idCamera,TipoCamere as camera FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['TipoCamere2'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res3 = $db->query($sel3);
                            $rec3 = $db->row($res3);

                            $sel4 = "SELECT TipoSoggiorno as soggiorno FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['TipoSoggiorno2'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res4 = $db->query($sel4);
                            $rec4 = $db->row($res4);

                            
                            $proposta2 .= '&pr'.$n_camere2.'id='.$rec3['idCamera'].'&pr'.$n_camere2.'nm=QUOTO - '.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).' - dal '.$DataArrivo2.' al '.$DataPartenza2.'&pr'.$n_camere2.'ca='.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).'&pr'.$n_camere2.'qt='.$_REQUEST['NumeroCamere2'][$i].'&pr'.$n_camere2.'pr='.$_REQUEST['Prezzo2'][$i].'$pr'.$n_camere2.'va='.$serv2;
    
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                      

                     }// fine ciclo for delle camere

                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############
                            // Solo se la provenienza è da Sito Web
                            if($_REQUEST['FontePrenotazione']== 'Sito Web'){

                                $AccountAnalytics = get_account_analytics($_REQUEST['idsito']);
            
                                if($AccountAnalytics != ''){
            
                                $select = "SELECT CLIENT_ID FROM hospitality_client_id WHERE NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."' AND idsito = ".$_REQUEST['idsito'];
                                $result = $db->query($select);
                                $record = $db->row($result);
                                $CLIENT_ID = $record['CLIENT_ID'];
            
                                if($CLIENT_ID != ''){
            
                                    $stringaDati = 'v=1&tid=UA-'.$AccountAnalytics.'&cid='.$CLIENT_ID.'&t=event&ti='.$_REQUEST['NumeroPrenotazione'].'&tr='.str_replace(",",".",$_REQUEST['PrezzoP2']).'&pa=purchase&ec=Ecommerce&ea=purchase&el=QUOTO CRM'.$proposta2;
            
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, 'https://www.google-analytics.com/collect');
                                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                                    curl_setopt($ch, CURLOPT_POST, true);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $stringaDati);
                                    curl_exec($ch);
                                    curl_close($ch); 
            
                                }// fine se account è inserito su suiteweb
            
                                }// fine se client id è presente
            
                            }// fine if solo se la provenienza è da Sito Web
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############



              }
              // se la terza proposta è compilata
              if($_REQUEST['CheckProposta3']!=''){

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

                     if($_REQUEST['PrezzoServizio3'] != '') {
                        //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$IdRichiesta." AND id_proposta = ".$IdProposta3);
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
                    ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
 
                    $query  = " SELECT 
                                    hospitality_tipo_servizi.*,
                                    hospitality_relazione_servizi_proposte.num_persone,
                                    hospitality_relazione_servizi_proposte.num_notti 
                                FROM 
                                    hospitality_relazione_servizi_proposte
                                INNER JOIN 
                                    hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                                WHERE 
                                    hospitality_tipo_servizi.idsito = ".IDSITO."
                                AND 
                                    hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta3."'
                                ORDER BY 
                                    hospitality_tipo_servizi.TipoServizio ASC";
                        $risultato_query = $db->query($query);
                        $record          = $db->result($risultato_query);
                        if(sizeof($record)>0){
                            $array_serv     = array();
                            $num_persone    = '';
                            $num_notti      = '';                          
                            $PrezzoServizio = ''; 
                            foreach($record as $key => $campo){

                                switch($campo['CalcoloPrezzo']){
                                    case "Al giorno":
                                        $num_persone = ''; 
                                        $num_notti = $campo['num_notti'];                            
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti),2):'Gratis');
                                    break;
                                    case "A percentuale":
                                    $num_persone = '';
                                    $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                                    break;
                                    case "Una tantum":
                                        $num_persone = '';
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format($campo['PrezzoServizio'],2):'Gratis');
                                    break;
                                    case "A persona":
                                    $num_persone = $campo['num_persone'];
                                    $num_notti = $campo['num_notti'];                          
                                    $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2):'Gratis');
                                    break;
                                }
                                $serv3 .= str_replace("&"," ",$campo['TipoServizio']).' '.$campo['CalcoloPrezzo'].' '.$PrezzoServizio;
                            }
                        }                                                        
              
                ######################################### ARRAY UTILE AL CURL PER ANALITICS###################################
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

                                           
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################         
                            $sel3 = "SELECT Id as idCamera,TipoCamere as camera FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['TipoCamere3'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res3 = $db->query($sel3);
                            $rec3 = $db->row($res3);

                            $sel4 = "SELECT TipoSoggiorno as soggiorno FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['TipoSoggiorno3'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res4 = $db->query($sel4);
                            $rec4 = $db->row($res4);

                            
                            $proposta3 .= '&pr'.$n_camere3.'id='.$rec3['idCamera'].'&pr'.$n_camere3.'nm=QUOTO - '.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).' - dal '.$DataArrivo3.' al '.$DataPartenza3.'&pr'.$n_camere3.'ca='.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).'&pr'.$n_camere3.'qt='.$_REQUEST['NumeroCamere3'][$i].'&pr'.$n_camere3.'pr='.$_REQUEST['Prezzo3'][$i].'$pr'.$n_camere3.'va='.$serv3;

                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                        

                    }// fine ciclo for delle camere

                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############
                            // Solo se la provenienza è da Sito Web
                            if($_REQUEST['FontePrenotazione']== 'Sito Web'){

                                $AccountAnalytics = get_account_analytics($_REQUEST['idsito']);
            
                                if($AccountAnalytics != ''){
            
                                    $select = "SELECT CLIENT_ID FROM hospitality_client_id WHERE NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."' AND idsito = ".$_REQUEST['idsito'];
                                    $result = $db->query($select);
                                    $record = $db->row($result);
                                    $CLIENT_ID = $record['CLIENT_ID'];
                
                                    if($CLIENT_ID != ''){
                
                                        $stringaDati = 'v=1&tid=UA-'.$AccountAnalytics.'&cid='.$CLIENT_ID.'&t=event&ti='.$_REQUEST['NumeroPrenotazione'].'&tr='.str_replace(",",".",$_REQUEST['PrezzoP3']).'&pa=purchase&ec=Ecommerce&ea=purchase&el=QUOTO CRM'.$proposta3;
                
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, 'https://www.google-analytics.com/collect');
                                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                                        curl_setopt($ch, CURLOPT_POST, true);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringaDati);
                                        curl_exec($ch);
                                        curl_close($ch); 
                
                                    }// fine se account è inserito su suiteweb
            
                                }// fine se client id è presente
            
                            }// fine if solo se la provenienza è da Sito Web
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############

              }

             // se la 4 proposta è compilata
             if($_REQUEST['CheckProposta4']!=''){

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

                     if($_REQUEST['PrezzoServizio4'] != '') {
                        //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$IdRichiesta." AND id_proposta = ".$IdProposta4);
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
                    ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
              
                    $query  = " SELECT 
                                    hospitality_tipo_servizi.*,
                                    hospitality_relazione_servizi_proposte.num_persone,
                                    hospitality_relazione_servizi_proposte.num_notti 
                                FROM 
                                    hospitality_relazione_servizi_proposte
                                INNER JOIN 
                                    hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                                WHERE 
                                    hospitality_tipo_servizi.idsito = ".IDSITO."
                                AND 
                                    hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta4."'
                                ORDER BY 
                                    hospitality_tipo_servizi.TipoServizio ASC";
                        $risultato_query = $db->query($query);
                        $record          = $db->result($risultato_query);
                        if(sizeof($record)>0){
                            $array_serv     = array();
                            $num_persone    = '';
                            $num_notti      = '';                          
                            $PrezzoServizio = ''; 
                            foreach($record as $key => $campo){

                                switch($campo['CalcoloPrezzo']){
                                    case "Al giorno":
                                        $num_persone = ''; 
                                        $num_notti = $campo['num_notti'];                            
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti),2):'Gratis');
                                    break;
                                    case "A percentuale":
                                    $num_persone = '';
                                    $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                                    break;
                                    case "Una tantum":
                                        $num_persone = '';
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format($campo['PrezzoServizio'],2):'Gratis');
                                    break;
                                    case "A persona":
                                    $num_persone = $campo['num_persone'];
                                    $num_notti = $campo['num_notti'];                          
                                    $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2):'Gratis');
                                    break;
                                }
                                $serv4 .= str_replace("&"," ",$campo['TipoServizio']).' '.$campo['CalcoloPrezzo'].' '.$PrezzoServizio;
                            }
                        }                                                        
              
                ######################################### ARRAY UTILE AL CURL PER ANALITICS###################################
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

                                         
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################         
                            $sel3 = "SELECT Id as idCamera,TipoCamere as camera FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['TipoCamere4'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res3 = $db->query($sel3);
                            $rec3 = $db->row($res3);

                            $sel4 = "SELECT TipoSoggiorno as soggiorno FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['TipoSoggiorno4'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res4 = $db->query($sel4);
                            $rec4 = $db->row($res4);

                            
                            $proposta4 .= '&pr'.$n_camere4.'id='.$rec3['idCamera'].'&pr'.$n_camere4.'nm=QUOTO - '.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).' - dal '.$DataArrivo4.' al '.$DataPartenza4.'&pr'.$n_camere4.'ca='.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).'&pr'.$n_camere4.'qt='.$_REQUEST['NumeroCamere4'][$i].'&pr'.$n_camere4.'pr='.$_REQUEST['Prezzo4'][$i].'$pr'.$n_camere4.'va='.$serv4;

                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                    


                     }// fine ciclo for delle camere

             
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############
                            // Solo se la provenienza è da Sito Web
                            if($_REQUEST['FontePrenotazione']== 'Sito Web'){

                                $AccountAnalytics = get_account_analytics($_REQUEST['idsito']);
            
                                if($AccountAnalytics != ''){
            
                                    $select = "SELECT CLIENT_ID FROM hospitality_client_id WHERE NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."' AND idsito = ".$_REQUEST['idsito'];
                                    $result = $db->query($select);
                                    $record = $db->row($result);
                                    $CLIENT_ID = $record['CLIENT_ID'];
                
                                    if($CLIENT_ID != ''){
                
                                        $stringaDati = 'v=1&tid=UA-'.$AccountAnalytics.'&cid='.$CLIENT_ID.'&t=event&ti='.$_REQUEST['NumeroPrenotazione'].'&tr='.str_replace(",",".",$_REQUEST['PrezzoP4']).'&pa=purchase&ec=Ecommerce&ea=purchase&el=QUOTO CRM'.$proposta4;
                
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, 'https://www.google-analytics.com/collect');
                                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                                        curl_setopt($ch, CURLOPT_POST, true);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringaDati);
                                        curl_exec($ch);
                                        curl_close($ch); 
                
                                    }// fine se account è inserito su suiteweb
            
                                }// fine se client id è presente
            
                            }// fine if solo se la provenienza è da Sito Web
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############


              }

             // se la 5 proposta è compilata
             if($_REQUEST['CheckProposta5']!=''){

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

                     if($_REQUEST['PrezzoServizio5'] != '') {
                        //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$IdRichiesta." AND id_proposta = ".$IdProposta5);
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
                    ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                  
                    $query  = " SELECT 
                                    hospitality_tipo_servizi.*,
                                    hospitality_relazione_servizi_proposte.num_persone,
                                    hospitality_relazione_servizi_proposte.num_notti 
                                FROM 
                                    hospitality_relazione_servizi_proposte
                                INNER JOIN 
                                    hospitality_tipo_servizi ON hospitality_relazione_servizi_proposte.servizio_id = hospitality_tipo_servizi.Id
                                WHERE 
                                    hospitality_tipo_servizi.idsito = ".IDSITO."
                                AND 
                                    hospitality_relazione_servizi_proposte.id_proposta = '".$IdProposta5."'
                                ORDER BY 
                                    hospitality_tipo_servizi.TipoServizio ASC";
                        $risultato_query = $db->query($query);
                        $record          = $db->result($risultato_query);
                        if(sizeof($record)>0){
                            $array_serv     = array();
                            $num_persone    = '';
                            $num_notti      = '';                          
                            $PrezzoServizio = ''; 
                            foreach($record as $key => $campo){

                                switch($campo['CalcoloPrezzo']){
                                    case "Al giorno":
                                        $num_persone = ''; 
                                        $num_notti = $campo['num_notti'];                            
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti),2):'Gratis');
                                    break;
                                    case "A percentuale":
                                    $num_persone = '';
                                    $PrezzoServizio = ($campo['PercentualeServizio']!=''?'% '.number_format(($campo['PercentualeServizio']),2):'');
                                    break;
                                    case "Una tantum":
                                        $num_persone = '';
                                        $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format($campo['PrezzoServizio'],2):'Gratis');
                                    break;
                                    case "A persona":
                                    $num_persone = $campo['num_persone'];
                                    $num_notti = $campo['num_notti'];                          
                                    $PrezzoServizio = ($campo['PrezzoServizio']!=0?'€ '.number_format(($campo['PrezzoServizio']*$num_notti*$num_persone),2):'Gratis');
                                    break;
                                }
                                $serv5 .= str_replace("&"," ",$campo['TipoServizio']).' '.$campo['CalcoloPrezzo'].' '.$PrezzoServizio;
                            }
                        }                                                        
               
                ######################################### ARRAY UTILE AL CURL PER ANALITICS###################################
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

                                          
                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################         
                            $sel3 = "SELECT Id as idCamera,TipoCamere as camera FROM hospitality_tipo_camere WHERE Id = ".$_REQUEST['TipoCamere5'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res3 = $db->query($sel3);
                            $rec3 = $db->row($res3);

                            $sel4 = "SELECT TipoSoggiorno as soggiorno FROM hospitality_tipo_soggiorno WHERE Id = ".$_REQUEST['TipoSoggiorno5'][$i]." AND idsito = ".$_REQUEST['idsito'];
                            $res4 = $db->query($sel4);
                            $rec4 = $db->row($res4);

                            
                            $proposta5 .= '&pr'.$n_camere5.'id='.$rec3['idCamera'].'&pr'.$n_camere5.'nm=QUOTO - '.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).' - dal '.$DataArrivo5.' al '.$DataPartenza5.'&pr'.$n_camere5.'ca='.str_replace("&"," ",$rec3['camera']).' - '.str_replace("&"," ",$rec4['soggiorno']).'&pr'.$n_camere5.'qt='.$_REQUEST['NumeroCamere5'][$i].'&pr'.$n_camere5.'pr='.$_REQUEST['Prezzo5'][$i].'$pr'.$n_camere5.'va='.$serv5;

                            ######################################### ARRAY UTILE AL CURL PER ANALITICS####################################
                         

                     } //fine ciclo for camere

                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############
                            // Solo se la provenienza è da Sito Web
                            if($_REQUEST['FontePrenotazione']== 'Sito Web'){

                                $AccountAnalytics = get_account_analytics($_REQUEST['idsito']);
            
                                if($AccountAnalytics != ''){
            
                                    $select = "SELECT CLIENT_ID FROM hospitality_client_id WHERE NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."' AND idsito = ".$_REQUEST['idsito'];
                                    $result = $db->query($select);
                                    $record = $db->row($result);
                                    $CLIENT_ID = $record['CLIENT_ID'];
                
                                    if($CLIENT_ID != ''){
                
                                        $stringaDati = 'v=1&tid=UA-'.$AccountAnalytics.'&cid='.$CLIENT_ID.'&t=event&ti='.$_REQUEST['NumeroPrenotazione'].'&tr='.str_replace(",",".",$_REQUEST['PrezzoP5']).'&pa=purchase&ec=Ecommerce&ea=purchase&el=QUOTO CRM'.$proposta5;
                
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, 'https://www.google-analytics.com/collect');
                                        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                                        curl_setopt($ch, CURLOPT_POST, true);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS, $stringaDati);
                                        curl_exec($ch);
                                        curl_close($ch); 
                
                                    }// fine se account è inserito su suiteweb
            
                                }// fine se client id è presente
            
                            }// fine if solo se la provenienza è da Sito Web
                        // ##############CURL VERSO ANALYTICS PER IMPUTARE I DATI DI QUOTO IN ANALYTICS##############

              }


            // UPDATE dello stato del preventivo in accettato
            $db->query("UPDATE hospitality_guest SET Accettato = 1,Inviata = 1, DataInvio = '".date('Y-m-d')."' WHERE Id = ".$_REQUEST['Id']);

       }

        if(($_REQUEST['TipoRichiesta']=='Conferma' && $TipoRichiesta == 'Conferma') || ($_REQUEST['TipoRichiesta']=='Preventivo' && $TipoRichiesta == 'Preventivo')){

                if($_REQUEST['Chiuso'] == 1 && $_REQUEST['DataChiuso'] != ''){
                    $cancella_prenotazione .= "Chiuso = '0',";
                    $cancella_prenotazione .= " DataChiuso = NULL,";
                }
                // controllo se è gia stata riempita la tabella rel_pagamenti
                $selP = "SELECT * FROM hospitality_rel_pagamenti_preventivi WHERE idsito = ".$_REQUEST['idsito']." AND id_richiesta = ".$_REQUEST['Id'];
                $resP = $db->query($selP);
                $totP = sizeof($db->result($resP));
                if($totP > 0){
                    $up_template = "UPDATE hospitality_rel_pagamenti_preventivi SET CC = '".$_REQUEST['CC']."', BB = '".$_REQUEST['BB']."', VP = '".$_REQUEST['VP']."', PP = '".$_REQUEST['PP']."', GB = '".$_REQUEST['GB']."', GBVP = '".$_REQUEST['GBVP']."', GBS = '".$_REQUEST['GBS']."', GBNX = '".$_REQUEST['GBNX']."' WHERE idsito = '".$_REQUEST['idsito']."' AND id_richiesta = '".$_REQUEST['Id']."'";
                    $db->query($up_template);
                }else{
                    $ins_pag = "INSERT INTO hospitality_rel_pagamenti_preventivi(idsito,id_richiesta,CC,BB,VP,PP,GB,GBVP,GBS,GBNX) VALUES ('".$_REQUEST['idsito']."','".$_REQUEST['Id']."','".$_REQUEST['CC']."','".$_REQUEST['BB']."','".$_REQUEST['VP']."','".$_REQUEST['PP']."','".$_REQUEST['GB']."','".$_REQUEST['GBVP']."','".$_REQUEST['GBS']."','".$_REQUEST['GBNX']."')";
                    $db->query($ins_pag);
                }

                // controllo se è gia stata riempita la tabella (questo per i QUOTO senza gestione template)
                $selT = "SELECT * FROM hospitality_template_link_landing WHERE idsito = ".$_REQUEST['idsito']." AND id_richiesta = ".$_REQUEST['Id'];
                $resT = $db->query($selT);
                $totT = sizeof($db->result($resT));
                if($totT > 0){
                    $up_template = "UPDATE hospitality_template_link_landing SET id_template = '".$_REQUEST['id_template']."' WHERE idsito = '".$_REQUEST['idsito']."' AND id_richiesta = '".$_REQUEST['Id']."'";
                    $db->query($up_template);
                }else{
                    $in_template = "INSERT INTO hospitality_template_link_landing(id_richiesta,id_template,idsito) VALUES ('".$_REQUEST['Id']."','".$_REQUEST['id_template']."','".$_REQUEST['idsito']."')";
                    $db->query($in_template);
                }

                if($_REQUEST['DataRiconferma']!=''){               
                    $datariconferma = "DataRiconferma = '".$_REQUEST['DataRiconferma']."',";
                }else{
                    $datariconferma = '';
                }
               // query di modifica
                $update = "UPDATE hospitality_guest SET ChiPrenota = '".addslashes($_REQUEST['ChiPrenota'])."',
                                                    EmailSegretaria = '".$_REQUEST['EmailSegretaria']."',
                                                    TipoVacanza = '".$_REQUEST['TipoVacanza']."',
                                                    idsito = '".$_REQUEST['idsito']."',
                                                    id_politiche = '".$_REQUEST['id_politiche']."',
                                                    id_template = '".$_REQUEST['id_template']."',
                                                    AccontoRichiesta = '".$_REQUEST['acconto_richiesta']."',
                                                    Accontolibero = '".$_REQUEST['acconto_libero']."',
                                                    Nome = '".addslashes($_REQUEST['Nome'])."',
                                                    Cognome = '".addslashes($_REQUEST['Cognome'])."',
                                                    Email = '".$_REQUEST['Email']."',
                                                    PrefissoInternazionale = '".$_REQUEST['PrefissoInternazionale']."',
                                                    Cellulare = '".$_REQUEST['Cellulare']."',
                                                    DataNascita = '".$DataNascita."',
                                                    Lingua = '".$_REQUEST['Lingua']."',
                                                    DataArrivo = '".$DataArrivo."',
                                                    DataPartenza = '".$DataPartenza."',
                                                    NumeroPrenotazione = '".$_REQUEST['NumeroPrenotazione']."',
                                                    NumeroAdulti = '".$_REQUEST['NumeroAdulti']."',
                                                    NumeroBambini = '".$_REQUEST['NumeroBambini']."',
                                                    EtaBambini1 = '".$_REQUEST['EtaBambini1']."',
                                                    EtaBambini2 = '".$_REQUEST['EtaBambini2']."',
                                                    EtaBambini3 = '".$_REQUEST['EtaBambini3']."',
                                                    EtaBambini4 = '".$_REQUEST['EtaBambini4']."',
                                                    EtaBambini5 = '".$_REQUEST['EtaBambini5']."',
                                                    EtaBambini6 = '".$_REQUEST['EtaBambini6']."',
                                                    FontePrenotazione = '".$_REQUEST['FontePrenotazione']."',
                                                    TipoPagamento = '".$_REQUEST['TipoPagamento']."',
                                                    DataScadenza = '".$DataScadenza."',
                                                    Note = '".addslashes($_REQUEST['Note'])."',
                                                    ".$cancella_prenotazione."
                                                    ".$datariconferma."
                                                    AbilitaInvio = '".$_REQUEST['AbilitaInvio']."'
                                                    WHERE Id = ".$_REQUEST['Id'];
               $db->query($update);

                  if($_REQUEST['id_proposta1']!=''){

                        $DataA_tmp1          = explode("/",$_REQUEST['DataArrivo1']);
                        $DataArrivo1         = $DataA_tmp1[2].'-'.$DataA_tmp1[1].'-'.$DataA_tmp1[0];
                        $DataP_tmp1          = explode("/",$_REQUEST['DataPartenza1']);
                        $DataPartenza1       = $DataP_tmp1[2].'-'.$DataP_tmp1[1].'-'.$DataP_tmp1[0];

                             $db->query("UPDATE hospitality_proposte SET
                                                                  Arrivo             = '".$DataArrivo1."',
                                                                  Partenza           = '".$DataPartenza1."',
                                                                  NomeProposta       = '".addslashes($_REQUEST['NomeProposta1'])."',
                                                                  TestoProposta      = '".addslashes($_REQUEST['TestoProposta1'])."',
                                                                  CheckProposta      = '".$_REQUEST['CheckProposta1']."',
                                                                  PrezzoL            = '".$_REQUEST['PrezzoL1']."',
                                                                  PrezzoP            = '".$_REQUEST['PrezzoP1']."',
                                                                  AccontoPercentuale = '".$_REQUEST['AccontoPercentuale1']."',
                                                                  AccontoImporto     = '".$_REQUEST['AccontoImporto1']."',
                                                                  AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa1'])."',
                                                                  AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto1'])."'
                                                                  WHERE Id           = '".$_REQUEST['id_proposta1']."'");

                        $n_rich = count($_REQUEST['idrichiesta1']);
                        for($i=0; $i<=($n_rich-1); $i++){
                            $db->query("UPDATE hospitality_richiesta SET TipoSoggiorno = '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                                         NumeroCamere  = '".$_REQUEST['NumeroCamere1'][$i]."',
                                                                         TipoCamere    = '".$_REQUEST['TipoCamere1'][$i]."',
                                                                         NumAdulti     = '".$_REQUEST['NumAdulti1'][$i]."',
                                                                         NumBambini    = '".$_REQUEST['NumBambini1'][$i]."',
                                                                         EtaB          = '".$_REQUEST['EtaB1'][$i]."',
                                                                         Prezzo        = '".$_REQUEST['Prezzo1'][$i]."'
                                                                         WHERE Id      = '".$_REQUEST['idrichiesta1'][$i]."'");
                            if($_REQUEST['idrichiesta1'][$i]==''){
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
                                                                      '".$_REQUEST['Id']."',
                                                                      '".$_REQUEST['id_proposta1']."',
                                                                      '".$_REQUEST['TipoSoggiorno1'][$i]."',
                                                                      '".$_REQUEST['NumeroCamere1'][$i]."',
                                                                      '".$_REQUEST['TipoCamere1'][$i]."',
                                                                      '".$_REQUEST['NumAdulti1'][$i]."',
                                                                      '".$_REQUEST['NumBambini1'][$i]."',
                                                                      '".$_REQUEST['EtaB1'][$i]."',
                                                                      '".$_REQUEST['Prezzo1'][$i]."')");
                            }
                        }

                        if($_REQUEST['PrezzoServizio1'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                            foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                            }
                        }

                        if($_REQUEST['VisibileServizio1'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                            foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$key."','".$value."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta1']);
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta1']."','".$_REQUEST['SC1']."')");    
                  }
                  if($_REQUEST['id_proposta_1']=='1' && $_REQUEST['PrezzoP1']!=''){

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
                                                                  '".$_REQUEST['Id']."',
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
                                                                  '".$_REQUEST['Id']."',
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
                            //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$IdProposta);
                            foreach($_REQUEST['PrezzoServizio1'] as $key => $value){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$key."','".$_REQUEST['num_persone_1_'.$key]."','".$_REQUEST['notti1_'.$key]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio1'] != '') {   
                            foreach($_REQUEST['VisibileServizio1'] as $key => $value){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$key."','".$value."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE  
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta."','".$_REQUEST['SC1']."')");    
         
                  }

                  if($_REQUEST['id_proposta2']!=''){

                    $DataA_tmp2          = explode("/",$_REQUEST['DataArrivo2']);
                    $DataArrivo2         = $DataA_tmp2[2].'-'.$DataA_tmp2[1].'-'.$DataA_tmp2[0];
                    $DataP_tmp2          = explode("/",$_REQUEST['DataPartenza2']);
                    $DataPartenza2       = $DataP_tmp2[2].'-'.$DataP_tmp2[1].'-'.$DataP_tmp2[0];

                             $db->query("UPDATE hospitality_proposte SET
                                                                  Arrivo             = '".$DataArrivo2."',
                                                                  Partenza           = '".$DataPartenza2."',
                                                                  NomeProposta       = '".addslashes($_REQUEST['NomeProposta2'])."',
                                                                  TestoProposta      = '".addslashes($_REQUEST['TestoProposta2'])."',
                                                                  CheckProposta      = '".$_REQUEST['CheckProposta2']."',
                                                                  PrezzoL            = '".$_REQUEST['PrezzoL2']."',
                                                                  PrezzoP            = '".$_REQUEST['PrezzoP2']."',
                                                                  AccontoPercentuale = '".$_REQUEST['AccontoPercentuale2']."',
                                                                  AccontoImporto     = '".$_REQUEST['AccontoImporto2']."',
                                                                  AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa2'])."',
                                                                  AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto2'])."'
                                                                  WHERE Id           = '".$_REQUEST['id_proposta2']."'");

                         $n_rich2 = count($_REQUEST['idrichiesta2']);
                         for($s=0; $s<=($n_rich2-1); $s++){
                             $db->query("UPDATE hospitality_richiesta SET  TipoSoggiorno = '".$_REQUEST['TipoSoggiorno2'][$s]."',
                                                                         NumeroCamere    = '".$_REQUEST['NumeroCamere2'][$s]."',
                                                                         TipoCamere      = '".$_REQUEST['TipoCamere2'][$s]."',
                                                                         NumAdulti       = '".$_REQUEST['NumAdulti2'][$s]."',
                                                                         NumBambini      = '".$_REQUEST['NumBambini2'][$s]."',
                                                                         EtaB            = '".$_REQUEST['EtaB2'][$s]."',
                                                                         Prezzo          = '".$_REQUEST['Prezzo2'][$s]."'
                                                                   WHERE Id              = '".$_REQUEST['idrichiesta2'][$s]."'");

                            if($_REQUEST['idrichiesta2'][$s]==''){
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
                                                                      '".$_REQUEST['Id']."',
                                                                      '".$_REQUEST['id_proposta2']."',
                                                                      '".$_REQUEST['TipoSoggiorno2'][$s]."',
                                                                      '".$_REQUEST['NumeroCamere2'][$s]."',
                                                                      '".$_REQUEST['TipoCamere2'][$s]."',
                                                                      '".$_REQUEST['NumAdulti2'][$s]."',
                                                                      '".$_REQUEST['NumBambini2'][$s]."',
                                                                      '".$_REQUEST['EtaB2'][$s]."',
                                                                      '".$_REQUEST['Prezzo2'][$s]."')");
                            }
                         }
                         if($_REQUEST['PrezzoServizio2'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                            foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio2'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                            foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$key2."','".$value2."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta2']);
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta2']."','".$_REQUEST['SC2']."')");    
         
                  }
                  if($_REQUEST['id_proposta_2']=='2' && $_REQUEST['PrezzoP2']!=''){

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
                                                                  '".$_REQUEST['Id']."',
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
                                                                  '".$_REQUEST['Id']."',
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
                            //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$IdProposta2);
                            foreach($_REQUEST['PrezzoServizio2'] as $key2 => $value2){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$key2."','".$_REQUEST['num_persone_2_'.$key2]."','".$_REQUEST['notti2_'.$key2]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio2'] != '') { 
                            foreach($_REQUEST['VisibileServizio2'] as $key2 => $value2){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$key2."','".$value2."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta2."','".$_REQUEST['SC2']."')");  
                  }

                  if($_REQUEST['id_proposta3']!=''){

                    $DataA_tmp3          = explode("/",$_REQUEST['DataArrivo3']);
                    $DataArrivo3         = $DataA_tmp3[2].'-'.$DataA_tmp3[1].'-'.$DataA_tmp3[0];
                    $DataP_tmp3          = explode("/",$_REQUEST['DataPartenza3']);
                    $DataPartenza3       = $DataP_tmp3[2].'-'.$DataP_tmp3[1].'-'.$DataP_tmp3[0];

                             $db->query("UPDATE hospitality_proposte SET
                                                                  Arrivo             = '".$DataArrivo3."',
                                                                  Partenza           = '".$DataPartenza3."',
                                                                  NomeProposta       = '".addslashes($_REQUEST['NomeProposta3'])."',
                                                                  TestoProposta      = '".addslashes($_REQUEST['TestoProposta3'])."',
                                                                  CheckProposta      = '".$_REQUEST['CheckProposta3']."',
                                                                  PrezzoL            = '".$_REQUEST['PrezzoL3']."',
                                                                  PrezzoP            = '".$_REQUEST['PrezzoP3']."',
                                                                  AccontoPercentuale = '".$_REQUEST['AccontoPercentuale3']."',
                                                                  AccontoImporto     = '".$_REQUEST['AccontoImporto3']."',
                                                                  AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa3'])."',
                                                                  AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto3'])."'
                                                                  WHERE Id           = '".$_REQUEST['id_proposta3']."'");

                         $n_rich3 = count($_REQUEST['idrichiesta3']);
                         for($t=0; $t<=($n_rich3-1); $t++){
                             $db->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno3'][$t]."',
                                                                            NumeroCamere  = '".$_REQUEST['NumeroCamere3'][$t]."',
                                                                            TipoCamere    = '".$_REQUEST['TipoCamere3'][$t]."',
                                                                            NumAdulti     = '".$_REQUEST['NumAdulti3'][$t]."',
                                                                            NumBambini    = '".$_REQUEST['NumBambini3'][$t]."',
                                                                            EtaB          = '".$_REQUEST['EtaB3'][$t]."',
                                                                            prezzo        = '".$_REQUEST['Prezzo3'][$t]."'
                                                                            WHERE Id      = '".$_REQUEST['idrichiesta3'][$t]."'");
                            if($_REQUEST['idrichiesta3'][$t]==''){
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
                                                                      '".$_REQUEST['Id']."',
                                                                      '".$_REQUEST['id_proposta3']."',
                                                                      '".$_REQUEST['TipoSoggiorno3'][$t]."',
                                                                      '".$_REQUEST['NumeroCamere3'][$t]."',
                                                                      '".$_REQUEST['TipoCamere3'][$t]."',
                                                                      '".$_REQUEST['NumAdulti3'][$t]."',
                                                                      '".$_REQUEST['NumBambini3'][$t]."',
                                                                      '".$_REQUEST['EtaB3'][$t]."',
                                                                      '".$_REQUEST['Prezzo3'][$t]."')");
                            }

                         }
                         if($_REQUEST['PrezzoServizio3'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                            foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio3'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                            foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$key3."','".$value3."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta3']);
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta3']."','".$_REQUEST['SC3']."')");  
                  }
                  if($_REQUEST['id_proposta_3']=='3' && $_REQUEST['PrezzoP3']!=''){

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
                                                                  '".$_REQUEST['Id']."',
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
                                                                  '".$_REQUEST['Id']."',
                                                                  '".$IdProposta3."',
                                                                  '".$_REQUEST['TipoSoggiorno3'][$i]."',
                                                                  '".$_REQUEST['NumeroCamere3'][$i]."',
                                                                  '".$_REQUEST['TipoCamere3'][$i]."',
                                                                  '".$_REQUEST['NumAdulti3'][$i]."',
                                                                  '".$_REQUEST['NumBambini3'][$i]."',
                                                                  '".$_REQUEST['EtaB3'][$i]."',
                                                                  '".$_REQUEST['Prezzo3'][$i]."')");
                         }

                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$_REQUEST['SC3']."')");  
 
                  }
                  if($_REQUEST['PrezzoServizio3'] != '') {
                    //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$IdProposta3);
                    foreach($_REQUEST['PrezzoServizio3'] as $key3 => $value3){
                        $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$key3."','".$_REQUEST['num_persone_3_'.$key3]."','".$_REQUEST['notti3_'.$key3]."')");
                    }
                }
                if($_REQUEST['VisibileServizio3'] != '') {
                    foreach($_REQUEST['VisibileServizio3'] as $key3 => $value3){
                        $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta3."','".$key3."','".$value3."')");
                    }
                }
                if($_REQUEST['id_proposta4']!=''){

                    $DataA_tmp4          = explode("/",$_REQUEST['DataArrivo4']);
                    $DataArrivo4         = $DataA_tmp4[2].'-'.$DataA_tmp4[1].'-'.$DataA_tmp4[0];
                    $DataP_tmp4          = explode("/",$_REQUEST['DataPartenza4']);
                    $DataPartenza4       = $DataP_tmp4[2].'-'.$DataP_tmp4[1].'-'.$DataP_tmp4[0];

                             $db->query("UPDATE hospitality_proposte SET
                                                                  Arrivo             = '".$DataArrivo4."',
                                                                  Partenza           = '".$DataPartenza4."',
                                                                  NomeProposta       = '".addslashes($_REQUEST['NomeProposta4'])."',
                                                                  TestoProposta      = '".addslashes($_REQUEST['TestoProposta4'])."',
                                                                  CheckProposta      = '".$_REQUEST['CheckProposta4']."',
                                                                  PrezzoL            = '".$_REQUEST['PrezzoL4']."',
                                                                  PrezzoP            = '".$_REQUEST['PrezzoP4']."',
                                                                  AccontoPercentuale = '".$_REQUEST['AccontoPercentuale4']."',
                                                                  AccontoImporto     = '".$_REQUEST['AccontoImporto4']."',
                                                                  AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa4'])."',
                                                                  AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto4'])."'
                                                                  WHERE Id           = '".$_REQUEST['id_proposta4']."'");

                         $n_rich4 = count($_REQUEST['idrichiesta4']);
                         for($w=0; $w<=($n_rich4-1); $w++){
                             $db->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno4'][$w]."',
                                                                            NumeroCamere  = '".$_REQUEST['NumeroCamere4'][$w]."',
                                                                            TipoCamere    = '".$_REQUEST['TipoCamere4'][$w]."',
                                                                            NumAdulti     = '".$_REQUEST['NumAdulti4'][$w]."',
                                                                            NumBambini    = '".$_REQUEST['NumBambini4'][$w]."',
                                                                            EtaB          = '".$_REQUEST['EtaB4'][$w]."',
                                                                            prezzo        = '".$_REQUEST['Prezzo4'][$w]."'
                                                                            WHERE Id      = '".$_REQUEST['idrichiesta4'][$w]."'");
                            if($_REQUEST['idrichiesta4'][$w]==''){
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
                                                                      '".$_REQUEST['Id']."',
                                                                      '".$_REQUEST['id_proposta4']."',
                                                                      '".$_REQUEST['TipoSoggiorno4'][$w]."',
                                                                      '".$_REQUEST['NumeroCamere4'][$w]."',
                                                                      '".$_REQUEST['TipoCamere4'][$w]."',
                                                                      '".$_REQUEST['NumAdulti4'][$w]."',
                                                                      '".$_REQUEST['NumBambini4'][$w]."',
                                                                      '".$_REQUEST['EtaB4'][$w]."',
                                                                      '".$_REQUEST['Prezzo4'][$w]."')");
                            }

                         }
                         if($_REQUEST['PrezzoServizio4'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                            foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio4'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                            foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$key4."','".$value4."')");
                            }
                        }
                    ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                    $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta4']);
                    $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta4']."','".$_REQUEST['SC4']."')");  
                      
                  }
                  if($_REQUEST['id_proposta_4']=='4' && $_REQUEST['PrezzoP4']!=''){

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
                                                                  '".$_REQUEST['Id']."',
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
                                                                  '".$_REQUEST['Id']."',
                                                                  '".$IdProposta4."',
                                                                  '".$_REQUEST['TipoSoggiorno4'][$i]."',
                                                                  '".$_REQUEST['NumeroCamere4'][$i]."',
                                                                  '".$_REQUEST['TipoCamere4'][$i]."',
                                                                  '".$_REQUEST['NumAdulti4'][$i]."',
                                                                  '".$_REQUEST['NumBambini4'][$i]."',
                                                                  '".$_REQUEST['EtaB4'][$i]."',
                                                                  '".$_REQUEST['Prezzo4'][$i]."')");
                         }

                      ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                      $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$id_proposta4."','".$_REQUEST['SC4']."')");  


                  }
                  if($_REQUEST['PrezzoServizio4'] != '') {
                    //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$IdProposta4);
                    foreach($_REQUEST['PrezzoServizio4'] as $key4 => $value4){
                        $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta4."','".$key4."','".$_REQUEST['num_persone_4_'.$key4]."','".$_REQUEST['notti4_'.$key4]."')");
                    }
                }
                if($_REQUEST['VisibileServizio4'] != '') {
                    foreach($_REQUEST['VisibileServizio4'] as $key4 => $value4){
                        $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta4."','".$key4."','".$value4."')");
                    }
                }

                if($_REQUEST['id_proposta5']!=''){

                    $DataA_tmp5          = explode("/",$_REQUEST['DataArrivo5']);
                    $DataArrivo5         = $DataA_tmp5[2].'-'.$DataA_tmp5[1].'-'.$DataA_tmp5[0];
                    $DataP_tmp5          = explode("/",$_REQUEST['DataPartenza5']);
                    $DataPartenza5       = $DataP_tmp5[2].'-'.$DataP_tmp5[1].'-'.$DataP_tmp5[0];

                             $db->query("UPDATE hospitality_proposte SET
                                                                  Arrivo             = '".$DataArrivo5."',
                                                                  Partenza           = '".$DataPartenza5."',
                                                                  NomeProposta       = '".addslashes($_REQUEST['NomeProposta5'])."',
                                                                  TestoProposta      = '".addslashes($_REQUEST['TestoProposta5'])."',
                                                                  CheckProposta      = '".$_REQUEST['CheckProposta5']."',
                                                                  PrezzoL            = '".$_REQUEST['PrezzoL5']."',
                                                                  PrezzoP            = '".$_REQUEST['PrezzoP5']."',
                                                                  AccontoPercentuale = '".$_REQUEST['AccontoPercentuale5']."',
                                                                  AccontoImporto     = '".$_REQUEST['AccontoImporto5']."',
                                                                  AccontoTariffa     = '".addslashes($_REQUEST['EtichettaTariffa5'])."',
                                                                  AccontoTesto       = '".addslashes($_REQUEST['AccontoTesto5'])."'
                                                                  WHERE Id           = '".$_REQUEST['id_proposta5']."'");

                         $n_rich5 = count($_REQUEST['idrichiesta5']);
                         for($a=0; $a<=($n_rich5-1); $a++){
                             $db->query("UPDATE hospitality_richiesta SET   TipoSoggiorno = '".$_REQUEST['TipoSoggiorno5'][$a]."',
                                                                            NumeroCamere  = '".$_REQUEST['NumeroCamere5'][$a]."',
                                                                            TipoCamere    = '".$_REQUEST['TipoCamere5'][$a]."',
                                                                            NumAdulti     = '".$_REQUEST['NumAdulti5'][$a]."',
                                                                            NumBambini    = '".$_REQUEST['NumBambini5'][$a]."',
                                                                            EtaB          = '".$_REQUEST['EtaB5'][$a]."',
                                                                            prezzo        = '".$_REQUEST['Prezzo5'][$a]."'
                                                                            WHERE Id      = '".$_REQUEST['idrichiesta5'][$a]."'");
                            if($_REQUEST['idrichiesta5'][$a]==''){
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
                                                                      '".$_REQUEST['Id']."',
                                                                      '".$_REQUEST['id_proposta5']."',
                                                                      '".$_REQUEST['TipoSoggiorno5'][$a]."',
                                                                      '".$_REQUEST['NumeroCamere5'][$a]."',
                                                                      '".$_REQUEST['TipoCamere5'][$a]."',
                                                                      '".$_REQUEST['NumAdulti5'][$a]."',
                                                                      '".$_REQUEST['NumBambini5'][$a]."',
                                                                      '".$_REQUEST['EtaB5'][$a]."',
                                                                      '".$_REQUEST['Prezzo5'][$a]."')");
                            }

                         }
                         if($_REQUEST['PrezzoServizio5'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                            foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                                $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                            }
                        }
                        if($_REQUEST['VisibileServizio5'] != '') {
                            $db->query("DELETE FROM hospitality_relazione_visibili_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                            foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                                $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$key5."','".$value5."')");
                            }
                        }
                        ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("DELETE FROM hospitality_relazione_sconto_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$_REQUEST['id_proposta5']);
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$_REQUEST['id_proposta5']."','".$_REQUEST['SC5']."')");  

                  }
                  if($_REQUEST['id_proposta_5']=='5' && $_REQUEST['PrezzoP5']!=''){

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
                                                                  '".$_REQUEST['Id']."',
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
                         for($h=0; $h<=($n_camere5-1); $h++){
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
                                                                  '".$_REQUEST['Id']."',
                                                                  '".$IdProposta5."',
                                                                  '".$_REQUEST['TipoSoggiorno5'][$h]."',
                                                                  '".$_REQUEST['NumeroCamere5'][$h]."',
                                                                  '".$_REQUEST['TipoCamere5'][$h]."',
                                                                  '".$_REQUEST['NumAdulti5'][$h]."',
                                                                  '".$_REQUEST['NumBambini5'][$h]."',
                                                                  '".$_REQUEST['EtaB5'][$h]."',
                                                                  '".$_REQUEST['Prezzo5'][$h]."')");
                         }

                       ## INSERIMENTO DELLO SCONTO IN TABELLA RELAZIONALE
                        $db->query("INSERT INTO hospitality_relazione_sconto_proposte(idsito,id_richiesta,id_proposta,sconto) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$id_proposta5."','".$_REQUEST['SC5']."')");  

                  }
                  if($_REQUEST['PrezzoServizio5'] != '') {
                    //$db->query("DELETE FROM hospitality_relazione_servizi_proposte WHERE idsito = ".IDSITO." AND id_richiesta = ".$_REQUEST['Id']." AND id_proposta = ".$IdProposta5);
                    foreach($_REQUEST['PrezzoServizio5'] as $key5 => $value5){
                        $db->query("INSERT INTO hospitality_relazione_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,num_persone,num_notti) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta5."','".$key5."','".$_REQUEST['num_persone_5_'.$key5]."','".$_REQUEST['notti5_'.$key5]."')");
                    }
                }
                if($_REQUEST['VisibileServizio5'] != '') {
                    foreach($_REQUEST['VisibileServizio5'] as $key5 => $value5){
                        $db->query("INSERT INTO hospitality_relazione_visibili_servizi_proposte(idsito,id_richiesta,id_proposta,servizio_id,visibile) VALUES('".IDSITO."','".$_REQUEST['Id']."','".$IdProposta5."','".$key5."','".$value5."')");
                    }
                }
                
                if($_REQUEST['Chiuso'] == 1 && ($_REQUEST['DataChiuso'] != '0000-00-00' || $_REQUEST['DataChiuso'] != null)){
                    $db->query("UPDATE hospitality_guest SET DataModificaPrenotazione = '".date('Y-m-d')."' WHERE Id = ".$_REQUEST['Id']." AND idsito = ".IDSITO);
                    popola_status_parity(IDSITO,$_REQUEST['NumeroPrenotazione'],8);
                }


            }

        if($_REQUEST['IdMotivazione']!=''){
            header('Location:'.BASE_URL_SITO.'buoni_voucher/');
        }
        if($_REQUEST['TipoRichiesta']=='Conferma'){
             header('Location:'.BASE_URL_SITO.'conferme/');
        }
        if($_REQUEST['TipoRichiesta']=='Preventivo'){
            header('Location:'.BASE_URL_SITO.'preventivi/');
        }

    }

<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.inc.php");

function DifferenzaDate($data1,$data2,$formato) {
  $datetime1 = new DateTime($data1);
  $datetime2 = new DateTime($data2);
  $interval = $datetime1->diff($datetime2);
  return $interval->format($formato);
}

function riepilogo($id,$idsito){

  global $dbMysqli;

  $sistemazione = '';


  $select = "SELECT
              hospitality_proposte.Id AS IdProposta,
              hospitality_proposte.NomeProposta,
              hospitality_proposte.PrezzoL,
              hospitality_proposte.PrezzoP,
              hospitality_guest.TipoRichiesta,
              hospitality_guest.idsito,
              hospitality_guest.AccontoRichiesta,
              hospitality_guest.Nome,
              hospitality_guest.Cognome,
              hospitality_guest.AccontoLibero,
              hospitality_proposte.AccontoPercentuale,
              hospitality_proposte.AccontoImporto,
              hospitality_proposte.AccontoTesto,
              hospitality_guest.Email,
              hospitality_guest.DataArrivo,
              hospitality_guest.DataPartenza,
              hospitality_guest.Chiuso 
            FROM
              hospitality_proposte
              INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta 
            WHERE
              hospitality_guest.NumeroPrenotazione = ".$id." 
            AND 
              hospitality_guest.idsito = ".$idsito." 
            ORDER BY
              hospitality_proposte.Id ASC";

  $result = $dbMysqli->query($select);
  $tot    = sizeof($result);

  if($tot > 0){
      $Camere          = '';
      $sistemazioneP   = '';
      $sistemazioneC   = '';
      $n               = 1;
      $data_alernativa = '';
      $saldo           = '';
      $etichetta_saldo = '';
      $DPartenza       = '';
      $DArrivo         = '';
      $DNotti          = '';
    foreach($result as $key => $value) {

          $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
          $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
          $IdProposta         = $value['IdProposta'];
          $PrezzoPC           = $value['PrezzoP'];
          $idsito             = $value['idsito'];
          $AccontoRichiesta   = $value['AccontoRichiesta'];
          $AccontoLibero      = $value['AccontoLibero'];
          $NomeProposta       = $value['NomeProposta'];
          $Nome               = stripslashes($value['Nome']);
          $Cognome            = stripslashes($value['Cognome']);
          $Email              = $value['Email'];
          $Arrivo_tmp         = explode("-",$value['DataArrivo']);
          $Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
          $Partenza_tmp       = explode("-",$value['DataPartenza']);
          $Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
          $start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
          $end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
          $formato            ="%a";
          $Notti              = DifferenzaDate($value['DataArrivo'],$value['DataPartenza'],$formato);
          $AccontoPercentuale = $value['AccontoPercentuale'];
          $AccontoImporto     = $value['AccontoImporto'];
          $AccontoTesto       = stripslashes($value['AccontoTesto']);
          // date alternative
          $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
          $re = $dbMysqli->query($se); 
          $tt = sizeof($re);

          if($tt>0){

              $rc = $re[0];

              $DArrivo_tmp    = explode("-",$rc['Arrivo']);
              $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
              $DPartenza_tmp  = explode("-",$rc['Partenza']);
              $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
              $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
              $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
              $formato="%a";
              $DNotti = DifferenzaDate($rc['Arrivo'],$rc['Partenza'],$formato);
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
              //$acconto = number_format($AccontoImporto,2,',','.');
              $acconto = 'Carta di Credito a garanzia';
          }
          if($PrezzoPC==$saldo){
              $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
          }else{
              $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
          }


          $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                      FROM hospitality_richiesta
                      INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                      INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                      WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;

          $result2 = $dbMysqli->query($select2);

          $Camere = '';
          if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
              if($value['TipoRichiesta']=='Preventivo'){
                  if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                      $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                  }
              }elseif($value['TipoRichiesta']=='Conferma'){
                  if($rc['Arrivo']!= $value['DataArrivo']){
                      $Arrivo   = $DArrivo;
                  }
                  if($rc['Partenza']!= $value['DataPartenza']){
                      $Partenza   = $DPartenza;
                  }
              }
          }
          foreach($result2 as $key2 => $val) {
              $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
          }

          if($value['TipoRichiesta'] == 'Preventivo'){

              $sistemazioneP .= '<b>'.$n.') PROPOSTA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.'<br>'.$data_alernativa.$Camere.'  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  '.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br />';

          }else{

              $sistemazioneC .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.'<br> '.$data_alernativa.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.'':'').'<br>'.$etichetta_saldo.'<br>';

          }

       $n++;
       $data_alernativa = '';
       $DPartenza       = '';
       $DArrivo         = '';
       $DNotti          = '';
      }

      if($sistemazioneP!=''){
          $sistemazione = '<div class="col-md-12"><h5 class="text-primary f-w-900 p-b-10">Preventivo:</h5>'.$sistemazioneP.'</div>';
      }
      if($sistemazioneC!=''){
          $sistemazione = '<div class="col-md-12"><h5 class="text-primary f-w-900 p-b-10">'.($value['Chiuso']==1?'Prenotazione':'Conferma').':</h5>'.$sistemazioneC.'</div>';
      }

      return '<div class="row">'.$sistemazione.'</div>';

  }else{
      return '<small class="text-maroon" style=" white-space: nowrap;">Da Completare</small>';
  }

}





    $select = " SELECT 
                  hospitality_guest.* 
                FROM 
                  hospitality_guest 
                WHERE 
                  hospitality_guest.idsito = ".$_REQUEST['idsito']."  
                AND 
                  hospitality_guest.NumeroPrenotazione = ".$_REQUEST['NumeroPrenotazione']."
                ORDER BY
                  hospitality_guest.Id DESC";

    $result = $dbMysqli->query($select);
    $row    = $result[0];

    $query  = "SELECT * FROM hospitality_operatori WHERE Abilitato = 1 AND idsito = ".$_REQUEST['idsito']." AND NomeOperatore != '".$row['ChiPrenota']."' ORDER BY Id ASC";
    $resu   = $dbMysqli->query($query);
    $Operatori .='<option value="">scegli</option>';
    foreach($resu as $k => $valore){
        $Operatori .='<option value="'.$valore['NomeOperatore'].'" >'.$valore['NomeOperatore'].'</option>';
    }

    $css_pulsante = 'btn btn-primary';

    if($row['DataScadenza']< date("Y-m-d")){
        $text         = '<div class="alert alert-info text-black text-center"><span class="f-12">La <b>Data  di Scadenza</b> della proposta è passata oppure non impostata, per <b>rispondere alla chat</b> è necessario <b>modificarla</b>!</span></div>';
        $title        = 'Data  di  Scadenza passata, modificarla!';
        //$command      = 'disabled="disabled"';
        //$css_pulsante = 'btn btn-disabled';

$form_data_scadenza .= '
                <div class="row m-t-10">
                    <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="card bg_gradient_gray">
                                <div class="card-block">
                                <small>
                                <div id="ResultDataScadenza"></div>
                                <form  method="POST" id="form_change" name="form_change">
                                    <div class="row">
     
                                        <div class="col-md-4">
                                            <label  class="control-label">Data Scadenza</label>
                                            <input type="date" id="DataScadenza" autocomplete="off"  class=" form-control" name="DataScadenza" value="'.$row['DataScadenza'].'">
                                        </div>
                                        <div class="col-md-2 text-left">
                                            <div class="clearfix" style="height:22px!important"></div>
                                            <input type="hidden" name="action" value="change">
                                            <input type="hidden" name="id_richiesta" value="'.$row['Id'].'">
                                            <input type="hidden" name="idsito" value="'.$_REQUEST['idsito'].'">
                                            <button type="submit" class="btn btn-primary btn-sm" id="bottone">Modifica</button>
                                        </div>
                                        <div class="col-md-6"><div class="clearfix p-b-20"></div>'.$text.'</div>
                                    </div>
                                </form>
                                </small>'."\r\n";
        $form_data_scadenza .=' <script>
                                    $(document).ready(function() {
                                        
                                        $("#form_change").submit(function(){
                                            
                                            var dati = $("#form_change").serialize();                                                            
                                                $.ajax({
                                                    url: "'.BASE_URL_SITO.'ajax/chat/modifica_data_scadenza.php",
                                                    type: "POST",
                                                    data: dati,
                                                        success: function(data) {                                                                                                          
                                                            $("#ResultDataScadenza").html(\'<div class="alert alert-success">Data salvata con successo! Attendi il reload della pagina!</div>\'); 
                                                            setTimeout(function(){ 
                                                                document.location.reload();  
                                                            }, 500);
                                                                                                            
                                                        }                                                                    
                                                    });                                                               
                                                return false; // con false senza refresh della pagina
                                        });                                                                                                                                                                                                                                                                                                  
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>'."\r\n";
    }  
    $js_chat ='<script>
                    $(document).ready(function() {
                        $("#form_chat").submit(function(){
                            
                            var dati = $("#form_chat").serialize();                                                            
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/chat/aggiungi_chat.php",
                                    type: "POST",
                                    data: dati,
                                        success: function(data) {                                                                                                          
                                            $("#chat").val(""); 
                                            $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                                                            
                                        }                                                                    
                                    });                                                               
                                return false; // con false senza refresh della pagina
                        });                                                                                                                                                                                                                                                                    

                        $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                    });
                </script>'."\r\n";
    $js_chat_load ='<script>
                        $(document).ready(function() {
                            $("#balloon").load("'.BASE_URL_SITO.'ajax/chat/ballon.php?NumeroPrenotazione='.$row['NumeroPrenotazione'].'&idsito='.$row['idsito'].'");                               
                        });
                    </script>'."\r\n";
 
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?></title>
    <!-- Nome della Web Application -->
    <meta name="application-name" content="<?=NOME_AMMINISTRAZIONE?> v.<?=VERSIONE?>">
    <!-- Autore -->
    <meta name="author" content="<?=AUTHOR?>">
    <!-- Proprietario del Software -->
    <meta name="copyright" content="<?=NAME_ADMIN?>">
    <!-- Favicon icon -->
    <link rel="icon" href="<?=BASE_URL_SITO?>favicon/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>files/assets/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/custom.css">
    <!-- mio Style.css -->
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL_SITO?>css/style.css">
    <!-- Jquery -->
    <script type="text/javascript" src="<?=BASE_URL_SITO?>js/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    </head>
    <body class="scroll" style="background-color:#FFF!important;">

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 text-right"> 
                <?php if($_REQUEST['id_notify']!=''){?>             
                    <button class="btn btn-inverse btn-sm" href="javascript:;" id="ChiudiChat<?=$_REQUEST['id_notify']?>" data-dismiss="modal" aria-label="Close">Chiudi la chat in corso <i class="fa fa-chain-broken"></i></button>
                    <script>
                    $(document).ready(function(){
                        $("#ChiudiChat<?=$_REQUEST['id_notify']?>").on("click",function(){
                            if (window.confirm("ATTENZIONE: Sicuro di voler chiudere la chat N° <?=$row['NumeroPrenotazione']?>?")){
                                $.ajax({
                                    url: "<?=BASE_URL_SITO?>ajax/chat/close_chat.php",
                                    type: "POST",
                                    data: "id=<?=$_REQUEST['id_notify']?>&idsito=<?=$row['idsito']?>&NumeroPrenotazione=<?=$row['NumeroPrenotazione']?>&id_guest=<?=$row['Id']?>&user=<?=$_SESSION['user_accesso']?>",
                                    dataType: "html",
                                    success: function(data) {
                                        //$("#view_form").hide();
                                        $("#view_form").html('<div class="alert alert-success text-center">La conversazione è stata chiusa con successo!<br>Ora clicca sul pulsante "chiudi" in alto a destra!</div>');
                                    }
                                });
                                return false;
                            }
                        });
                    });
                    </script>
                <?}?>
                </div>
                <div class="col-md-1"></div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-1"></div>
                <div class="col-md-10 f-12" id="view_form">
                    <div class="card bg_gradient_yellow">
                        <div class="card-block">
                                <h5>N° <b><?=$row['NumeroPrenotazione']?></b> 
                                Nome: <b><?=stripslashes($row['Nome'])?></b> 
                                Cognome: <b><?=stripslashes($row['Cognome'])?></b></h5>
                            <div class="clearfix p-b-10"></div>
                            <?=riepilogo($row['NumeroPrenotazione'],$row['idsito'])?>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

            <? //echo $form_data_scadenza?>

            <div class="row">
            <div class="col-md-1"></div>
              <div class="col-md-10">
                    <div class="card bg_blocchi_light_gray">
                        <div class="card-block">
                            <form id="form_chat" name="form_chat" method="post">
                            <div class="form-group">
                            <label for="op">Cambia operatore <a href="javascript:;" id="attiva_legenda_info_fonti" data-toogle="tooltip" data-html="true" title="Se sei un operatore diverso da chi ha creato il preventivo e/o la conferma,puoi cambiare!"><i class="fa fa-life-ring text-info"></i></a></label>
                                <select class="form-control"name="operatore" id="operatore" >
                                <?=$Operatori?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Messaggio">Hotel Chat</label>
                                <textarea class="form-control" rows="10" name="chat" id="chat" required></textarea>
                            </div>
                            <input type="hidden" name="id_guest" value="<?=$row['Id']?>">
                            <input type="hidden" name="NumeroPrenotazione" value="<?=$row['NumeroPrenotazione']?>">
                            <input type="hidden" name="user" value="<?=$row['ChiPrenota']?>">
                            <input type="hidden" name="lang" value="<?=$row['Lingua']?>">
                            <input type="hidden" name="idsito" value="<?=$row['idsito']?>">
                            <input type="hidden" name="action" value="add_chat">
                            <button id="bottone_invio_chat" type="submit" class="btn <?=$css_pulsante?> btn-sm" style="float:right!important;" title="<?=$title?>" <?=$command?> >Invia</button>
                            </form>
                            <?=$js_chat?>
                            <?=$js_chat_load?>
                            <br><br><br>
                            <div id="balloon"></div>
                        </div>
                    </div>                      
              </div>
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
        <!-- Required Jquery -->

        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/popper.js/js/popper.min.js"></script>
        <script type="text/javascript" src="<?=BASE_URL_SITO?>files/bower_components/bootstrap/js/bootstrap.min.js"></script> 
    </body>
</html>
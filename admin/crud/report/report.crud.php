<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");


$select = " SELECT 
                siti.web, 
                siti.idsito,
                siti.hospitality,
                siti.data_start_hospitality,
                siti.data_end_hospitality
            FROM
                siti
            WHERE
                1 = 1
            ".($_REQUEST['idsito']!=''?'AND siti.idsito = '.$_REQUEST['idsito']:'')."
            GROUP BY 
                siti.idsito
            ORDER BY
                siti.idsito DESC ";

$array_dati = $dbMysqli->query($select);


$ieri_tmp      = mktime (0,0,0,date('m'),(date('d')-1),date('Y'));
$ieri          = date('Y-m-d',$ieri_tmp);

$settimana_tmp = mktime (0,0,0,date('m'),(date('d')-7),date('Y'));
$settimana     = date('Y-m-d',$settimana_tmp);

$mese_tmp      = mktime (0,0,0,date('m'),(date('d')-30),date('Y'));
$mese          = date('Y-m-d',$mese_tmp);

$anno_tmp      = mktime(0,0,0,date('m'),(date('d')-1),(date('Y')-1));
$anno          = date('Y-m-d',$anno_tmp);

foreach($array_dati as $key => $row){

    $ButtonQto = "<a type='button' class='btn btn-sm btn-default btn-outline-inverse btn-custom' onClick='get_modal_syncro_content(".$row['idsito'].");' data-toggle='modal' data-target='#syncro".$row['idsito']."' data-provenienza='quoto' data-idsito='".$row['idsito']."' data-web='".$row['web']."' title='Crea report Quoto'><img src='".BASE_URL_ADMIN."report/images/q.png' style='height:16px;widht:auto'></a>";
    
    $action = $ButtonQto;
 

    $modaleSyncro = "<div class='modal fade' id='syncro".$row['idsito']."' tabindex='-1' role='dialog' aria-labelledby='syncro".$row['idsito']."label' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                    <h5 class='modal-title' id='exampleModalLabel'>Sincronizza i dati per </h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>
                                        <div class='modal-body'>
                                            <div id='requiredD".$row['idsito']."'></div>
                                            <div id='requiredA".$row['idsito']."'></div>
                                            <div id='Legenda".$row['idsito']."'></div>
                                            <form name='formsyncro' id='formsyncro".$row['idsito']."' method='POST' action=''>
                                                <input type='hidden' name='idsito'>     
                                                <input type='hidden' name='provenienza' id='provenienza".$row['idsito']."'> 
                                                <input type='hidden' name='web'>  
                                                <div class='alert alert-info icons-alert text-left''>
                                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                        <i class='icofont icofont-close-line-circled'></i>
                                                    </button>
                                                    <p>
                                                        Imposta una data per il report!<br>
                                                        Questo campo può essere utile nel caso in cui si voglia fare un report per un canale <br> 
                                                        che NON era stato compilato in precedenza!
                                                    </p>
                                                </div>  
                                                <div class='row'>
                                                    <div class='col-md-5 text-left'>
                                                        <label class='col-form-label'><b>Data Report</b></label>
                                                    </div>
                                                    <div class='col-md-5 text-left'>
        
                                                    </div>
                                                </div>    
                                                <div class='row'>
                                                    <div class='col-md-5'>
                                                        <input type='date' name='data_report' id='data_report".$row['idsito']."' value='".date('Y-m-d')."' class='form-control no_border_top_dx font20Bold'>
                                                    </div>
                                                    <div class='col-md-5'>
                                                        <div  id='nascondi_pul".$row['idsito']."'>
                                                            <button id='ieri".$row['idsito']."' class='btn btn-default btn-outline-inverse btn-sm'>Ieri</button>
                                                            <button id='settimana".$row['idsito']."' class='btn btn-default btn-outline-inverse btn-sm'>Ultimi 7 giorni</button>
                                                            <button id='mese".$row['idsito']."' class='btn btn-default btn-outline-inverse btn-sm'>Ultimi 30 giorni</button>
                                                            <button id='anno".$row['idsito']."' class='btn btn-default btn-outline-inverse btn-sm'>Questo anno</button>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div  id='nascondi_date".$row['idsito']."'>                                  
                                                    <div class='row'>
                                                        <div class='col-md-5 text-left'><label class='col-form-label'><b>Data Start</b></label></div>
                                                        <div class='col-md-5 text-left'><label class='col-form-label'><b>Data End</b></label></div>
                                                    </div>    
                                                    <div class='row'>
                                                        <div class='col-md-5'>
                                                            <input type='date' name='datastart' id='datastart".$row['idsito']."' class='form-control no_border_top_dx font20Bold'>
                                                        </div>
                                                        <div class='col-md-5'>
                                                            <input type='date' name='dataend' id='dataend".$row['idsito']."' class='form-control no_border_top_dx font20Bold'>
                                                        </div>
                                                    </div> 
                                                </div>                                         
                                                <div class='clearfix m-t-5'></div>
                                                <div class='row'>
                                                    <div class='col-md-11 text-right'> <button type='button' class='btn btn-primary  m-r-10' id='pul_syncro".$row['idsito']."'><i class='fa fa-refresh'></i> Lancia Syncro</button></div>
                                                </div>  
                                            </form>   
                                            <script>
                                            $(document).ready(function(){
                                               
                                                document.getElementById('datastart".$row['idsito']."').required = true;
                                                document.getElementById('dataend".$row['idsito']."').required = true;

                                                var url = '';

                                                $('#pul_syncro".$row['idsito']."').on('click',function(){

                                                    var provenienza = $('#provenienza".$row['idsito']."').val();

                                                    if(provenienza != 'facebook'){
                                                        if($('#datastart".$row['idsito']."').val() == ''){
                                                            $('#requiredD".$row['idsito']."').html(\"<div class='alert alert-danger'><p>Attenzione: Il campo Data Start deve essere compilato!</p></div>\");
                                                            setTimeout(function(){ $('#requiredD".$row['idsito']."').hide('slow'); }, 1000);
                                                            return false;
                                                        }
                                                        if($('#dataend".$row['idsito']."').val() == ''){
                                                            $('#requiredA".$row['idsito']."').html(\"<div class='alert alert-danger'><p>Attenzione: Il campo Data End deve essere compilato!</p></div>\");
                                                            setTimeout(function(){ $('#requiredA".$row['idsito']."').hide('slow'); }, 1000);
                                                            return false;
                                                        }
                                                    }
                                                    $('#loading".$row['idsito']."').html('<div class=\'preloader3\' style=\'height:50px!important;\'><div class=\'circ1\'></div><div class=\'circ2 bg-info\'></div><div class=\'circ3 bg-danger\'></div><div class=\'circ4 bg-warning\'></div><div class=\'circ1\'></div><div class=\'circ2 bg-info\'></div><div class=\'circ3 bg-danger\'></div><div class=\'circ4 bg-warning\'></div></div><span class=\'text-primary\'>Attendere gli step delle chiamate API per il caricamento dei dati...!</span>');
                                                   
                                                   
                                                    if(provenienza == 'quoto'){
                                                        url = 'report/quoto/';
                                                    }

                                                    $('#formsyncro".$row['idsito']."').attr('action', '".BASE_URL_ADMIN."'+ url);
                                                    
                                                    $('#formsyncro".$row['idsito']."').submit();
                                             
                                                });

                                                $('#ieri".$row['idsito']."').on('click',function(){
                                                    $('#datastart".$row['idsito']."').val('".$ieri."');
                                                    $('#dataend".$row['idsito']."').val('".$ieri."');
                                                    return false;
                                                });
                                                $('#settimana".$row['idsito']."').on('click',function(){
                                                    $('#datastart".$row['idsito']."').val('".$settimana."');
                                                    $('#dataend".$row['idsito']."').val('".$ieri."');
                                                    return false;
                                                });
                                                $('#mese".$row['idsito']."').on('click',function(){
                                                    $('#datastart".$row['idsito']."').val('".$mese."');
                                                    $('#dataend".$row['idsito']."').val('".$ieri."');
                                                    return false;
                                                });
                                                $('#anno".$row['idsito']."').on('click',function(){
                                                    $('#datastart".$row['idsito']."').val('".date('Y')."-01-01');
                                                    $('#dataend".$row['idsito']."').val('".$ieri."');
                                                    return false;
                                                });

                                            }); 
                                        </script>  
                                        <div id='loading".$row['idsito']."'></div>                  
                                    </div>
                                </div>
                            </div>
                        </div>";


    $data[] = array(													
                    "idsito"         => '<label class="badge badge-success">'.$row['idsito'].'</label>',
                    "web"            => '<div class="text-left">'.$row['web'].'</div>',
                    "quoto"          => '<div class="text-center nowrap">'.(($row['hospitality']==1 && $row['data_end_hospitality'] >= date('Y-m-d'))?'<span class="text-green">attivo</span>':'<span class="text-red">disdetto oppure scaduto <span class="f-11">[ '.$fun->gira_data($row['data_end_hospitality']).']</span></span>').'</div>',
                    "action"         => '<div class="text-center nowrap">'.$action.''.$modaleSyncro.'</div>'
                    );


}

$json_data = array(
    "draw"            => 1,
    "recordsTotal"    => sizeof($array_dati),
    "recordsFiltered" => sizeof($array_dati),
    "data" 			  => $data
    ); 



if(empty($json_data) || is_null($json_data)){
    $json_data = NULL;
}else{
    $json_data = json_encode($json_data);
} 

echo $json_data; 

?>
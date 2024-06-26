<?php
    //inserimento ACAMERA in tipologia listino per tutte le camere
    $select = "SELECT * FROM hospitality_tipo_listino WHERE idsito = ".IDSITO;
    $res    = $dbMysqli->query($select);
    $rw     = $res[0];
    $tot    = sizeof($res);

    if($tot == 0){
        $insert = "INSERT INTO hospitality_tipo_listino(idsito,TipoListino) VALUES('".IDSITO."','0')";
        $ins    = $dbMysqli->query($insert);
        $id     = $dbMysqli->getInsertId($ins);
    }else{
        $id = $rw['Id'];
    } 


    $content .= '<div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="res"></div>
                        <div class="row m-t-10">
                            <div class="col-md-3 nowrap text-left">
                                <label class="f-w-600">Tipologia Prezzi  <i class="fa fa-exclamation-circle text-black" data-toggle="tooltip" title="ATTENZIONE se impostate il listino a Persona, il prezzo inserito verrà moltiplicato solo per il numero di adulti"></i></label>
                            </div>
                            <div class="col-md-6 text-left">
                                <select name="TipoListino" id="TipoListino" class="form-control">
                                    <option value="0" '.($rw['TipoListino']==0?'selected="selected"':'').'>a camera</option>
                                    <option value="1" '.($rw['TipoListino']==1?'selected="selected"':'').'>a persona</option>
                                </select>
                            </div>
                            <div class="col-md-1 text-left">
                                <button type="button" class="btn btn-primary btn-sm" id="salva">Salva</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                <div class="col-md-2"></div>
                </div>      
                <script>
                    $(document).ready(function(){

                        // UPDATE
                        $("#salva").on("click",function(){
                            var TipoListino = $(\'#TipoListino option:selected\').val(); 
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiorna_tipologia_listino.php",
                                    type: "POST",
                                    data: "idsito='.IDSITO.'&TipoListino="+TipoListino+"",
                                    success: function(msg){  
                                        $("#res").html(\'<div class="clearfix p-b-30"></div><div class="alert alert-info text-center"><p>Dati salvati con successo!</p></div>\');
                                        setTimeout(function(){ 
                                            $("#res").hide(); 
                                        }, 2000);
                                    },
                                    error: function(){
                                        alert("Chiamata fallita, si prega di riprovare...");
                                    }
                                });
                                return false; // con false senza refresh della pagina
                        });
                    });
                </script> 
                <div class="clearfix p-b-30"></div>'."\r\n";


    $legenda = '<div id="LEGEND" class="alert alert-info text-black">              
                    <ul>
                        <li><b>LEGENDA:</b></li>
                        <li>l\'impostazione della tipologia dei prezzi, ha <b>valore per tutti i listini</b> creati</li>
                        <li>se impostate il listino <b>a Persona</b>, il calcolo del prezzo verrà moltiplicato <b>SOLO per il numero di adulti</b> ed il numero di notti.</li>
                        <li>se impostate il listino <b>a Camera</b>, il calcolo del prezzo verrà moltiplicato per il numero di camere ed il numero di notti.</li>
                    </ul>
                    <div class="clearfix p-b-10"></div>
                    <p><b>PRESTARE ATTENZIONE:</b> il listino di QUOTO può essere usato solo se non ci sono moduli di sincronizzazioni con booking engine o channel manager, abilitati!</p>
                    <p>Inserire la camera, il trattamento, il periodo ed il prezzo!</p>
                    <p>L\'nserimento dei prezzi di listino può anche essere gestito dettagliatamente per ogni tipologia di camera  <span>&#10230;</span> alla voce di menù <a href="'.BASE_URL_SITO.'disponibilita-camere/"><b>Camere</b></a></p>

                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#LEGEND").insertBefore("#tipo_listino");
                    })
                </script>'."\r\n";

$content .=' <div class="modal fade" id="ModaleListini" tabindex="-1" role="dialog" aria-labelledby="ModaleLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi Listino</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                <form method="POST" id="form_add_listini" name="form_add_listini">
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Listino</label>
                                            </div>
                                            <div class="col-md-9">                                            	                                                     
                                                <div class="input-group input-group-primary">
                                                    <span class="input-group-addon"><i class="fa fa-euro fa-fw"></i></span>
                                                    <input type="text" class="form-control" id="Listino" name="Listino"  required/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Abilitato</label>
                                            </div>
                                            <div class="col-md-1">                                            	                                                     
                                                <input type="checkbox" class="form-control" id="Abilitato" name="Abilitato" value="1" checked="checked"/>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">  
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                            </div>
                                        </div>
                                    </div>                                 
                                </form> 
                                </div> 
                                <div class="col-md-2"></div>
                                </div>                      
                                <script>
                                    $(document).ready(function() {

                                        $("#Abilitato").click(function() {
                                            if($("#Abilitato").is(":checked")){
                                                $("#Abilitato").attr("value","1");
                                            }else{
                                                $("#Abilitato").attr("value",false);
                                                $("#Abilitato").attr("checked",false);
                                            }
                                        });

                                        $("#form_add_listini").submit(function () {   
                                            var  Listino  = $("#Listino").val(); 
                                            var  Abilitato = $("#Abilitato").val(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/disponibilita/aggiungi_listino.php",
                                                type: "POST",
                                                data: "action=add_listino&idsito='.IDSITO.'&Listino="+Listino+"&Abilitato="+Abilitato+"",
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleListini").modal("hide");
                                                    $("#listini").DataTable().ajax.reload();    
                                                }
                                            });
                                            return false; // con false senza refresh della pagina                                       
                                        });
                                    });
                                </script>
                        </div>
                    </div>
                </div>           
            </div>'."\r\n";

   # INTERFACCIA CRUD DATATABLE
$content .='   <!-- Table datatable-->
<table id="listini" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
     <thead>
         <tr>';

$content .='          
             <th>Tipologia Listino</th>
             <th>Abilitato</th>
             <th style="width:4%"></th>
         </tr>
     </thead>

 </table> '."\r\n";
$content .='<style>
 #azioniPrev .dropdown-toggle::after {
     display: none !important;
 }
 .buttons-collection{
    display: none !important;
}
 #listini_filter {
    display: none !important;
}
</style>'."\r\n";
# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {'."\r\n";


$content .=' 
 //INIZIALIZZO I TOOLTIP
 $(\'[data-tooltip="tooltip"]\').tooltip();

 // CONFIG DATATABLE
 var table = $("#listini").DataTable( {
    order: [[1, \'asc\']],                                     
     responsive: true,
     processing:true,
     oLanguage: {sProcessing: " <div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
     "paging": false,
         "pagingType": "simple_numbers",    
         "language": {
              "search": "Filtro rapido:",
              "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
              "emptyTable": " ",
              "paginate": {
                  "previous": "Precedente",
                  "next":"Successivo",
              },
              buttons: {
                 pageLength: {                                
                     _: "Mostra %d record",
                     \'-1\': "Mostra tutto"
                 }
             }
         },
         dom: \'Bfrtip\',
         lengthMenu: [
             [ 10, 20, -1 ],
             [  \'10 record\', \'20 record\', \'Tutti\' ]
         ],	
         buttons: [
         {
             text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi Listino\',
             className: \'buttonSelezioni\',
             attr: {id: \'aggiungi\'},
             action: function () {
                 $("#ModaleListini").modal("show");
             }
         },
     \'pageLength\',                    


     ],			
     "ajax": "'.BASE_URL_SITO.'crud/disponibilita/listini.crud.php?idsito='.IDSITO.'",
     "deferRender": true,
     "columns": ['."\r\n";

$content .='    { "data": "tipo"},  
                { "data": "abilitato","class":"text-center"},        
                { "data": "action","class":"text-center"}
     ],';
$content .='    "columnDefs": [
               {"targets": [0,1,2], "orderable": false} 

         ]
     })


     // ORDINAMENTO TABELLA

     $("#listini_processing").removeClass("card");'."\r\n";


$content .='})
</script>';
?>
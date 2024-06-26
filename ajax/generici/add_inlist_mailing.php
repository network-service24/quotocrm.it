<?php
include($_SERVER['DOCUMENT_ROOT']."/include/settings.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/include/declaration.inc.php");

    $id_rich = substr($_REQUEST['checkbox'],0,-1);
    $qry  = "SELECT hospitality_guest.Nome,hospitality_guest.Cognome ,hospitality_guest.NumeroPrenotazione FROM hospitality_guest 
                    WHERE hospitality_guest.idsito = ".$_REQUEST['idsito']." 
                    AND hospitality_guest.Id IN (".$id_rich.")";
    $ris_qry = $dbMysqli->query($qry);
    $iscritti = array();
    foreach($ris_qry as $key => $val){	
        $iscritti[] = '[Nr.'.$val['NumeroPrenotazione'].'] '.$val['Nome'].' '.$val['Cognome'];
    }

    $query_generale  = "SELECT * FROM mailing_newsletter_nome_liste	WHERE idsito = ".$_REQUEST['idsito']." ORDER BY nome_lista DESC";  
    $risultato       = $dbMysqli->query($query_generale);
    $tot             = sizeof($risultato);
    if($tot > 0){  
        foreach($risultato as $ky => $row){
            $lista .= '&nbsp;<input type="radio" name="id_lista" value="'.$row['id'].'" required > '.$row['nome_lista'].'<div class="clearfix"></div>';
        }
    }

    echo'<script type="text/javascript">
            $(function() {
                $("#add_inlist").modal("show");                                                
            });
        </script> 
        <!-- modale per invio email di upselling -->
        <div class="modal fade" id="add_inlist"  role="dialog" aria-labelledby="myadd_inlist">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myemail_upselling">Inserisci selezionati in una lista</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                    <div class="modal-body">
                    <div id="risultato_add_list"></div>
                    <div id="risultato_emessenger"></div>
                        <div class="alert alert-profila alert-default-profila alert-dismissable">      
                            <p>Scegli se inserire i nominativi selezionati in una lista già presente, oppure creane una nuova!</p>
                            <p>Attenzione: i nominativi già presenti oppure selezionati più volte, vengon inseriti come iscritti ad '.NOME_CLIENT_EMAIL.', una sola volta!</p>
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>
                        <div class="form-group">
                        <label data-toogle="tooltip" title="Lista nominativi selezionati"><i class="fa fa-fw fa-users"></i> Lista nominativi selezionati</label>
                        <textarea id="xx" name="xx" rows="'.(count($iscritti)>5?'4':'1').'" cols="50" class="form-control no_border_top_dx bold" readonly="readonly">'.implode(',',$iscritti).'</textarea>
                        </div>
                        <form id="form_list" name="form_list" method="post" action="'.BASE_URL_SITO.'add_all_mailing/">
                        <h2>ELENCO LISTE</h2>
                        <div class="form-group">                        
                            '.$lista.'
                        </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-center"></div>
                                        <div class="col-md-4 text-center">
                                        <input type="hidden" name="checkbox" value="'.$id_rich.'">
                                        <input type="hidden" name="action" value="add_all_inlist">
                                        <input name="idsito" type="hidden" value="'.$_REQUEST['idsito'].'" />
                                        <button type="submit"  class="btn btn-primary">Aggiungi i nominativi selezionati ad una lista</button></div>
                                    </div>
                                </div>
                            </form>                                
                        <form id="form_new_list" name="form_new_list" method="post"  action="'.BASE_URL_SITO.'add_all_mailing/">
                        <h2>CREA NUOVA LISTA</h2>
                        <div class="form-group">
                            <label>Nome Lista</label>
                            <input name="nome_lista" type="text" class="form-control" id="nome_lista" required/>
                        </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-center"></div>
                                        <div class="col-md-4 text-center">
                                        <input type="hidden" name="checkbox" value="'.$id_rich.'">
                                        <input type="hidden" name="action" value="add_all_inlist">
                                        <input type="hidden" name="new_list" value="1">
                                        <input name="idsito" type="hidden" value="'.$_REQUEST['idsito'].'" />
                                        <button type="submit"  class="btn btn-primary">Aggiungi i nominativi ad una nuova lista</button></div>
                                    </div>
                                </div>
                            </form>                                                                                                           
                        </div>
                    </div>
                </div>
            </div>
        </div>';

?>
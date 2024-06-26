<?php
$record = $fun->get_Schedina($_REQUEST['azione'],IDSITO);

$stati = $fun->getListaStati();
$lista_stati ='<option value="" '.($record['nome_stato']==''?'selected="selected"':'').'>--</option>';
foreach($stati as $key => $value){
    $lista_stati .='<option value="'.$value['nome_stato'].'" '.($record['Cittadinanza']==$value['nome_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
}
$lista_statiNascita ='<option value="" '.($record['StatoNascita']==''?'selected="selected"':'').'>--</option>';
foreach($stati as $key => $value){
    $lista_statiNascita .='<option value="'.$value['nome_stato'].'" '.($record['StatoNascita']==$value['nome_stato']?'selected="selected"':'').'>'.$value['nome_stato'].'</option>';
}

$province = $fun->getListaProvince();
$lista_province ='<option value="" '.($record['sigla_provincia']==''?'selected="selected"':'').'>--</option>';
foreach($province as $key => $value){
    $lista_province .='<option value="'.$value['sigla_provincia'].'" '.($record['Provincia']==$value['sigla_provincia']?'selected="selected"':'').'>'.$value['sigla_provincia'].'</option>';
}
$lista_provinceNascita ='<option value="" '.($record['sigla_provincia']==''?'selected="selected"':'').'>--</option>';
foreach($province as $key => $value){
    $lista_provinceNascita .='<option value="'.$value['sigla_provincia'].'" '.($record['ProvinciaNascita']==$value['sigla_provincia']?'selected="selected"':'').'>'.$value['sigla_provincia'].'</option>';
}

$comuni = $fun->getListaComuni();
$lista_comuni ='<option value="" '.($record['nome_comune']==''?'selected="selected"':'').'>--</option>';
foreach($comuni as $key => $value){
    $lista_comuni .='<option value="'.$value['nome_comune'].'" '.($record['Citta']==$value['nome_comune']?'selected="selected"':'').'>'.$value['nome_comune'].'</option>';
}
##AGGIORNA DATI DEL PRIMO COMPONENTE 
$content .='<div class="clearfix p-b-30"></div>
                <a class="btn btn-primary btn-sm" href="'.BASE_URL_SITO.'checkinonline-schedine_alloggiati/"><i class="fa fa-arrow-left" aria-hidden="true"></i> torna alla schedine</a>
            <div class="clearfix p-b-30"></div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form name="mod_schedina" id="mod_schedina" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Nr.Preno</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Prenotazione'].'" name="Prenotazione"  readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Componente</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['TipoComponente'].'" name="TipoComponente"  readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Documento</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['TipoDocumento'].'" name="TipoDocumento"  readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">File Documento</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    '.($record['Documento']!=''?'<a href="'.BASE_URL_LANDING.'checkin/uploads/'.$record['Documento'].'" target="_blank"><i class="fa fa-file-o" aria-hidden="true"></i></a>':'<span class="f-11 text-gray">Nessun file è stato caricato!</span>').'
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Nr.Documento</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <input class="form-control" type="text"  value="'.$record['NumeroDocumento'].'" name="NumeroDocumento" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Comune Emissione</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <input class="form-control" type="text"  value="'.$record['ComuneEmissione'].'" name="ComuneEmissione" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Stato Emissione</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <input class="form-control" type="text"  value="'.$record['StatoEmissione'].'" name="StatoEmissione" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Data Rilascio</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <input class="form-control" type="date"  value="'.$record['DataRilascio'].'" name="DataRilascio" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Data Scadenza</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <input class="form-control" type="date"  value="'.$record['DataScadenza'].'" name="DataScadenza" readonly="readonly" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Nome</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Nome'].'" name="Nome" id="Nome" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Cognome</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Cognome'].'" name="Cognome" id="Cognome" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Sesso</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="Sesso" id="Sesso" >
                                            <option value="Maschio" '.($record['Sesso']=='Maschio'?'selected="selected"':'').'>Maschio</option>
                                            <option value="Femmina" '.($record['Sesso']=='Femmina'?'selected="selected"':'').'>Femmina</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Cittadinanza</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="Cittadinanza" id="Cittadinanza" >
                                        '.$lista_stati.'
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div id="cittadino_italiano">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Provincia</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="Provincia" id="Provincia" >
                                        '.$lista_province.'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Città</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Citta'].'" name="Citta" id="Citta" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="cittadino_estero">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['ProvinciaBis'].'" name="ProvinciaBis" id="ProvinciaBis" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600 nowrap">Città (ESTERO)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['CittaBis'].'" name="CittaBis" id="CittaBis" />
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Indirizzo</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Indirizzo'].'" name="Indirizzo" id="Indirizzo" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Cap</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['Cap'].'" name="Cap" id="Cap" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Data Nascita</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="date"  value="'.$record['DataNascita'].'" name="DataNascita" id="DataNascita"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Stato Nascita</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control" name="StatoNascita" id="StatoNascita" >
                                        '.$lista_statiNascita.'
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div id="nascita_italiano">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600">Luogo Nascita</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['LuogoNascita'].'" name="LuogoNascita" id="LuogoNascita" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="nascita_estero">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['ProvinciaNascitaBis'].'" name="ProvinciaNascitaBis" id="ProvinciaNascitaBis" />
                                </div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600 nowrap">Luogo Nascita (ESTERO)</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input class="form-control" type="text"  value="'.$record['LuogoNascitaBis'].'" name="LuogoNascitaBis" id="LuogoNascitaBis" />
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="f-w-600 nowrap">Note</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                <textarea class="form-control" name="Note" id="Note">'.$record['Note'].'</textarea>
                                </div>
                            </div>
                        </div>               
                        <div class="form-group">  
                            <div class="row">
                                <div class="col-md-3">
                                 
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" name="Id" id="Id" value="'.$record['Id'].'">
                                    <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                    <input type="hidden" name="action"  value="aggiorna_schedina">
                                    <button type="submit" class="btn btn-primary col-md-12">SALVA</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $("#mod_schedina").submit(function () {   
                                var  dati  = $("#mod_schedina").serialize(); 
                                $.ajax({
                                    url: "'.BASE_URL_SITO.'ajax/generici/aggiorna_schedina.php",
                                    type: "POST",
                                    data: dati,
                                    dataType: "html",
                                    success: function(msg) {
                                        $("#result_mod").html(\'<div class="alert alert-info text-black text-center"> Dati salvati con successo!</div>\');
                                        setTimeout(function(){ 
                                            $("#result_mod").hide(); 
                                        }, 2000);
                                    }
                                });
                                return false; // con false senza refresh della pagina                                       
                            });
                        });
                    </script>
                    <div id="result_mod"></div>
                </div>
                <div class="col-md-2"></div>
                </div>
                <div class="clearfix p-b-30"></div>'."\r\n";
## AGGIUNGERE COMPONENTE 
$content .=' <div class="modal fade" id="ModaleScheda" tabindex="-1" role="dialog" aria-labelledby="ModaleTargetLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Aggiungi un componente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-10">
                                    <form name="add_scheda" id="add_scheda" method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Nr.Preno</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  value="'.$record['Prenotazione'].'" name="Prenotazione"  readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Componente</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="TipoComponente">
                                                        <option value="">--</option>
                                                        <option value="Capo Famiglia">Capo Famiglia</option>
                                                        <option value="Familiare">Familiare</option>
                                                        <option value="Capo Gruppo">Capo Gruppo</option>
                                                        <option value="Membro Gruppo">Membro Gruppo</option>
                                                        <option value="Ospite Singolo">Ospite Singolo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Documento</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="TipoDocumento" >
                                                        <option value="--">--</option>
                                                        <option value="Carta di Identità">Carta di Identità</option>
                                                        <option value="Passaporto">Passaporto</option>
                                                        <option value="Patente">Patente</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Nr.Documento</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                <input class="form-control" type="text"  name="NumeroDocumento" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Comune Emissione</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                <input class="form-control" type="text" name="ComuneEmissione" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Stato Emissione</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="StatoEmissione" >
                                                        '.$lista_stati.'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Data Rilascio</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                <input class="form-control" type="date"  name="DataRilascio" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Data Scadenza</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                <input class="form-control" type="date" name="DataScadenza" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Nome</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  name="Nome" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Cognome</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="Cognome" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Sesso</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="Sesso" >
                                                            <option value=""></option>
                                                            <option value="Maschio">Maschio</option>
                                                            <option value="Femmina">Femmina</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Cittadinanza</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="Cittadinanza" id="CittadinanzaM">
                                                        '.$lista_stati.'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="cittadino_italianoM">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Provincia</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="Provincia">
                                                        '.$lista_province.'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Città</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="Citta"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cittadino_esteroM">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  name="ProvinciaBis"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600 nowrap">Città (ESTERO)</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="CittaBis" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Indirizzo</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="Indirizzo"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Cap</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="Cap"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Data Nascita</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="date" name="DataNascita"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Stato Nascita</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <select class="form-control" name="StatoNascita" id="StatoNascitaM">
                                                        '.$lista_statiNascita.'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600">Luogo Nascita</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  name="LuogoNascita"  />
                                                </div>
                                            </div>
                                        </div>
                                    <div id="nascita_esteroM">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600 nowrap">Stato/regione/provincia (ESTERO)</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  name="ProvinciaNascitaBis"  />
                                                </div>
                                            </div>
                                        </div>                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600 nowrap">Luogo Nascita (ESTERO)</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input class="form-control" type="text"  name="LuogoNascitaBis"  />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="f-w-600 nowrap">Note</label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                <textarea class="form-control" name="Note" id="Note"></textarea>
                                                </div>
                                            </div>
                                        </div>               
                                        <div class="form-group">  
                                            <div class="row">
                                                <div class="col-md-12 text-center">   
                                                    <input type="hidden" name="lang"  value="'.$record['lang'].'">     
                                                    <input type="hidden" name="NumeroPersone"  value="'.$record['NumeroPersone'].'">                            
                                                    <input type="hidden" name="idsito"  value="'.IDSITO.'">
                                                    <input type="hidden" name="action"  value="add_schedina">
                                                    <button type="button" class="btn btn-warning col-md-5" data-dismiss="modal" aria-label="Close">CHIUDI</button>
                                                    <button type="submit" class="btn btn-primary col-md-5">SALVA</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <script>
                                    $(document).ready(function() {
                                        $("#add_scheda").submit(function () {   
                                            var  valori = $("#add_scheda").serialize(); 
                                            $.ajax({
                                                url: "'.BASE_URL_SITO.'ajax/generici/aggiungi_schedina.php",
                                                type: "POST",
                                                data: valori,
                                                dataType: "html",
                                                success: function(data) {
                                                    $("#ModaleScheda").modal("hide");
                                                    $("#add_schedine").DataTable().ajax.reload();    
                                                }
                                            });
                                            return false; // con false senza refresh della pagina                                       
                                        });
                                    });
                                </script>
                                </div> 
                                <div class="col-md-1"></div>
                            </div>                      
                        </div>
                    </div>
                </div>           
            </div>'."\r\n";
$content .='<style>
                #azioniPrev .dropdown-toggle::after {
                    display: none !important;
                }
                #add_schedine_filter{
                    display: none !important;
                }
                .buttons-collection{
                    display: none !important;
                }
                #add_schedine_info{
                    display: none !important;
                }
            </style>'."\r\n";
# INTERFACCIA CRUD DATATABLE
$content .=' <table id="add_schedine" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                    <thead>
                        <tr>';

$content .='                <th>Nr.Preno</th>
                            <th>Lang</th>
                            <th>Documento</th>
                            <th>Componente</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Cittadinanza</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>

                </table> '."\r\n";

# CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
$content .='<script>

            $(document).ready(function() {'."\r\n";

$content .=' 
                $("#cittadino_estero").hide();
                $("#cittadino_italiano").show();
                $("#Cittadinanza").on("change", function(){
                    var Cittadinanza = $("#Cittadinanza option:selected").val();
                    if(Cittadinanza == "Italia"){
                        $("#cittadino_estero").hide();
                        $("#cittadino_italiano").show();
                    }else{
                        $("#cittadino_estero").show();
                        $("#cittadino_italiano").hide();
                    }
                }); 

                $("#nascita_estero").hide();
                $("#nascita_italiano").show();
                $("#StatoNascita").on("change", function(){
                    var StatoNascita = $("#StatoNascita option:selected").val();
                    if(StatoNascita == "Italia"){
                        $("#nascita_estero").hide();
                        $("#nascita_italiano").show();
                    }else{
                        $("#nascita_estero").show();
                        $("#nascita_italiano").hide();
                    }
                }); 

                $("#cittadino_esteroM").hide();
                $("#cittadino_italianoM").show();
                $("#CittadinanzaM").on("change", function(){
                    var CittadinanzaM = $("#CittadinanzaM option:selected").val();
                    if(CittadinanzaM == "Italia"){
                        $("#cittadino_esteroM").hide();
                        $("#cittadino_italianoM").show();
                    }else{
                        $("#cittadino_esteroM").show();
                        $("#cittadino_italianoM").hide();
                    }
                }); 

                $("#nascita_esteroM").hide();
                $("#nascita_italianoM").show();
                $("#StatoNascitaM").on("change", function(){
                    var StatoNascitaM = $("#StatoNascitaM option:selected").val();
                    if(StatoNascitaM == "Italia"){
                        $("#nascita_esteroM").hide();
                        $("#nascita_italianoM").show();
                    }else{
                        $("#nascita_esteroM").show();
                        $("#nascita_italianoM").hide();
                    }
                }); 

                //INIZIALIZZO I TOOLTIP
                $(\'[data-tooltip="tooltip"]\').tooltip();


                // CONFIG DATATABLE
                var table = $("#add_schedine").DataTable( {
                    order: [[0, \'DESC\']], 
                    responsive: true,
                    processing:true,
                    oLanguage: {sProcessing: "<div class=\'cell preloader5 loader-block\'><div class=\'circle-5 l loader-warning\'></div><div class=\'circle-5 m loader-warning\'></div><div class=\'circle-5 r loader-warning\'></div></div><span class=\'text-primary f-w-400 f-14 f-s-intial\'>QUOTO! sta caricando i dati...<br><span class=\'\'>Attendere!!</span></span>"},
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
							[ 30, 40, 60, 100, -1 ],
							[ \'30 record\', \'40 record\', \'60 record\', \'100 record\', \'Tutti\' ]
                        ],	
                        buttons: [
                            {
                                text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi componente\',
                                className: \'buttonSelezioni\',
                                attr: {id: \'aggiungi\'},
                                action: function () {
                                    $("#ModaleScheda").modal("show");
                                }
                            },
                    \'pageLength\',                    

                    ],			
                    "ajax": "'.BASE_URL_SITO.'crud/proposte/add_schedine.crud.php?idsito='.IDSITO.'&prenotazione='.$_REQUEST['param'].'",
                    "deferRender": true,
                    "columns": ['."\r\n";

        $content .='    { "data": "nr","class":"text-center"},
                        { "data": "lg","class":"text-center"}, 
                        { "data": "documento","class":"text-center"},         
                        { "data": "componente"},
                        { "data": "nome"}, 
                        { "data": "cognome"}, 
                        { "data": "cittadinanza","class":"text-center"},
                        { "data": "action","class":"text-center"}
                    ],';
        $content .='    "columnDefs": [
                            {"targets": [1,2,3,4,5,6,7], "orderable": false}

                        ]
                    })

                    $("#schedine_processing").removeClass("card"); '."\r\n";



$content .='})
        </script>';     
    

?>

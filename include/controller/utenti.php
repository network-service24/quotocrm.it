<?php

if (!$_REQUEST['azione']) {

  
    # INTERFACCIA CRUD DATATABLE
    $content .='   <!-- Table datatable-->
                   <table id="utenti" class="display compact dataTable table table-striped table-hover table-bordered table-sm f-13"  style="width:100%">
                        <thead>
                            <tr>';
    
    $content .='          
                                <th>Tipo Accesso</th>
                                <th>Nome</th>
                                <th>Sesso</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Abilitato</th>
                                <th></th>
                            </tr>
                        </thead>
    
                    </table> '."\r\n";
    $content .='<style>
                    #azioniPrev .dropdown-toggle::after {
                        display: none !important;
    
                    }
                    .dataTables_filter {
                        display: none;
                    }
                </style>'."\r\n";
    # CODICE JS PER ESECUZIONE INSERT,UPDATE;DELETE E DATATABLE
    $content .='<script>
    
                var editor; // use a global for the submit and return data rendering in the examples
    
                $(document).ready(function() {'."\r\n";
    
    
    $content .=' 
    
                    $("#Abilitato").click(function() {
                        if($("#Abilitato").is(":checked")){
                            $("#Abilitato").attr("value","1");
                        }else{
                            $("#Abilitato").attr("value",false);
                            $("#Abilitato").attr("checked",false);
                        }
                    });
    
                    //INIZIALIZZO I TOOLTIP
                    $(\'[data-tooltip="tooltip"]\').tooltip();
    
                    // CONFIG DATATABLE
                    var table = $("#utenti").DataTable( {
                                                                   
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
                                '."\r\n";

            $content .='     {
                                text:      \'<i class="fa fa-plus fa-2x fa-fw"></i> Aggiungi\',
                                className: \'buttonSelezioni\',
                                attr: {id: \'aggiungi\'},
                                action: function () {
                                    document.location=\''.BASE_URL_SITO.'accessi-utenti/add/\';
                                }
                            },'."\r\n";

            $content .='
                        \'pageLength\',                    
    
    
                        ],			
                        "ajax": "'.BASE_URL_SITO.'crud/setting/utenti.crud.php?idsito='.IDSITO.'",
                        "deferRender": true,
                        "columns": ['."\r\n";
    
            $content .='     
                            { "data": "tipo"}, 
                            { "data": "nome"},        
                            { "data": "sesso" ,"class":"text-center"},
                            { "data": "user"},
                            { "data": "pass"},
                            { "data": "abilitato","class":"text-center"},
                            { "data": "action","class":"text-center"}
                        ],';
            $content .='    "columnDefs": [
                                  {"targets": [0,1,2,3,4,5,6], "orderable": false} 
    
                            ]
                        })
        
    
                        // ORDINAMENTO TABELLA
                        table.order( [ 0, \'DESC\' ] ).draw();
                        $("#utenti_processing").removeClass("card"); 
    
                        $(".buttons-page-length").before("<i class=\"fa fa-eye fa-2x fa-fw\"></i>");
                        $(".buttonExport").before("<i class=\"fa fa-file-excel-o fa-2x fa-fw\"></i>");'."\r\n";
    
    
    $content .='})
            </script>';
    

}

if($_REQUEST['azione']=='add'){

    if ($_REQUEST['action'] == 'aggiungi') {


        $idsito            = $_REQUEST['idsito'];
        $nome              = addslashes($_REQUEST['nome']);
        $Sesso             = addslashes($_REQUEST['Sesso']);
        $username          = addslashes($_REQUEST['username']);
        $password          = base64_encode($_REQUEST['password']);
        $unique_display    = $_REQUEST['unique_display'];
        $config1           = $_REQUEST['config1'];
        $config2           = $_REQUEST['config2'];
        $config3           = $_REQUEST['config3'];
        $config4           = $_REQUEST['config4'];
        $config5           = $_REQUEST['config5'];
        $config6           = $_REQUEST['config6'];
        $dashboard_box     = $_REQUEST['dashboard_box'];
        $statistiche       = $_REQUEST['statistiche'];
        $crea_proposta     = $_REQUEST['crea_proposta'];
        $preventivi        = $_REQUEST['preventivi'];
        $conferme          = $_REQUEST['conferme'];
        $prenotazioni      = $_REQUEST['prenotazioni'];
        $profila           = $_REQUEST['profila'];
        $giudizi           = $_REQUEST['giudizi'];
        $archivio          = $_REQUEST['archivio'];
        $schedine          = $_REQUEST['schedine'];
        $content_email     = $_REQUEST['content_email'];
        $content_landing   = $_REQUEST['content_landing'];
        $anteprima_email   = $_REQUEST['anteprima_email'];
        $anteprima_landing = $_REQUEST['anteprima_landing'];
        $screenshots       = $_REQUEST['screenshots'];
        $comunicazioni     = $_REQUEST['comunicazioni'];
        $data_account      = date('Y-m-d');
        $abilitato         = $_REQUEST['abilitato'];

        $sel   = "SELECT * FROM utenti_quoto WHERE username = '".$username."'";
        $r     = $dbMysqli->query($sel);
        $check_user = sizeof($r);

        $sel2   = "SELECT * FROM utenti_quoto WHERE password = '".$password."'";
        $r2     = $dbMysqli->query($sel2);
        $check_pass = sizeof($r2);

        if($check_user>0 || $check_pass>0){

            $message = 'La '.($check_user>0?'UserName':'').' '.($check_pass>0?'PassWord':'').' inserita è già in uso!';
            $location = BASE_URL_SITO.'accessi-utenti/';

            print"<script language=\"javascript\">alert(\"$message\");document.location=\"$location\"</script>";
            exit;

        }else{

            $insert = "INSERT INTO utenti_quoto (idsito,
                                                nome,
                                                Sesso,
                                                username,
                                                password,
                                                unique_display,
                                                config1,
                                                config2,
                                                config3,
                                                config4,
                                                config5,
                                                config6,
                                                dashboard_box,
                                                statistiche,
                                                crea_proposta,
                                                preventivi,
                                                conferme,
                                                prenotazioni,
                                                profila,
                                                giudizi,
                                                archivio,
                                                schedine,
                                                content_email,
                                                content_landing,
                                                anteprima_email,
                                                anteprima_landing,
                                                screenshots,
                                                comunicazioni,
                                                data_account
                                                )
                                        VALUES('" .$idsito . "',
                                            '" .   $nome . "',
                                            '" .   $Sesso . "',
                                            '" .   $username . "',
                                            '" .   $password . "',
                                            '" .   $unique_display . "',
                                            '" .   $config1 . "',
                                            '" .   $config2   . "',
                                            '" .   $config3  . "',
                                            '" .   $config4 . "',
                                            '" .   $config5 . "',
                                            '" .   $config6 . "',
                                            '" .   $dashboard_box . "',
                                            '" .   $statistiche . "',
                                            '" .   $crea_proposta . "',
                                            '" .   $preventivi . "',
                                            '" .   $conferme  . "',
                                            '" .   $prenotazioni . "',
                                            '" .   $profila . "',
                                            '" .   $giudizi. "',
                                            '" .   $archivio  . "',
                                            '" .   $schedine. "',
                                            '" .   $content_email. "',
                                            '" .   $content_landing. "',
                                            '" .   $anteprima_email  . "',
                                            '" .   $anteprima_landing  . "',
                                            '" .   $screenshots  . "',
                                            '" .   $comunicazioni  . "',
                                            '" .   $data_account . "'
                                            )";
            $dbMysqli->query($insert);

            ##LOGS OPERAZIONI
            $log->lwrite('('.$_GET['template'].') idsito = '.$idsito.', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', configurati permessi per = '.$nome);
            $log->lclose(); 

            header('location:' . BASE_URL_SITO . 'accessi-utenti/');

        }
    }

    $selec           = "SELECT * FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND Abilitato = 1 ORDER BY NomeOperatore ASC";
    $array_operatori = $dbMysqli->query($selec);
    $lista_operatori .= '<option value="">--</option>';
    foreach ($array_operatori as $key => $value) {
        $lista_operatori .= '<option value="'.$value['NomeOperatore'].'">'.$value['NomeOperatore'].'</option>';
    }

            $html .= '
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <form id="mod_permessi" name="mod_permessi" method="post" action="' . $_SERVER['REQUEST_URI'] . '" >
                                                <table class="table">
                                                    <tr>
                                                        <td colspan="2" style="border-top: none;">
                                                            <button type="submit" class="btn btn-success btn-sm">Salva & Ritorna</button>
                                                            <a href="'.BASE_URL_SITO.'accessi-utenti/" class="btn btn-warning btn-sm">Ritorna</a>
                                                            <input type="hidden" name="action" value="aggiungi" />
                                                            <input type="hidden" name="idsito" value="' . IDSITO . '" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Nome</b></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <select name="nome" class="form-control" required>
                                                                '.$lista_operatori.'
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Sesso</b> <small>(icona utente)</small></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <select name="Sesso" class="form-control" required>
                                                                <option value="" selected="selected">--</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Username</b></td>
                                                        <td style="border-top: none;" width="75%"><input type="text" class="form-control" name="username" value="" required/></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Password</b></td>
                                                        <td style="border-top: none;" width="75%"><input type="text" class="form-control" name="password" value="'.PasswordCasuale().'" minlength="4" maxlength="8"  required/></td>
                                                    </tr>';
            if(CHECKINONLINE == 0){                
                $html .= '                   <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><h2>Permessi</h2></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <table class="table">
                                                                <tr>
                                                                    <td style = "border-top: none;" class = "text-center" colspan = "4"><h2>Filtra per Operatore <small><small>(il filtro sarà attivo su: preventivi, conferme, prenotazioni ed archivio)</small></small></h2>Saranno visibili solo le richieste dell\'utente in questione!</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita filtro per <b>Operatore</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="unique_display" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Configurazioni</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Uso quotidiano di QUOTO</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>1° Config.Impostazioni</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config1" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Crea Proposta Soggiorno</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="crea_proposta" value="1"  /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>2° Config.Disponibilità</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config2" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Preventivi</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="preventivi" value="1"  /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>3° Config.Generiche</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config3" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Conferme in trattativa</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="conferme" value="1"  /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>4° Config.Questionario</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config4" value="1"  /></td>

                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Prenotazioni Chiuse</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="prenotazioni" value="1"  /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>5° Config.Autoresponder</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config5" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>6° Contenuti & Template</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config6" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Dashboard e Statistiche</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Uso quotidiano di QUOTO</></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita i <b>BOX statistici della Dashboard</b><br><small>compreso il grafico del fatturato</small></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="dashboard_box" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Profila ed Esporta</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="profila" value="1"  /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Statistiche Fatturato</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="statistiche" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Giudizi Finali</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="giudizi" value="1"  /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="2"></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Archivio</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="archivio" value="1"  /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="2"></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>P.S. Schedine Alloggiati</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="schedine" value="1"  /></td>
                                                               </tr>
                                                                <!-- <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Content & Preview</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Content & Preview</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Content E-mail</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="content_email" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Anteprima E-mail</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="anteprima_email" value="1"  /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Content Landing</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="content_landing" value="1"  /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Anteprima Landing</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="anteprima_landing" value="1"  /></td>
                                                               </tr>  -->
                                                               <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Screenshots</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Network Service</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Cosa vede il cliente</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="screenshots" value="1" /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Riepilogo Comunicazioni</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="comunicazioni" value="1" /></td>

                                                               </tr>';

            }

            $html .= '                                       </table>
                                                       </td>
                                                    </tr>';

            $html .= '
                                        </table>
                                    </form>
                                </div>
                            <div class="col-md-1"></div>
                </div>' . "\r\n";
}

if ($_REQUEST['azione'] == 'edit' && $_REQUEST['param'] != '') {


    if ($_REQUEST['action'] == 'modifica') {

        $id                = $_REQUEST['id'];
        $idsito            = $_REQUEST['idsito'];
        $nome              = addslashes($_REQUEST['nome']);
        $Sesso             = addslashes($_REQUEST['Sesso']);
        $password          = base64_encode($_REQUEST['password']);
        $unique_display    = $_REQUEST['unique_display'];
        $config1           = $_REQUEST['config1'];
        $config2           = $_REQUEST['config2'];
        $config3           = $_REQUEST['config3'];
        $config4           = $_REQUEST['config4'];
        $config5           = $_REQUEST['config5'];
        $config6           = $_REQUEST['config6'];
        $dashboard_box     = $_REQUEST['dashboard_box'];
        $statistiche       = $_REQUEST['statistiche'];
        $crea_proposta     = $_REQUEST['crea_proposta'];
        $preventivi        = $_REQUEST['preventivi'];
        $conferme          = $_REQUEST['conferme'];
        $prenotazioni      = $_REQUEST['prenotazioni'];
        $profila           = $_REQUEST['profila'];
        $giudizi           = $_REQUEST['giudizi'];
        $archivio          = $_REQUEST['archivio'];
        $schedine          = $_REQUEST['schedine'];
        $content_email     = $_REQUEST['content_email'];
        $content_landing   = $_REQUEST['content_landing'];
        $anteprima_email   = $_REQUEST['anteprima_email'];
        $anteprima_landing = $_REQUEST['anteprima_landing'];
        $screenshots       = $_REQUEST['screenshots'];
        $comunicazioni     = $_REQUEST['comunicazioni'];
        $abilitato         = $_REQUEST['abilitato'];





        $update = "UPDATE utenti_quoto SET nome   = '" . $nome . "',
                                            Sesso             = '" . $Sesso . "',
                                            password          = '" . $password . "',
                                            unique_display    =  '" .   $unique_display . "',
                                            config1           =  '" .   $config1 . "',
                                            config2           =  '" .   $config2 . "',
                                            config3           =  '" .   $config3 . "',
                                            config4           =  '" .   $config4 . "',
                                            config5           =  '" .   $config5 . "',
                                            config6           =  '" .   $config6 . "',
                                            dashboard_box     =  '" .   $dashboard_box . "',
                                            statistiche       =  '" .   $statistiche . "',
                                            crea_proposta     =  '" .   $crea_proposta . "',
                                            preventivi        =  '" .   $preventivi . "',
                                            conferme          =  '" .   $conferme . "',
                                            prenotazioni      =  '" .   $prenotazioni . "',
                                            profila           =  '" .   $profila . "',
                                            giudizi           =  '" .   $giudizi . "',
                                            archivio          =  '" .   $archivio . "',
                                            schedine          =  '" .   $schedine . "',
                                            content_email     =  '" .   $content_email . "',
                                            content_landing   =  '" .   $content_landing . "',
                                            anteprima_email   =  '" .   $anteprima_email . "',
                                            anteprima_landing =  '" .   $anteprima_landing . "',
                                            screenshots       =  '" .   $screenshots . "',
                                            comunicazioni     =  '" .   $comunicazioni . "',
                                            abilitato         =  '" .   $abilitato . "'
                                            WHERE Id = ".$id;
        $dbMysqli->query($update);

        ##LOGS OPERAZIONI
        $log->lwrite('('.$_GET['template'].') idsito = '.$idsito.', operatore = '.$_SESSION['user_accesso'].', IP = '.$_SERVER['REMOTE_ADDR'].', modificati permessi per = '.$nome);
        $log->lclose(); 

        header('location:' . BASE_URL_SITO . 'accessi-utenti/');
    }

    $select = "SELECT * FROM utenti_quoto WHERE id = ".$_REQUEST['param']." AND idsito = ".IDSITO." ORDER BY id DESC";
    $res    = $dbMysqli->query($select);
    $rw     = $res[0];


    $selec           = "SELECT * FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND Abilitato = 1 ORDER BY NomeOperatore ASC";
    $array_operatori = $dbMysqli->query($selec);
    foreach ($array_operatori as $key => $value) {
        $lista_op .= '<option value="'.$value['NomeOperatore'].'" '.($value['NomeOperatore']==$rw['nome']?'selected="selected"':'').'>'.$value['NomeOperatore'].'</option>';
    }


            $content .= '
                                <div class="row">
                                    <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <form id="mod_permessi" name="mod_permessi" method="post" action="' . $_SERVER['REQUEST_URI'] . '" >
                                                <table class="table">
                                                    <tr>
                                                        <td colspan="2" style="border-top: none;">
                                                            <button type="submit" class="btn btn-success btn-sm">Salva & Modifica</button>
                                                            <a href="'.BASE_URL_SITO.'accessi-utenti/" class="btn btn-warning btn-sm">Ritorna</a>
                                                            <input type="hidden" name="action" value="modifica" />
                                                            <input type="hidden" name="idsito" value="' . IDSITO . '" />
                                                            <input type="hidden" name="id" value="' . $rw['id'] . '" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Nome</b></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <select name="nome" class="form-control">
                                                                '.$lista_op.'
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Sesso</b> <small>(icona utente)</small></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <select name="Sesso" class="form-control" required>
                                                                <option value="" '.($rw['Sesso']==''?'selected="selected"':'').'>--</option>
                                                                <option value="Male" '.($rw['Sesso']=='Male'?'selected="selected"':'').'>Male</option>
                                                                <option value="Female" '.($rw['Sesso']=='Female'?'selected="selected"':'').'>Female</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Username</b></td>
                                                        <td style="border-top: none;" width="75%"><input type="text" class="form-control" name="username" value="' . $rw['username'] . '" readonly/></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Password</b></td>
                                                        <td style="border-top: none;" width="75%"><input type="text" class="form-control" name="password" value="' . base64_decode($rw['password']) . '" readonly/></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><b>Abilitato</b></td>
                                                        <td style="border-top: none;" width="75%"><input type="checkbox" class="js-switch" name="abilitato" value="1" ' . ($rw['abilitato'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                    </tr>';
        if(CHECKINONLINE == 0){  
            $content .= '                           <tr>
                                                        <td style="border-top: none;" width="25%" align="right"><h2>Permessi</h2></td>
                                                        <td style="border-top: none;" width="75%">
                                                            <table class="table">
                                                                <tr>
                                                                    <td style = "border-top: none;" class = "text-center" colspan = "4"><h2>Filtra per Operatore <span class="f-11">(il filtro sarà attivo su: preventivi, conferme, prenotazioni ed archivio)</span></h2>Saranno visibili solo le richieste dell\'utente in questione!</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita filtro per <b>Operatore</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="unique_display" value="1" ' . ($rw['unique_display'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Configurazioni</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Uso quotidiano di QUOTO</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>1° Config.Impostazioni</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config1" value="1" ' . ($rw['config1'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Crea Proposta Soggiorno</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="crea_proposta" value="1" ' . ($rw['crea_proposta'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>2° Config.Disponibilità</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config2" value="1" ' . ($rw['config2'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Preventivi</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="preventivi" value="1" ' . ($rw['preventivi'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>3° Config.Generiche</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config3" value="1" ' . ($rw['config3'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Conferme in trattativa</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="conferme" value="1" ' . ($rw['conferme'] == 1 ? 'checked="checked"' : '') . ' /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>4° Config.Questionario</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config4" value="1" ' . ($rw['config4'] == 1 ? 'checked="checked"' : '') . ' /></td>

                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Prenotazioni Chiuse</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="prenotazioni" value="1" ' . ($rw['prenotazioni'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>5° Config.Autoresponder</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config5" value="1" ' . ($rw['config5'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>6° Contenuti & Template</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="config6" value="1" ' . ($rw['config6'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right"></td>
                                                                    <td style="border-top: none;" width="10%"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Dashboard e Statistiche</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Uso quotidiano di QUOTO</></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita i <b>BOX statistici della Dashboard</b><br><small>compreso il grafico del fatturato</small></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="dashboard_box" value="1"  ' . ($rw['dashboard_box'] == 1 ? 'checked="checked"' : '') . '/></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Profila ed Esporta</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="profila" value="1"  ' . ($rw['profila'] == 1 ? 'checked="checked"' : '') . '/></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Statistiche Fatturato</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="statistiche" value="1" ' . ($rw['statistiche'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Giudizi Finali</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="giudizi" value="1" ' . ($rw['giudizi'] == 1 ? 'checked="checked"' : '') . ' /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="2"></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Archivio</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="archivio" value="1" ' . ($rw['archivio'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" colspan="2"></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>P.S. Schedine Alloggiati</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="schedine" value="1" ' . ($rw['schedine'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr>
                                                                <!-- <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Content & Preview</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Content & Preview</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Content E-mail</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="content_email" value="1" ' . ($rw['content_email'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Anteprima E-mail</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="anteprima_email" value="1" ' . ($rw['anteprima_email'] == 1 ? 'checked="checked"' : '') . ' /></td>

                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Content Landing</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="content_landing" value="1" ' . ($rw['content_landing'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Anteprima Landing</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="anteprima_landing" value="1" ' . ($rw['anteprima_landing'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                               </tr> -->
                                                               <tr>
                                                                    <td style="border-top: none;" colspan="4"></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Screenshots</h2></td>
                                                                    <td style="border-top: none;" class="text-center" colspan="2"><h2>Network Service</h2></td>
                                                               </tr>
                                                                <tr>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Cosa vede il cliente</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="screenshots" value="1" ' . ($rw['screenshots'] == 1 ? 'checked="checked"' : '') . ' /></td>
                                                                    <td style="border-top: none;" width="40%" align="right">Abilita voce <b>Riepilogo Comunicazioni</b></td>
                                                                    <td style="border-top: none;" width="10%"><input type="checkbox" class="js-switch" name="comunicazioni" value="1" ' . ($rw['comunicazioni'] == 1 ? 'checked="checked"' : '') . ' /></td>

                                                               </tr>';
        }
            $content .= '                                </table>
                                                       </td>
                                                    </tr>';

            $content .= '
                                        </table>
                                    </form>
                                </div>
                            <div class="col-md-1"></div>
                </div>' . "\r\n";

}

<?php

if (!$_REQUEST['azione']) {
    $pulsante_aggiungi ='<div class="xcrud-top-actions">
                            <a href="'.BASE_URL_SITO.'accessi-utenti/add/" data-task="create" class="btn btn-success xcrud-action"><i class="glyphicon glyphicon-plus-sign"></i> Aggiungi</a>
                            <div class="clearfix"></div>
                        </div>'."\r\n";

    $xcrud_suiteweb->table('utenti_quoto');
    $xcrud_suiteweb->where('idsito', IDSITO);
    $xcrud_suiteweb->order_by('id', 'DESC');


    $xcrud_suiteweb->columns('utenti,nome,Sesso,username,password,abilitato', false);
    $xcrud_suiteweb->label('utenti','');
    $xcrud_suiteweb->column_callback('utenti','check_superuser');
    $xcrud_suiteweb->column_callback('Sesso','ico_sesso');
    $xcrud_suiteweb->column_callback('password','hidden_password');

    $xcrud_suiteweb->column_tooltip('Sesso','Richiesto solo per scopo grafico, per determinare l\'icona dell\'utente da associare');

    $xcrud_suiteweb->button(BASE_URL_SITO . 'accessi-utenti/edit/{id}', 'Modifica', 'icon-checkmark glyphicon glyphicon-edit', 'bg-orange');

    $xcrud_suiteweb->unset_title(true);
    $xcrud_suiteweb->unset_add();
    $xcrud_suiteweb->unset_view();
    $xcrud_suiteweb->unset_edit();
    $xcrud_suiteweb->unset_print();
    $xcrud_suiteweb->unset_csv();
    $xcrud_suiteweb->unset_numbers();
    $xcrud_suiteweb->unset_search();
    $xcrud_suiteweb->hide_button('save_new');
    $xcrud_suiteweb->hide_button('save_edit');
    $xcrud_suiteweb->limit(20);
    $xcrud_suiteweb->limit_list('20,40,80,all');

}

if($_REQUEST['azione']=='add'){

    if ($_REQUEST['action'] == 'aggiungi') {


        $idsito            = $_REQUEST['idsito'];
        $nome              = addslashes($_REQUEST['nome']);
        $Sesso             = addslashes($_REQUEST['Sesso']);
        $username          = addslashes($_REQUEST['username']);
        $password          = addslashes(base64_encode($_REQUEST['password']));
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
        $r     = $db_suiteweb->query($sel);
        $check_user = sizeof($db_suiteweb->result($r));

        $sel2   = "SELECT * FROM utenti_quoto WHERE password = '".$password."'";
        $r2     = $db_suiteweb->query($sel2);
        $check_pass = sizeof($db_suiteweb->result($r2));

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
            $db_suiteweb->query($insert);

            header('location:' . BASE_URL_SITO . 'accessi-utenti/');

        }
    }

    $selec           = "SELECT * FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND Abilitato = 1 ORDER BY NomeOperatore ASC";
    $re              = $db->query($selec);
    $array_operatori = $db->result($re);
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
                                                            <button type="submit" class="btn btn-success btn-md">Salva & Ritorna</button>
                                                            <a href="'.BASE_URL_SITO.'accessi-utenti/" class="btn btn-warning btn-md">Ritorna</a>
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
                                                                    <td style = "border-top: none;" class = "text-center" colspan = "4"><h2>Filtra per Operatore <small><small>(il filtro sarà attivo su: preventivi, conferme, prenotazioni ed archivio)</small></small></h2></td>
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
        $password          = addslashes($_REQUEST['password']);
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
        $db_suiteweb->query($update);

        header('location:' . BASE_URL_SITO . 'accessi-utenti/');
    }

    $select = "SELECT * FROM utenti_quoto WHERE id = ".$_REQUEST['param']." AND idsito = ".IDSITO." ORDER BY id DESC";
    $res = $db_suiteweb->query($select);
    $rw = $db_suiteweb->row($res);


    $selec           = "SELECT * FROM hospitality_operatori WHERE  idsito = ".IDSITO." AND Abilitato = 1 ORDER BY NomeOperatore ASC";
    $re              = $db->query($selec);
    $array_operatori = $db->result($re);
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
                                                            <button type="submit" class="btn btn-success btn-md">Salva & Modifica</button>
                                                            <a href="'.BASE_URL_SITO.'accessi-utenti/" class="btn btn-warning btn-md">Ritorna</a>
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
                                                        <td style="border-top: none;" width="75%"><input type="text" class="form-control" name="password" value="' . $rw['password'] . '" readonly/></td>
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
                                                                    <td style = "border-top: none;" class = "text-center" colspan = "4"><h2>Filtra per Operatore <small><small>(il filtro sarà attivo su: preventivi, conferme, prenotazioni ed archivio)</small></small></h2></td>
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

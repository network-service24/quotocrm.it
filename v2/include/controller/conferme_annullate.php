<?php
header("Refresh:240; url=".BASE_URL_SITO."conferme/");



if($_REQUEST['azione']!='' && $_REQUEST['param']=='delete'){
        $db->query("UPDATE hospitality_guest SET Hidden = 1 WHERE Id = '".$_REQUEST['azione']."'");
        header('location:'.BASE_URL_SITO.'conferme/');
}
    $xcrud->table('hospitality_guest');
        /**
     * ! SE IL PERMESSO E' IMPOSTATO LE RICHIESTE VENGONO FILTRATE PER OPERATORE
     */
    $permessi_unique = check_permessi();
    if($permessi_unique['UNIQUE']==1){
        $xcrud->where('hospitality_guest.ChiPrenota', NOMEUTENTEACCESSI);
    }
    ####################################################################
    if($_REQUEST['action']=='unique_filter'){

        if($_REQUEST['Aperture']!=''){

            $lista_id_     = array();
            $lista_id_full = array();
            $lista_id      = array();
            $aperture      = '';

            if($_REQUEST['Aperture'] == 0){

                $select = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta,COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                                hospitality_guest
                            RIGHT OUTER JOIN
                                hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".IDSITO."
                                AND hospitality_guest.TipoRichiesta = 'Conferma'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $result   = $db->query($select);
                $array_id = $db->result($result);
                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {
                        if($value['DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
                            $aperture = $value['conteggio'];
                        }else{
                            $aperture = ($value['conteggio'] > 0 ? ($value['conteggio']-1) : $value['conteggio'] );
                        }
                        if($aperture!= 0){
                            $lista_id_[] = $value['Id'];
                        }
                    }
                }

                $select2 = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta
                            FROM
                                hospitality_guest
                            WHERE hospitality_guest.idsito = ".IDSITO."
                                AND hospitality_guest.TipoRichiesta = 'Conferma'
                                AND hospitality_guest.Archivia = 0
                                AND hospitality_guest.Chiuso = 0";
                $result2   = $db->query($select2);
                $array_id2 = $db->result($result2);
                if(sizeof($array_id2)>0){
                    foreach ($array_id2 as $ky => $val) {
                        $lista_id_full[] = $val['Id'];
                    }
                }

                $lista_id = array_diff($lista_id_full,$lista_id_);

            }


            if($_REQUEST['Aperture'] == 1){

                $select = "SELECT hospitality_guest.Id,hospitality_guest.DataRichiesta, COUNT(hospitality_traccia_email.Id) as conteggio
                            FROM
                            hospitality_guest
                            LEFT JOIN
                            hospitality_traccia_email ON hospitality_traccia_email.IdRichiesta = hospitality_guest.Id
                            WHERE hospitality_guest.idsito = ".IDSITO."
                            AND hospitality_guest.TipoRichiesta = 'Conferma'
                            AND hospitality_guest.Archivia = 0
                            AND hospitality_guest.Chiuso = 0
                            GROUP BY hospitality_traccia_email.IdRichiesta";
                $result   = $db->query($select);
                $array_id = $db->result($result);
                if(sizeof($array_id)>0){
                    foreach ($array_id as $key => $value) {
                        if($value['DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
                            $aperture = $value['conteggio'] ;
                        }else{
                            $aperture = ($value['conteggio'] > 0 ? ($value['conteggio']-1) : $value['conteggio'] );
                        }
                        if($aperture!= 0){
                            $lista_id[] = $value['Id'];
                        }
                    }
                }
            }

            if(empty($lista_id)  || is_null($lista_id)){
                $lista_id[] = 0;
            }
            $xcrud->where('hospitality_guest.Id IN('.implode(",",$lista_id).')');

        }
    }
    if($_REQUEST['action']=='search'){
        if($_REQUEST['NumeroPrenotazione']!=''){
            $xcrud->where('hospitality_guest.NumeroPrenotazione', $_REQUEST['NumeroPrenotazione']);
        }
        if($_REQUEST['Operatore']!=''){
            $xcrud->where('hospitality_guest.ChiPrenota', $_REQUEST['Operatore']);
        }
        if($_REQUEST['FontePrenotazione']!=''){
            $xcrud->where('hospitality_guest.FontePrenotazione', $_REQUEST['FontePrenotazione']);
        }
        if($_REQUEST['TipoVacanza']!=''){
            $xcrud->where('hospitality_guest.TipoVacanza', $_REQUEST['TipoVacanza']);
        }
        if($_REQUEST['Nome']!=''){
            $xcrud->where('hospitality_guest.Nome LIKE "%'.$_REQUEST['Nome'].'%"');
        }
        if($_REQUEST['Cognome']!=''){
            $xcrud->where('hospitality_guest.Cognome LIKE "%'.$_REQUEST['Cognome'].'%"');
        }
        if($_REQUEST['Email']!=''){
            $xcrud->where('hospitality_guest.Email', $_REQUEST['Email']);
        }
        if($_REQUEST['DataScadenza']!=''){
            $data_scad_tmp = explode("/",$_REQUEST['DataScadenza']);
            $data_scad = $data_scad_tmp[2].'-'.$data_scad_tmp[1].'-'.$data_scad_tmp[0];
            $xcrud->where('hospitality_guest.DataScadenza >= "'.$data_scad.'"');
        }
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] ==''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'"');
        }
        if($_REQUEST['DataArrivo']!='' && $_REQUEST['DataPartenza'] !=''){
            $data_dal_tmp = explode("/",$_REQUEST['DataArrivo']);
            $data_dal = $data_dal_tmp[2].'-'.$data_dal_tmp[1].'-'.$data_dal_tmp[0];
            $data_al_tmp = explode("/",$_REQUEST['DataPartenza']);
            $data_al = $data_al_tmp[2].'-'.$data_al_tmp[1].'-'.$data_al_tmp[0];
            $xcrud->where('hospitality_guest.DataArrivo >= "'.$data_dal.'" AND hospitality_guest.DataPartenza <= "'.$data_al.'"');
        }
        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] ==''){
            $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
            $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
            $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'"');
        }
        if($_REQUEST['DataRichiesta_dal']!='' && $_REQUEST['DataRichiesta_al'] !=''){
            $dataR_dal_tmp = explode("/",$_REQUEST['DataRichiesta_dal']);
            $dataR_dal = $dataR_dal_tmp[2].'-'.$dataR_dal_tmp[1].'-'.$dataR_dal_tmp[0];
            $dataR_al_tmp = explode("/",$_REQUEST['DataRichiesta_al']);
            $dataR_al = $dataR_al_tmp[2].'-'.$dataR_al_tmp[1].'-'.$dataR_al_tmp[0];
            $xcrud->where('hospitality_guest.DataRichiesta >= "'.$dataR_dal.'" AND hospitality_guest.DataRichiesta <= "'.$dataR_al.'"');
        }
        if($_REQUEST['Lingua']!=''){
            $xcrud->where('hospitality_guest.Lingua', $_REQUEST['Lingua']);
        }
        if($_REQUEST['TipoSoggiorno']!=''){
            $xcrud->join('hospitality_guest.Id', 'hospitality_richiesta', 'id_richiesta');
            $xcrud->where('hospitality_richiesta.TipoSoggiorno', $_REQUEST['TipoSoggiorno']);
        }
    }
    $xcrud->where('hospitality_guest.idsito', IDSITO);
   // $xcrud->where('TipoRichiesta', 'Conferma');
    $xcrud->where('hospitality_guest.Chiuso', '0');
    $xcrud->where('hospitality_guest.NoDisponibilita', '1');
    $xcrud->where('hospitality_guest.CheckinOnlineClient', '0');
    $xcrud->where('hospitality_guest.Archivia', '0');
    $xcrud->where('hospitality_guest.Hidden', '0');
    $xcrud->order_by('DataRichiesta','DESC');
    $xcrud->order_by('hospitality_guest.Id','DESC');
    $xcrud->order_by('DataInvio','DESC');

    $xcrud->columns('ChiPrenota,NumeroPrenotazione,TipoRichiesta,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Email,Lingua,DataArrivo,DataPartenza,NumeroAdulti,NumeroBambini,Proposte,DataInvio,Id,idsito,NoDisponibilita,Provenienza', false);

    $xcrud->column_callback('idsito','func_cc');
    $xcrud->column_callback('TipoVacanza','bg_tipo');
    $xcrud->column_callback('FontePrenotazione','bg_fonte');
    $xcrud->column_callback('Nome','gia_presente_conf');
    $xcrud->column_callback('ChiPrenota' , 'get_operatore');
    $xcrud->column_callback('Id' , 'conta_click');



    $xcrud->column_callback('NoDisponibilita' , 'check_no_disponibilita');
    $xcrud->column_callback('Provenienza' , 'motivazione_conferme_annullate');

    $xcrud->column_pattern('Nome' , '<small><b>{value} {Cognome}</b></small>');
    $xcrud->column_pattern('Cognome' , '<small><b>{value}</b></small>');
    $xcrud->column_pattern('Email' , '<small style="white-space: nowrap;">{value}</small>');
    $xcrud->column_pattern('DataRichiesta' , '<small>{value}</small>');
    $xcrud->column_pattern('Lingua' , '<small>{value}</small>');
    $xcrud->column_callback('DataArrivo' , 'get_data_arrivo_conferma');
    $xcrud->column_callback('DataPartenza' , 'get_data_partenza_conferma');
    $xcrud->column_pattern('NumeroAdulti' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroBambini' , '<small>{value}</small>');
    $xcrud->column_pattern('DataInvio' , '<small>{value}</small>');
    $xcrud->column_pattern('DataScadenza' , '<small>{value}</small>');
    $xcrud->column_pattern('NumeroPrenotazione' , '<a href="'.BASE_URL_SITO.'timeline/{NumeroPrenotazione}" title="Timeline"  data-toogle="tooltip"><small>{value}</small></a>');
    $xcrud->column_pattern('Id' , '<small>{value}</small>');
    $xcrud->column_pattern('Click' , '<small>{value}</small>');
    //$xcrud->column_pattern('TipoRichiesta' , '<small><b>{value}</b></small>');
    $xcrud->column_callback('TipoRichiesta' , 'etichetta_preno_conf');

    $xcrud->label(array('Proposte' => 'Proposta',
                                'TipoVacanza' => 'Tipo',
                                'Nome' => 'Nome Cognome',
                                'DataRichiesta' => 'Richiesta',
                                'Lingua' => 'Lg',
                                'DataArrivo' => 'Arrivo',
                                'DataPartenza' => 'Partenza',
                                'NumeroAdulti' => 'A',
                                'NumeroBambini' => 'B',
                                'NumeroPrenotazione' => 'Nr.',
                                'ChiPrenota' => 'Nome Operatore',
                                'EmailSegretaria' => 'Email Operatore',
                                'FontePrenotazione' => 'Fonte',
                                'DataScadenza' => 'Scadenza',
                                'idsito' => '',
                                'Id' => 'Aperta',
                                'TipoPagamento' => 'Tipologia Pagamento',
                                'DataInvio' => 'Invio',
                                'ChiPrenota' => 'Op.',
                                'TipoRichiesta' => 'Step',
                                'NoDisponibilita' => '',
                                'Provenienza' => 'Motivazione'));

    $xcrud->column_callback('Email','ico_mail');
    $xcrud->column_class('ChiPrenota,Email,Proposte,idsito,NumeroAdulti,NumeroBambini,Id,NoDisponibilita,Provenienza', 'align-center');
    $xcrud->column_tooltip('idsito','Tipo Pagamento', 'fa fa fa-ellipsis-h text-white');

    $xcrud->column_callback('Lingua','show_flags');
    //$xcrud->column_callback('Proposte','get_conferma');
    $xcrud->column_callback('Proposte','dettaglio');

    $xcrud->column_callback('DataInvio','get_invio');

    $xcrud->highlight('DataInvio', '=', '', '#FDFDD3');

    //$xcrud->highlight_row('NoDisponibilita', '=', '1', '#E1E1E1');

    $xcrud->search_columns('Id,NumeroPrenotazione,FontePrenotazione,TipoVacanza,DataRichiesta,Nome,Cognome,Email,Lingua,DataArrivo,DataPartenza,DataInvio,DataScadenza');
    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_edit();
    $xcrud->unset_view();
    $xcrud->unset_remove();
    $xcrud->unset_csv();
    $xcrud->unset_print();
    $xcrud->unset_numbers();
    $numero = paginazione(IDSITO);
    if(!isset($numero) || is_null($numero) || empty($numero)){
            $numero = 15;
    }
    $numero2 = ($numero*2);
    $numero3 = ($numero*3);
    $numero4 = ($numero*4);
    $xcrud->limit($numero);
    $xcrud->limit_list($numero.','.$numero2.','.$numero3.','.$numero4);



    $xcrud->button('javascript:validator_ri_abilita(\''.BASE_URL_SITO.'ri_abilita_conferma/{id}\');','Ri Abilita','icon-checkmark fa fa-minus-circle text-green','');
    

    //$xcrud->button('javascript:validator_cestino(\''.$_SERVER['REQUEST_URI'].'{id}/delete/\');','Cestina','glyphicon glyphicon-remove','bg-red',array('data-toogle' => 'tooltip'));


    if(check_configurazioni(IDSITO,'check_pagination')==1){
        $js_pagination = '
        <script>
            $(document).ajaxComplete(function(){
                $(\'.pagination li\').hasClass(\'active\');
                var Pagina = $(\'.pagination li span\').text();
                var Pagina_clean = Pagina.replace("\u2026","");
                console.log(Pagina_clean);
                scriviCookie(\'PaginationConf\',Pagina_clean,\'60\');
                $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
            });
            $("document").ready(function() {
                $(\'.pagination li\').one("mouseover",function(){
                    $( "#legendaPagination" ).show( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                $(\'.pagination li\').one("mouseout",function(){
                    $( "#legendaPagination" ).hide( "slow", function() {
                        $(\'#legendaPagination\').html("<div class=\"alert alert-warning\">Per eliminare la memoria della pagina scelta nel menù di paginazione, ripassare sempre dalla pagina N° 1</div>");
                      });
                });
                if(leggiCookie(\'PaginationConf\')) {
                    var numero = "";
                    console.log(leggiCookie(\'PaginationConf\'));
                    if(leggiCookie(\'PaginationConf\')!=1){
                        var moltiplicatore = (leggiCookie(\'PaginationConf\')-1);
                        var multi          = parseInt(moltiplicatore);
                        numero             = ('.$numero.'*multi);
                    setTimeout(function() {
                            $(\'.xcrud-action[data-start="\'+numero+\'"]\').trigger(\'click\');
                        },1);
                    }
                }
            })
        </script>'."\r\n";
    }

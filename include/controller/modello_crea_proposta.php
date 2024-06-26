<?php
$riga_camere_proposta_1 ='
<div class="table-responsive">
        <table class="table no-border-top no-border-bottom">
        <tr>
            <td class="td25 no-border-top">
                <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_1_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                    <select name="TipoSoggiorno1[]" id="TipoSoggiorno_1_1" class="form-control" required>
                        '.$ListaSoggiorno.'
                    </select>
                </div>
            </td>
            <td class="td25 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Tipo Camera</b></label>
                    <input type="hidden" name="NumeroCamere1[]" id="NumeroCamere_1_1" value="1">
                    '.$select_tipo_camere1.'
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Adulti</b></label>
                    <select required name="NumAdulti1[]" id="NumeroAdulti_1_1" class="form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(1,1);"':'').'>
                        '.$NumeroAdulti.'
                    </select>
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Bambini</b></label>
                    <select name="NumBambini1[]" id="NumeroBambini_1_1" class="NumeroBambini_1_1 form-control" onchange="eta_bimbi(\'1_1\');">
                        '.$NumeroBambini.'
                    </select>
                    <div class="EtaBambini1_1" style="display:none">
                        <input type="text"  name="EtaB1[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td30 no-border-top">
                <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_1_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Prezzo</b></label>
                    <div class="input-group">
                        <input type="text" name="Prezzo1[]" id="Prezzo_1_1" class="prezzo1 form-control" placeholder="Prezzo 0000.00"  '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(1,1);"':'').' onkeyup="calcola_totale1();">
                        <span class="input-group-addon" onclick="room_fields(1,\'righe_room\');">
                            <i class="fa fa-plus"></i>
                        </span>
                   </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top no-border-bottom">
                <table id="righe_room"  class="nopadding no-border-top no-border-bottom" style="width:100%"></table>
            </td>
        </tr>
        '.$fun->get_servizi_aggiuntivi(1).'
    </table>
</div>
'."\r\n";
$riga_camere_proposta_2 ='
<div class="table-responsive">
        <table class="table no-border-top no-border-bottom">
        <tr>
            <td class="td25 no-border-top">
                <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_2_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                    <select name="TipoSoggiorno2[]" id="TipoSoggiorno_2_1" class="form-control" tabindex="20">
                        '.$ListaSoggiorno.'
                    </select>
                </div>
            </td>
            <td class="td25 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Tipo Camera</b></label>
                    <input type="hidden" name="NumeroCamere2[]" id="NumeroCamere_2_1" value="1">
                    '.$select_tipo_camere2.'
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Adulti</b></label>
                    <select name="NumAdulti2[]" id="NumeroAdulti_2_1" class="form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(2,1);"':'').'>
                        '.$NumeroAdulti.'
                    </select>
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Bambini</b></label>
                    <select name="NumBambini2[]" class="NumeroBambini_2_1 form-control" onchange="eta_bimbi(\'2_1\')">
                        '.$NumeroBambini.'
                    </select>
                    <div class="EtaBambini2_1" style="display:none">
                        <input type="text"  name="EtaB2[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td30 no-border-top">
                <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_2_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Prezzo</b></label>
                    <div class="input-group">   
                        <input type="text" name="Prezzo2[]" id="Prezzo_2_1" class="prezzo2 form-control" placeholder="Prezzo 0000.00"  '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(2,1);"':'').' onkeyup="calcola_totale2();">
                        <span class="input-group-addon" onclick="room_fields(2,\'righe_room2\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top no-border-bottom">
                <table id="righe_room2" class="nopadding no-border-bottom" style="width:100%"></table>
            </td>
        </tr>
        '.$fun->get_servizi_aggiuntivi(2).'
    </table>
</div>
'."\r\n";
$riga_camere_proposta_3 ='
<div class="table-responsive">
        <table class="table no-border-top no-border-bottom">
        <tr>
            <td class="td25 no-border-top">
                <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_3_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                    <select name="TipoSoggiorno3[]" id="TipoSoggiorno_3_1" class="form-control">
                        '.$ListaSoggiorno.'
                    </select>
                </div>
            </td>
            <td class="td25 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Tipo Camera</b></label>
                    <input type="hidden" name="NumeroCamere3[]" id="NumeroCamere_3_1" value="1">
                    '.$select_tipo_camere3.'
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Adulti</b></label>
                    <select name="NumAdulti3[]" id="NumeroAdulti_3_1" class="form-control"  '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(3,1);"':'').'>
                        '.$NumeroAdulti.'
                    </select>
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Bambini</b></label>
                    <select name="NumBambini3[]" class="NumeroBambini_3_1 form-control"  onchange="eta_bimbi(\'3_1\')">
                        '.$NumeroBambini.'
                    </select>
                    <div class="EtaBambini3_1" style="display:none">
                        <input type="text"  name="EtaB3[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td30 no-border-top">
                <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_3_1"></div>
                <div class="form-group">
                 <label class="control-label"><b>Prezzo</b></label>
                    <div class="input-group">
                        <input type="text" name="Prezzo3[]" id="Prezzo_3_1" class="prezzo3 form-control" placeholder="Prezzo 0000.00" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(3,1);"':'').' onkeyup="calcola_totale3();">
                        <span class="input-group-addon" onclick="room_fields(3,\'righe_room3\');">
                            <i class="fa fa-plus"></i>
                        </span>
                   </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top no-border-bottom">
                <table id="righe_room3" class="no-border-bottom no-border-top nopadding" style="width:100%"></table>
            </td>
        </tr>
        '.$fun->get_servizi_aggiuntivi(3).'
    </table>
</div>
'."\r\n";
$riga_camere_proposta_4 ='
<div class="table-responsive">
        <table class="table no-border-top no-border-bottom">
        <tr>
            <td class="td25 no-border-top">
              <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_4_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                    <select name="TipoSoggiorno4[]" id="TipoSoggiorno_4_1" class="form-control" >
                        '.$ListaSoggiorno.'
                    </select>
                </div>
            </td>
            <td class="td25 no-border-top">
                <div class="form-group">
                    <label class="control-label"><b>Tipo Camera</b></label>
                    <input type="hidden" name="NumeroCamere4[]" id="NumeroCamere_4_1" value="1">
                    '.$select_tipo_camere4.'
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                 <label class="control-label"><b>Adulti</b></label>
                    <select name="NumAdulti4[]" id="NumeroAdulti_4_1" class="form-control" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(4,1);"':'').' >
                        '.$NumeroAdulti.'
                    </select>
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                 <label class="control-label"><b>Bambini</b></label>
                    <select name="NumBambini4[]" class="NumeroBambini_4_1 form-control"  onchange="eta_bimbi(\'4_1\');">
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini4_1" style="display:none">
                        <input type="text"  name="EtaB4[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td30 no-border-top">
                <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_4_1"></div>
                <div class="form-group">
                 <label class="control-label"><b>Prezzo</b></label>
                    <div class="input-group">
                        <input type="text" name="Prezzo4[]" id="Prezzo_4_1" class="prezzo4 form-control" placeholder="Prezzo 0000.00" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(4,1);"':'').' onkeyup="calcola_totale4();">
                        <span class="input-group-addon" onclick="room_fields(4,\'righe_room4\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top no-border-bottom">
                <table id="righe_room4" class="no-border-bottom no-border-top nopadding" style="width:100%"></table>
            </td>
        </tr>
        '.$fun->get_servizi_aggiuntivi(4).'
    </table>
</div>
'."\r\n";
$riga_camere_proposta_5 ='
<div class="table-responsive">
        <table class="table no-border-top no-border-bottom">
        <tr>
            <td class="td25 no-border-top">
              <div class="td25 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_5_1"></div>
                <div class="form-group">
                    <label class="control-label"><b>Tipo Soggiorno</b></label>
                    <select name="TipoSoggiorno5[]" id="TipoSoggiorno_5_1" class="form-control" tabindex="20">
                        '.$ListaSoggiorno.'
                    </select>
                </div>
            </td>
            <td class="td25 no-border-top">
                <div class="form-group">
                 <label class="control-label"><b>Tipo Camera</b></label>
                    <input type="hidden" name="NumeroCamere5[]" id="NumeroCamere_5_1" value="1">
                    '.$select_tipo_camere5.'
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                 <label class="control-label"><b>Adulti</b></label>
                    <select name="NumAdulti5[]" id="NumeroAdulti_5_1" class="form-control"  '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(5,1);"':'').'>
                        '.$NumeroAdulti.'
                    </select>
                </div>
            </td>
            <td class="td10 no-border-top">
                <div class="form-group">
                 <label class="control-label"><b>Bambini</b></label>
                    <select name="NumBambini5[]" class="NumeroBambini_5_1 form-control" onchange="eta_bimbi(\'5_1\')">
                        '.$NumeroBambini.'
                    </select>
                    <div class="EtaBambini5_1" style="display:none">
                        <input type="text"  name="EtaB5[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td30 no-border-top">
                <div class="td30 f-right posizione_spiegazione_prezzo" id="spiegazione_prezzo_5_1"></div>
                <div class="form-group">
                 <label class="control-label"><b>Prezzo</b></label>
                    <div class="input-group">
                        <input type="text" name="Prezzo5[]" id="Prezzo_5_1" class="prezzo5 form-control" placeholder="Prezzo 0000.00" '.(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(5,1);"':'').' onkeyup="calcola_totale5();">
                        <span class="input-group-addon" onclick="room_fields(5,\'righe_room5\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top no-border-bottom">
                <table id="righe_room5" class="no-border-bottom no-border-top nopadding" style="width:100%"></table>
            </td>
        </tr>
        '.$fun->get_servizi_aggiuntivi(5).'
    </table>
</div>
    <!-- id utile alla compilazione automatica dei prezzi camere in ajax -->
    <div id="valori"></div>
    <div id="valori_serv"></div>
'."\r\n";
?>

<?php
/**
 * * variabile con icona legenda
 * * spiega come comportarsi con 
 * * creazione della proposta se si usa PMS Ericsoft
 */
if(check_ericsoftpms(IDSITO) == 1){
    $pms = true;
    $etichetta_pms = 'EricSoft';
}
if(check_bedzzlePMS(IDSITO) == 1){
    $pms = true;
    $etichetta_pms = 'Bedzzle';
}
if(check_pms_cinquestelle(IDSITO) == 1){
    $pms = true;
    $etichetta_pms = 'HotelCinqueStelle';
}
if($pms == true){
    $ico_legenda_pms_ericsoft  = '<small style="padding-left:10px">Per un uso corretto della sincronia con il PMS di '.$etichetta_pms.'</small> <i style="position:relative;padding-bottom:-20px" class="fa fa-question-circle text-info" data-toggle="tooltip" title="" aria-hidden="true" data-original-title="Se il numero di camere vendute sono più di una, non incrementare i numeri camera dalla select (Nr.), ma impostare il campo sempre con valore 1. Aggiungere una riga per ogni camera, altrimenti nel vostro PMS non risulterà il giusto numero di camere"></i>';
}
/**
 * * Fine
 */
$riga_camere_proposta_v2_1 ='
<tr>
    <td colspan="6" class="nopadding no-border-top">
    '.$ico_legenda_pms_ericsoft.'
        <table class="table table-responsive">
        <tr>
            <td class="td25pdl10pdr10 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_1_1"></div>
                    <div class="form-group">
                        <select name="TipoSoggiorno1[]" id="TipoSoggiorno_1_1"
                            class="form-control" tabindex="20">
                            <option value="" selected="selected">Tipo Soggiorno</option>
                            '.$ListaSoggiorno.'
                        </select>
                    </div>
            </td>
            <td class="td6pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumeroCamere1[]" id="NumeroCamere_1_1"
                        class="form-control" tabindex="21">
                        <option value="" selected="selected">Nr.</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td25pdl0pdr10 no-border-top">
                <div class="form-group">
                    '.$select_tipo_camere1.'
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumAdulti1[]" id="NumeroAdulti_1_1"
                        class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(1,1);"':'').'>
                        <option value="" selected="selected">Adulti</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumBambini1[]" id="NumeroBambini_1_1"
                        class="NumeroBambini_1_1 form-control" tabindex="20" onchange="eta_bimbi(\'1_1\');">
                        <option value="" selected="selected">Bambini</option>
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini1_1" style="display:none">
                        <input type="text"  name="EtaB1[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td25pdl0pdr0 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_1_1"></div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                        <input type="text" name="Prezzo1[]" id="Prezzo_1_1"
                            class="prezzo1 form-control"
                            placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(1,1);"':'').' onmouseout="calcola_totale1();">
                        <span class="input-group-addon btn bg-green" onclick="room_fields(1,\'righe_room\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top">
                <table id="righe_room" class="table table-responsive nopadding"></table>
            </td>
        </tr>
        '.get_servizi_aggiuntivi(1).'
    </table>
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v2_2 ='
<tr>
    <td colspan="6" class="nopadding">
    '.$ico_legenda_pms_ericsoft.'
        <table class="table table-responsive">
        <tr>
            <td class="td25pdl10pdr10 no-border-top">
              <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_2_1"></div>
                    <div class="form-group">
                        <select name="TipoSoggiorno2[]" id="TipoSoggiorno_2_1"
                            class="form-control" tabindex="20">
                            <option value="" selected="selected">Tipo Soggiorno</option>
                            '.$ListaSoggiorno.'
                        </select>
                    </div>
            </td>
            <td class="td6pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumeroCamere2[]" id="NumeroCamere_2_1"
                        class="form-control" tabindex="21">
                        <option value="" selected="selected">Nr.</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td25pdl0pdr10 no-border-top">
                <div class="form-group">
                    '.$select_tipo_camere2.'
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumAdulti2[]" id="NumeroAdulti_2_1"
                        class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(2,1);"':'').'>
                        <option value="" selected="selected">Adulti</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumBambini2[]"
                        class="NumeroBambini_2_1 form-control" tabindex="20" onchange="eta_bimbi(\'2_1\')">
                        <option value="" selected="selected">Bambini</option>
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini2_1" style="display:none">
                        <input type="text"  name="EtaB2[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td25pdl0pdr0 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_2_1"></div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                        <input type="text" name="Prezzo2[]" id="Prezzo_2_1"
                            class="prezzo2 form-control"
                            placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(2,1);"':'').' onmouseout="calcola_totale2();">
                        <span class="input-group-addon btn bg-green" onclick="room_fields(2,\'righe_room2\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top">
                <table id="righe_room2" class="table table-responsive nopadding"></table>
            </td>
        </tr>
        '.get_servizi_aggiuntivi(2).'
    </table>
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v2_3 ='
<tr>
    <td colspan="6" class="nopadding">
    '.$ico_legenda_pms_ericsoft.'
        <table class="table table-responsive">
        <tr>
            <td class="td25pdl10pdr10 no-border-top">
              <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_3_1"></div>
                    <div class="form-group">
                        <select name="TipoSoggiorno3[]" id="TipoSoggiorno_3_1"
                            class="form-control" tabindex="20">
                            <option value="" selected="selected">Tipo Soggiorno</option>
                            '.$ListaSoggiorno.'
                        </select>
                    </div>
            </td>
            <td class="td6pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumeroCamere3[]" id="NumeroCamere_3_1"
                        class="form-control" tabindex="21">
                        <option value="" selected="selected">Nr.</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td25pdl0pdr10 no-border-top">
                <div class="form-group">
                    '.$select_tipo_camere3.'
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumAdulti3[]" id="NumeroAdulti_3_1"
                        class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(3,1);"':'').'>
                        <option value="" selected="selected">Adulti</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumBambini3[]"
                        class="NumeroBambini_3_1 form-control" tabindex="20" onchange="eta_bimbi(\'3_1\')">
                        <option value="" selected="selected">Bambini</option>
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini3_1" style="display:none">
                        <input type="text"  name="EtaB3[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td25pdl0pdr0 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_3_1"></div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                        <input type="text" name="Prezzo3[]" id="Prezzo_3_1"
                            class="prezzo3 form-control"
                            placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(3,1);"':'').' onmouseout="calcola_totale3();">
                        <span class="input-group-addon btn bg-green" onclick="room_fields(3,\'righe_room3\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top">
                <table id="righe_room3" class="table table-responsive nopadding"></table>
            </td>
        </tr>
        '.get_servizi_aggiuntivi(3).'
    </table>
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v2_4 ='
<tr>
    <td colspan="6" class="nopadding">
    '.$ico_legenda_pms_ericsoft.'
        <table class="table table-responsive">
        <tr>
            <td class="td25pdl10pdr10 no-border-top">
              <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_4_1"></div>
                    <div class="form-group">
                        <select name="TipoSoggiorno4[]" id="TipoSoggiorno_4_1"
                            class="form-control" tabindex="20">
                            <option value="" selected="selected">Tipo Soggiorno</option>
                            '.$ListaSoggiorno.'
                        </select>
                    </div>
            </td>
            <td class="td6pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumeroCamere4[]" id="NumeroCamere_4_1"
                        class="form-control" tabindex="21">
                        <option value="" selected="selected">Nr.</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td25pdl0pdr10 no-border-top">
                <div class="form-group">
                    '.$select_tipo_camere4.'
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumAdulti4[]" id="NumeroAdulti_4_1"
                        class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(4,1);"':'').' >
                        <option value="" selected="selected">Adulti</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumBambini4[]"
                        class="NumeroBambini_4_1 form-control" tabindex="20" onchange="eta_bimbi(\'4_1\');">
                        <option value="" selected="selected">Bambini</option>
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini4_1" style="display:none">
                        <input type="text"  name="EtaB4[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td25pdl0pdr0 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_4_1"></div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                        <input type="text" name="Prezzo4[]" id="Prezzo_4_1"
                            class="prezzo4 form-control"
                            placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(4,1);"':'').' onmouseout="calcola_totale4();">
                        <span class="input-group-addon btn bg-green" onclick="room_fields(4,\'righe_room4\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top">
                <table id="righe_room4" class="table table-responsive nopadding"></table>
            </td>
        </tr>
        '.get_servizi_aggiuntivi(4).'
    </table>
    </td>
</tr>'."\r\n";
$riga_camere_proposta_v2_5 ='
<tr>
    <td colspan="6" class="nopadding">
    '.$ico_legenda_pms_ericsoft.'
        <table class="table table-responsive">
        <tr>
            <td class="td25pdl10pdr10 no-border-top">
              <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_5_1"></div>
                    <div class="form-group">
                        <select name="TipoSoggiorno5[]" id="TipoSoggiorno_5_1"
                            class="form-control" tabindex="20">
                            <option value="" selected="selected">Tipo Soggiorno</option>
                            '.$ListaSoggiorno.'
                        </select>
                    </div>
            </td>
            <td class="td6pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumeroCamere5[]" id="NumeroCamere_5_1"
                        class="form-control" tabindex="21">
                        <option value="" selected="selected">Nr.</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td25pdl0pdr10 no-border-top">
                <div class="form-group">
                    '.$select_tipo_camere5.'
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumAdulti5[]" id="NumeroAdulti_5_1"
                        class="form-control" tabindex="20" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onChange="get_listino(5,1);"':'').'>
                        <option value="" selected="selected">Adulti</option>
                        '.$Numeri.'
                    </select>
                </div>
            </td>
            <td class="td9pdl0pdr10 no-border-top">
                <div class="form-group">
                    <select name="NumBambini5[]"
                        class="NumeroBambini_5_1 form-control" tabindex="20" onchange="eta_bimbi(\'5_1\')">
                        <option value="" selected="selected">Bambini</option>
                        '.$NumeriBimbi.'
                    </select>
                    <div class="EtaBambini5_1" style="display:none">
                        <input type="text"  name="EtaB5[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1">
                    </div>
                </div>
            </td>
            <td class="td25pdl0pdr0 no-border-top">
            <div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_5_1"></div>
                <div class="form-group">
                    <div class="input-group" style="width:100%">
                <span class="input-group-addon"><i class="fa fa-euro"></i></span>
                        <input type="text" name="Prezzo5[]" id="Prezzo_5_1"
                            class="prezzo5 form-control"
                            placeholder="Prezzo 0000.00" tabindex="23" '.((check_simplebooking(IDSITO)==0 && check_ericsoftbooking(IDSITO)==0 && check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(5,1);"':'').' onmouseout="calcola_totale5();">
                        <span class="input-group-addon btn bg-green" onclick="room_fields(5,\'righe_room5\');">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="6" class="nopadding no-border-top">
                <table id="righe_room5" class="table table-responsive nopadding"></table>
            </td>
        </tr>
        '.get_servizi_aggiuntivi(5).'
    </table>
    <!-- id utile alla compilazione automatica dei prezzi camere in ajax -->
    <div id="valori"></div>
    <div id="valori_serv"></div>
    </td>
</tr>'."\r\n";
?>

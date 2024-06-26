<script>
var room = 1;
function room_fields(n_proposta,id) {

    setTimeout(function(){
            var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : { allow_single_deselect: true },
            '.chosen-select-no-single' : { disable_search_threshold: 10 },
            '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
            '.chosen-select-rtl'       : { rtl: true },
            '.chosen-select-width'     : { width: '95%' }
            }

                for (var selector in config) {
                    $(selector).chosen(config[selector]);
                }
            }, 500);

    room++;
    var objTo = document.getElementById(id)
    var divtest = document.createElement("tr");
    divtest.setAttribute("class", "removeclass" + room);
    var rdiv = 'removeclass' + room;

    divtest.innerHTML = '<tr>'
                        +'<td class="td25 no-border-top no-border-bottom"><div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_soggiorno_' + n_proposta + '_' + room + '"></div><div class="form-group"><input type="hidden" value="" name="idrichiesta' + n_proposta + '[]"><select name="TipoSoggiorno' + n_proposta + '[]" id="TipoSoggiorno_' + n_proposta + '_' + room + '" class="form-control"><?=$fun->lista_soggiorni(IDSITO)?></select></div></td>'
                        +'<td class="td25 no-border-top no-border-bottom"><div class="form-group"><input type="hidden" name="NumeroCamere' + n_proposta + '[]" id="NumeroCamere_' + n_proposta + '_' + room + '"><select name="TipoCamere' + n_proposta + '[]" id="TipoCamere_' + n_proposta + '_' + room + '" class="<?=$stile_chosen?> form-control" onChange="get_listino(' + n_proposta + ',' + room + ');"><?=$fun->lista_camere(IDSITO)?></select></div></td>'
                        +'<td class="td10 no-border-top no-border-bottom"><div class="form-group"><select name="NumAdulti' + n_proposta + '[]" id="NumeroAdulti_' + n_proposta + '_' + room + '" class="form-control" onChange="get_listino(' + n_proposta + ',' + room + ');"><?=$NumeroAdulti?></select></div></td>'
                        +'<td class="td10 no-border-top no-border-bottom"><div class="form-group"><select name="NumBambini' + n_proposta + '[]"  class="NumeroBambini_' + n_proposta + '_' + room + ' form-control" onchange="eta_bimbi(\'' + n_proposta + '_' + room + '\');"><?=$NumeroBambini?></select><div class="EtaBambini' + n_proposta + '_' + room + '" style="display:none"><input type="text"  name="EtaB' + n_proposta + '[]" placeholder="Età: 1,3 mesi,< 1" class="form-control" data-toggle="tooltip" title="inserire prima un numero intero, poi successivamente 3 mesi, oppure < 1"></div> </div></td>'
                        +'<td class="td30 no-border-top no-border-bottom"><div class="posizione_spiegazione_prezzo" id="spiegazione_prezzo_' + n_proposta + '_' + room + '"></div><div class="form-group"><div class="input-group"><input type="text" name="Prezzo' + n_proposta + '[]" id="Prezzo_' + n_proposta + '_' + room + '"  class="prezzo' + n_proposta + ' form-control" placeholder="Prezzo 000.00" <?=(($fun->check_simplebooking(IDSITO)==0 && $fun->check_ericsoftbooking(IDSITO)==0 && $fun->check_bedzzlebooking(IDSITO)==0)?'onfocus="get_listino(\' + n_proposta + \',\' + room + \');"':'')?> onkeyup="calcola_totale' + n_proposta + '();"><span class="input-group-addon"><i class="fa fa-minus" onclick="remove_room_fields(' + room + ');"></i></span></div></div></td>'
                        +'</tr>';

    objTo.appendChild(divtest)
}

function remove_room_fields(rid) {
    $('.removeclass' + rid).remove();
}
</script>

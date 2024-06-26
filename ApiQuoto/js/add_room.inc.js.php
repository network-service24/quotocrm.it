<script>
var linea = 1;

function room_fields(n_proposta,id) {

    linea++;
    var objTo = document.getElementById(id)
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "removeclass" + linea);
    var rdiv = 'removeclass' + linea;
  
    divtest.innerHTML = '<div style="ca"></div>' 
                        +'<div class="row">'
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-suitcase onselect"></i></div><?}?> <select name="TipoSoggiorno[]" id="TipoSoggiorno_' + n_proposta + '" class="form-control padding6-12 <?=$css_input?>"><option value="" selected="selected"><?=$form['trattamento'][$language]?></option><?=$ListaSoggiorno?></select></div>'
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-list onselect"></i></div><?}?> <select name="NumeroCamere[]" id="NumeroCamere_' + n_proposta + '" class="form-control padding6-12 <?=$css_input?>"><option value="" selected>Nr.<?=$form['camere'][$language]?></option> <?=$NumeriC?></select></div>'
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-bed onselect"></i></div><?}?> <select name="TipoCamere[]" id="TipoCamere_' + n_proposta + '" class="form-control  padding6-12 <?=$css_input?>"><option value="" selected><?=$form['sistemazione'][$language]?></option> <?=$ListaCamere?> </select></div>'
                        +'</div>'
                        +'<div class="row">'
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-male onselect"></i></div><?}?> <select name="NumAdulti[]" id="NumeroAdulti_' + n_proposta + '" class="form-control padding6-12 <?=$css_input?>" onchange="calcola_totale_adulti();"><option value="" selected="selected">Nr.<?=$form['adulti'][$language]?></option><?=$NumeriAD?></select></div>'
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><?php if($view_icon == 1){?><div class="icon-group righeSogg"><i class="fa fa-fw  fa-child onselect"></i></div><?}?> <select name="NumBambini[]"  class="NumeroBambini_' + n_proposta + '_' + linea + ' form-control padding6-12 <?=$css_input?>"  onchange="eta_bimbi(\'' + n_proposta + '_' + linea + '\');calcola_totale_bambini();equalizza_change_bambini();"><option value="" selected="selected">Nr.<?=$form['bambini'][$language]?></option><?=$NumeriBimbi?></select></div>'                        
                        +'<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><input type="text"  name="EtaB[]" placeholder="<?=$form['bambini_eta'][$language]?>" class="form-control <?=$css_input?>" autocomplete="off"></div>'
                        +'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left"><small><a id="re" href="javascript:;"  onclick="remove_room_fields(' + linea + ');"><i class="fa fa-fw  fa-minus"></i> <?=$form['remRoom'][$language]?></a></small></div>'
                        +'</div>';

    objTo.appendChild(divtest);
    <?php if($eqr == 1){?>
        EQR();
    <?}?>
}

function remove_room_fields(rid) {
    $('.removeclass' + rid).remove();
    <?php if($eqr == 1){?>
        EQR();
    <?}?>
}
</script>

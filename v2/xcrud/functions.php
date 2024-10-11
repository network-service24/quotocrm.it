<?php

function abilita($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_servizi_camera SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_servizi_camera SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function visibile($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Visibile = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function invisibile($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Visibile = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_operatore($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_operatori SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_operatore($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_operatori SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_camera($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_camere SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_camera($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_camere SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_fonti($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_fonti_prenotazione SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary').' AND FontePrenotazione != "Sito Web" ';
        $db->query($query);
    }
}
function disabilita_fonti($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_fonti_prenotazione SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary').' AND FontePrenotazione != "Sito Web" ';
        $db->query($query);
    }
}
function abilita_soggiorno($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_soggiorno SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_soggiorno($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_soggiorno SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_pacchetto($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_pacchetto SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_pacchetto($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_pacchetto SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_pagamento($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_pagamenti SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_pagamento($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_pagamenti SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_servizio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_servizi SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_servizio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_servizi SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_listino($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_listino_camere SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_listino($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_listino_camere SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_Nlistino($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_numero_listini SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_Nlistino($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_numero_listini SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_target($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_target SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_target($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_target SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_camera_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_camere SET Abilitato_form = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_camera_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_camere SET Abilitato_form = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_soggiorno_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_soggiorno SET Abilitato_form = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_soggiorno_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_soggiorno SET Abilitato_form = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_target_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_target SET Abilitato_form = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_target_form($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_target SET Abilitato_form = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}



function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" />';
}


function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if(strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif(strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function col_ucfirst($value, $fieldname, $primary_key, $row, $xcrud)
{
	return ucfirst($value);
}

function col_tolower($value, $fieldname, $primary_key, $row, $xcrud)
{
	$value = strtolower($value);
	return ucfirst($value);
}

function show_flags($value, $fieldname, $primary_key, $row, $xcrud)
{
	// se il campo contiene un solo codice di lingua
	if(strlen($value) == 2) {
		return '<img src="https://'.$_SERVER["HTTP_HOST"].'/v2/img/flags/mini/'.$value.'.png" class="flag_ico">';
	}
	else { // se il campo contiene più codici di lingua (es: testi di una domanda)
		$lingue = explode(' ',$value);	// i codici di lingua devono essere separati da spazio
		foreach($lingue as $val) {
			if(strlen($val) == 2) {
				$return_value .= ' <img src="https://'.$_SERVER["HTTP_HOST"].'/v2/img/flags/mini/'.$val.'.png" class="flag_ico"> ';
			}
		}
		return $return_value;
	}
}
function messaggio_email($value, $fieldname, $primary_key, $row, $xcrud)
{


    return '<div class="callout callout-danger">'
            .'  <h4>Legenda:</h4> '
            .'     <p> E\' possibile personalizzare il testo del messaggio inserendo la variabile [cliente] (es.: Gentile [cliente], ....).'
            .'         Al momento dell\'invio il sistema sostituirà [cliente] con il nome ed il cognome del contatto contenuto nelle varie richieste (es.: Gentile Mario Rossi, ....).</p>'
            .'     <p>Per evitare di commettere errori di battitura, se desiderate utilizzare la variabile <b>[cliente]</b> potete copiarla con la combinazione di tasti <b>CTRL+C</b>'
            .'        ed incollarla con <b>CTRL+V</b> all\'interno della TextArea! <br><b>Attenzione</b> è sempre consigliabile usare le combinazioni brevi da tastiera per copiare ed incollare qualsiasi contenuto nella textarea.</p>'
            .'  </div>'
            .'  <textarea id="MSG" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'     '.($value==''?'Gentile [cliente],':$value).' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("MSG");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';

}
function messaggio_web($value, $fieldname, $primary_key, $row, $xcrud)
{

    return '<div class="callout callout-danger">'
            .'  <h4>Legenda:</h4> '
            .'     <p> E\' possibile personalizzare il testo del messaggio inserendo la variabile [cliente] (es.: Gentile [cliente], ....).'
            .'         Al momento dell\'invio il sistema sostituirà [cliente] con il nome ed il cognome del contatto contenuto nelle varie richieste (es.: Gentile Mario Rossi, ....)'
            .'      <br /><b> Non copiare ed incollare testo da editor come Word oppure da pagine web, al massimo pulire i contenuti ri-passandoli dal blocco note!</b></p>'
            .'  </div>'
            .'  <textarea id="MSGWEB" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'     '.($value==''?'Gentile [cliente],':$value).' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("MSGWEB");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';
}
function abilita_email($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_contenuti_email SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_email($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_contenuti_email SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_web($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_contenuti_web SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_web($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_contenuti_web SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_gallery($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_gallery SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_gallery($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_gallery SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function get_preventivo($value, $fieldname, $primary_key, $row, $xcrud){

    $db  = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota,hospitality_guest.id_template
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key." ORDER BY hospitality_proposte.Id ASC";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere          = '';
        $n               = 1;
        $IdTemplate      = '';
        $Template        = '';
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        $res2            = array();
        foreach ($res as $key => $value) {

            $PrezzoL       = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP       = number_format($value['PrezzoP'],2,',','.');
            $IdProposta    = $value['IdProposta'];
            $NomeProposta  = $value['NomeProposta'];
            $Operatore     = stripslashes($value['ChiPrenota']);
            $Nome          = stripslashes($value['Nome']);
            $Cognome       = stripslashes($value['Cognome']);
            $Email         = $value['Email'];
            $NumeroAdulti  = $value['NumeroAdulti'];
            $NumeroBambini = $value['NumeroBambini'];
            $EtaBambini1   = $value['EtaBambini1'];
            $EtaBambini2   = $value['EtaBambini2'];
            $EtaBambini3   = $value['EtaBambini3'];
            $EtaBambini4   = $value['EtaBambini4'];
            $EtaBambini5   = $value['EtaBambini5'];
            $EtaBambini6   = $value['EtaBambini6'];
            $Arrivo_tmp    = explode("-",$value['DataArrivo']);
            $Arrivo        = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp  = explode("-",$value['DataPartenza']);
            $Partenza      = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $IdTemplate    = $value['id_template'];

            $start         = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end           = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $formato="%a";
            $Notti = dateDiffNotti($value['DataArrivo'],$value['DataPartenza'],$formato);
            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $db->query($se);
            $rc = $db->row($re);
            if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $formato="%a";
                $DNotti = dateDiffNotti($rc['Arrivo'],$rc['Partenza'],$formato);
            }

            if(is_null($IdTemplate) || $IdTemplate == 0){
                $Template = 'Predefinito';
            }else{
                $sel      = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = ".$IdTemplate;
                $res      = $db->query($sel);
                $rec      = $db->row($res);
                if($rec['TemplateName']!= 'default' || $rec['TemplateName'] != 'smart'){
                    $Template = ucfirst($rec['TemplateName']);
                }else{
                    $Template = check_nome_template_by_id($IdTemplate,$_SESSION['IDSITO']);
                }
                if($rec['TemplateType']!= '' && $rec['TemplateType'] != 'custom1' && $rec['TemplateType'] != 'custom2' && $rec['TemplateType'] != 'custom3'){
                    $urlTemplate     = 'javascript:;';
                    $t = '<small style=\'position:absolute;bottom:40px!important;\'>Template visibile solo dalla nuova interfaccia!</small>';
                }else{
                    $urlTemplate     = 'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_web/'.$primary_key.'';
                    $t= '';
                }
            }

            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta." AND  hospitality_richiesta.id_richiesta = ".$primary_key ;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != '' && $rc['Arrivo'] != '0000-00-00' && $rc['Partenza'] != '0000-00-00'){
                if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                    $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }
             $sistemazione .= '<b>'.$n.') PROPOSTA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> '.($EtaBambini1!='' && $EtaBambini1!='0'?'- '.$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br>'.$data_alernativa.$Camere.'  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  '.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br />';
        $n++;
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        }

        $sistemazione = str_replace('"',' ',$sistemazione);
        $sistemazione .= '<div style=\'float:right\'>'.$t.'<a href=\'https://'.$_SERVER['HTTP_HOST'].'/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Stampa PDF</a> <a href=\''.$urlTemplate.'\' class=\'btn btn-warning btn-xs\'>Anteprima template '.$Template.'</a></div><br>';

        return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="Proposte a preventivo Nr.'.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore: '.$Operatore.'" data-content="'.$sistemazione.'" class="xcrud_modal"><i class="glyphicon glyphicon-comment"></i></a>';


    }else{
        return '<small class="text-maroon" style=" white-space: nowrap;"><small>Da Completare</small></small>';
    }

}

function get_conferma($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta, hospitality_proposte.NomeProposta,hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
                        hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota,hospitality_guest.id_template

                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key." ORDER BY hospitality_proposte.Id ASC";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere          = '';
        $acconto         = '';
        $saldo           = '';
        $etichetta_saldo = '';
        $IdTemplate      = '';
        $Template        = '';
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        foreach ($res as $key => $value) {

            $PrezzoL          = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP          = number_format($value['PrezzoP'],2,',','.');
            $IdProposta       = $value['IdProposta'];
            $PrezzoPC         = $value['PrezzoP'];
            $AccontoRichiesta = $value['AccontoRichiesta'];
            $AccontoLibero    = $value['AccontoLibero'];
            $NomeProposta     = $value['NomeProposta'];
            $Operatore        = stripslashes($value['ChiPrenota']);
            $Nome             = stripslashes($value['Nome']);
            $Cognome          = stripslashes($value['Cognome']);
            $Email            = $value['Email'];
            $NumeroAdulti     = $value['NumeroAdulti'];
            $NumeroBambini    = $value['NumeroBambini'];
            $EtaBambini1      = $value['EtaBambini1'];
            $EtaBambini2      = $value['EtaBambini2'];
            $EtaBambini3      = $value['EtaBambini3'];
            $EtaBambini4      = $value['EtaBambini4'];
            $EtaBambini5      = $value['EtaBambini5'];
            $EtaBambini6      = $value['EtaBambini6'];
            $Arrivo_tmp       = explode("-",$value['DataArrivo']);
            $Arrivo           = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp     = explode("-",$value['DataPartenza']);
            $Partenza         = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $IdTemplate       = $value['id_template'];


            $start            = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end              = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $formato="%a";
            $Notti = dateDiffNotti($value['DataArrivo'],$value['DataPartenza'],$formato);
            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $db->query($se);
            $rc = $db->row($re);
            if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $formato="%a";
                $DNotti = dateDiffNotti($rc['Arrivo'],$rc['Partenza'],$formato);
            }

            if(is_null($IdTemplate) || $IdTemplate == 0){
                $Template = 'Predefinito';
            }else{
                $sel      = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = ".$IdTemplate;
                $res      = $db->query($sel);
                $rec      = $db->row($res);
                if($rec['TemplateName']!= 'default' || $rec['TemplateName'] != 'smart'){
                    $Template = ucfirst($rec['TemplateName']);
                }else{
                    $Template = check_nome_template_by_id($IdTemplate,$_SESSION['IDSITO']);
                }

            }
            if($rec['TemplateType']!= '' && $rec['TemplateType'] != 'custom1' && $rec['TemplateType'] != 'custom2' && $rec['TemplateType'] != 'custom3'){
                $urlTemplate     = 'javascript:;';
                $t = '<small style=\'position:absolute;bottom:40px!important;\'>Template visibile solo dalla nuova interfaccia!</small>';
            }else{
                $urlTemplate     = 'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_web/'.$primary_key.'';
                $t= '';
            }
            $AccontoPercentuale = $value['AccontoPercentuale'];
            $AccontoImporto     = $value['AccontoImporto'];
            $AccontoTesto       = stripslashes($value['AccontoTesto']);


            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $saldo   = ($PrezzoPC-$AccontoLibero);
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                if($AccontoImporto >= 1) {
                    $etichetta_caparra  = '';
                }else{
                    $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                }
                $saldo   = ($PrezzoPC-$AccontoImporto);
                $acconto = number_format($AccontoImporto,2,',','.');
            }
            if($PrezzoPC==$saldo){
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
            }else{
                if($AccontoPercentuale == 0 && $AccontoImporto <= 1) {
                    $saldo   = $PrezzoPC;
                }
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
            }


            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta." AND  hospitality_richiesta.id_richiesta = ".$primary_key  ;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != '' && $rc['Arrivo'] != '0000-00-00' && $rc['Partenza'] != '0000-00-00'){
                if($rc['Arrivo']!= $value['DataArrivo']){
                    $Arrivo   = $DArrivo;
                    $Notti    = $DNotti;
                }
                if($rc['Partenza']!= $value['DataPartenza']){
                    $Partenza   = $DPartenza;
                    $Notti      = $DNotti;
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

             $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br />'.$etichetta_saldo.'<br>';

             $data_alernativa = '';
             $DPartenza       = '';
             $DArrivo         = '';
             $DNotti          = '';
        }
            $sistemazione = str_replace('"',' ',$sistemazione);
            $sistemazione .= '<div style=\'float:right\'>'.$t.'<a href=\'https://'.$_SERVER['HTTP_HOST'].'/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Stampa PDF</a> <a href=\''.$urlTemplate.'\' class=\'btn btn-warning btn-xs\'>Anteprima template '.$Template.'</a> <a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_voucher/'.$primary_key.'\' class=\'btn btn-info btn-xs\'>Anteprima Voucher</a> '.($_SERVER['REQUEST_URI']=='/prenotazioni/'?'<a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/send_vaucher/send/'.$primary_key.'\' class=\'btn bg-maroon btn-xs\'>Re-invia Voucher</a>':'').'</div><br>';
            return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="Proposte confermate Nr.'.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore: '.$Operatore.'" data-content="'.$sistemazione.'" class="xcrud_modal"><i class="glyphicon glyphicon-comment"></i></a>';
          
        }else{

            $sel = "SELECT RequestProposta FROM hospitality_guest WHERE Id = ".$primary_key;
            $res = $db->query($sel);
            $rec = $db->row($res);
            if($rec['RequestProposta']!=''){
                $RequestProposta = '<a href="javascript:;" data-toogle="tooltip" data-html="true" title="<div class=\'text-left\'><b>CLICCA QUI!!</b><br>Con i dati qui visualizzati avete la possibilità di <b>ri-creare</b> la conferma in trattativa direttamente da QUOTO dalla schermata <b>Crea Proposta Soggiorno</b>, come <b>Tipologia della Richiesta</b> scegliete <b>Conferma</b>, solo dopo aver fatto questa operazione potrete cancellare questa conferma che purtroppo non è andata a buon fine</div>" data-header="Ricostruisci la conferma in trattativa" data-content="'.$rec['RequestProposta'].'" class="xcrud_modal"><i class="fa fa-send-o" style="font-size:9px!important"></i></a>';
            }
            return '<i class="fa fa-life-ring text-orange"  data-toogle="tooltip" data-html="true" data-placement="left" title="<div class=\'text-left\'>IN CASI MOLTO RARI!<br> Se NON doveste trovare la nuvoletta del riepilogo; potreste ri-creare direttamente da<br> Crea Proposta Soggiorno<br> una Conferma, ricavando i dati dalla e-mail di Copia Conferma<br> che avete ricevuto.<br>E solo dopo potete cancellare questa che è incompleta!<br><b>Stiamo lavorando perchè non accada più!<b></div>"></i> '.$RequestProposta;
    }
}


function abilita_invio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET AbilitaInvio = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_invio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET AbilitaInvio = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_evento($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_eventi SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_evento($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_eventi SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_pdi($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_pdi SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_pdi($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_pdi SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function get_invio($value, $fieldname, $primary_key, $row, $xcrud){

    if($value){
        $value = date('d-m-Y' , strtotime($value));
        $db = Xcrud_db::get_instance();
        $query = 'SELECT * FROM hospitality_guest  WHERE Id = ' . $primary_key;
        $result = $db->query($query);
        $record = $db->row($result);

        return '<small style=" white-space: nowrap;">'.$value.($record['MetodoInvio']!=''?'<br /><small>Tramite: '.$record['MetodoInvio'].'</small>':'').'</small>';
    }else{
        return '<small class="text-green" style=" white-space: nowrap;"><small>Da Inviare</small></small>';
    }
}
/**
 * [get_scadenza description]
 * @return [type]  [se la data è minore ad oggi in rosso e si blocca  invio email, se maggiore normale, se non impostata allora segnale di impostarla]
 */
function get_scadenza($value, $fieldname, $primary_key, $row, $xcrud){

    if($value){
        if($value < date('Y-m-d')){
            $value = date('d-m-Y' , strtotime($value));
            $value_input = date('d/m/Y' , strtotime($value));
            // disabilito invio email perchè la scadenza è passata ( solo per i preventivi)
            $db = Xcrud_db::get_instance();
            $query = 'UPDATE hospitality_guest SET AbilitaInvio = 0 WHERE Id = '.$primary_key;
            $db->query($query);
            return '
            <a href="javascript:;" class="editable editable-click" id="data_scadenza'.$primary_key.'" data-toggle="modal" data-target="#myModal'.$primary_key.'" title="Re-imposta la data di scadenza"><small class="text-red" style="white-space: nowrap;">'.$value.'</small></a>
                                <div class="modal fade" id="myModal'.$primary_key.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <form id="form_data'.$primary_key.'" name="form_data" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/preventivi/">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Re-imposta la data di scadenza</h4>
                              </div>
                              <div class="modal-body">

                                    <div class="control-group">
                                        <label for="DataScadenza" class="control-label">Data Scadenza</label>
                                        <div class="controls">
                                            <div class="input-group">
                                                <label for="DataScadenza" class="input-group-addon btn">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </label>
                                                <input id="DataScadenza'.$primary_key.'" name="DataScadenza" value="'.$value_input.'" type="text" class="form-control" autocomplete="off" required/>
                                            </div>
                                        </div>
                                        <style>.ui-datepicker{z-index:99999!important;}</style>
                                        <script>
                                            $(function() {
                                                $( "#DataScadenza'.$primary_key.'" ).datepicker({
                                                        numberOfMonths: 1,
                                                        language:\'it\',
                                                        showButtonPanel: true
                                                    });
                                                });
                                        </script>
                                    </div>
                                      <input type="hidden" name="idrichiesta" value="'.$primary_key.'">
                                      <input type="hidden" name="action" value="send_data">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                                    <button type="submit"  class="btn btn-primary"><span id="txt_save'.$primary_key.'">Salva</span></button>
                                  </div>
                              </form>
                              <script>
                                $( document ).ready(function() {
                                    $("#form_data'.$primary_key.'").on("submit",function(){
                                        $("#txt_save'.$primary_key.'").html(\'<i class="fa fa-spinner fa-pulse"></i>\');
                                    });
                                });
                              </script>
                            </div>
                          </div>
                        </div> ';


        }else{
            $value = date('d-m-Y' , strtotime($value));
            return '<small style="white-space: nowrap;">'.$value.'</small>';
        }
    }else{
        return '<small class="text-red" style=" white-space: nowrap;"><small>Scadenza<br>da impostare</small></small>';

    }
}

function func_chat($value, $fieldname, $primary_key, $row, $xcrud){

        $new_chat = '';
        $chat = '';
        $command = '';
        $db = Xcrud_db::get_instance();
        $q = $db->query('select * from hospitality_chat where NumeroPrenotazione = '.$row['hospitality_guest.NumeroPrenotazione'].' AND idsito = '.$row['hospitality_guest.idsito'].' ORDER by data DESC');
        $rec = $db->row($q);
        if(is_array($rec)) {
            if($rec > count($rec)) // se la pagina richiesta non esiste
                $tot = count($rec); // restituire la pagina con il numero più alto che esista
        }else{
            $tot = 0;
        }
        if($tot > 0){
                 if($rec['operator']==0){
                    $new_chat = '<i class="fa fa-spinner fa-pulse"></i>';
                    $title = 'Rispondi alla Chat';
                }else{
                    $new_chat = '';
                    $title = 'Discussione Chat';
                }

                $chat = ' <form id="form_c'.$rec['id'].'" name="form_c" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/chat/" >
                                  <input type="hidden" name="id_guest" value="'.$primary_key.'">
                                  <input type="hidden" name="NumeroPrenotazione" value="'.$row['hospitality_guest.NumeroPrenotazione'].'">
                                  <button type="submit" class="btn btn-info btn-xs" data-toggle="tooltip" title="'.$title.'">'.$new_chat.' Chat</button>
                        </form>';
        }else{
            if($row['hospitality_guest.DataInvio'] != ''){
                if($row['hospitality_guest.DataScadenza'] >= date("Y-m-d")){
                    $chat = '<form id="form_c'.$rec['id'].'" name="form_c" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/chat/" >
                                    <input type="hidden" name="id_guest" value="'.$primary_key.'">
                                    <input type="hidden" name="NumeroPrenotazione" value="'.$row['hospitality_guest.NumeroPrenotazione'].'">
                                    <button type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" title="Apri una Chat"><i class="fa fa-comments-o"></i> Apri Chat</button>
                            </form>';
                }
            }
            if(($row['hospitality_guest.DataChiuso']!= '')  && ($row['hospitality_guest.DataArrivo'] > date('Y-m-d'))){

                $chat =  '<form id="form_c'.$rec['id'].'" name="form_c" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/chat/" >
                                <input type="hidden" name="id_guest" value="'.$primary_key.'">
                                <input type="hidden" name="NumeroPrenotazione" value="'.$row['hospitality_guest.NumeroPrenotazione'].'">
                                <button type="submit" class="btn btn-success btn-xs" data-toggle="tooltip" title="Apri una Chat"><i class="fa fa-comments-o"></i> Apri Chat</button>
                        </form>';
         
            }
        }

        return $chat;
}
function func_chat_riepilogo($value, $fieldname, $primary_key, $row, $xcrud){

        $new_chat = '';
        $db = Xcrud_db::get_instance();
        $q = $db->query('select * from hospitality_chat where NumeroPrenotazione = '.$row['hospitality_guest.NumeroPrenotazione'].' AND idsito = '.$row['hospitality_guest.idsito'].'  ORDER by data DESC');
        $rec = $db->row($q);
        if(is_array($rec)) {
            if($rec > count($rec)) // se la pagina richiesta non esiste
                $tot = count($rec); // restituire la pagina con il numero più alto che esista
        }else{
            $tot = 0;
        }
        if($tot > 0){
            $chat = ' <form id="form_cr'.$rec['id'].'" name="form_cr" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/riepilogo_chat/" >
                              <input type="hidden" name="NumeroPrenotazione" value="'.$row['hospitality_guest.NumeroPrenotazione'].'">
                              <input type="hidden" name="id_guest" value="'.$rec['id_guest'].'">
                              <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Riepilogo discussione in Chat" ><i class="fa fa-comments-o" aria-hidden="true"></i> Talk</button>
                    </form>';

        return $chat;
        }

}

function movetop($xcrud)
{

    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');

        $db = Xcrud_db::get_instance();
        $query = 'SELECT Id FROM `hospitality_tipo_pagamenti` WHERE idsito = '.$_SESSION['IDSITO'].' ORDER BY `Ordine`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['Id'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `hospitality_tipo_pagamenti` SET `Ordine` = ' . $key . ' WHERE Id = '.$item['Id'].' AND idsito = '.$_SESSION['IDSITO'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{

    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');

        $db = Xcrud_db::get_instance();
        $query = 'SELECT Id FROM `hospitality_tipo_pagamenti` WHERE idsito = '.$_SESSION['IDSITO'].' ORDER BY `Ordine`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['Id'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `hospitality_tipo_pagamenti` SET `Ordine` = ' . $key . ' WHERE Id = '.$item['Id'].' AND idsito = '.$_SESSION['IDSITO'];
            $db->query($query);
        }
    }
}


function abilita_domanda($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_domande SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_domanda($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_domande SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function func_stelline($value, $fieldname, $primary_key, $row, $xcrud){

    switch($value){
        case 1:
            $ico = '<div align="center"><i class="fa fa-star text-yellow"></i></div>';
        break;
        case 2:
            $ico = '<div align="center"><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i></div>';
        break;
        case 3:
            $ico = '<div align="center"><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i></div>';
        break;
        case 4:
            $ico = '<div align="center"><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i></div>';
        break;
        case 5:
            $ico = '<div align="center"><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i></div>';
        break;
    }

    return $ico;


}

function func_cc($value, $fieldname, $primary_key, $row, $xcrud){

        $pul_cc = '';
        $check_cambio = '';
        $db = Xcrud_db::get_instance();

        $quy = $db->query('SELECT * FROM hospitality_cambio_pagamenti WHERE id_richiesta = '.$primary_key.' AND idsito = '.$_SESSION['IDSITO']." ORDER BY Id DESC");
        $arr = $db->result($quy);
        $check_cambio = sizeof($arr); 


        $q = $db->query('SELECT * FROM hospitality_carte_credito WHERE id_richiesta = '.$primary_key.' AND idsito = '.$_SESSION['IDSITO']);
        $rec = $db->row($q);
        if(is_array($rec)) {
            if($rec > count($rec)) 
                $tot = count($rec); 
        }else{
            $tot = 0;
        }
        if($tot > 0){
            $pul_cc = ' <form id="form_cc'.$rec['Id'].'" name="form_cc" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/carta_credito/" >
                              <input type="hidden" name="id_richiesta" value="'.$rec['id_richiesta'].'#'.$check_cambio.'">
                              <button type="submit" class="btn btn-success btn-xs" data-toogle="tooltip" title="'.($check_cambio > 1 ? 'pagamento cambiato con ' : '').'Carta di Credito" >'.($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '').'<i class="fa fa-credit-card fa-fw"></i></button>
                    </form>';


        }else{
            $qy = $db->query('SELECT * FROM hospitality_altri_pagamenti WHERE id_richiesta = '.$primary_key.' AND idsito = '.$_SESSION['IDSITO']);
            $res = $db->row($qy);
            $icona = '';
            $color = '';
            $title = '';
            if(is_array($res)) {
                if($res > count($res)) 
                    $totP = count($res); 
            }else{
                $totP = 0;
            }
            if($totP > 0){

                if($res['TipoPagamento']=='Bonifico'){

                    if($res['ricevuta']!='' || $res['CRO'] != ''){
                        $color = 'btn-success';
                        $style = '';
                        $title = 'Ricevuto ';
                    }else{
                        $color = 'btn-danger';
                        $style = '';
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-university fa-fw"></i>';

                }elseif($res['TipoPagamento']=='Vaglia Postale'){

                    if($res['ricevuta']!=''){
                        $color = 'btn-success';
                        $style = '';
                        $title = 'Ricevuto ';
                    }else{
                        $color = 'btn-danger';
                        $style = '';
                        $title = 'In attesa di ';
                    }

                    $icona = '<i class="fa fa-euro fa-fw"></i>';

                }elseif($res['TipoPagamento']=='PayPal'){

                    $color = 'btn-success';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<i class="fa fa-paypal fa-fw"></i>';

                }elseif($res['TipoPagamento']=='Gateway Bancario'){

                    $color = 'btn-default';
                    $style = '';
                    $title = 'Pagamento ricevuto con ';
                    $icona = '<img src="https://'.$_SERVER['HTTP_HOST'].'/v2/img/logo-bcc.png">';

                }elseif($res['TipoPagamento']=='Gateway Bancario Virtual Pay'){

                      $color = 'btn-warning';
                      $style = '';
                      $title = 'Pagamento ricevuto con ';
                      $icona = '<i class="fa fa-credit-card fa-fw" data-toogle="tooltip" title="Virtual Pay"></i>';

                }elseif($res['TipoPagamento']=='Stripe'){

                        $color = '';
                        $style = 'style="background-color:#0073b7!important;width:28px!important;height:22px!important"';
                        $title = 'Pagamento ricevuto con ';
    
                        $icona = '<img src="https://'.$_SERVER['HTTP_HOST'].'/v2/img/ico-stripe.png">';

                }elseif($res['TipoPagamento']=='Nexi'){

                        $color = '';
                        $style = 'style="background-color:#6486c4!important;width:28px!important;height:22px!important"';
                        $title = 'Pagamento ricevuto con ';
    
                        $icona = '<img src="https://'.$_SERVER['HTTP_HOST'].'/v2/img/ico-xpay.png">';
                }

                $pul_cc = ' <form id="form_cc'.$primary_key.'" name="form_cc" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/pagamento/" >
                                  <input type="hidden" name="id_richiesta" value="'.$res['id_richiesta'].'#'.$check_cambio.'">
                                  <button type="submit" class="btn '.$color.' btn-xs" '.$style.' data-toogle="tooltip" title="'.($check_cambio > 1 ? 'Il tipo di pagamento è stato cambiato con '.$res['TipoPagamento'] : $title.$res['TipoPagamento']).'">'.($check_cambio > 1 ? '<i class="fa fa-refresh fa-spin fa-fw"></i>' : '').''.$icona.'</button>
                        </form>';


            }
        }

        return $pul_cc;
}
function check_quest($value, $fieldname, $primary_key, $row, $xcrud){

        $pul_cc = '';
        $db = Xcrud_db::get_instance();
        $q = $db->query('select cs_inviato from hospitality_guest where Id = '.$primary_key.'');
        $rec = $db->row($q);
        if($rec['cs_inviato'] == 0){
            $check = '<i class="fa fa-thumbs-o-down text-red" data-toggle="tooltip" title="Questionario Non Inviato"></i>';
        }else{
            $db = Xcrud_db::get_instance();
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "CsSend" ORDER BY Id DESC');
            $rec = $db->row($q);
            if(is_array($rec)) {
                if($rec > count($rec)) // se la pagina richiesta non esiste
                    $tot = count($rec); // restituire la pagina con il numero più alto che esista
            }else{
                $tot = 0;
            }
            if($tot>0){
                $DataA_tmp      = explode(' ',$rec['DataAzione']);
                $DataAzione_tmp = explode('-',$DataA_tmp[0]);
                $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
                $check = '<i class="fa fa-thumbs-o-up text-green" data-toggle="tooltip" title="Invio Questionario automatico avvenuto il '.$DataAzione.'"></i>';
            }else{
                $check = '<i class="fa fa-thumbs-o-up text-green" data-toggle="tooltip" title="Questionario Inviato"></i>';
            }

        }
        return $check;
}
function date_it($value,$xcrud)
{
    if($value != '') {
       $value = date('d-m-Y' , strtotime($value));
    }else{
        $value = '';
    }
    return '<small>'.$value.'</small>';
}
/**
 * [funzione solo per il controllo delle date dalla schermata delle conferme]
 * @return [type]  [se la data è minore ad oggi in rosso, se maggiore normale, se non impostata allora form per impostarla]
 */
function data_scadenza($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        if($value < date('Y-m-d')){
            $value = date('d-m-Y' , strtotime($value));
            $value_input = date('d/m/Y' , strtotime($value));
            return '<a href="javascript:;"  data-toggle="modal" data-target="#myModal'.$primary_key.'" title="Re-imposta la data del pagamento caparra"><small class="text-red">'.$value.'</small></a>
                <div class="modal fade" id="myModal'.$primary_key.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form id="form_data'.$primary_key.'" name="form_data" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/conferme/">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Re-imposta la data di scadenza per il pagamento della caparra</h4>
                      </div>
                      <div class="modal-body">
                            <div class="control-group">
                                <label for="DataScadenza" class="control-label">Data Scadenza</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataScadenza" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataScadenza'.$primary_key.'" name="DataScadenza" value="'.$value_input.'" type="text" class="form-control" autocomplete="off" required/>
                                    </div>
                                </div>
                                <style>.ui-datepicker{z-index:99999!important;}</style>
                                <script>
                                    $(function() {

                                        $( "#DataScadenza'.$primary_key.'" ).datepicker({
                                                numberOfMonths: 1,
                                                language:\'it\',
                                                showButtonPanel: true
                                            });
                                        });
                                </script>
                            </div>
                              <input type="hidden" name="idrichiesta" value="'.$primary_key.'">
                              <input type="hidden" name="action" value="send_data">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary"><span id="txt_save'.$primary_key.'">Salva</span></button>
                          </div>
                      </form>
                      <script>
                      $( document ).ready(function() {
                          $("#form_data'.$primary_key.'").on("submit",function(){
                              $("#txt_save'.$primary_key.'").html(\'<i class="fa fa-spinner fa-pulse"></i>\');
                          });
                      });
                    </script>
                    </div>
                  </div>
                </div>';
       }else{
            $value = date('d-m-Y' , strtotime($value));
            return '<small>'.$value.'</small>';
       }

    }else{
        return ' <div align="center"><!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal'.$primary_key.'" title="Impostare data pagamento della caparra">
                  <i class="fa fa-calendar"></i>
                </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal'.$primary_key.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Imposta la data di scadenza per il pagamento della caparra</h4>
                      </div>
                      <div class="modal-body">
                        <form id="form_data'.$primary_key.'" name="form_data" method="post" action="https://'.$_SERVER['HTTP_HOST'].'/v2/conferme/">
                            <div class="control-group">
                                <label for="DataScadenza" class="control-label">Data Scadenza</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <label for="DataScadenza" class="input-group-addon btn">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </label>
                                        <input id="DataScadenza'.$primary_key.'" name="DataScadenza" value="'.$value.'" type="text" class="form-control" autocomplete="off" required/>
                                    </div>
                                </div>
                                <style>.ui-datepicker{z-index:99999!important;}</style>
                                <script>
                                    $(function() {

                                        $( "#DataScadenza'.$primary_key.'" ).datepicker({
                                                numberOfMonths: 1,
                                                language:\'it\',
                                                showButtonPanel: true
                                            });
                                        });
                                </script>
                            </div>
                              <input type="hidden" name="idrichiesta" value="'.$primary_key.'">
                              <input type="hidden" name="action" value="send_data">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary"><span id="txt_save'.$primary_key.'">Salva</span></button>
                          </div>
                      </form>
                      <script>
                      $( document ).ready(function() {
                          $("#form_data'.$primary_key.'").on("submit",function(){
                              $("#txt_save'.$primary_key.'").html(\'<i class="fa fa-spinner fa-pulse"></i>\');
                          });
                      });
                    </script>
                    </div>
                  </div>
                </div>';
    }

}
function textarea_input($value, $fieldname, $primary_key, $row, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $q = $db->query('SELECT * from hospitality_dizionario_lingua where id = '.$row['primary_key'].'');
    $rec = $db->row($q);

    if($rec['textarea'] == 1){

        return  '  <textarea id="TEXT'.$row['primary_key'].'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
                .'    '.$value.' '
                .'  </textarea>  '
                .'  <script type="text/javascript">'
                .'      $(function(){ '
                .'         CKEDITOR.replace("TEXT'.$row['primary_key'].'");'
                .'         $(".textarea").wysihtml5(); '
                .'     });'
                .'  </script>'
                .'  <script type="text/javascript">'
                .'        CKEDITOR.config.toolbar = ['
                .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
                .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
                .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
                .'                       [\'Table\',\'Link\',\'Image\']'
                .'                    ] ;'
                .'        CKEDITOR.config.autoGrow_onStartup = true;'
                .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
                .'        CKEDITOR.config.autoGrow_minHeight = 200;'
                .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
                .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
                .'  </script>';
    }else{
        return '<textarea name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input form-control" style="width:100%!important" >'.$value.'</textarea>';
    }

}
function bg_tipo($value, $fieldname, $primary_key, $row, $xcrud)
{
    switch($value) {
        case 'Family':
             $ico = '<small class="label bg-green">'.$value.'</small>';
        break;
        case 'Business':
             $ico = '<small class="label bg-red">'.$value.'</small>';
        break;
        case 'Fiera':
             $ico = '<small class="label bg-black">'.$value.'</small>';
        break;
        case 'Benessere':
             $ico = '<small class="label bg-light-blue">'.$value.'</small>';
        break;
        case 'Bike':
             $ico = '<small class="label bg-aqua">'.$value.'</small>';
        break;
        case 'Sport':
             $ico = '<small class="label bg-purple">'.$value.'</small>';
        break;
        case 'Divertimento':
             $ico = '<small class="label bg-maroon">'.$value.'</small>';
        break;
        case 'Romantico':
             $ico = '<small class="label bg-navy">'.$value.'</small>';
        break;
        case 'Culturale':
             $ico = '<small class="label bg-fuchsia">'.$value.'</small>';
        break;
        case 'Enogastronomico':
             $ico = '<small class="label bg-lime">'.$value.'</small>';
        break;
        default:
             $ico = '<small class="label bg-blue">'.$value.'</small>';
        break;
    }
    return $ico;
}


function bg_fonte($value, $fieldname, $primary_key, $row, $xcrud)
{
    $multi = '';
    
    $db = Xcrud_db::get_instance();
    $q = $db->query('SELECT MultiStruttura FROM hospitality_guest WHERE Id = '.$primary_key.'');
    $rec = $db->row($q);

        if(strstr($rec['MultiStruttura'],'?')){

            $multi_ =  explode('?',$rec['MultiStruttura']);
            $multi = $multi_[1];

            if(strstr($multi,'&')){
                $multi_ =  explode('&',$rec['MultiStruttura']);
                $multi = $multi_[1];
            }else{
                $multi = $rec['MultiStruttura'];
            }

            if(strstr($multi,'=')){
                $multi_ =  explode('=',$rec['MultiStruttura']);
                $multi = $multi_[1];
            }else{
                $multi = $rec['MultiStruttura'];
            }

        }elseif(strstr($rec['MultiStruttura'],'&')){

            $multi_ =  explode('&',$rec['MultiStruttura']);
            $multi = $multi_[1];

            if(strstr($multi,'?')){
                $multi_ =  explode('&',$rec['MultiStruttura']);
                $multi = $multi_[1];
            }else{
                $multi = $rec['MultiStruttura'];
            }

            if(strstr($multi,'=')){
                $multi_ =  explode('=',$rec['MultiStruttura']);
                $multi = $multi_[1];
            }else{
                $multi = $rec['MultiStruttura'];
            }

        }else{

             $multi = $rec['MultiStruttura'];
            
        }

        if(strstr($rec['MultiStruttura'],'captcha=error')){
            $multi_ =  explode('?',$rec['MultiStruttura']);
            $multi = $multi_[0];
        }

       $propertyId = $_SESSION['PROPERTY_ID_ANALYTICS_GA4'] ;


    switch($value) {
        case 'Reception':
             $ico = '<small class="label bg-teal">'.$value.'</small>';
        break;
        case 'Sito Web':
             $ico = '<small class="label bg-yellow"><a href="javascript:;" class="xcrud_modal" title="Percorso referer" data-header="Percorso di provenienza dettagliato!" data-content="<iframe height=\'20px\' width=\'100%\' frameborder=\'0\' scrolling=\'no\' allowtransparency=\'true\' src=\'https://'.$_SERVER['HTTP_HOST'].'/v2/'.($propertyId != ''?'referer_GA4':'referer').'/'.$row['hospitality_guest.NumeroPrenotazione'].'/\'></iframe><iframe height=\'30px\' width=\'100%\' frameborder=\'0\' scrolling=\'no\' allowtransparency=\'true\' src=\'https://'.$_SERVER['HTTP_HOST'].'/v2/referer_utm/'.$row['hospitality_guest.NumeroPrenotazione'].'/\'></iframe>">'.$value.' /Landing</a></small>'.($rec['MultiStruttura']!=''?'<br><small><small>'.(strlen($multi)<=30?$multi:substr($multi,0,30).'...').'</small></small>':'').'';
        break;
        case 'Info Alberghi':
             $ico = '<small class="label bg-purple">'.$value.'</small>';
        break;
        case 'gabiccemare.com':
             $ico = '<small class="label bg-red">'.$value.'</small>';
        break;
        case 'italyfamilyhotels.it':
            $ico = '<small class="label bg-green">'.$value.'</small>';
        break;
        case 'familygo.eu':
            $ico = '<small class="label bg-primary">'.$value.'</small>';
        break;
        case 'italybikehotels.it':
            $ico = '<small class="label bg-red">'.$value.'</small>';
        break;
        case 'Altro':
             $ico = '<small class="label bg-black">'.$value.'</small>';
        break;
        case '':
             $ico = '<small class="label bg-fuchsia">Da impostare</small>';
        break;
        default:
             $ico = '<small class="label bg-blue">'.$value.'</small>';
        break;

    }
    return $ico;
}
function si_no($value)
{
    if($value == 0) {
        $valore = '<small align="center" class="badge bg-red">No</small>' ;
    }else{
        $valore = '<small align="center" class="badge bg-green">Si</small>' ;
    }
    return $valore;
}
function bg_richiesta($value)
{
    switch($value) {
        case 'Preventivo':
             $val = '<small class="label bg-navy">'.$value.'</small>';
        break;
        case 'Conferma':
             $val = '<small class="label bg-blue">'.$value.'</small>';
        break;
    }
    return $val;
}
function dateDiffNotti($data1,$data2,$formato) {
    $datetime1 = new DateTime($data1);
    $datetime2 = new DateTime($data2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format($formato);
}

function dettaglio($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,hospitality_guest.TipoRichiesta,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key." ORDER BY hospitality_proposte.Id ASC";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere          = '';
        $acconto         = '';
        $saldo           = '';
        $etichetta_saldo = '';
        $n               = 1;
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        foreach ($res as $key => $value) {

            $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
            $IdProposta         = $value['IdProposta'];
            $PrezzoPC           = $value['PrezzoP'];
            $AccontoRichiesta   = $value['AccontoRichiesta'];
            $AccontoLibero      = $value['AccontoLibero'];
            $NomeProposta       = $value['NomeProposta'];
            $Operatore          = stripslashes($value['ChiPrenota']);
            $Nome               = stripslashes($value['Nome']);
            $Cognome            = stripslashes($value['Cognome']);
            $Email              = $value['Email'];
            $NumeroAdulti       = $value['NumeroAdulti'];
            $NumeroBambini      = $value['NumeroBambini'];
            $EtaBambini1        = $value['EtaBambini1'];
            $EtaBambini2        = $value['EtaBambini2'];
            $EtaBambini3        = $value['EtaBambini3'];
            $EtaBambini4        = $value['EtaBambini4'];
            $EtaBambini5        = $value['EtaBambini5'];
            $EtaBambini6        = $value['EtaBambini6'];
            $Arrivo_tmp         = explode("-",$value['DataArrivo']);
            $Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp       = explode("-",$value['DataPartenza']);
            $Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $AccontoPercentuale = $value['AccontoPercentuale'];
            $AccontoImporto     = $value['AccontoImporto'];
            $AccontoTesto       = stripslashes($value['AccontoTesto']);

            $start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);

            $formato="%a";
            $Notti = dateDiffNotti($value['DataArrivo'],$value['DataPartenza'],$formato);

            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $db->query($se);
            $rc = $db->row($re);
            if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $formato="%a";
                $DNotti = dateDiffNotti($rc['Arrivo'],$rc['Partenza'],$formato);
            }
            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $saldo   = ($PrezzoPC-$AccontoLibero);
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                if($AccontoImporto >= 1) {
                    $etichetta_caparra  = '';
                }else{
                    $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                }
                $saldo   = ($PrezzoPC-$AccontoImporto);
                $acconto = number_format($AccontoImporto,2,',','.');
            }
            if($PrezzoPC==$saldo){
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
            }else{
                if($AccontoPercentuale == 0 && $AccontoImporto <= 1) {
                    $saldo   = $PrezzoPC;
                }
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
            }

            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta." AND hospitality_richiesta.id_richiesta = ".$primary_key;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != ''){
                if($value['TipoRichiesta']=='Preventivo'){
                    if($Arrivo != $DArrivo || $Partenza != $DPartenza){
                        $data_alernativa = '<b>Date alternative</b><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$DArrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$DPartenza.' - per notti: '.$DNotti.'<br>';
                    }
                }elseif($value['TipoRichiesta']=='Conferma'){
                    if($rc['Arrivo']!= $value['DataArrivo']){
                        $Arrivo   = $DArrivo;
                        $Notti    = $DNotti;
                    }
                    if($rc['Partenza']!= $value['DataPartenza']){
                        $Partenza   = $DPartenza;
                        $Notti    = $DNotti;
                    }
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }
            if($value['TipoRichiesta']=='Preventivo'){
                $sistemazione .= '<b>'.$n.') PROPOSTA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br>'.$data_alernativa.$Camere.'  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  '.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br />';
            }else{
                $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$data_alernativa.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br>'.$etichetta_saldo.'<br>';
            }
        $n++;
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';

        }
            $sistemazione = str_replace('"',' ',$sistemazione);
            $sistemazione .= '<div style=\'float:right\'><a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Stampa PDF</a> '.($value['TipoRichiesta']=='Preventivo'?'<a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/duplica_preventivo/'.$primary_key.'/now/\' class=\'btn btn-primary btn-xs\'>Ri-crea Preventivo con questi dati</a>':'').'</div><br>';
        return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="'.($value['TipoRichiesta']=='Preventivo'?'Preventivo Proposto '.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore '.$Operatore:'Proposte confermate Nr.'.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore '.$Operatore).'" data-content="'.$sistemazione.'" class="xcrud_modal label bg-black">Dettaglio</a>';
    }else{
        return '';
    }

}
function change_value($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        $valore = str_replace("_"," ",$value);
        $valore = strtolower($valore);
        $valore = ucwords($valore);
    }
    return $valore;
}
function change_vaucher($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        $valore = str_replace("_"," ",$value);
        $valore = strtolower($valore);
        $valore = ucwords($valore);
        $valore = str_replace("Vaucher", "Voucher",$valore);
    }
    return $valore;
}
function gia_presente($value, $fieldname, $primary_key, $row, $xcrud){
    $db = Xcrud_db::get_instance();
    $select = "SELECT Cognome FROM hospitality_guest
                WHERE Nome = '".addslashes($value)."' AND Cognome = '".addslashes($row['hospitality_guest.Cognome'])."' AND TipoRichiesta = 'Preventivo' AND idsito = ".$_SESSION['IDSITO'];
    $result = $db->query($select);
    $res    = $db->result($result);
    if(sizeof($res)>1){
        return '<small style=" white-space: nowrap;"><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b> <i class="fa fa-star text-red" style="font-size:60%!important"></i></small>';
    }else{
        return '<small><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b></small>';
    }
}
function gia_presente_conf($value, $fieldname, $primary_key, $row, $xcrud){
    $db = Xcrud_db::get_instance();
    $select = "SELECT Cognome FROM hospitality_guest
                WHERE Nome = '".addslashes($value)."' AND Cognome = '".addslashes($row['hospitality_guest.Cognome'])."' AND TipoRichiesta = 'Conferma' AND Chiuso = 0 AND idsito = ".$_SESSION['IDSITO'];
    $result = $db->query($select);
    $res    = $db->result($result);
    if(sizeof($res)>1){
        return '<small style=" white-space: nowrap;"><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b> <i class="fa fa-star text-red" style="font-size:60%!important"></i></small>';
    }else{
        return '<small><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b></small>';
    }
}
function gia_presente_chiuse($value, $fieldname, $primary_key, $row, $xcrud){
    $db = Xcrud_db::get_instance();
    $select = "SELECT Cognome FROM hospitality_guest
                WHERE Nome = '".addslashes($value)."' AND Cognome = '".addslashes($row['hospitality_guest.Cognome'])."' AND TipoRichiesta = 'Conferma' AND Chiuso = 1 AND idsito = ".$_SESSION['IDSITO'];
    $result = $db->query($select);
    $res    = $db->result($result);
    if(sizeof($res)>1){
        return '<small style=" white-space: nowrap;"><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b> <i class="fa fa-star text-red" style="font-size:60%!important"></i></small>';
    }else{
        return '<small><b>'.$value.' '.stripslashes($row['hospitality_guest.Cognome']).'</b></small>';
    }
}
function ico_mail($value, $fieldname, $primary_key, $row, $xcrud){

    if($value){
        return '<a href="mailto:'.$value.'?subject=Rif.Numero '.$row['hospitality_guest.NumeroPrenotazione'].'"><i class="fa fa-envelope text-green" title="'.$value.'"  data-toogle="tooltip"></i></a>';
    }
}
function textarea_doc($value, $fieldname, $primary_key, $row, $xcrud)
{

    return  '  <textarea id="'.$xcrud->fieldname_encode($fieldname).'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'    '.$value.' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("'.$xcrud->fieldname_encode($fieldname).'");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';
}
function textarea_img($value, $fieldname, $primary_key, $row, $xcrud)
{

    return  '  <textarea id="'.$xcrud->fieldname_encode($fieldname).'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'    '.$value.' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("'.$xcrud->fieldname_encode($fieldname).'");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\',\'Image\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';
}
function textarea_count($value, $fieldname, $primary_key, $row, $xcrud)
{

    return  ' <div class="alert alert-success">'
            .'     <p>E\' consigliabile rimanere entro i <b>150 caratteri di battitura</b>, tenete sotto controllo il numero di battute dall\'apposito campo sulla toolbar <i class="fa fa-level-down" style="position:relative;padding-left:10px;transform:rotate(65deg);margin-bottom:-20px"></i></p>'
            .'  </div>'
            .' <textarea  id="'.$xcrud->fieldname_encode($fieldname).'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'    '.$value.' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("'.$xcrud->fieldname_encode($fieldname).'", {extraPlugins: \'charcount\', maxLength: 151, toolbar: \'TinyBare\', toolbar_TinyBare: [[\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],[\'Bold\',\'Italic\',\'Underline\'],[\'Undo\',\'Redo\'],[\'Cut\',\'Copy\',\'Paste\'],[\'NumberedList\',\'BulletedList\',\'Table\',\'Link\'],[\'CharCount\']] });'
            .'        $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>';
}
function strips($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
       $value =  stripslashes($value);
    }
     return $value;
}
function strips_small_b($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
       $value =  stripslashes($value);
    }
     return '<small><b>'.$value.'</b></small>';
}
function abilita_imap($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_imap_email SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_imap($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_imap_email SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_txt_precheckin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_precheckin SET abilitato = \'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_txt_precheckin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_precheckin SET abilitato = \'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function invio_si_no($value, $fieldname, $primary_key, $row, $xcrud){
    if($value==1){
       $valore =  '<span class="text-green">I contenuti sono abilitati all\'invio</span>';
    }else{
        $valore =  '<span class="text-red">I contenuti non sono abilitati all\'invio</span>';
    }
    return $valore;
}
function listino_si_no($value, $fieldname, $primary_key, $row, $xcrud){
    if($value==1){
       $valore =  '<span class="text-green">Il listino è attivo!</span>';
    }else{
        $valore =  '<span class="text-red">Il listino non è attivo!</span>';
    }
    return $valore;
}
function send_cs($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendCS = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function nosend_cs($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendCS = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function send_info($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendInfo = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function nosend_info($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendInfo = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_simplebooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_simplebooking SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_simplebooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_simplebooking SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_ericsoftbooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_ericsoftbooking SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_ericsoftbooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_ericsoftbooking SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function flag_booking($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        return '<small style="white-space:nowrap;">'.$value.' &nbsp;<span class="text-red">Sync da SB</span></small>';
    }else{
        return '<small style="white-space:nowrap;" class="text-green">Impostato da QUOTO!</small>';
    }
}
function flag_ericsoftbooking($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        return '<small style="white-space:nowrap;">'.$value.' &nbsp;<span class="text-red">Sync da EricsoftB</span></small>';
    }else{
        return '<small style="white-space:nowrap;" class="text-green">Impostato da QUOTO!</small>';
    }
}
function abilita_info($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_infohotel SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_info($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_infohotel SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disdetta($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Disdetta = \'1\', SendInfo = \'0\', visibile = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function no_disdetta($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Disdetta = \'0\', SendInfo = \'1\', visibile = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function CheckTipoRichiesta($value, $fieldname, $primary_key, $row, $xcrud)
{
        $db  = Xcrud_db::get_instance();
        $rec = $db->query("SELECT Chiuso,DataValiditaVoucher FROM hospitality_guest  WHERE Id = ".$primary_key);
        $row = $db->row($rec);

        if($value=='Preventivo'){
            $val = '<small class="label bg-navy">'.$value.'</small>';
        }else{
            if($row['Chiuso']=='1'){
                 $val = '<small class="label bg-green">Prenotazione Confermata</small>';
            }else{
                $val = '<small class="label bg-blue">'.$value.' in trattativa</small>';
            }
        }
        if(!is_null($row['DataValiditaVoucher']) && $row['DataValiditaVoucher'] != '' && $row['DataValiditaVoucher'] != '0000-00-00'){
            $buono = '<br><small class="label bg-teal" style="font-size:10px!important">Buono Voucher</small>';
        }else{
            $buono = '';
        }

    return $val.$buono;
}
function get_archivio($value, $fieldname, $primary_key, $row, $xcrud){

    $db  = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.NomeProposta, hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_guest.Nome,hospitality_guest.Cognome,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.AccontoLibero,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota,
                        hospitality_guest.TipoRichiesta,hospitality_guest.Chiuso,hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.id_template
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key." ORDER BY hospitality_proposte.Id ASC";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere        = '';
        $n             = 1;
        $TipoRichiesta = '';
        $Chiuso        = '';
        $Adulti        = '';
        $Bambini       = '';
        $IdTemplate    = '';
        $Template      = '';
        foreach ($res as $key => $value) {

            $TipoRichiesta    = $value['TipoRichiesta'];
            $Chiuso           = $value['Chiuso'];

            $PrezzoL          = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP          = number_format($value['PrezzoP'],2,',','.');
            $Adulti           = $value['NumeroAdulti'];
            $Bambini          = $value['NumeroBambini'];
            $IdProposta       = $value['IdProposta'];
            $AccontoRichiesta = $value['AccontoRichiesta'];
            $AccontoLibero    = $value['AccontoLibero'];
            $NomeProposta     = $value['NomeProposta'];
            $Operatore        = stripslashes($value['ChiPrenota']);
            $Nome             = stripslashes($value['Nome']);
            $Cognome          = stripslashes($value['Cognome']);
            $Email            = $value['Email'];
            $Arrivo_tmp       = explode("-",$value['DataArrivo']);
            $Arrivo           = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp     = explode("-",$value['DataPartenza']);
            $Partenza         = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $IdTemplate       = $value['id_template'];
            $start         = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end           = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $Notti            = ceil(abs($end - $start) / 86400);

            $marzo              = mktime(24,0,0,03,01,2020);
            $marzo2             = mktime(01,0,0,03,31,2020);
            $aprile             = mktime(24,0,0,04,01,2020);
            $aprile2            = mktime(01,0,0,04,30,2020);
            if(($start >= $marzo && $start <= $marzo2) && ($end >= $aprile && $end <= $aprile2)){
                $Notti = ($Notti+1);
            }else{
                $Notti = $Notti;
            }

            if(is_null($IdTemplate) || $IdTemplate == 0){
                $Template = 'Predefinito';
            }else{
                $sel      = "SELECT TemplateName,TemplateType FROM hospitality_template_background  WHERE Id = ".$IdTemplate;
                $res      = $db->query($sel);
                $rec      = $db->row($res);
                $Template = ucfirst($rec['TemplateName']);
            }
            if($rec['TemplateType']!= '' && $rec['TemplateType'] != 'custom1' && $rec['TemplateType'] != 'custom2' && $rec['TemplateType'] != 'custom3'){
                $urlTemplate     = 'javascript:;';
                $t = '<small style=\'position:absolute;bottom:40px!important;\'>Template visibile solo dalla nuova interfaccia!</small>';
            }else{
                $urlTemplate     = 'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_web/'.$primary_key.'';
                $t= '';
            }
            $AccontoPercentuale = $value['AccontoPercentuale'];
            $AccontoImporto     = $value['AccontoImporto'];
            $AccontoTesto       = stripslashes($value['AccontoTesto']);

            $select2 = "SELECT hospitality_richiesta.Prezzo,hospitality_richiesta.NumeroCamere,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

            if($TipoRichiesta=='Preventivo'){

                    $sistemazione .= '<b>'.$n.') PROPOSTA</b><br>Soggiorno per N° Adulti: '.$Adulti.' - N° Bambini: '.$Bambini.'<br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br>'.$Camere.'  <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>  '.($PrezzoL!='0,00'?'Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br />';
            }else{

                    if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                        $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
                    }
                    if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                        $acconto = number_format($AccontoLibero,2,',','.');
                    }

                    if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                        $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
                    }
                    if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                        if($AccontoImporto >= 1) {
                            $etichetta_caparra  = '';
                        }else{
                            $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                        }
                        $acconto = number_format($AccontoImporto,2,',','.');
                    }
                    if($acconto == 0){
                        $acconto = '';
                    }

                     $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>Soggiorno per N° Adulti: '.$Adulti.' - N° Bambini: '.$Bambini.'<br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br>';

            }

        $n++;

        }
        $sistemazione = str_replace('"',' ',$sistemazione);
        $sistemazione .= '<div style=\'float:right\'>'.$t.'<a href=\'https://'.$_SERVER['HTTP_HOST'].'/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Stampa PDF</a> <a href=\''.$urlTemplate.'\' class=\'btn btn-warning btn-xs\'>Anteprima template '.$Template.'</a></div><br>';
        return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="Proposte confermate Nr.'.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore: '.$Operatore.'" data-content="'.$sistemazione.'" class="xcrud_modal"><i class="glyphicon glyphicon-comment"></i></a>';


    }else{

        return '<small class="text-maroon" style=" white-space: nowrap;"><small>Da Completare</small></small>';
    }

}
function get_data_chiuso($value,$xcrud)
{
    if($value != '') {
       $value = date('d-m-Y' , strtotime($value));
    }else{
        $value = '';
    }
    return '<small>'.$value.'</small>';
}
function cambia_ordine_domande($value, $fieldname, $primary_key, $row, $xcrud){


        $db = Xcrud_db::get_instance();

        $db->query('SELECT Ordine,Id,idsito FROM hospitality_domande WHERE Id = '.$primary_key.' AND idsito = '.$value.'');
        $rw = $db->row();

        $nt = 50;

        for($i==1; $i<=$nt; $i++) {
            $link .= '<li><a href="https://'.$_SERVER['HTTP_HOST'].'/v2/cambia_ordine_domande/'.$primary_key.'/'.$value.'/'.$i.'">'.$i.'</a></li>';
            $bottone .= ($rw['Ordine']==$i?'<button type="button" class="btn btn-default">'.($i==''?'--':$i).'</button>':'');
        }


        $code = '
        <div class="btn-group">
            '.$bottone.'
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu" style="z-index:999999999!important">
                '.$link.'
            </ul>
        </div>';



    return $code;
}
function cambia_ordine_pdi($value, $fieldname, $primary_key, $row, $xcrud){


        $db = Xcrud_db::get_instance();

        $db->query('SELECT Ordine,Id,idsito FROM hospitality_pdi WHERE Id = '.$primary_key.' AND idsito = '.$value.'');
        $rw = $db->row();

        $nt = 50;

        for($i==1; $i<=$nt; $i++) {
            $link .= '<li><a href="https://'.$_SERVER['HTTP_HOST'].'/v2/cambia_ordine_pdi/'.$primary_key.'/'.$value.'/'.$i.'">'.$i.'</a></li>';
            $bottone .= ($rw['Ordine']==$i?'<button type="button" class="btn btn-default">'.($i==''?'--':$i).'</button>':'');
        }


        $code = '
        <div class="btn-group">
            '.$bottone.'
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu" style="z-index:999999999!important">
                '.$link.'
            </ul>
        </div>';



    return $code;
}
function clean_tolower($stringa){

    $clean_title = str_replace( "!", "", $stringa );
    $clean_title = str_replace( "?", "", $clean_title );
    $clean_title = str_replace( ":", "", $clean_title );
    $clean_title = str_replace( "+", "", $clean_title );
    $clean_title = str_replace( ".", "", $clean_title );
    $clean_title = str_replace( ",", "", $clean_title );
    $clean_title = str_replace( ";", "", $clean_title );
    $clean_title = str_replace( "'", "", $clean_title );
    $clean_title = str_replace( "*", "", $clean_title );
    $clean_title = str_replace( "/", "", $clean_title );
    $clean_title = str_replace( "\"", "", $clean_title );
    $clean_title = str_replace( " - ", "-", $clean_title );
    $clean_title = str_replace( "     ", " ", $clean_title );
    $clean_title = str_replace( "    ", " ", $clean_title );
    $clean_title = str_replace( "   ", " ", $clean_title );
    $clean_title = str_replace( "  ", " ", $clean_title );
    $clean_title = trim($clean_title);
    $clean_title = strtolower($clean_title);


    return($clean_title);
}
function clean_tolower_nome_template($postdata, $xcrud){
    $postdata->set('TemplateName', clean_tolower($postdata->get('TemplateName')));
}
function clean_tolower_nome_gallery($postdata, $xcrud){
    $postdata->set('TargetGallery', clean_tolower($postdata->get('TargetGallery')));
}
function clean($stringa){

    $clean_title = str_replace( "!", "", $stringa );
    $clean_title = str_replace( "?", "", $clean_title );
    $clean_title = str_replace( ":", "", $clean_title );
    $clean_title = str_replace( "+", "", $clean_title );
    $clean_title = str_replace( ".", "", $clean_title );
    $clean_title = str_replace( ",", "", $clean_title );
    $clean_title = str_replace( ";", "", $clean_title );
    $clean_title = str_replace( "'", "", $clean_title );
    $clean_title = str_replace( "*", "", $clean_title );
    $clean_title = str_replace( "/", "", $clean_title );
    $clean_title = str_replace( "\"", "", $clean_title );
    $clean_title = str_replace( "     ", " ", $clean_title );
    $clean_title = str_replace( "    ", " ", $clean_title );
    $clean_title = str_replace( "   ", " ", $clean_title );
    $clean_title = str_replace( "  ", " ", $clean_title );
    //$clean_title = strtolower($clean_title);
    $clean_title = trim($clean_title);

    return($clean_title);
}
function clean_servizio($postdata, $xcrud){
    $postdata->set('Servizio', clean($postdata->get('Servizio')));
}
function clean_tipo_camera($postdata, $xcrud){
    $postdata->set('TipoCamere', clean($postdata->get('TipoCamere')));
}
function clean_camera($postdata, $xcrud){
    $postdata->set('Camera', clean($postdata->get('Camera')));
}
function flag_listino($postdata, $xcrud){

        $db = Xcrud_db::get_instance();
        $query = 'SELECT * FROM hospitality_numero_listini WHERE Abilitato = 1 AND idsito = '.$_SESSION['IDSITO'] ;
        $result = $db->query($query);
        $record = $db->result($result);
        if(sizeof($record)>0){
          $update = 'UPDATE hospitality_numero_listini SET Abilitato = 0 WHERE idsito = '.$_SESSION['IDSITO'].' AND Abilitato != 1' ;
          $db->query($update);
        }

}
function abilita_smtp($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_smtp SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_smtp($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_smtp SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function checkin_send($value, $fieldname, $primary_key, $row, $xcrud){

        $db = Xcrud_db::get_instance();
        $q = $db->query('select CheckinInviato from hospitality_guest where Id = '.$primary_key.'');
        $rec = $db->row($q);
        if($rec['CheckinInviato'] == 0){
            $check = '<i class="fa fa-check-square text-red" data-toggle="tooltip" title="Modulo del Check-in Online Non Inviato"></i>';
        }else{
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "CheckinOnline" ORDER BY Id DESC');
            $rec = $db->row($q);
            if(is_array($rec)) {
                if($rec > count($rec))
                    $tot = count($rec);
            }else{
                $tot = 0;
            }
            if($tot > 0){
                $DataA_tmp      = explode(' ',$rec['DataAzione']);
                $DataAzione_tmp = explode('-',$DataA_tmp[0]);
                $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
                $check = '<i class="fa fa-check-square text-green" data-toggle="tooltip" title="Invio Modulo Check-in Online automatico avvenuto il '.$DataAzione.'"></i>';
            }else{
                $check = '<i class="fa fa-check-square text-green" data-toggle="tooltip" title="Modulo del Check-in Online Inviato"></i>';
            }
        }
        return $check;
}
function get_checkin($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta,hospitality_proposte.id_richiesta,hospitality_proposte.NomeProposta,hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota
                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_guest.idsito = ".$value." AND hospitality_guest.NumeroPrenotazione = ".$row['hospitality_checkin.Prenotazione']." AND hospitality_guest.TipoRichiesta = 'Conferma' AND hospitality_guest.Chiuso = 1";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere  = '';
        $acconto = '';
        foreach ($res as $key => $value) {

            $PrezzoL            = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP            = number_format($value['PrezzoP'],2,',','.');
            $IdProposta         = $value['IdProposta'];
            $PrezzoPC           = $value['PrezzoP'];
            $AccontoRichiesta   = $value['AccontoRichiesta'];
            $IdRichiesta        = $value['id_richiesta'];
            $AccontoLibero      = $value['AccontoLibero'];
            $NomeProposta       = $value['NomeProposta'];
            $Operatore          = stripslashes($value['ChiPrenota']);
            $Nome               = stripslashes($value['Nome']);
            $Cognome            = stripslashes($value['Cognome']);
            $Email              = $value['Email'];
            $NumeroAdulti       = $value['NumeroAdulti'];
            $NumeroBambini      = $value['NumeroBambini'];
            $EtaBambini1        = $value['EtaBambini1'];
            $EtaBambini2        = $value['EtaBambini2'];
            $EtaBambini3        = $value['EtaBambini3'];
            $EtaBambini4        = $value['EtaBambini4'];
            $EtaBambini5        = $value['EtaBambini5'];
            $EtaBambini6        = $value['EtaBambini6'];
            $Arrivo_tmp         = explode("-",$value['DataArrivo']);
            $Arrivo             = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp       = explode("-",$value['DataPartenza']);
            $Partenza           = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $AccontoPercentuale = $value['AccontoPercentuale'];
            $AccontoImporto     = $value['AccontoImporto'];
            $AccontoTesto       = stripslashes($value['AccontoTesto']);
            $start              = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end                = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $Notti              = ceil(abs($end - $start) / 86400);

            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                $acconto = number_format($AccontoImporto,2,',','.');
            }

            $select2 = "SELECT hospitality_richiesta.Prezzo,hospitality_richiesta.NumeroCamere,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

             $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> - '.($EtaBambini1!='' && $EtaBambini1!='0'?$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.'':'').'<br>';

        }
            $sistemazione = str_replace('"',' ',$sistemazione);
            //$sistemazione .= '<div style=\'float:right\'><a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Print PDF</a> <a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_web/'.$primary_key.'\' class=\'btn btn-warning btn-xs\'>Preview landing</a></div><br>';
           return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="Proposte confermate Nr.'.$IdRichiesta.'/'.$row['hospitality_checkin.Prenotazione'].' - Operatore: '.$Operatore.'" data-content="'.$sistemazione.'" class="xcrud_modal"><i class="glyphicon glyphicon-comment"></i></a>';
    }else{
        $sel = "SELECT 
                    hospitality_guest.FontePrenotazione
                FROM 
                    hospitality_guest
                WHERE 
                    hospitality_guest.idsito = ".$value." 
                AND 
                    hospitality_guest.NumeroPrenotazione = ".$row['hospitality_checkin.Prenotazione']." 
                AND 
                    hospitality_guest.TipoRichiesta = 'Conferma' 
                AND 
                    hospitality_guest.Chiuso = 1";
        $res    = $db->query($sel);
        $rec    = $db->row($res);
        return '<small class="text-maroon">'.$rec['FontePrenotazione'].'</small>';
    }
}

function check_screenshot($value, $fieldname, $primary_key, $row, $xcrud){
    $db = Xcrud_db::get_instance();
    $select = "SELECT Id,idsito FROM hospitality_guest WHERE idsito = ".$value." AND TipoRichiesta = 'Preventivo' AND DataScadenza >= '".date('Y-m-d')."' ORDER BY Id DESC LIMIT 1";
    $result = $db->query($select);
    $res    = $db->row($result);
    if(is_array($res)) {
        if($res > count($res)) // se la pagina richiesta non esiste
            $tot = count($res); // restituire la pagina con il numero più alto che esista
    }else{
        $tot = 0;
    }

    if($tot > 0){

        $url    = $_SESSION['URL_LANDING'];

        switch($row['hospitality_template_landing.Template']){
            case 'default':
                $img = '<img src="/img/thumb-default.png">';
            break;
            case 'smart':
                $img = '<img src="/img/thumb-smart.png">';
            break;
            case 'family':
                $img = '<img src="/img/thumb-family.png">';
            break;
            case 'bike':
                $img = '<img src="/img/thumb-bike.png">';
            break;
            case 'romantico':
                $img = '<img src="/img/thumb-romantico.png">';
            break;
            default:
                $img = '';
            break;
        }
    }
    return  $img;
}

function get_operatore($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value){
        $db = Xcrud_db::get_instance();
        $q = $db->query('SELECT img,idsito,Abilitato from hospitality_operatori WHERE NomeOperatore = "'.$value.'" AND idsito = '.$row['hospitality_guest.idsito']);
        $rec = $db->row($q);
        $Img = $rec['img'];
        $idsito = $rec['idsito'];
        $Abilitato = $rec['Abilitato'];
        if($Img){
            $val = '<img src="https://'.$_SERVER['HTTP_HOST'].'/uploads/'.$idsito.'/'.$Img.'" class="img-circle" data-toogle="tooltip" title="Operatore '.($Abilitato==0?'DISABILITATO':'').': '.$value.'" style="width:18px;height:18px;'.($Abilitato==0?'opacity:0.5':'').'">';
        }else{
             $val = '<i class="fa fa-user" data-toogle="tooltip" '.($Abilitato==0?'style="opacity:0.5"':'').' title="Operatore '.($Abilitato==0?'DISABILITATO':'').': '.$value.'"></i>';
        }
    }else{
        $val = '<div style="width:100%!important">
                    <i class="fa fa-user text-red" data-toogle="tooltip" title="Operatore: ancora da assegnare"></i>
                    '.($_SERVER['REQUEST_URI']=='/preventivi/'?'<label data-toogle="tooltip" title="Assegna un Operatore al Preventivo" class="cont_check_op" style="float:right;margin-top:15px"><input type="checkbox" name="IdPrev" value="'.$row['hospitality_guest.Id'].'" /><span class="checkmark_op"></span></label>':'').'
                </div>';
    }

    return $val;
}
function comunicazione_scaduta($value, $fieldname, $primary_key, $row, $xcrud){

    if($value){
        if($value <= date('Y-m-d')){
            $value = date('d-m-Y' , strtotime($value));
            return '<span class="text-red">'.$value.'</span>';
        }else{
            $value = date('d-m-Y' , strtotime($value));
            return $value;
        }
    }
}
function Archivia($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Archivia = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function NoArchivia($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Archivia = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function NoHidden($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET Hidden = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function check_input($value, $field, $priimary_key, $list, $xcrud)
{
        return '<label class="cont_check"><input type="checkbox" name="Id" value="'.$value.'" /><span class="checkmark"></span></label>';
}
function conta_click($value, $fieldname, $primary_key, $row, $xcrud)
{

        $db = Xcrud_db::get_instance();
        $query = "SELECT COUNT(Id) as Click FROM hospitality_traccia_email WHERE IdRichiesta = ".$primary_key." AND idsito = ".$_SESSION['IDSITO'];
        $res = $db->query($query);
        $rw = $db->row($res);
        if($row['hospitality_guest.DataRichiesta']>=$_SESSION['DATA_DOWGRADE_SHORTURL']){
            $aperture = $rw['Click'];
        }else{
            $aperture = ($rw['Click']>0?$rw['Click']-1:$rw['Click']);
        }
        if($aperture == 0 && $row['hospitality_guest.DataInvio'] != '' && $row['hospitality_guest.DataInvio'] < date('Y-m-d') && $row['hospitality_guest.DataScadenza'] > date('Y-m-d')){
            $GiornoPassato = '<div style="clear:both!important;text-align:right!important" id="notify'.$primary_key.'">
                                <i class="fa fa-question-circle  text-info" data-toogle="tooltip" title="Sono passate più di 24 ore dall\'invio dell\'email!!"></i>
                            </div>';
        }else{
            $GiornoPassato = '';
        }
    return '<small>'.$aperture.$GiornoPassato.'</small>';
}

function color_selector($value, $fieldname, $primary_key, $row, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $select = "SELECT * FROM hospitality_template_colori WHERE idsito = ".$_SESSION['IDSITO']." ";
    $result = $db->query($select);
    $res    = $db->result($result);
    $input_select = '';

    foreach ($res as $key => $val) {
        $input_select .= '<option value="'.$val['Background'].'" data-color="'.$val['Background'].'" '.($value==$val['Background']?'selected="selected"':'').'>'.$val['Background'].'</option>'."\r\n";
    }

    return  ' <div class="alert alert-info alert-dismissible">'
            .'    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
            .'    <p><i class="icon fa fa-info"></i> Clicca sul quadrato colorato per aprire ulteriori possibilità di abbinamento colore tra il principale ed il colore pulsanti!</p>'
            .'    <i class="icon fa fa-arrow-down text-black" style="position:absolute;left:18px;top:55px"></i>'
            .' </div>'
            .' <select name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input" id="colorselector">'
            .'  '.$input_select.' '
            .' </select>  '
            .' <script type="text/javascript">'
            .'  $(function() {'
            .'    $(\'#colorselector\').colorselector();'
            .'  });'
            .' </script>';
}


function help_font($value, $fieldname, $primary_key, $row, $xcrud)
{

    return '<div class="callout callout-warning">'
            .'  <h4>Esempi dei Font disponibili:</h4> '
            .'  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Lora:400,400i,700|Open+Sans:300,400,400i,700|Playfair+Display:400,400i,700|Raleway:300,400,400i,700|Roboto+Slab:300,400,700|Roboto:300,400,400i,700|Ubuntu:300,400,400i,700" rel="stylesheet">
                    <style>
                    #SWtesto{
                        position: relative;
                        width: 100%;
                        margin: 15px 0;
                    }
                    .SWtesto{
                        font-size:12px;
                        font-weight: normal;
                        position: relative;
                        display: inline-block;
                        box-sizing: border-box;
                        padding: 20px;
                        border: 10px solid #ededed;
                        width: calc(25% - 10px);
                    margin: 2px;
                        vertical-align: top;
                    }
                    .SWtesto .titolo{
                        font-weight: 700;
                        font-size: 20px;
                        margin-bottom: 10px;

                    }
                    .SW-roboto{font-family: \'Roboto\', sans-serif;}
                    .SW-open{font-family: \'Open Sans\', sans-serif;}
                    .SW-lato{font-family: \'Lato\', sans-serif;}
                    .SW-raleway{font-family: \'Raleway\', sans-serif;}
                    .SW-robotoslab{font-family: \'Roboto Slab\', serif;}
                    .SW-lora{font-family: \'Lora\', serif;}
                    .SW-playfair{font-family: \'Playfair Display\', serif;}
                    .SW-ubuntu{font-family: \'Ubuntu\', sans-serif;}
                    @media screen and (max-width: 1000px) {
                        .SWtesto{
                            width: calc(33.33% - 10px);
                        }
                    }
                    @media screen and (max-width: 700px) {
                        .SWtesto{
                            width: calc(50% - 10px);
                        }
                    }
                    @media screen and (max-width: 500px) {}
                    </style>
                    <div id="SWtesto">
                        <div class="SWtesto SW-lato">
                            <div class="titolo">Font: Lato</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-lora">
                            <div class="titolo">Font: Lora</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-open">
                            <div class="titolo">Font: Open Sans</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-playfair">
                            <div class="titolo">Font: PlayFair Display</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                    <div class="SWtesto SW-raleway">
                            <div class="titolo">Font: Raleway</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-roboto">
                            <div class="titolo">Font: Roboto</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-robotoslab">
                            <div class="titolo">Font: Roboto Slab</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                        <div class="SWtesto SW-ubuntu">
                            <div class="titolo">Font: Ubuntu</div>
                            Vita Brevis
                            <strong>Ars Longa</strong>,
                            <em>Occasio Praeceps</em>,
                            Experimentum Periculosum, Iudicium Difficile.
                        </div>
                    </div>'
            .'  </div>'
            .'  <select  name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input form-control" data-type="select" maxlength="255" >'
            .'   <option value="" '.($value==''?'selected="selected"':'').'>--</option>'
            .'   <option value="\'Lato\', sans-serif" '.($value=='\'Lato\', sans-serif'?'selected="selected"':'').'>Lato</option>'
            .'   <option value="\'Lora\', serif" '.($value=='\'Lora\', serif'?'selected="selected"':'').'>Lora</option>'
            .'   <option value="\'Open Sans\', sans-serif" '.($value=='\'Open Sans\', sans-serif'?'selected="selected"':'').'>Open Sans</option>'
            .'   <option value="\'Playfair Display\', serif" '.($value=='\'Playfair Display\', serif'?'selected="selected"':'').'>PlayFair Display</option>'
            .'   <option value="\'Raleway\', sans-serif" '.($value=='\'Raleway\', sans-serif'?'selected="selected"':'').'>Raleway</option>'
            .'   <option value="\'Roboto\', sans-seri" '.($value=='\'Roboto\', sans-seri'?'selected="selected"':'').'>Roboto</option>'
            .'   <option value="\'Roboto Slab\', serif" '.($value=='\'Roboto Slab\', serif'?'selected="selected"':'').'>Roboto Slab</option>'
            .'   <option value="\'Ubuntu\', sans-serif" '.($value=='\'Ubuntu\', sans-serif'?'selected="selected"':'').'>Ubuntu</option>'
            .'   <option value="\'Montserrat\', sans-serif" '.($value=='\'Montserrat\', sans-serif'?'selected="selected"':'').'>Montserrat</option>'
            . '</select>';

}
function check_voucher($value, $fieldname, $primary_key, $row, $xcrud){

        $db = Xcrud_db::get_instance();
        $q = $db->query('SELECT Voucher_send FROM hospitality_guest WHERE Id = '.$primary_key.'');
        $rec = $db->row($q);
        $check = '';
        if($rec['Voucher_send'] != 0){
            $check = '<i class="fa fa-ticket text-green" data-toggle="tooltip" title="Voucher Inviato"></i>';
        }else{
            $check = '<i class="fa fa-ticket text-red" data-toggle="tooltip" title="Voucher non Inviato"></i>';
        }
        return $check;
}
function check_buonivoucher($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $q = $db->query('SELECT DataVoucherRecSend FROM hospitality_guest WHERE Id = '.$primary_key.'');
    $rec = $db->row($q);
    $check = '';
    if($rec['DataVoucherRecSend'] !='' && $rec['DataVoucherRecSend'] !='0000-00-00'){
        $check = '<i class="fa fa-ticket text-green" data-toggle="tooltip" title="Voucher Inviato"></i>';
    }else{
        $check = '<i class="fa fa-ticket text-red" data-toggle="tooltip" title="Voucher non Inviato"></i>';
    }
    return $check;
}
function re_email_call($value, $fieldname, $primary_key, $row, $xcrud){

        if($value == 0){
            $check = '';
        }else{
            $db = Xcrud_db::get_instance();
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "ReCall" ORDER BY Id DESC');
            $rec = $db->row($q);
            $DataA_tmp      = explode(' ',$rec['DataAzione']);
            $DataAzione_tmp = explode('-',$DataA_tmp[0]);
            $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
            $check = '<i class="fa fa-repeat text-info" data-toggle="tooltip" title="Invio ReCall del preventivo automatico avvenuto il '.$DataAzione.'"></i>';
        }
        return $check;
}
function re_email_send($value, $fieldname, $primary_key, $row, $xcrud){

        if($value == 0){
            $check = '';
        }else{
            $db = Xcrud_db::get_instance();
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "ReSend" ORDER BY Id DESC');
            $rec = $db->row($q);
            $DataA_tmp      = explode(' ',$rec['DataAzione']);
            $DataAzione_tmp = explode('-',$DataA_tmp[0]);
            $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
            $check = '<i class="fa fa-envelope-o text-info" data-toggle="tooltip" title="Invio ReCall della conferma  automatico avvenuto il '.$DataAzione.'"></i>';
        }
        return $check;
}
function re_email_upselling($value, $fieldname, $primary_key, $row, $xcrud){

        if($value == 0){
            $check = '';
        }else{
            $db = Xcrud_db::get_instance();
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "UpSelling" ORDER BY Id DESC');
            $rec = $db->row($q);
            $DataA_tmp      = explode(' ',$rec['DataAzione']);
            $DataAzione_tmp = explode('-',$DataA_tmp[0]);
            $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
            $check = '<i class="fa fa-send-o text-info" data-toggle="tooltip" title="Invio Benvenuto automatico avvenuto il '.$DataAzione.'"></i>';
        }
        return $check;
}
function re_email_precheckin($value, $fieldname, $primary_key, $row, $xcrud){

        if($value == 0){
            $check = '';
        }else{
            $db = Xcrud_db::get_instance();
            $q = $db->query('SELECT DataAzione FROM hospitality_traccia_email_cron WHERE IdRichiesta = '.$primary_key.' AND Idsito = '.$_SESSION['IDSITO'].' AND TipoReInvio = "PreCheckin" ORDER BY Id DESC');
            $rec = $db->row($q);
            $DataA_tmp      = explode(' ',$rec['DataAzione']);
            $DataAzione_tmp = explode('-',$DataA_tmp[0]);
            $DataAzione     = $DataAzione_tmp[2].'-'.$DataAzione_tmp[1].'-'.$DataAzione_tmp[0];
            $check = '<i class="fa fa-info text-info" data-toggle="tooltip" title="Invio PreCheckin automatico avvenuto il '.$DataAzione.'"></i>';
        }
        return $check;
}
function dett_consenso_dgpr($value, $fieldname, $primary_key, $row, $xcrud){

            $flg_marketing    = 0;
            $stringa_consensi = '';

            $db  = Xcrud_db::get_instance();
            $qy  = 'SELECT Id,TipoRichiesta,FontePrenotazione,CheckConsensoPrivacy,CheckConsensoMarketing,CheckConsensoProfilazione,Ip,Agent,DataRichiesta,Email FROM hospitality_guest WHERE Id = '.$primary_key.' AND idsito = '.$_SESSION['IDSITO'].'';
            $q   = $db->query($qy);
            $rec = $db->row($q);

            $query2 ='SELECT * FROM log_consenso_notifiche WHERE id_richiesta = "'.$rec['Id'].'"';
            $res2 = $db->query($query2);
            $r2 = $db->row($res2);
            if(is_array($r2['log'])) {
                if($r2['log'] > count($r2['log'])) // se la pagina richiesta non esiste
                    $tot = count($r2['log']); // restituire la pagina con il numero più alto che esista
            }else{
                $tot = 0;
            }
            if($tot>0){
                $testo_log = $r2['log'];
                $flg_marketing = 1;
            }else{
                $flg_marketing = 0;
            }
            $Data_t      = explode('-',$rec['DataRichiesta']);
            $Data        = $Data_t[2].'-'.$Data_t[1].'-'.$Data_t[0];

           /* $string_link = 'https://'.$_SERVER['HTTP_HOST'].'/v2/profila/change/'.$primary_key.'/';
            $stringa_consensi .= '<b>Soggetto interessato:</b>: '.$rec['Email'].'<br>';
            $stringa_consensi .= '<b>Data</b>: '.$Data.'';
            $stringa_consensi .= ($rec['Ip']!=''?'<br><b>Fonte IP</b>: '.$rec['Ip']:'');
            $stringa_consensi .= ($rec['Agent']!=''?'<br><b>Agent</b>: '.$rec['Agent']:'');
            $stringa_consensi .= '<br><b>Consenso trattamento dati</b>: '.($rec['CheckConsensoPrivacy']==1?'<i class=\'fa fa-check-circle text-green\'></i>':'');
            $stringa_consensi .= '<br><b>Consenso invio materiale marketing</b>: '.($rec['CheckConsensoMarketing']==1?'<i class=\'fa fa-check-circle text-green\'></i>'.($flg_marketing==1?'<br><small class=\'text-red\'>'.$testo_log:'</small>'):'<a href=\''.$string_link.'\' ><i class=\'fa fa-times-circle text-red\' ></i></a>');

            if($rec['TipoRichiesta']=='Conferma'){
                    return '<a href="javascript:;" data-toogle="tooltip" title="Consensi GDPR" data-header="Consenso per richiesta N.'.$row['hospitality_guest.NumeroPrenotazione'].'" data-content="'.$stringa_consensi.'" class="xcrud_modal label bg-gray">GDPR</a>';
            }else{
                return '';
            }*/
            $stringa_consensi .= '<div id="view_consensi_gdpr'.$primary_key.'" class="pointer">Consensi GDPR <i class="fa fa-chevron-down" style="float:right;padding-top:5px"></i></div>';
            $stringa_consensi .= '<div id="consensi_gdpr'.$primary_key.'" style="display:none">';
            $stringa_consensi .= '<b>Identificativo</b>: '.$rec['Id'].'';
            $stringa_consensi .= '<br><b>Data</b>: '.$Data.'';
            $stringa_consensi .= ($rec['Ip']!=''?'<br><b>Fonte IP</b>: '.$rec['Ip']:'');
            $stringa_consensi .= ($rec['Agent']!=''?'<br><b>Agent</b>: '.$rec['Agent']:'');
            $stringa_consensi .= ($rec['CheckConsensoPrivacy']==1?'<br><b>Consenso trattamento dati</b>: <i class="fa fa-check-circle text-green"></i>':'');
            $stringa_consensi .= '<br><b>Consenso invio materiale marketing</b>: '.($rec['CheckConsensoMarketing']==1?'<i class="fa fa-check-circle text-green" id="marketing'.$primary_key.'" style="cursor:pointer" data-id="0"></i><span id="new_marketing_green'.$primary_key.'"></span>':'<i class="fa fa-times-circle text-red" id="marketing'.$primary_key.'" style="cursor:pointer" data-id="1"></i><span id="new_marketing_red'.$primary_key.'"></span>').($flg_marketing==1?'<small class="text-red"  id="log'.$primary_key.'"><br>'.$testo_log.'</small>':'');
            $stringa_consensi .= '<br><b>Consenso profilazione</b>: '.($rec['CheckConsensoProfilazione']==1?'<i class="fa fa-check-circle text-green" id="profilazione'.$primary_key.'" style="cursor:pointer" data-id="0"></i><span id="new_profilazione_green'.$primary_key.'"></span>':'<i class="fa fa-times-circle text-red" id="profilazione'.$primary_key.'" style="cursor:pointer" data-id="1"></i><span id="new_profilazione_red'.$primary_key.'"></span>');
            $stringa_consensi .= '<br>Invia email per modifica consensi: <i class="fa fa-envelope text-light-blue" id="sendmailconsensi'.$primary_key.'" style="cursor:pointer"></i> <span id="sendmail_ok'.$primary_key.'" style="color:#000!important"></span>';

            $stringa_consensi .= '
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $("#marketing'.$primary_key.'").click(function(){
                                            if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
                                                var valore_marketing = $("#marketing'.$primary_key.'").data("id");
                                                $.ajax({
                                                      url: "/ajax/change_consenso_marketing_gdpr.php",
                                                      type: "POST",
                                                      data: "id_richiesta='.$primary_key.'&valore_marketing="+valore_marketing,
                                                      dataType: "html",
                                                      success: function(data) {
                                                        $("#marketing'.$primary_key.'").remove();
                                                        $("#log'.$primary_key.'").remove();
                                                        if(valore_marketing==1){
                                                            $("#new_marketing_red'.$primary_key.'").html("<i class=\"fa fa-check-circle text-green\" id=\"marketing'.$primary_key.'\" style=\"cursor:pointer\" data-id=\"0\"></i>");
                                                        }else{
                                                            $("#new_marketing_green'.$primary_key.'").html("<i class=\"fa fa-times-circle text-red\" id=\"marketing'.$primary_key.'\" style=\"cursor:pointer\" data-id=\"1\"></i>");
                                                        }
                                                      }
                                                  });
                                                  return false;
                                              }
                                            });
                                            $("#profilazione'.$primary_key.'").click(function(){
                                                if (window.confirm("ATTENZIONE: Sicuro di modifcare il consenso?")){
                                                    var valore_profilazione = $("#profilazione'.$primary_key.'").data("id");
                                                    $.ajax({
                                                          url: "/ajax/change_consenso_profilazione_gdpr.php",
                                                          type: "POST",
                                                          data: "id_richiesta='.$primary_key.'&valore_profilazione="+valore_profilazione,
                                                          dataType: "html",
                                                          success: function(data) {
                                                            $("#profilazione'.$primary_key.'").remove();
                                                            $("#log'.$primary_key.'").remove();
                                                            if(valore_profilazione==1){
                                                                $("#new_profilazione_red'.$primary_key.'").html("<i class=\"fa fa-check-circle text-green\" id=\"profilazione'.$primary_key.'\" style=\"cursor:pointer\" data-id=\"0\"></i>");
                                                            }else{
                                                                $("#new_profilazione_green'.$primary_key.'").html("<i class=\"fa fa-times-circle text-red\" id=\"profilazione'.$primary_key.'\" style=\"cursor:pointer\" data-id=\"1\"></i>");
                                                            }
                                                          }
                                                      });
                                                      return false;
                                                  }
                                                });
                                            $("#sendmailconsensi'.$primary_key.'").click(function(){
                                            if (window.confirm("ATTENZIONE: Vuoi procedere con l\'invio della mail all\'utente?")){
                                                $.ajax({
                                                      url: "/ajax/send_mail_consensi.php",
                                                      type: "POST",
                                                      data: "id_richiesta='.$primary_key.'&email_utente='.$rec['Email'].'&action=send",
                                                      dataType: "html",
                                                      success: function(data) {
                                                         $("#sendmail_ok'.$primary_key.'").html("<i class=\"fa fa-check text-green\"></i> <br><span class=\"text-maroon\">Email inviata!</span>");
                                                      }
                                                  });
                                                  return false;
                                              }
                                            });
                                            $("#view_consensi_gdpr'.$primary_key.'").on("click",function(){
                                                $("#consensi_gdpr'.$primary_key.'").toggle();
                                            });
                                        });
                                    </script>
                                </div>';

            if($rec['TipoRichiesta']=='Conferma'){
                return '<small>'.$stringa_consensi.'</small>';
            //}elseif($rec['TipoRichiesta']=='Preventivo' && $rec['FontePrenotazione']=='Sito Web'){
                //return '<small>'.$stringa_consensi.'</small>';
            }else{
                return '';
            }
}
function data_modifica($postdata, $primary, $xcrud)
{
    $db = Xcrud_db::get_instance();
    $db->query("UPDATE hospitality_dizionario_lingua SET data_modifica = '".date('Y-m-d')."' WHERE id = " . $db->escape($primary));
}
function check_superuser($value, $fieldname, $primary_key, $row, $xcrud){
    if($value==1){
        $valore = '<small class="text-red">Accesso da SuperUser abilitato dal cliente!</small>';
    }else{
        $valore = '<small class="text-info">Accesso custom creato da quest\'area!</small>';
    }
    return $valore;
}
function leggi_risposta($value, $fieldname, $primary_key, $row, $xcrud)
{
    $content    = explode('|',$value); // separo
    if($value != ''){
        $titolo_stato = 'Ticket elaborato';
    }else{
        $titolo_stato = 'Ticket in attesa di elaborazione';
    }
    ############# NUOVA ISTANZA DB #####################
    $db                = Xcrud_db::get_instance();
    $xcrud_suiteweb    = Xcrud::get_instance();
    $xcrud_suiteweb->connection('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net');
    $xcrud_suiteweb->language('it');
    $dbsuiteweb_params = array('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net','UTF8');
    $db_suiteweb       = Xcrud_db::get_instance($dbsuiteweb_params);
    ############# NUOVA ISTANZA DB #####################
    $db_suiteweb->query('SELECT ut_nome,username,ut_cognome FROM utenti WHERE idutente = "'.$content[0].'"');
    $rws = $db_suiteweb->row();
    $operatore = ($rws['ut_nome']==''?$rws['username']:$rws['ut_nome'].' '.$rws['ut_cognome']);

    if($content[2]!=''){
        $data_tmp = explode("-",$content[2]);
        $data_r_tmp = explode(" ",$data_tmp[2]);
        $data = $data_r_tmp[0].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data_r_tmp[1];
    }

    $rif = '<table class="table table-bordered">
            <tr><td colspan="2" style="width:100%"><b>'.$titolo_stato.'</b></td></tr>
            <tr>
                <td style="width:20%"><b>Operatore</b></td>
                <td style="width:80%">'.$operatore.'</td>
            </tr>
             <tr>
                <td style="width:20%"><b>Data risposta</b></td>
                <td style="width:80%">'.$data.'</td>
            </tr>
             <tr>
                <td style="width:20%"><b>Messaggio</b></td>
                <td style="width:80%">'.$content[1].'</td>
            </tr>
        </table>';
    return $rif;

}
function color_idcategory($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value!=''){
    ############# NUOVA ISTANZA DB #####################
    $db                = Xcrud_db::get_instance();
    $xcrud_suiteweb    = Xcrud::get_instance();
    $xcrud_suiteweb->connection('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net');
    $xcrud_suiteweb->language('it');
    $dbsuiteweb_params = array('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net','UTF8');
    $db_suiteweb       = Xcrud_db::get_instance($dbsuiteweb_params);
    ############# NUOVA ISTANZA DB #####################
    $sel = $db_suiteweb->query('SELECT ticket_cat.nome as categoria,ticket_cat.colore_etichetta as colore
                        FROM ticket
                        INNER JOIN ticket_cat ON ticket_cat.id = ticket.idcat
                        WHERE ticket.id = ' .$primary_key);
    $row = $db_suiteweb->row($sel);


        $label = '<span class="label" style="background:'.$row['colore'].'">' .$row['categoria']. '</span>';
    }
    return $label;
}
function send_mail_ticket($primary, $xcrud){

    ############# NUOVA ISTANZA DB #####################
    $db                = Xcrud_db::get_instance();
    $xcrud_suiteweb    = Xcrud::get_instance();
    $xcrud_suiteweb->connection('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net');
    $xcrud_suiteweb->language('it');
    $dbsuiteweb_params = array('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net','UTF8');
    $db_suiteweb       = Xcrud_db::get_instance($dbsuiteweb_params);
    ############# NUOVA ISTANZA DB #####################
    #
    $sel = $db_suiteweb->query('SELECT ticket.*, ticket_cat.nome as categoria,ticket_cat.email as email_categoria
                        FROM ticket
                        INNER JOIN ticket_cat ON ticket_cat.id = ticket.idcat
                        WHERE ticket.idsito = '.$_SESSION['IDSITO'].' ORDER BY id DESC');
    $row = $db_suiteweb->row($sel);

    $sel2 = $db_suiteweb->query('SELECT web FROM siti WHERE idsito = '.$_SESSION['IDSITO']);
    $rw = $db_suiteweb->row($sel2);

    $data_richesta_tmp = explode("-",$row['data_invio']);
    $data_r_tmp = explode(" ",$data_richesta_tmp[2]);
    $data_richiesta = $data_r_tmp[0].'-'.$data_richesta_tmp[1].'-'.$data_richesta_tmp[0].' '.$data_r_tmp[1];


    $n_ticket = 'sTk_'.$row['id'].'_v2';


    $oggetto = "Ticket ".$n_ticket." - by Network Service srl";

    $messaggio = '
                <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
                    <title>SuiteTicket v 1.0  by Network Service</title>
                    <link rel="stylesheet" type="text/css" href="https://www.suiteweb.it/css/style_email.css" />
                    <style>
                            @charset "UTF-8";

                        @font-face {
                          font-family: \'Source Sans Pro\';
                          font-style: normal;
                          font-weight: 300;
                          src: local(\'Source Sans Pro Light\'), local(\'SourceSansPro-Light\'), url(https://www.suiteweb.it/css/fonts/toadOcfmlt9b38dHJxOBGNbE_oMaV8t2eFeISPpzbdE.woff) format(\'woff\');
                        }
                        @font-face {
                          font-family: \'Source Sans Pro\';
                          font-style: normal;
                          font-weight: 400;
                          src: local(\'Source Sans Pro\'), local(\'SourceSansPro-Regular\'), url(https://www.suiteweb.it/css/fonts/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format(\'woff\');
                        }
                        @font-face {
                          font-family: \'Source Sans Pro\';
                          font-style: normal;
                          font-weight: 700;
                          src: local(\'Source Sans Pro Bold\'), local(\'SourceSansPro-Bold\'), url(https://www.suiteweb.it/css/fonts/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format(\'woff\');
                        }

                        @font-face {
                          font-family: \'Vollkorn\';
                          font-style: normal;
                          font-weight: 400;
                          src: local(\'Vollkorn Regular\'), local(\'Vollkorn-Regular\'), url(https://www.suiteweb.it/css/fonts/BCFBp4rt5gxxFrX6F12DKvesZW2xOQ-xsNqO47m55DA.woff) format(\'woff\');
                        }
                        @font-face {
                          font-family: \'Vollkorn\';
                          font-style: normal;
                          font-weight: 700;
                          src: local(\'Vollkorn Bold\'), local(\'Vollkorn-Bold\'), url(https://www.suiteweb.it/css/fonts/wMZpbUtcCo9GUabw9JODeobN6UDyHWBl620a-IRfuBk.woff) format(\'woff\');
                        }

                        body { background-image:url(https://www.suiteweb.it/img/bg-mail.jpg); background-position:top left; background-repeat:no-repeat; background-color:#FFFFFF; margin:0 auto; font-family:Tahoma,Geneva,sans-serif; font-size:11px; }
                        a{ text-decoration:none; color:#333333; }
                        h2{ font-size:12pt; }
                        .tbl_body { width:700px; font-size:10pt; background-color:#FFFFFF; border-collapse:collapse; }
                        .tbl_body td { padding:5px; }
                        .tbl_body .spacer_td { border-top:solid 1px #999999; background-color:#EEEEEE; height:30px; }
                        .tbl_body .spacer_btm_td { border-bottom:solid 1px #999999; height:15px; }
                        .title{ background-color:#FFFFFF; color:#666666; font-size:14pt; }
                        .footer{ background-color:#BBBBBB; color:#666666; font-size:8pt; }
                        .gray{color:#666666;}
                        .size8{ font-size:8pt; }
                        .footer a{ color:#EEEEEE; }
                        .tit_residuo{ display: inline-block; font-size: 10pt; margin: 0 0 0 40px; padding: 3px 0 0; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .alert_tit_residuo{ color:#990000; }
                        .tit_residuo .lbl_tit_residuo { display:inline-block; width:450px; }
                        .tit_residuo .lbl_val_residuo { display:inline-block; width:100px; vertical-align: top;}
                        .tit_ass_ore_residuo{   display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: left; /*text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .tit_ass_ore_consumato{ display: inline-block; font-size: 10pt; margin: 0 5px; padding: 3px 0 0; text-align: center; width: 40%; /* text-shadow: 1px 1px 2px #333; */ filter: dropshadow(color=#333, offx=1, offy=1);}
                        .tbl_pack {display:table;}
                        .tbl_pack_row {display:table-row;}
                        .tbl_pack_row:nth-child(1) {border-top: 1px solid #DDDDDD;}
                        .tbl_pack_row:nth-child(2) {background-color:#dfedfe;}
                        .tbl_pack_td {border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD; display: table-cell; margin: 0 5px 5px 0; padding: 5px; font-size: 9pt; vertical-align:top;}
                        .tbl_pack_td:nth-child(1) {border-left: 1px solid #DDDDDD;}
                        .tbl_pack_td_tit { font-weight:bold; background-color:#f7fedf; font-size: 10pt;}
                        .tbl_pack_td small{font-size:8pt;}
                        .tbl_pack_td b{font-size: 9pt;}
                        .box_note_commerciali_det_storico{background-color: #FFFFFF; border: 1px solid #999999; display: inline-block; min-height: 350px; overflow: auto; padding: 0 5px; width: 465px; vertical-align: top;}
                        .info_note_commerciali_top{font-size:9pt; border-bottom:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
                        .info_note_commerciali_bottom{font-size:9pt; border-top:solid 1px #999999; padding:5px 0; display:block; height: auto; position:relative;}
                        .info_note_commerciali_top p, .info_note_commerciali_bottom p{margin:0;}
                        .info_note_commerciali_top h3, .info_note_commerciali_bottom h3{margin:0;}
                        .txt_nota_commerciale{font-size:10pt; padding:5px 15px;}
                        .txt_nota_tecnica{display:block; margin:0px 0px 10px 0px; padding:10px; background-color:#F5F5F5;}
                        .row_nota_commerciale{display:block; margin:0px 0px 10px 0px; padding:10px;}
                        .row_list_note{display:block; padding: 10px 5px; border: 1px solid #666666; margin:0px 0px 5px;}
                    </style>
            </head>
            <body>
                    <table class="tbl_body" cellpadding="0px" cellspacing="0px" border="0px" align="center">
                        <tr>
                            <td class="title" colspan="2">
                                    <img src="https://'.$_SERVER['HTTP_HOST'].'/v2/img/logo.png" /><br />
                                <h2>SuiteTicket v <sub>1.0</sub> by Network Service</h2>
                            </td>
                        </tr>
                         <tr>
                            <td valign="top">
                                <b>Ticket:</b>
                            </td>
                             <td valign="top">
                                <p>'.$n_ticket.'</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <b>Priorità:</b>
                            </td>
                             <td valign="top">
                                <p>'.$row['priorita'].'</p>
                            </td>
                        </tr>
                         <tr>
                            <td valign="top">
                                <b>Reparto:</b>
                            </td>
                            <td valign="top">
                                <p>'.$row['categoria'].'</p>
                            </td>
                        </tr>
                         <tr>
                            <td valign="top">
                                <b>Data Richiesta Ticket:</b>
                            </td>
                            <td valign="top">
                                <p>'.$data_richiesta.'</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <b>Oggetto:</b>
                            </td>
                            <td valign="top">
                                <p>'.$row['oggetto'].'</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <b>Messaggio:</b>
                            </td>
                            <td valign="top">
                                <p>'.$row['messaggio'].'</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" colspan="2" class="gray size8">
                                <p>Questo ticket verrà elaborato entro 12/48 dalla sua data di invio. <br>Riceverai e-mail di conferma con il dettaglio della risposta, ma in qualsiasi momento puoi
                                entrare in QUOTO! nella zona "Gestione Ticket" per visualizzare il riepilogo ed il dettaglio dei ticket stessi!!<br>
                                Se la vostra richiesta dovesse risultare troppo complessa da risolvere con un unico ticket..., potete riaprire tutti i ticket che volete senza limiti di numero.</p>
                            </td>
                        </tr>
                           <tr>
                                <td colspan="2" valign="top" class="footer" style="padding:10px 3px; text-align:left;">
                                     <strong>SuiteTicket v <sub>1.0</sub> </strong> &egrave; una realizzazione:<br />
                                        <br/>
                                        <img height="27" src="https:/www.suiteweb.it/img/ns.png" align="left" style="margin-right:5px;"> Network Service srl - Via Valentini A. e L., 11 47922 Rimini (RN) | P.I. 04297510408<br />
                                        tel. 0541.790062 | fax 0541.778656 | <a href="mailto:info@network-service.it">info@network-service.it</a>
                                </td>
                            </tr>
                        </table>
            </body>
            </html>';


    $destinatari  = $row['categoria']." <".$row['email_categoria'].">";


    $intestazioni  = "MIME-Version: 1.0\r\n";
    $intestazioni .= "Content-type: text/html; charset=UTF-8\r\n";

    $intestazioni .= "From: SuiteTicket v1 - Ticket ".$rw['web']." <".$row['email_ticket'].">\r\n";

    @mail($destinatari, $oggetto, $messaggio, $intestazioni);


    $destinatari = $rw['web']." <".$row['email_ticket'].">";

    $intestazioni  = "MIME-Version: 1.0\r\n";
    $intestazioni .= "Content-type: text/html; charset=UTF-8\r\n";


    $intestazioni .= "From: SuiteTicket v1 - Ticket ".$row['categoria']." <".$row['email_categoria'].">\r\n";



    @mail($destinatari, $oggetto, $messaggio, $intestazioni);

}
function letto_ticket($postdata, $primary_key, $xcrud){

    ############# NUOVA ISTANZA DB #####################
    $db                = Xcrud_db::get_instance();
    $xcrud_suiteweb    = Xcrud::get_instance();
    $xcrud_suiteweb->connection('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net');
    $xcrud_suiteweb->language('it');
    $dbsuiteweb_params = array('www60795','XYMZIROIHWZUCLB','www60795','gimli.nwscloud.net','UTF8');
    $db_suiteweb       = Xcrud_db::get_instance($dbsuiteweb_params);
    ############# NUOVA ISTANZA DB #####################
    $update = "UPDATE ticket SET letto = 1 WHERE id = ".$primary_key." AND stato = 'Chiuso'";
    $db_suiteweb->query($update);
}
function abilita_pms($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_pms SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_pms($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_pms SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function func_pms($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value!=''){

        switch($value){
            case "hotelcinquestelle.cloud":
                $tipo_pms = 'C';
            break;
            case "booking.ericsoft.com":
                $tipo_pms = 'E';
            break;
        }

        $db = Xcrud_db::get_instance();
        $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = ".$row['hospitality_guest.Id']."  AND  idsito = ".$_SESSION['IDSITO'];
        $res = $db->query($select);
        $rec = $db->row($res);
        if(is_array($rec)) {
            if($rec > count($rec)) // se la pagina richiesta non esiste
                $tot = count($rec); // restituire la pagina con il numero più alto che esista
        }else{
            $tot = 0;
        }

        if($tot > 0){

            $data_tmp = explode("-",$rec['data_reservation']);
            $data_reservation = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];

            $color_ins  = 'text-orange';
            $title      = 'Ri-sincronizza se hai modificato la prenotazione dopo la prima sincro del '.$data_reservation;
            $button_del = '<a href = "javascript: validator(\'//'.$_SERVER["HTTP_HOST"].'/v2/delete_preno_pms/'.$row['hospitality_guest.Id'].'/sync/'.$tipo_pms.'/\');" title = "Elimina Prenotazione sincronizzata il '.$data_reservation.' dal PMS" data-toogle = "tooltip" style = "float: left;padding-left : 4px;"><i class = "fa fa-trash text-red" aria-hidden = "true"></i></a>';
        }else{
            $color      = '';
            $title      = 'Sincronizza con PMS';
            $button_del = '';
        }
        $button_ins    = '<a href = "javascript: validator_pms(\'//'.$_SERVER["HTTP_HOST"].'/v2/syncro_pms/'.$row['hospitality_guest.Id'].'/sync/'.$tipo_pms.'/\');" title   = "'.$title.'"  data-toogle = "tooltip" style = "float: left;padding-right: 4px;margin-left: 4px"><i class = "fa fa-refresh '.$color_ins.'" aria-hidden = "true"></i></a>';

        $action_button = $button_ins.$button_del;
    }
    return $action_button;
}
function func_pms_ericsoft($value, $fieldname, $primary_key, $row, $xcrud)
{
    $ret = '';
    $tipo_pms = 'E';

    $db = Xcrud_db::get_instance();
    $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = " . $row['hospitality_guest.Id'] . "  AND  idsito = " . $_SESSION['IDSITO'] . " AND TypePms = '$tipo_pms'";
    $res = $db->query($select);
    $rec = $db->row();

    if ($rec && is_array($rec)) {
        $data_tmp = explode("-", $rec['data_reservation']);
        $data_reservation = $data_tmp[2] . '-' . $data_tmp[1] . '-' . $data_tmp[0];

        $ret = '<i class="fa fa-check text-primary" data-toggle="tooltip" title="Sincronizzato Ericsoft" aria-hidden="true"></i><br/>';

        if ($rec['pms_info'] != 'modified') {
            $ret .= '<a href="javascript: validator_pms(\'//' . $_SERVER["HTTP_HOST"] . '/v2/modify_preno_pms/' . $row['hospitality_guest.Id'] . '/sync/' . $tipo_pms . '/\');" 
                   title="Se modificate la prenotazione in QUOTO, per aggiornarla anche sul PMS cliccate sull\'icona! Modifica la prenotazione sincronizzata il ' . $data_reservation . ' dal PMS" 
                   data-toogle="tooltip"
                   style="margin-right: 10px" 
                   ><i class = "fa fa-edit text-primary" aria-hidden = "true"></i></a>';

        } 
        if ($rec['pms_info'] != 'canceled') {
            $ret .= '<a href="javascript: validator(\'//' . $_SERVER["HTTP_HOST"] . '/v2/modify_preno_pms/' . $row['hospitality_guest.Id'] . '/sync/' . $tipo_pms . '&pms_info=canceled\');" 
                    title="Elimina Prenotazione sincronizzata il ' . $data_reservation . ' dal PMS, dopo aver cliccato devi mettere nel cestino di QUOTO la prenotazione, cosi viene eliminata anche nel PMS" 
                    data-toogle="tooltip" ><i class = "fa fa-trash text-red" aria-hidden = "true"></i></a>';

        }
    } else {
        $ret = '<i class="fa fa-refresh text-primary" data-toggle="tooltip" title="In attesa di sincronizzazione da parte di Ericsoft" aria-hidden="true"></i>';
    }

    return $ret;
}
function func_pms_bedzzle($value, $fieldname, $primary_key, $row, $xcrud)
{
        $db = Xcrud_db::get_instance();
        $select = "SELECT   *  FROM   hospitality_data_syncro_pms   WHERE  id_prenotazione = ".$row['hospitality_guest.Id']."  AND  idsito = ".$_SESSION['IDSITO'] . " AND TypePms = 'B'";
        $res = $db->query($select);
        $rec = $db->row($res);
        if(is_array($rec)) {
            if($rec > count($rec)) 
                $tot = count($rec); 
        }else{
            $tot = 0;
        }

        if($tot > 0){

            $data_tmp = explode("-",$rec['data_reservation']);
            $data_reservation = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0];

            $color_ins  = 'text-orange';
            $title      = 'Ri-sincronizza se hai modificato la prenotazione dopo la prima sincro del '.$data_reservation;
            $button_del = '<a href = "javascript: validator(\'//'.$_SERVER["HTTP_HOST"].'/v2/delete_preno_pms_bedzzle/'.$row['hospitality_guest.Id'].'/sync/B/\');" title = "Elimina Prenotazione sincronizzata il '.$data_reservation.' dal PMS" data-toogle = "tooltip" style = "float: left;padding-left : 4px;"><i class = "fa fa-trash text-red" aria-hidden = "true"></i></a>';
        }else{
            $color      = '';
            $title      = 'Sincronizza con PMS';
            $button_del = '';
        }
        $button_ins    = '<a href = "javascript: validator_pms(\'//'.$_SERVER["HTTP_HOST"].'/v2/syncro_pms/'.$row['hospitality_guest.Id'].'/sync/B/\');" title   = "'.$title.'"  data-toogle = "tooltip" style = "float: left;padding-right: 4px;margin-left: 4px"><i class = "fa fa-refresh '.$color_ins.'" aria-hidden = "true"></i></a>';

        $action_button = $button_ins.$button_del;
    
    return $action_button;
}
function flag_pms($value, $fieldname, $primary_key, $row, $xcrud){

        $db = Xcrud_db::get_instance();
        $db->query('SELECT * FROM hospitality_tipo_camere WHERE Id = '.$primary_key);
        $rw = $db->row();

        $select = "SELECT * FROM hospitality_pms_camere WHERE idsito = ".$_SESSION['IDSITO'];
        $ris    = $db->query($select);
        $rows 	= $db->result($ris);
        if($rows) {

                $butt .= ($rw['RoomTypePms']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Camera</button>':'');

                foreach($rows as $value) {
                    $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                    $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere/'.$value['RoomTypeId'].'/'.$rw['Id'].'/"><small>'.$value['RoomTypeDescription'].'</small></a></li>';
                    $butt .= ($rw['RoomTypePms']==$value['RoomTypeId']?'<button type="button" class="btn btn-default btn-xs">'.$value['RoomTypeDescription'].'</button>':'');
                }

                $code = '
                <div class="btn-group">
                    '.$butt.'
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                    '.$filtro1.''.$filtro.'
                    </ul>
                </div>';


    }else{
        $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
    }


return $code;
}
function flag_soggiorni_pms($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $db->query('SELECT * FROM hospitality_tipo_soggiorno WHERE Id = '.$primary_key);
    $rw = $db->row();

    $select = "SELECT * FROM hospitality_pms_trattamenti WHERE idsito = ".$_SESSION['IDSITO'];
    $ris    = $db->query($select);
    $rows 	= $db->result($ris);
    if($rows) {

            $butt .= ($rw['PlanTypePms']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Soggiorno</button>':'');

            foreach($rows as $value) {
                $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno/'.$value['RateId'].'/'.$rw['Id'].'/"><small>['.$value['RateId'].'] '.$value['Description'].'</small></a></li>';
                $butt .= ($rw['PlanTypePms']==$value['RateId']?'<button type="button" class="btn btn-default btn-xs">['.$value['RateId'].'] '.$value['Description'].'</button>':'');
            }

            $code = '
            <div class="btn-group">
                '.$butt.'
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                '.$filtro1.''.$filtro.'
                </ul>
            </div>';


}else{
    $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
}


return $code;
}
function campo_prezzo($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div class="input-group">
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-euro"></i></span>
                </div>
                <input style="z-index:1!important" class="xcrud-input form-control"  type="text" data-type="float" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" data-pattern="numeric" placeholder="Se il prezzo contiene decimali separarli da un punto es. 00.00">
            </div>';
}
function percentuale_prezzo($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div class="input-group">
                <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-percent"></i></span>
                </div>
                <input style="z-index:1!important" class="xcrud-input form-control"  type="text" data-type="float" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" data-pattern="numeric" placeholder="00">
            </div>';
}
function format_price($value, $fieldname, $primary_key, $row, $xcrud)
{
        if($value){
            $prezzo = '<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($value,2,',','.');
        }
    return $prezzo;
}
function format_price_sevizi($value, $fieldname, $primary_key, $row, $xcrud)
{
        if($value){
            $prezzo = '<i class="fa fa-euro"></i>&nbsp;&nbsp;'.number_format($value,2,',','.');
        }else{
            if($row['hospitality_tipo_servizi.PercentualeServizio']!=''){
                $prezzo = '';
            }else{
                $prezzo = 'Gratuito';
            }
           
        }
    return $prezzo;
}
function format_percentuale_sevizi($value, $fieldname, $primary_key, $row, $xcrud)
{
        if($value){
            $output = '<i class="fa fa-percent"></i>&nbsp;&nbsp;'.number_format($value,2);
        }
    return $output;
}
function ico_sesso($value, $fieldname, $primary_key, $row, $xcrud)
{
        if($value){
            if($value == 'Male'){
                $icona = '<i class="fa fa-male" data-toogle="tooltip" title="Uomo"></i>';
            }else{
                $icona = '<i class="fa fa-female" data-toogle="tooltip" title="Donna"></i>';
            }
        }
    return $icona;
}
function custom_textarea_camere($value, $fieldname, $primary_key, $row, $xcrud)
{
    return  ' <div class="alert alert-warning">'
            .'     <p>LEGENDA: <br>vuoi inserire un iframe GMAP per ogni camera/appartamento/bungalow clicca sul <a href="https://www.google.it/maps/" target="_blank" title="Link alla google map">Link alla Google Maps</a> Una volta ottenuto il codice dell\'iframe copialo ed incollalo nella posizione che preferisci della textarea ma visualizzandola lato SORGENTE!
                    <br>Se inserite una googlemap per ogni camera e/o appartamento è consigliabile disabilitare la Mappa principale della landing page dalla voce di menù Contenuti & Template -> Abilita/Disabilita GoogleMap</p>'
            .'  </div>'
            .'  <textarea id="'.$xcrud->fieldname_encode($fieldname).'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'    '.$value.' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("'.$xcrud->fieldname_encode($fieldname).'");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';
}
function get_data_esplosa($value,$xcrud)
{
    if($value != '') {
       $value        = date('D, d M Y' , strtotime($value));
       $array_mesi   = array('Jan' => 'Gen', 'Feb' => 'Feb', 'Mar' => 'mar', 'Apr' => 'Apr','May' => 'Mag', 'Jun' => 'Giu', 'Jul' => 'Lug', 'Aug' => 'Ago','Sep' => 'Set', 'Oct' => 'Ott', 'Nov' => 'Nov','Dec' => 'Dic');
       $array_giorni = array('Sun' => 'Dom','Mon'  => 'Lun','Tue'  => 'Mar','Wed'  => 'Mer','Thu' => 'Gio','Fri'  => 'Ven','Sat'  => 'Sab');
       $data_tmp     = explode(",",$value);
       $data_tmp_    = explode(" ",$data_tmp[1]);
       $data         = $array_giorni[$data_tmp[0]].', '.$data_tmp_[1].' '.$array_mesi[$data_tmp_[2]].' '.$data_tmp_[3];
    }else{
        $data  = '';
    }
    return '<small>'.$data.'</small>';
}

function get_data_arrivo_conferma($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value != '') {


            $arrivo   = '';
            $d_arrivo = '';
            $d_value  = '';
                // date alternative
                $db = Xcrud_db::get_instance();
                $se = "SELECT hospitality_proposte.Arrivo FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$primary_key." AND Arrivo IS NOT NULL";
                $re = $db->query($se);
                $rc = $db->row($re);
                if(is_array($rc)) {
                    if($rc > count($rc))
                        $tt = count($rc);
                }else{
                    $tt = 0;
                }
                if($tt>0){


                        if($value != $rc['Arrivo']){

                            if($rc['Arrivo']!= '' && $rc['Arrivo'] != '0000-00-00'){

                                $d_arrivo = date('d-m-Y' , strtotime($rc['Arrivo']));
                                $arrivo =  $d_arrivo;
                            }else{
                                $d_value  = date('d-m-Y' , strtotime($value));
                                $arrivo =  $d_value;
                            }
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($value));
                            $arrivo =  $d_value;
                        }

                }else{
                    $d_value  = date('d-m-Y' , strtotime($value));
                    $arrivo =  $d_value;
                }



    return '<small style="white-space: nowrap;">'.$arrivo.'</small>';
    }
}
function get_data_partenza_conferma($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value != '') {


            $partenza   = '';
            $d_partenza = '';
            $d_value    = '';

                // date alternative
                $db = Xcrud_db::get_instance();
                $se = "SELECT hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$primary_key." AND Partenza IS NOT NULL";
                $re = $db->query($se);
                $rc = $db->row($re);
                if(is_array($rc)) {
                    if($rc > count($rc))
                        $tt = count($rc);
                }else{
                    $tt = 0;
                }
                if($tt>0){

                    if($value != $rc['Partenza']){
                        if($rc['Partenza']!= '' && $rc['Partenza'] != '0000-00-00'){
                            $d_partenza = date('d-m-Y' , strtotime($rc['Partenza']));
                            $partenza   = $d_partenza;
                            $update = "UPDATE hospitality_guest SET DataPartenza = '".$rc['Partenza']."' WHERE id = ".$primary_key;
                            $db->query($update);
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($value));
                            $partenza = $d_value;
                        }
                    }else{
                        $d_value  = date('d-m-Y' , strtotime($value));
                        $partenza = $d_value;
                    }
                }else{
                    $d_value  = date('d-m-Y' , strtotime($value));
                    $partenza = $d_value;
                }


    return '<small style="white-space: nowrap;">'.$partenza.'</small>';
    }
}
function get_data_arrivo_profila($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($row['hospitality_guest.TipoRichiesta'] == 'Conferma') {


            $arrivo   = '';
            $d_arrivo = '';
            $d_value  = '';
                // date alternative
                $db = Xcrud_db::get_instance();
                $se = "SELECT hospitality_proposte.Arrivo FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$primary_key." AND Arrivo IS NOT NULL";
                $re = $db->query($se);
                $rc = $db->row($re);
                if(is_array($rc)) {
                    if($rc > count($rc))
                        $tt = count($rc);
                }else{
                    $tt = 0;
                }
                if($tt>0){

                    if($value != $rc['Arrivo']){
                        if($rc['Arrivo']!= '' && $rc['Arrivo'] != '0000-00-00'){
                            $d_arrivo = date('d-m-Y' , strtotime($rc['Arrivo']));
                            $arrivo =  $d_arrivo;
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($value));
                            $arrivo =  $d_value;
                        }
                    }else{
                        $d_value  = date('d-m-Y' , strtotime($value));
                        $arrivo =  $d_value;
                    }
                }else{
                    $d_value  = date('d-m-Y' , strtotime($value));
                    $arrivo =  $d_value;
                }

            }else{
                $d_value  = date('d-m-Y' , strtotime($value));
                $arrivo =  $d_value;
            }

    return '<small style="white-space: nowrap;">'.$arrivo.'</small>';

}
function get_data_partenza_profila($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($row['hospitality_guest.TipoRichiesta'] == 'Conferma') {


            $partenza   = '';
            $d_partenza = '';
            $d_value    = '';

                // date alternative
                $db = Xcrud_db::get_instance();
                $se = "SELECT hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.id_richiesta = ".$primary_key." AND Partenza IS NOT NULL";
                $re = $db->query($se);
                $rc = $db->row($re);
                if(is_array($rc)) {
                    if($rc > count($rc))
                        $tt = count($rc);
                }else{
                    $tt = 0;
                }
                if($tt>0){

                    if($value != $rc['Partenza']){
                        if($rc['Partenza']!= '' && $rc['Partenza'] != '0000-00-00'){
                            $d_partenza = date('d-m-Y' , strtotime($rc['Partenza']));
                            $partenza   = $d_partenza;
                        }else{
                            $d_value  = date('d-m-Y' , strtotime($value));
                            $partenza = $d_value;
                        }
                    }else{
                        $d_value  = date('d-m-Y' , strtotime($value));
                        $partenza = $d_value;
                    }
                }else{
                    $d_value  = date('d-m-Y' , strtotime($value));
                    $partenza = $d_value;
                }

        }else{
            $d_value  = date('d-m-Y' , strtotime($value));
            $partenza = $d_value;
        }

    return '<small style="white-space: nowrap;">'.$partenza.'</small>';

}
function view_domanda($value, $fieldname, $primary_key, $row, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $se = "SELECT hospitality_domande.Domanda FROM hospitality_domande  WHERE hospitality_domande.Id = ".$row['hospitality_customer_satisfaction.id_domanda']." ";
    $re = $db->query($se);
    $record = $db->row($re);

    return $record['Domanda'];

}
function view_nome_richiesta($value, $fieldname, $primary_key, $row, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $se = "SELECT hospitality_guest.Nome,hospitality_guest.Cognome FROM hospitality_guest  WHERE hospitality_guest.Id = ".$row['hospitality_customer_satisfaction.id_richiesta']." ";
    $re = $db->query($se);
    $record = $db->row($re);

    return $record['Nome'].' '.$record['Cognome'];

}
function check_email_upselling($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value > 0){
        $DataInvio = '';
        $db = Xcrud_db::get_instance();
        $se = "SELECT hospitality_traccia_email_upselling.data_invio FROM hospitality_traccia_email_upselling  WHERE hospitality_traccia_email_upselling.id_richiesta = ".$row['hospitality_guest.Id']." AND NumPreno = ".$row['hospitality_guest.NumeroPrenotazione']." ORDER BY data_invio DESC LIMIT 1";
        $re = $db->query($se);
        $rec = $db->row($re);
        $DataInvio_tmp = explode(" ", $rec['data_invio']);
        $DataInvio_ = explode("-", $DataInvio_tmp[0]);
        $DataInvio = $DataInvio_[2].'-'.$DataInvio_[1].'-'.$DataInvio_[0].' '.$DataInvio_tmp[1];
        $valore = '<small><label class="badge bg-teal pull-center"><a href="https://'.$_SERVER['HTTP_HOST'].'/v2/timeline/'.$row['hospitality_guest.NumeroPrenotazione'].'" class="text-white"  data-toogle="tooltip" title="Inviat'.($value==1?'a':'e').' Email di Upselling il '.$DataInvio.'">'.$value.'</a></label></small>';
    }else{
        $valore = '';
    }
    return $valore;
}
function abilita_plugin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_configurazioni SET valore = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_plugin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_configurazioni SET valore = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function descr_parametro_config($value, $fieldname, $primary_key, $row, $xcrud){
  if($value){
    switch($value){
      case"select_tipo_camere":
        $result = 'Abilita o disabilita il <b>box di ricerca nella select delle camere</b> in Crea Proposta Soggiorno';
      break;
      case"check_verify_email":
        $result = 'Abilita o disabilita il <b>controllo in real-time della email</b> del cliente inserita in Crea Proposta Soggiorno';
      break;
      case"check_pagination":
        $result = 'Abilita o disabilita la possibilità di <b>usare il ritorno alla pagina in base alla scelta nel menù di paginazione</b> in Preventivi, Conferme e Prenotazioni';
      break;
      case"check_paypal":
        $result = 'Abilita o disabilita il <b>modulo di pagamento PayPal</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, ricordatevi di completare il relativo setting inserendo l\'email che avete dedicato a PayPal <small>(nome del campo: Email per account PayPal)</small>';
      break;
      case"check_gateway_bancario":
        $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario BCC</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la BCC quindi ricordatevi di completare il setting con i dati mancanti <small>(nomi dei campi: Server URL Gateway BCC, Id Cliente, API Key Cliente, Email Cliente)</small>';
      break;
      case"check_notifiche_push":
        $result = 'Abilita o disabilita le <b>Box Notifiche in Push</b> che appaiono in Preventivi, Conferme, Prenotazioni, Ticket, Dashboard, ecc';
      break;
      case"check_open_servizi":
        $result = 'Fai partire da <b>aperto o chiuso il box dei Servizi Aggiuntivi</b> in Crea Proposta Soggiorno';
      break;
      case"check_virtualpay":
        $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario Virtual Pay</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la Banca e richiesto il modulo di pagamento Virtual Pay. Quindi ricordatevi di completare il setting con i dati mancanti';
      break;
      case"check_banca_sella":
        $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway Bancario Banca Sella</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto con la Banca e richiesto il modulo di pagamento Banca Sella. Quindi ricordatevi di completare il setting con i dati mancanti';
      break;
      case"check_stripe":
        $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway STRIPE</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto e/o una registrazione con STRIPE. Quindi ricordatevi di completare il setting con i dati mancanti';
      break;
      case"check_nexi":
        $result = 'Abilita o disabilita il <b>modulo di pagamento tramite Gateway NEXI</b> in Config.Impostazioni->Tipi di Pagamento. Se abilitate il modulo, significa che avete stipulato un contratto e/o una registrazione con NEXI. Quindi ricordatevi di completare il setting con i dati mancanti';
      break;
      case"check_mailup":
        $result = 'Abilita o disabilita il <b>salvataggio dei dati FORM del tuo sito in MAIL UP</b>';
      break;
      case "check_adr":
        $result = 'Abilita o disabilita info-box <b>ADR QUOTO!</b> visibile dall\'area Dashboard.';
        break;
    case "check_interfaccia":
        $result = 'Abilita o disabilita <b>per aprire QUOTO al login</b> con la <b>nuova</b> o <b>vecchia</b> interfaccia.';
        break;
    case "check_email_voucher_hotel":
        $result = 'Abilita o disabilita <b>invio copia della mail voucher</b> verso Hotel';
        break;
    }
    return $result;
  }
}
function hidden_password($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value){

        $pass_cript = '';
        $pass       = '';
        $i          = 1;
        $rnd = md5(rand(1000,9999).$value);

        $n_caratteri = strlen($value);
        for($i==1; $i<=$n_caratteri; $i++){
            $pass_cript .= '*';
        }

        $pass .= '<div id="Cpass'.$rnd.'" style="display:block;cursor:pointer">'.$pass_cript.'</div>'."\r\n";
        $pass .= '<div id="pul'.$rnd.'" onclick="copyToClipboard(\'#'.$rnd.'\')" title="Copia" style="display:none;cursor:pointer;font-size:10px;float:right;"><i class="fa fa-clone" id="'.$rnd.'fa"></i><br><br></div>';
        $pass .= '<div id="'.$rnd.'" style="display:none;cursor:pointer">'.base64_decode($value).'</div>'."\r\n";
        $pass .= '<script>
                    $(document).ready(function() {
                        $(\'#Cpass'.$rnd.'\').click(function() {
                                $(\'#Cpass'.$rnd.'\').hide();
                                $(\'#'.$rnd.'\').show();
                                $(\'#pul'.$rnd.'\').show();
                        });
                        $(\'#'.$rnd.'\').click(function() {
                                $(\'#pul'.$rnd.'\').hide();
                                $(\'#'.$rnd.'\').hide();
                                $(\'#Cpass'.$rnd.'\').show();
                        });
                    });
                    function copyToClipboard(element) {
                        var $temp = $("<input>");
                        $("body").append($temp);
                        $temp.val($(element).text()).select();
                        document.execCommand("copy");
                        $(element+"fa").removeClass("fa fa-clone");
                        $(element+"fa").addClass("fa fa-check");
                        setTimeout(function(){
                          $(element+"fa").removeClass("fa fa-check");
                          $(element+"fa").addClass("fa fa-clone");
                        },5000);
                        $temp.remove();
                    }
                </script>'."\r\n";

        return $pass;
    }
}
function check($stringa){

  $db = Xcrud_db::get_instance();
  $query = "SELECT * FROM hospitality_fonti_prenotazione WHERE idsito = ".$_SESSION['IDSITO']." AND FontePrenotazione = '".$stringa."' ";
  $res = $db->query($query);
  $record = $db->result($res);
  if(sizeof($record)==0){
    $output = $stringa;
  }else{
    $output = 'La fonte che avete inserito era già presente, elimina questo record!';
  }

    return $output;
}
function check_fonte($postdata, $xcrud){

    $postdata->set('FontePrenotazione', check($postdata->get('FontePrenotazione')));
}

function alert_fonte($value, $fieldname, $primary_key, $row, $xcrud)
{
  if($value){
    if($value == 'La fonte che avete inserito era già presente, elimina questo record!'){
      return '<span class="text-red">'.($value== 'Sito Web'?$value.' / Landing':$value).'</span>';
    }else{
      return ($value== 'Sito Web'?$value.' / Landing':$value);
    }
  }
}
function func_fatturato($value, $fieldname, $primary_key, $row, $xcrud)
{
  if($value){
    $valore = '<div style="display:none">'.$value.'</div>';
  }
  return $valore;
}
function abilita_parity($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_parityrate SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_parity($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_parityrate SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function flag_pms_bedzzle($value, $fieldname, $primary_key, $row, $xcrud){

        $db = Xcrud_db::get_instance();
        $db->query('SELECT * FROM hospitality_tipo_camere WHERE Id = '.$primary_key);
        $rw = $db->row();

        $select = "SELECT * FROM hospitality_pms_camere  WHERE hospitality_pms_camere.idsito = ".$_SESSION['IDSITO'];
        $ris    = $db->query($select);
        $rows 	= $db->result($ris);
        if($rows) {

                $butt = ($rw['RoomTypePms']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Camera</button>':'');

                foreach($rows as $value) {

                        $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                        $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere/'.$value['RoomTypeId'].'/'.$rw['Id'].'/"><small>'.$value['RoomTypeDescription'].'</small></a></li>';
                        $butt .= ($rw['RoomTypePms']==$value['RoomTypeId']?'<button type="button" class="btn btn-default btn-xs">'.$value['RoomTypeDescription'].'</button>':'');
                    
                }

                $code = '
                <div class="btn-group">
                    '.$butt.'
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                    '.$filtro1.''.$filtro.'
                    </ul>
                </div>';


    }else{
        $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
    }


return $code;
}
function flag_pms_soggiorno_bedzzle($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $db->query('SELECT * FROM hospitality_tipo_soggiorno WHERE Id = '.$primary_key.'');
    $rw = $db->row();

    $select = "SELECT * FROM hospitality_pms_trattamenti INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.PlanCode = hospitality_pms_trattamenti.RateId WHERE hospitality_tipo_soggiorno.idsito = ".$_SESSION['IDSITO']." AND hospitality_pms_trattamenti.idsito = ".$_SESSION['IDSITO'];
    $ris    = $db->query($select);
    $rows 	= $db->result($ris);
 
    if($rows) {
            $butt = ($rw['RateId']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Soggiorno</button>':'');
 
            foreach($rows as $value) {
                if($value['RateId']==$rw['PlanCode'] ){
                    $butt = '<button type="button" class="btn btn-default btn-xs">['.$value['RateId'].'] '.$value['Description'].'</button>';
                    $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno/'.$value['RateId'].'/'.$rw['Id'].'/"><small>['.$value['RateId'].'] '.$value['Description'].'</small></a></li>';
                }else{     
                    $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                    $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno/'.$value['RateId'].'/'.$rw['Id'].'/"><small>['.$value['RateId'].'] '.$value['Description'].'</small></a></li>';
                    $butt .= ($value['RateId']==$rw['PlanCode']?'<button type="button" class="btn btn-default btn-xs">['.$value['RateId'].'] '.$value['Description'].'</button>':'');
                }
            }

            $code = '
            <div class="btn-group">
                '.$butt.'
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                '.$filtro1.''.$filtro.'
                </ul>
            </div>';


    }else{
        $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
    }

    return $code;
}
function flag_soggiorni_parity($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $db->query('SELECT * FROM hospitality_tipo_soggiorno WHERE Id = '.$primary_key);
    $rw = $db->row();

    $select = "SELECT * FROM hospitality_parity_trattamenti WHERE idsito = ".$_SESSION['IDSITO'];
    $ris    = $db->query($select);
    $rows 	= $db->result($ris);
    if($rows) {

            $butt .= ($rw['RateParityId']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Soggiorno</button>':'');

            foreach($rows as $value) {
                $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno_parity/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_soggiorno_parity/'.$value['RateId'].'/'.$rw['Id'].'/"><small>['.$value['RateId'].'] '.$value['Description'].'</small></a></li>';
                $butt .= ($rw['RateParityId']==$value['RateId']?'<button type="button" class="btn btn-default btn-xs">['.$value['RateId'].'] '.$value['Description'].'</button>':'');
            }

            $code = '
            <div class="btn-group">
                '.$butt.'
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                '.$filtro1.''.$filtro.'
                </ul>
            </div>';


  }else{
      $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinato!</small>';
  }
return $code;
}
function flag_camere_parity($value, $fieldname, $primary_key, $row, $xcrud){

        $db = Xcrud_db::get_instance();
        $db->query('SELECT * FROM hospitality_tipo_camere WHERE Id = '.$primary_key);
        $rw = $db->row();

        $select = "SELECT * FROM hospitality_parity_camere WHERE idsito = ".$_SESSION['IDSITO'];
        $ris    = $db->query($select);
        $rows 	= $db->result($ris);
        if($rows) {

                $butt .= ($rw['RoomParityId']==''?'<button type="button" class="btn btn-default btn-xs">Abbina tipo Camera</button>':'');

                foreach($rows as $value) {
                    $filtro1 = '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere_parity/0/'.$rw['Id'].'/"><small>Non abbinato</small></a></li>';
                    $filtro .= '<li><a href="//'.$_SERVER["HTTP_HOST"].'/v2/associa_camere_parity/'.$value['RoomId'].'/'.$rw['Id'].'/"><small>'.$value['RoomDescription'].'</small></a></li>';
                    $butt .= ($rw['RoomParityId']==$value['RoomId']?'<button type="button" class="btn btn-default btn-xs">'.$value['RoomDescription'].'</button>':'');
                }

                $code = '
                <div class="btn-group">
                    '.$butt.'
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                    '.$filtro1.''.$filtro.'
                    </ul>
                </div>';


    }else{
        $code =  '<small style="white-space:nowrap;" class="text-red">Non abbinata!</small>';
    }


return $code;
}
function custom_input($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text"  class="xcrud-input form-control" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" />';
}
function get_whatsapp($value, $fieldname, $primary_key, $row, $xcrud)
{
    if(strlen($value)>3){
        if(($row['hospitality_guest.DataScadenza']!='') && ($row['hospitality_guest.DataScadenza']>=date('Y-m-d')) && ($row['hospitality_guest.AbilitaInvio'] == 1)){
            $db = Xcrud_db::get_instance();
            $db->query('SELECT PrefissoInternazionale FROM hospitality_guest WHERE Id = '.$primary_key);
            $rw = $db->row();
            if($rw['PrefissoInternazionale']==''){
                $WhatsApp = '<small><small class="text-red">Prefisso (int) non impostato!</small></small>';
            }else{
                $WhatsApp = '<a class="btn btn-default btn-sm" href="https://'.$_SERVER['HTTP_HOST'].'/v2/send_whatsapp/send/'.$primary_key.'" data-toogle="tooltip" target="_blank" title="Invia preventivo con Whatsapp al '.$value.'">
                                <i class="fa fa-whatsapp text-green" aria-hidden="true"></i>
                            </a>';
            }
        }
    }else{
        $WhatsApp = '';
    }
    return $WhatsApp;
}
function get_whatsapp_conf($value, $fieldname, $primary_key, $row, $xcrud)
{
    if(strlen($value)>3){
        if(($row['hospitality_guest.DataScadenza']!='') && ($row['hospitality_guest.DataScadenza']>=date('Y-m-d'))){
            $WhatsApp = '<a class="btn btn-default btn-sm" href="https://'.$_SERVER['HTTP_HOST'].'/v2/send_whatsapp/send/'.$primary_key.'" data-toogle="tooltip" target="_blank" title="Invia richiesta caparra con Whatsapp al '.$value.'">
                            <i class="fa fa-whatsapp text-green" aria-hidden="true"></i>
                        </a>';
        }
    }else{
        $WhatsApp = '';
    }
    return $WhatsApp;
}
function abilita_motivazione($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_voucher_cancellazione SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_motivazione($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_voucher_cancellazione SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function textarea_motivazioni($value, $fieldname, $primary_key, $row, $xcrud)
{

    return '<div class="alert alert-profila alert-default-profila alert-dismissable">'
            .'  <p>Legenda:</p> '
            .'     <p><small>Durante la compilazione del <b>contenuto email</b> è possibile e consigliato l\'uso di SHORT TAG ! '        
            .'          <b>LISTA DEGLI SHORT TAG DISPONIBILI:</b> [cliente], [caparra], [numeropreno], [emailhotel], [linkvoucher] e [struttura]</small></p>'
            .'  </div>'
            .'  <textarea id="'.$xcrud->fieldname_encode($fieldname).'" name="'.$xcrud->fieldname_encode($fieldname).'"  class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
            .'    '.$value.' '
            .'  </textarea>  '
            .'  <script type="text/javascript">'
            .'      $(function(){ '
            .'         CKEDITOR.replace("'.$xcrud->fieldname_encode($fieldname).'");'
            .'         $(".textarea").wysihtml5(); '
            .'     });'
            .'  </script>'
            .'  <script type="text/javascript">'
            .'        CKEDITOR.config.toolbar = ['
            .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
            .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
            .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
            .'                       [\'Table\',\'Link\']'
            .'                    ] ;'
            .'        CKEDITOR.config.autoGrow_onStartup = true;'
            .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
            .'        CKEDITOR.config.autoGrow_minHeight = 200;'
            .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
            .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
            .'  </script>';
}
function oggetto_motivazioni($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div class="alert alert-profila alert-default-profila alert-dismissable">'
            .'  <p>Legenda:</p> '
            .'     <p><small>Durante la compilazione del <b>oggetto email</b> è possibile e consigliato l\'uso di SHORT TAG ! '        
            .'          <b>LISTA DEGLI SHORT TAG DISPONIBILI:</b> [cliente] e [numeropreno]</small></p>'
            .'  </div>'
            .'<input type="text" class="xcrud-input form-control" name="' . $xcrud->fieldname_encode($fieldname) . '"  value="' . $value .'" />';
}
function giradata($data){
	$data = explode(" ",$data);
	$data_tmp = explode("-",$data[0]);
	$new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];
	return $new_data;
}
function check_voucher_recupero_send($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value!= '' && $value!= '0000-00-00'){

        $db = Xcrud_db::get_instance();
        $query = 'SELECT hospitality_tipo_voucher_cancellazione.Motivazione FROM hospitality_tipo_voucher_cancellazione INNER JOIN hospitality_guest ON hospitality_guest.IdMotivazione = hospitality_tipo_voucher_cancellazione.Id WHERE hospitality_guest.Id = '.$primary_key.' AND hospitality_guest.idsito = '.$_SESSION['IDSITO'];
        $result = $db->query($query);
        $record = $db->row($result);

        $valore = '<i class="fa fa-tag blink text-orange" data-toogle="tooltip" data-html="true" title="Conferma proveniente da <br>buono voucher per modifica <br> date soggiorno,<br>Email inviata in data <br> '.giradata($row['hospitality_guest.DataVoucherRecSend']).' <br> Motivazione: <b>'.$record['Motivazione'].'</b>!"></i>';
    }else{
        $valore = '';
    }
    return $valore;
}
function check_recensione($value, $fieldname, $primary_key, $row, $xcrud){

    if($value==1){
        $db = Xcrud_db::get_instance();
        $select = "SELECT * FROM hospitality_recensioni_range WHERE idsito = ".$_SESSION['IDSITO']." AND abilita = 1";
        $result = $db->query($select);
        $res    = $db->result($result);
        $check  = sizeof($res);
        if($check==1){
            $tipo = 'con range a punteggio';
        }
        $select2 = "SELECT * FROM hospitality_giorni_recensioni WHERE idsito = ".$_SESSION['IDSITO']." AND abilita = 1";
        $result2 = $db->query($select2);
        $res2    = $db->result($result2);
        $check2  = sizeof($res2);
        if($check2==1){
            $tipo = 'con filtro temporale';
        }
        if($check == 0 && $check2 == 0){
            $tipo = 'con invio manuale';
        }
        $valore = '<i class="fa fa-tripadvisor text-green" data-toogle="tooltip" data-html="true" title="Richiesta di recensione '.$tipo.' su TripAdvisor inviata!"></i>';
    }else{
        $valore = '';
    }
    return $valore;
}
function check_preno_riconfermata($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value!= '' && $value!= '0000-00-00'){

        $db = Xcrud_db::get_instance();
        $query = 'SELECT hospitality_tipo_voucher_cancellazione.Motivazione FROM hospitality_tipo_voucher_cancellazione INNER JOIN hospitality_guest ON hospitality_guest.IdMotivazione = hospitality_tipo_voucher_cancellazione.Id WHERE hospitality_guest.Id = '.$primary_key.' AND hospitality_guest.idsito = '.$_SESSION['IDSITO'];
        $result = $db->query($query);
        $record = $db->row($result);

        $valore = '<i  class="fa fa-tag blink text-green" data-toogle="tooltip" data-html="true" title="Questa prenotazione proviene da un Buono Voucher ('.$record['Motivazione'].')<br>ri-confermato dopo variazione <br>delle date soggiorno!"></i>';
    }else{
        $valore = '';
    }
    return $valore;
}
function get_buono_voucher($value, $fieldname, $primary_key, $row, $xcrud){

    $db = Xcrud_db::get_instance();
    $select = "SELECT hospitality_proposte.Id as IdProposta, hospitality_proposte.NomeProposta,hospitality_proposte.PrezzoL,hospitality_proposte.PrezzoP,
                        hospitality_proposte.AccontoPercentuale,hospitality_proposte.AccontoImporto,hospitality_proposte.AccontoTesto,
                        hospitality_guest.NumeroAdulti,hospitality_guest.NumeroBambini,
                        hospitality_guest.EtaBambini1,hospitality_guest.EtaBambini2,hospitality_guest.EtaBambini3,hospitality_guest.EtaBambini4,
                        hospitality_guest.EtaBambini5,hospitality_guest.EtaBambini6,
                        hospitality_guest.AccontoRichiesta,hospitality_guest.Nome,hospitality_guest.Cognome,hospitality_guest.AccontoLibero,
                        hospitality_guest.Email,hospitality_guest.DataArrivo,hospitality_guest.DataPartenza,hospitality_guest.ChiPrenota,hospitality_guest.id_template

                FROM hospitality_proposte
                INNER JOIN hospitality_guest ON hospitality_guest.Id = hospitality_proposte.id_richiesta
                WHERE hospitality_proposte.id_richiesta = ".$primary_key." ORDER BY hospitality_proposte.Id ASC";
    $result = $db->query($select);
    $res    = $db->result($result);
    $tot    = sizeof($res);
    if($tot > 0){
        $Camere          = '';
        $acconto         = '';
        $saldo           = '';
        $etichetta_saldo = '';
        $IdTemplate      = '';
        $Template        = '';
        $data_alernativa = '';
        $DPartenza       = '';
        $DArrivo         = '';
        $DNotti          = '';
        foreach ($res as $key => $value) {

            $PrezzoL          = number_format($value['PrezzoL'],2,',','.');
            $PrezzoP          = number_format($value['PrezzoP'],2,',','.');
            $IdProposta       = $value['IdProposta'];
            $PrezzoPC         = $value['PrezzoP'];
            $AccontoRichiesta = $value['AccontoRichiesta'];
            $AccontoLibero    = $value['AccontoLibero'];
            $NomeProposta     = $value['NomeProposta'];
            $Operatore        = stripslashes($value['ChiPrenota']);
            $Nome             = stripslashes($value['Nome']);
            $Cognome          = stripslashes($value['Cognome']);
            $Email            = $value['Email'];
            $NumeroAdulti     = $value['NumeroAdulti'];
            $NumeroBambini    = $value['NumeroBambini'];
            $EtaBambini1      = $value['EtaBambini1'];
            $EtaBambini2      = $value['EtaBambini2'];
            $EtaBambini3      = $value['EtaBambini3'];
            $EtaBambini4      = $value['EtaBambini4'];
            $EtaBambini5      = $value['EtaBambini5'];
            $EtaBambini6      = $value['EtaBambini6'];
            $Arrivo_tmp       = explode("-",$value['DataArrivo']);
            $Arrivo           = $Arrivo_tmp[2].'-'.$Arrivo_tmp[1].'-'.$Arrivo_tmp[0];
            $Partenza_tmp     = explode("-",$value['DataPartenza']);
            $Partenza         = $Partenza_tmp[2].'-'.$Partenza_tmp[1].'-'.$Partenza_tmp[0];
            $IdTemplate       = $value['id_template'];

            $start            = mktime(24,0,0,$Arrivo_tmp[1],$Arrivo_tmp[2],$Arrivo_tmp[0]);
            $end              = mktime(01,0,0,$Partenza_tmp[1],$Partenza_tmp[2],$Partenza_tmp[0]);
            $formato="%a";
            $Notti = dateDiffNotti($value['DataArrivo'],$value['DataPartenza'],$formato);
            // date alternative
            $se = "SELECT hospitality_proposte.Arrivo,hospitality_proposte.Partenza FROM hospitality_proposte  WHERE hospitality_proposte.Id = ".$IdProposta."";
            $re = $db->query($se);
            $rc = $db->row($re);
            if(is_array($rc)) {
                if($rc > count($rc)) // se la pagina richiesta non esiste
                    $tt = count($rc); // restituire la pagina con il numero più alto che esista
            }else{
                $tt = 0;
            }
            if($tt>0){
                $DArrivo_tmp    = explode("-",$rc['Arrivo']);
                $DArrivo        = $DArrivo_tmp[2].'-'.$DArrivo_tmp[1].'-'.$DArrivo_tmp[0];
                $DPartenza_tmp  = explode("-",$rc['Partenza']);
                $DPartenza      = $DPartenza_tmp[2].'-'.$DPartenza_tmp[1].'-'.$DPartenza_tmp[0];
                $Dstart         = mktime(24,0,0,$DArrivo_tmp[1],$DArrivo_tmp[2],intval($DArrivo_tmp[0]));
                $Dend           = mktime(01,0,0,$DPartenza_tmp[1],$DPartenza_tmp[2],intval($DPartenza_tmp[0]));
                $formato="%a";
                $DNotti = dateDiffNotti($rc['Arrivo'],$rc['Partenza'],$formato);
            }

            if(is_null($IdTemplate) || $IdTemplate == 0){
                $Template = 'Predefinito';
            }else{
                $sel      = "SELECT TemplateName FROM hospitality_template_background  WHERE Id = ".$IdTemplate;
                $res      = $db->query($sel);
                $rec      = $db->row($res);
                $Template = ucfirst($rec['TemplateName']);
            }

            $AccontoPercentuale = $value['AccontoPercentuale'];
            $AccontoImporto     = $value['AccontoImporto'];
            $AccontoTesto       = stripslashes($value['AccontoTesto']);


            if($AccontoRichiesta != 0 && $AccontoLibero == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoRichiesta/100));
                $acconto = number_format(($PrezzoPC*$AccontoRichiesta/100),2,',','.');
            }
            if($AccontoRichiesta == 0 && $AccontoLibero != 0) {
                $saldo   = ($PrezzoPC-$AccontoLibero);
                $acconto = number_format($AccontoLibero,2,',','.');
            }

            if($AccontoPercentuale != 0 && $AccontoImporto == 0) {
                $saldo   = ($PrezzoPC-($PrezzoPC*$AccontoPercentuale/100));
                $acconto = number_format(($PrezzoPC*$AccontoPercentuale/100),2,',','.');
            }
            if($AccontoPercentuale == 0 && $AccontoImporto != 0) {
                if($AccontoImporto >= 1) {
                    $etichetta_caparra  = '';
                }else{
                    $etichetta_caparra  = '<br /><i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Carta di Credito a garanzia';
                }
                $saldo   = ($PrezzoPC-$AccontoImporto);
                $acconto = number_format($AccontoImporto,2,',','.');
            }
            if($PrezzoPC==$saldo){
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.0,00';
            }else{
                $etichetta_saldo = '<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Cifra a saldo €.'.number_format(floatval($saldo),2,',','.');
            }


            $select2 = "SELECT hospitality_richiesta.*,hospitality_tipo_camere.TipoCamere,hospitality_tipo_soggiorno.TipoSoggiorno
                        FROM hospitality_richiesta
                        INNER JOIN hospitality_tipo_camere ON hospitality_tipo_camere.Id = hospitality_richiesta.TipoCamere
                        INNER JOIN hospitality_tipo_soggiorno ON hospitality_tipo_soggiorno.Id = hospitality_richiesta.TipoSoggiorno
                        WHERE hospitality_richiesta.id_proposta = ".$IdProposta ;
            $result2 = $db->query($select2);
            $res2    = $db->result($result2);
            $Camere = '';
            if($rc['Arrivo'] != '' && $rc['Partenza'] != '' && $rc['Arrivo'] != '0000-00-00' && $rc['Partenza'] != '0000-00-00'){
                if($rc['Arrivo']!= $value['DataArrivo']){
                    $Arrivo   = $DArrivo;
                    $Notti    = $DNotti;
                }
                if($rc['Partenza']!= $value['DataPartenza']){
                    $Partenza   = $DPartenza;
                    $Notti      = $DNotti;
                }
            }
            foreach ($res2 as $ky => $val) {
                $Camere .= $val['TipoSoggiorno'].' <i class=\'fa fa-angle-right\'></i> Nr. '.$val['NumeroCamere'].' '.$val['TipoCamere'].($val['NumAdulti']!=0?' <i class=\'fa fa-angle-right\'></i> A: '.$val['NumAdulti']:'').($val['NumBambini']!=0?' B: '.$val['NumBambini']:'').($val['EtaB']!='' || $val['EtaB']!=0?' età: '.$val['EtaB']:'').' - €. '.number_format($val['Prezzo'],2,',','.').'<br>';
            }

             $sistemazione .= '<b>SOLUZIONE CONFERMATA</b><br>'.($NomeProposta!=''?'<b>'.$NomeProposta.'</b><br>':'').'<b>'.$Nome.' '.$Cognome.'</b> - <em>'.$Email.'</em><br>Adulti: <b>'.$NumeroAdulti .'</b> '.($NumeroBambini!='0'?' - Bambini: <b>'.$NumeroBambini .'</b> '.($EtaBambini1!='' && $EtaBambini1!='0'?' - '.$EtaBambini1.' anni ':'').($EtaBambini2!='' && $EtaBambini2!='0'?' - '.$EtaBambini2.' anni ':'').($EtaBambini3!='' && $EtaBambini3!='0'?' - '.$EtaBambini3.' anni ':'').($EtaBambini4!='' && $EtaBambini4!='0'?' - '.$EtaBambini4.' anni ':'').($EtaBambini5!='' && $EtaBambini5!='0'?' - '.$EtaBambini5.' anni ':'').($EtaBambini6!='' && $EtaBambini6!='0'?' - '.$EtaBambini6.' anni ':'').' ':'').'<br>Arrivo <i class=\'fa fa-angle-right\'></i> '.$Arrivo.' - Partenza <i class=\'fa fa-angle-right\'></i> '.$Partenza.' - per notti: '.$Notti.'<br> '.$Camere.' <i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp;  '.($PrezzoL!='0,00'?' Prezzo List. €.<strike>'.$PrezzoL.'</strike> <i class=\'fa fa-angle-right\'></i>':'').'  Prezzo Proposto €.'.$PrezzoP.'<br /> '.($acconto!=''?'<i class=\'fa fa-level-up\' style=\'transform:rotate(90deg)\'></i>&nbsp; Caparra versata o da prelevare €.'.$acconto.''.$etichetta_caparra:'').'<br />'.$etichetta_saldo.'<br>';

             $data_alernativa = '';
             $DPartenza       = '';
             $DArrivo         = '';
             $DNotti          = '';
        }
            $sistemazione = str_replace('"',' ',$sistemazione);
            $sistemazione .= '<div style=\'float:right\'><a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/print_pdf/'.base64_encode($primary_key).'\' target=\'_blank\' class=\'btn btn-success btn-xs\'>Print PDF</a>  <a href=\'https://'.$_SERVER['HTTP_HOST'].'/v2/anteprima_voucher_rec/'.$primary_key.'\' class=\'btn btn-info btn-xs\'>Preview Buono Voucher</a></div><br>';
           return '<a href="javascript:;" data-toogle="tooltip" title="Operatore: '.$Operatore.'" data-header="Proposte confermate Nr.'.$primary_key.'/'.$row['hospitality_guest.NumeroPrenotazione'].' - Operatore: '.$Operatore.'" data-content="'.$sistemazione.'" class="xcrud_modal"><i class="glyphicon glyphicon-comment"></i></a>';
    }else{
        return '';
    }
}
function motivazione_scadenza($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value!= ''){
        $contatore = '';
        $db = Xcrud_db::get_instance();
        $query = 'SELECT hospitality_guest.DataValiditaVoucher FROM hospitality_guest WHERE hospitality_guest.Id = '.$primary_key.' AND hospitality_guest.idsito = '.$_SESSION['IDSITO'];
        $result = $db->query($query);
        $record = $db->row($result);

        $query2 = 'SELECT hospitality_traccia_email_buoni_voucher.count FROM hospitality_traccia_email_buoni_voucher WHERE hospitality_traccia_email_buoni_voucher.id_richiesta = '.$primary_key.' AND hospitality_traccia_email_buoni_voucher.idsito = '.$_SESSION['IDSITO'];
        $result2 = $db->query($query2);
        $record2 = $db->row($result2);
        $numero = $record2['count'];
        if($numero > 0){
            $contatore = '<label class="badge bg-yellow pull-right" data-toogle="tooltip" title="Numero invii via e-mail del buono voucher"><small>'.$numero.'</small></label>';
        }else{
            $contatore = '';
        }

        $valore = $contatore.'<small><b>'.$value.'<br>Scad: '.($record['DataValiditaVoucher'] < date('Y-m-d')?'<span class="text-red">'.giradata($record['DataValiditaVoucher']).'</span>': '<span class="text-green">'.giradata($record['DataValiditaVoucher']).'</span>').'</b></small>';
    }else{
        $valore = '';
    }
    return $valore;
}
function link_documento($value, $fieldname, $primary_key, $row, $xcrud){

    if($value != ''){
        $link = '<a href="https://offerta.quoto.online/checkin/uploads/'.$value.'" target="_blank"><i class="fa fa-file-o"></i></a>';
    }else{
        $link = '<small class="text-gray">Nessun file è stato caricato!</small>';
    }
    return $link;
}
function check_campo_vuoto($value, $fieldname, $primary_key, $row, $xcrud){

    if($value){
        $output = '';
    }
    return $output;
}

function get_whatsapp_ckeckin($value, $fieldname, $primary_key, $row, $xcrud)
{
    if(strlen($value)>3){
        if($row['hospitality_guest.Cellulare']!=''){
            $db = Xcrud_db::get_instance();
            $db->query('SELECT PrefissoInternazionale FROM hospitality_guest WHERE Id = '.$primary_key);
            $rw = $db->row();
            if($rw['PrefissoInternazionale']==''){
                $WhatsApp = '<small><small class="text-red">Prefisso (int) non impostato!</small></small>';
            }else{
                $WhatsApp = '<div class="text-right" style="float:right";>
                                <a class="btn btn-default btn-sm" href="https://'.$_SERVER['HTTP_HOST'].'/v2/send_whatsapp_checkin/send/'.$primary_key.'" data-toogle="tooltip" target="_blank" title="Invia modulo di Checkin Online con Whatsapp al '.$value.'">
                                    <i class="fa fa-whatsapp text-green" aria-hidden="true"></i>
                                </a>
                            </div>';
            }
        }
    }else{
        $WhatsApp = '';
    }
    return $WhatsApp;
}
function abilita_info_checkin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_boxinfo_checkin SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_info_checkin($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_boxinfo_checkin SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_info_banner($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_banner_info SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_info_banner($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_banner_info SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function count_row_compilate($value, $fieldname, $primary_key, $row, $xcrud)
{
    $db = Xcrud_db::get_instance();
    $query = "SELECT COUNT(Id) as num FROM hospitality_checkin WHERE Prenotazione = '".$row['hospitality_checkin.Prenotazione']."' AND idsito = ".$row['hospitality_checkin.idsito'] ;
    $result = $db->query($query);
    $record = $db->row($result);
    $numero_compilati = $record['num'];
    $mancanti = ($row['hospitality_checkin.NumeroPersone']-$numero_compilati);
    if($mancanti < 2){
        $frase_mancanti =  'manca <b>'.$mancanti.'</b> ospite';
    }else{
        $frase_mancanti =  'mancano <b>'.$mancanti.'</b> ospiti';
    }
    if($numero_compilati == $row['hospitality_checkin.NumeroPersone']){
        $message = '<small class="text-green">Operazione di check-in completata!</small>';
    }else{
        $message = '<small class="text-red">L\'utente non ha portato a termine tutta la procedura di check-in, '.$frase_mancanti.'</small>';
    }
    return $message;
}

function abilita_tipo_gallery($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_gallery SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_tipo_gallery($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_gallery SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function abilita_tipo_gallery_target($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_gallery_target SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_tipo_gallery_target($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_gallery_target SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function abilita_servizio_obbligatorio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_servizi SET Obbligatorio = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_servizio_obbligatorio($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_tipo_servizi SET Obbligatorio = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function update_nome_template_from_target($postdata, $xcrud){

    $db = Xcrud_db::get_instance();
    $query = 'SELECT * FROM hospitality_tipo_gallery WHERE idsito = '.$_SESSION['IDSITO'];
    $result = $db->query($query);
    $record = $db->result($result);
    if(sizeof($record)>0){
        foreach($record as $key => $val){
            $update = 'UPDATE hospitality_template_background SET TemplateName = "'.$val['TargetGallery'].'" WHERE idsito = '.$_SESSION['IDSITO'].' AND TemplateType = "'.$val['TargetType'].'"';
            $db->query($update);
        }
    }

}
function update_nome_target_from_template($postdata, $xcrud){

    $db = Xcrud_db::get_instance();
    $query = 'SELECT * FROM hospitality_template_background WHERE idsito = '.$_SESSION['IDSITO'].' AND TemplateName != "default" AND TemplateName != "smart" AND TemplateType != ""';
    $result = $db->query($query);
    $record = $db->result($result);
    if(sizeof($record)>0){
        foreach($record as $key => $val){
            $update = 'UPDATE hospitality_tipo_gallery SET TargetGallery = "'.$val['TemplateName'].'" WHERE idsito = '.$_SESSION['IDSITO'].' AND TargetType = "'.$val['TemplateType'].'"';
            $db->query($update);
        }
    }

}
function change_value_custom($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        $valore = str_replace("_"," ",$value);
        $valore = strtolower($valore);
        $valore = ucwords($valore);
    }
    if($valore != 'PREVENTIVO_CUSTOM1' || $valore != 'CONFERMA_CUSTOM1'
        || $valore != 'PREVENTIVO_CUSTOM2' || $valore != 'CONFERMA_CUSTOM2'
        || $valore != 'PREVENTIVO_CUSTOM3' || $valore != 'CONFERMA_CUSTOM3'){

            switch($value){
                case 'PREVENTIVO_CUSTOM1':
                    $valore = 'Preventivo ';
                    $tipo   = 'custom1';
                break;
                case 'CONFERMA_CUSTOM1':
                    $valore = 'Conferma ';
                    $tipo   = 'custom1';
                break;
                case 'PREVENTIVO_CUSTOM2':
                    $valore = 'Preventivo ';
                    $tipo   = 'custom2';
                break;
                case 'CONFERMA_CUSTOM2':
                    $valore = 'Conferma ';
                    $tipo   = 'custom2';
                break;
                case 'PREVENTIVO_CUSTOM3':
                    $valore = 'Preventivo ';
                    $tipo   = 'custom3';
                break;
                case 'CONFERMA_CUSTOM3':
                    $valore = 'Conferma ';
                    $tipo   = 'custom3';
                break;
        
            }
            $db = Xcrud_db::get_instance();
            $query = 'SELECT TemplateName FROM hospitality_template_background WHERE idsito = '.$_SESSION['IDSITO'].' AND TemplateType = "'.$tipo.'"';
            $result = $db->query($query);
            $record = $db->row($result);

            $valore = $valore.$record['TemplateName'];
        }

    return $valore;
}
function check_no_disponibilita($value, $fieldname, $primary_key, $row, $xcrud){

    if($value==1){

        $db = Xcrud_db::get_instance();
        $query = 'SELECT DataOperazione FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.idsito = '.$_SESSION['IDSITO'].' AND hospitality_motivi_disdetta.IdRichiesta = '.$primary_key.' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $db->query($query);
        $record = $db->row($result);

        $data = explode(" ",$record['DataOperazione']);
        $data_tmp = explode("-",$data[0]);
        $new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];

        $valore = '<i class="icon-checkmark fa fa-minus-circle text-info" data-toogle="tooltip" data-html="true" title="Email di '.$row['hospitality_guest.TipoRichiesta'].' annullata, inviata il '.$new_data.'"></i>';
    }else{
        $valore = '';
    }
    return $valore;
}
function check_no_disponibilita_p($value, $fieldname, $primary_key, $row, $xcrud){

    if($value==1){

        $db = Xcrud_db::get_instance();
        $query = 'SELECT DataOperazione FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.idsito = '.$_SESSION['IDSITO'].' AND hospitality_motivi_disdetta.IdRichiesta = '.$primary_key.' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $db->query($query);
        $record = $db->row($result);

        $data = explode(" ",$record['DataOperazione']);
        $data_tmp = explode("-",$data[0]);
        $new_data = $data_tmp[2].'-'.$data_tmp[1].'-'.$data_tmp[0].' '.$data[1];

        $valore = '<i class="icon-checkmark fa fa-minus-circle text-info" data-toogle="tooltip" data-html="true" title="Email per preventivo annullato, inviata il '. $new_data.'"></i>';
    }else{
        $valore = '';
    }
    return $valore;
} 
function motivazione_conferme_annullate($value, $fieldname, $primary_key, $row, $xcrud)
{
        $db = Xcrud_db::get_instance();
        $query = 'SELECT hospitality_motivi_disdetta.* FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.IdRichiesta = '.$primary_key.' AND hospitality_motivi_disdetta.idsito = '.$_SESSION['IDSITO'].' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $db->query($query);
        $record = $db->row($result);

        $valore = '<small>'.$record['Motivo'].'<br>
                        '.(strlen($record['MotivoCustom'])<=30?
                            $record['MotivoCustom']:
                            substr($record['MotivoCustom'],0,30).'... <i class="fa fa-angle-down" id="more'.$primary_key.'" style="position:absolute;margin-top:10px;cursor:pointer;"></i>
                            <div id="textmore'.$primary_key.'" style="display:none">'.substr($record['MotivoCustom'],30,500).'</div>
                        ').'
                    </small>';
        $valore .= '<script>
                        $(document).ready(function(){
                            $("#more'.$primary_key.'").on("click",function(){
                                $("#textmore'.$primary_key.'").slideToggle("slow");
                            });
                        });
                    </script>';
    return $valore;
}
function si_no_annullate($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value == 0) {
        $valore = '<small align="center" class="badge bg-red">No</small>' ;
    }else{
        $db = Xcrud_db::get_instance();
        $query = 'SELECT hospitality_motivi_disdetta.* FROM hospitality_motivi_disdetta WHERE hospitality_motivi_disdetta.IdRichiesta = '.$primary_key.' AND hospitality_motivi_disdetta.idsito = '.$_SESSION['IDSITO'].' ORDER BY hospitality_motivi_disdetta.id DESC';
        $result = $db->query($query);
        $record = $db->row($result);
        $valore = '<small align="center" style="cursor:pointer" class="badge bg-green" data-toggle="tooltip" data-html="true" title="<div class=text-left>Motivo: '.$record['Motivo'].($record['MotivoCustom']!=''?'<br>'.$record['MotivoCustom']:'').'</div>">Si</small>' ;
    }
    return $valore;
}

function custom_oggetto_preventivo($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div id="oggetto_preventivo"><input type="text" class="xcrud-input form-control" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" maxlength="70" /></div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(\'#oggetto_preventivo input\').jMaxLength({maxLength: 70, showMaxLength: true, showTrunksCount: false});

                });
            </script>';
}

function custom_oggetto_conferma($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<div id="oggetto_conferma"><input type="text" class="xcrud-input form-control" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .'" maxlength="70" /></div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $(\'#oggetto_conferma input\').jMaxLength({maxLength: 70, showMaxLength: true, showTrunksCount: false});

                });
            </script>';
}

function textarea_input_custom($value, $fieldname, $primary_key, $row, $xcrud)
{

    $db = Xcrud_db::get_instance();
    $q = $db->query('SELECT * from hospitality_dizionario_lingua where id = '.$row['primary_key'].'');
    $rec = $db->row($q);

    if($rec['textarea'] == 1){

        return  '  <textarea id="TEXT'.$row['primary_key'].'" name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input xcrud-texteditor form-control editor-loaded" style="width:100%!important" >'
                .'    '.$value.' '
                .'  </textarea>  '
                .'  <script type="text/javascript">'
                .'      $(function(){ '
                .'         CKEDITOR.replace("TEXT'.$row['primary_key'].'");'
                .'         $(".textarea").wysihtml5(); '
                .'     });'
                .'  </script>'
                .'  <script type="text/javascript">'
                .'        CKEDITOR.config.toolbar = ['
                .'                       [\'Source\',\'-\',\'Maximize\'],[\'Format\',\'FontSize\'],'
                .'                       [\'Bold\',\'Italic\',\'Underline\',\'StrikeThrough\',\'-\',\'Cut\',\'Copy\',\'Paste\',\'PasteText\',\'PasteFromWord\',\'-\',\'Outdent\',\'Indent\'],'
                .'                       [\'NumberedList\',\'BulletedList\',\'-\',\'JustifyLeft\',\'JustifyCenter\',\'JustifyRight\',\'JustifyBlock\'],'
                .'                       [\'Table\',\'Link\',\'Image\']'
                .'                    ] ;'
                .'        CKEDITOR.config.autoGrow_onStartup = true;'
                .'        CKEDITOR.config.extraPlugins = \'autogrow\';'
                .'        CKEDITOR.config.autoGrow_minHeight = 200;'
                .'       CKEDITOR.config.autoGrow_maxHeight = 600;'
                .'        CKEDITOR.config.autoGrow_bottomSpace = 50; '
                .'  </script>';
    }else{
        return '<div id="oggetto_'.$row['primary_key'].'"><textarea name="'.$xcrud->fieldname_encode($fieldname).'" class="xcrud-input form-control" style="width:100%!important" >'.$value.'</textarea></div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(\'#oggetto_'.$row['primary_key'].' textarea\').jMaxLength({maxLength: 70, showMaxLength: true, showTrunksCount: false});

                    });
                </script>';
    }

}
function send_re($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendRE = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function nosend_re($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_guest SET SendRE = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function from_id_to_numero($value, $fieldname, $primary_key, $row, $xcrud)
{
    $db = Xcrud_db::get_instance();
    $query = 'SELECT NumeroPrenotazione FROM hospitality_guest WHERE Id = ' . $value;
    $result = $db->query($query);
    $record = $db->row($query);
    if($record['NumeroPrenotazione'] != ''){
        return '<small>'.$record['NumeroPrenotazione'].'</small>';
    }
    /*else{
        return '<small>Inserito nuovo record, quindi non esite chiave primaria!</small>';
    }*/

}
function CodiceCasuale($lunghezza=5){
    $caratteri_disponibili ="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $codice = "";
    for($i = 0; $i<$lunghezza; $i++){
        $codice = $codice.substr($caratteri_disponibili,rand(0,strlen($caratteri_disponibili)-1),1);
    }
    return $codice.'_'.date('Y');
}
function cod_input($value, $fieldname, $primary_key, $row, $xcrud)
{
    if($value ==''){
            return '<div class="input-prepend input-append">'
                . '<input type="text" name="'.$xcrud->fieldname_encode($fieldname).'" value="'.CodiceCasuale().'" class="xcrud-input form-control" />'
                . '</div>';
        }else{
            return '<div class="input-prepend input-append">'
                . '<input type="text" name="'.$xcrud->fieldname_encode($fieldname).'" value="'.$value.'" class="xcrud-input form-control" />'
                . '</div>';
        }
}
function abilita_bedzzlebooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_bedzzlebooking SET Abilitato = \'1\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function disabilita_bedzzlebooking($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE hospitality_bedzzlebooking SET Abilitato = \'0\' WHERE Id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function flag_bedzzlebooking($value, $fieldname, $primary_key, $row, $xcrud){
    if($value){
        return '<small style="white-space:nowrap;">'.$value.' &nbsp;<span class="text-red">Sync da Bedzzle</span></small>';
    }else{
        return '<small style="white-space:nowrap;" class="text-green">Impostato da QUOTO!</small>';
    }
}
function etichetta_preno_conf($value, $fieldname, $primary_key, $row, $xcrud){
    if($value=='Preventivo'){
        return '<small style="white-space:nowrap;" class="text-maroon">'.$value.'</small>';
    }else{
        return '<small style="white-space:nowrap;" class="text-green">'.$value.'</small>';
    }
}

function cambia_ordine_camere($value, $fieldname, $primary_key, $row, $xcrud){


        $db = Xcrud_db::get_instance();

        $db->query('SELECT Ordine,Id,idsito FROM hospitality_tipo_camere WHERE Id = '.$primary_key.' AND idsito = '.$value.'');
        $rw = $db->row();

        $nt = 50;

        for($i==1; $i<=$nt; $i++) {
            $link .= '<li><a href="https://'.$_SERVER['HTTP_HOST'].'/v2/cambia_ordine_camere/'.$primary_key.'/'.$value.'/'.$i.'">'.$i.'</a></li>';
            $bottone .= ($rw['Ordine']==$i?'<button type="button" class="btn btn-default">'.($i==''?'--':$i).'</button>':'');
        }


        $code = '
        <div class="btn-group">
            '.$bottone.'
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu" style="z-index:999999999!important">
                '.$link.'
            </ul>
        </div>';



    return $code;
}
function tipo_pagamento($value, $fieldname, $primary_key, $row, $xcrud)
{
	if(strstr($value,'Carta di Credito')) {
		$return_value = $value.' a garanzia <span style="padding-left:30px;"><small class="alert alert-danger  alert-default-profila  text-red text-center" style="white-space: nowrap;">Il modulo non rispetta le norme (bancarie) vigenti e non vi tutela! Questo metodo di pagamento è altamente sconsigliato dagli Istituti di credito dal Gennaio del 2020</small></span>';
	}
	else { 

		$return_value = $value;
	}

    return $return_value;
}

function num_bambini_eta_tooltip($value, $fieldname, $primary_key, $row, $xcrud)
{
    $db = Xcrud_db::get_instance();

    $db->query('SELECT NumeroBambini,Note FROM hospitality_guest WHERE Id = '.$primary_key);
    $rw = $db->row();

	if($rw['Note']) {
		$return_value = '<span style="cursor:pointer;" data-toggle="tooltip" title="'.$rw['Note'].'"><small>'.$rw['NumeroBambini'].'</small></span>';
	}else { 

		$return_value = $rw['NumeroBambini'];
	}

    return $return_value;
}
<?php
		$css = '
		<style>           
			.btn-primary:before{
				content: \'Invia Ticket - \';
			}
			.alert-default{
				background-color: #F6F6F6!important;
			}
			.alert {
				border: 1px solid #CCCCCC!important;
			}
		</style>'."\r\n";

		$xcrud_suiteweb->table('ticket');
		$xcrud_suiteweb->where('idsito =',IDSITO);
		$xcrud_suiteweb->where('idcat =',CATEGORIA_TICKET_QUOTO);
		$xcrud_suiteweb->order_by('data_invio','DESC');	

		//$xcrud_suiteweb->relation('idcat','ticket_cat','id','nome',array('id' => 26,'attivo' => 1,'visibile' => 0));
		$xcrud_suiteweb->relation('idsito','siti','idsito','web');

    	$xcrud_suiteweb->columns('data_invio,idcat,email_ticket,oggetto,messaggio,priorita,stato,letto', false);

		$xcrud_suiteweb->subselect('Risposta','SELECT CONCAT(idoperatore,"|",messaggio,"|",data) AS risposta FROM ticket_risp WHERE idticket = {id} LIMIT 1');
	    $xcrud_suiteweb->column_callback('Risposta','leggi_risposta');

	    $xcrud_suiteweb->column_callback('ticket.idcat','color_idcategory');


		$xcrud_suiteweb->column_pattern('data_invio'  , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('idcat'       , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('email_ticket', '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('oggetto'     , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('messaggio'   , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('priorita'    , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('stato'       , '<small>{value}</small>');
		$xcrud_suiteweb->column_pattern('letto'       , '<small>{value}</small>');  

		$xcrud_suiteweb->pass_default('data_invio',date('Y-m-d H:i:s'));
		$xcrud_suiteweb->change_type('idcat','select','',array(CATEGORIA_TICKET_QUOTO =>'Help Desk QUOTO!'));

		$xcrud_suiteweb->pass_default('email_ticket',EMAILHOTEL);

		$xcrud_suiteweb->validation_required('idcat');
		$xcrud_suiteweb->validation_required('oggetto');
		$xcrud_suiteweb->validation_required('messaggio');

		$xcrud_suiteweb->pass_var('stato','In Lavorazione','create');
		$xcrud_suiteweb->pass_var('idsito',IDSITO,'create');

    	$xcrud_suiteweb->fields('data_invio,priorita', false);
    	$xcrud_suiteweb->fields('stato', false, false, 'view');
    	$xcrud_suiteweb->fields('idcat,email_ticket,oggetto,messaggio', false);

		$xcrud_suiteweb->fields('Risposta', false, false, 'view');	

		$xcrud_suiteweb->label('data_invio','Data Ticket');
		$xcrud_suiteweb->label('idsito','Utente');
		$xcrud_suiteweb->label('priorita','Priorità');
		$xcrud_suiteweb->label('idcat','Settore interessato');
		$xcrud_suiteweb->label('oggetto','Oggetto');
		$xcrud_suiteweb->label('messaggio','Ticket');
		$xcrud_suiteweb->label('stato','Stato');
		$xcrud_suiteweb->label('letto','Letto');

		$xcrud_suiteweb->after_insert('send_mail_ticket');

		$xcrud_suiteweb->before_view('letto_ticket');

		$xcrud_suiteweb->change_type('letto','bool');

		$xcrud_suiteweb->modal('messaggio');

		$xcrud_suiteweb->highlight_row('letto','=',0,'#DCFFFF');

		$xcrud_suiteweb->highlight('priorita','=','Urgente','#FFCC00');

		$xcrud_suiteweb->highlight('stato','=','Chiuso','#FF0000');
		$xcrud_suiteweb->highlight('stato','=','In Lavorazione','#EEEE00');

		$xcrud_suiteweb->unset_title();
		$xcrud_suiteweb->unset_numbers();
		$xcrud_suiteweb->unset_print();
		$xcrud_suiteweb->unset_csv();
		$xcrud_suiteweb->unset_search();
		$xcrud_suiteweb->unset_remove();
		$xcrud_suiteweb->unset_edit();
		$xcrud_suiteweb->hide_button('save_new');

	    $numero = paginazione(IDSITO);
	    if(!isset($numero) || is_null($numero) || empty($numero)){
	            $numero = 30;
	    }
	    $numero2 = ($numero*2);
	    $numero3 = ($numero*3);
	    $xcrud_suiteweb->limit($numero);  
	    $xcrud_suiteweb->limit_list($numero.','.$numero2.','.$numero3.',all');          



		$js_script ='
		<script>
			$(document).ready(function(){
				$(".btn-success").html(\'<i class="fa fa-plus-circle"></i> Apri un Ticket\');
			})
			$(document).ajaxComplete(function(){
				$(".btn-success").html(\'<i class="fa fa-plus-circle"></i> Apri un Ticket\');
			})
	  </script>'."\r\n";
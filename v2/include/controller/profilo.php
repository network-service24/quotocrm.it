<?php

     $xcrud_suiteweb_suiteweb = Xcrud::get_instance();
     $xcrud_suiteweb_suiteweb->connection(DB_SUITEWEB_USER,DB_SUITEWEB_PASSWORD,DB_SUITEWEB_NAME,DB_SUITEWEB_HOST);
	 $xcrud_suiteweb->table('utenti');
	 $xcrud_suiteweb->join('idsito','siti','idsito');
	 $xcrud_suiteweb->join('idanagra','anagrafica','idanagra');
	 $xcrud_suiteweb->where('utenti.idutente',$_SESSION['utente']['idutente']);	

	 $xcrud_suiteweb->relation('siti.id_stato','stati','id_stato','nome_stato');
	 $xcrud_suiteweb->relation('siti.codice_regione','regioni','id_regione','nome_regione','','','',' ','','id_stato','siti.id_stato');
     $xcrud_suiteweb->relation('siti.codice_provincia','province','codice_provincia','sigla_provincia','','','',' ','','codice_regione','siti.codice_regione');
     $xcrud_suiteweb->relation('siti.codice_comune','comuni','codice_comune','nome_comune','','','','','','codice_provincia','siti.codice_provincia');

	 $xcrud_suiteweb->disabled('anagrafica.rag_soc','edit');
	 $xcrud_suiteweb->disabled('siti.web','edit');
	 $xcrud_suiteweb->disabled('utenti.username','edit');
	 $xcrud_suiteweb->disabled('utenti.password','edit');

     $xcrud_suiteweb->change_type('logo', 'image', '', array('url' => BASE_URL_SUITEWEB.'v2/uploads/loghi_siti/'));
     $xcrud_suiteweb->disabled('utenti.logo','edit');
	 $xcrud_suiteweb->fields('utenti.logo,
					anagrafica.rag_soc,
					siti.web,
					utenti.username,
					utenti.password,    				
    				siti.id_stato,
    				siti.codice_regione,
    				siti.codice_provincia,
				 	siti.codice_comune,
				 	siti.indirizzo,
				 	siti.cap,				 	
				 	siti.email,
				 	siti.tel,
				 	siti.cell,
				 	siti.fax', false);

     $xcrud_suiteweb->label('utenti.logo','Logo Struttura');
	 $xcrud_suiteweb->label('anagrafica.rag_soc','Ragione Sociale');
	 $xcrud_suiteweb->label('siti.web','Sito Internet');
	 $xcrud_suiteweb->label('siti.tel','Telefono');
	 $xcrud_suiteweb->label('siti.fax','Fax');
	 $xcrud_suiteweb->label('siti.cell','Cellulare');
	 $xcrud_suiteweb->label('siti.id_stato','Nazione');
	 $xcrud_suiteweb->label('siti.codice_regione','Regione');
	 $xcrud_suiteweb->label('siti.codice_provincia','Provincia');
	 $xcrud_suiteweb->label('siti.codice_comune','Comune');


     $xcrud_suiteweb->unset_title();
	 $xcrud_suiteweb->unset_add();
	 $xcrud_suiteweb->unset_view();
	 $xcrud_suiteweb->unset_remove();
	 $xcrud_suiteweb->unset_numbers();
	 $xcrud_suiteweb->unset_search();
	 $xcrud_suiteweb->unset_print();
	 $xcrud_suiteweb->unset_csv();
	 $xcrud_suiteweb->unset_pagination();
	 $xcrud_suiteweb->unset_limitlist();
	 $xcrud_suiteweb->hide_button('save_return');
	 $xcrud_suiteweb->hide_button('return');


	?>